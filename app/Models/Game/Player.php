<?php

namespace App\Models\Game;

use App\Services\CardBuilder;

class Player {

    private $played = array();

    private $hand = array();

    private $discard = array();

    private $deck = array();

    private $revealed = array();

    private $setAside = array();

    private $id;

    private $name;

    private $cardBuilder;

    public function __construct($id, CardBuilder $cardBuilder) {
        $this->id = $id;
        $this->cardBuilder = $cardBuilder;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getDeck() {
        return $this->deck;
    }

    public function getHand() {
        return $this->hand;
    }

    public function setDeck($deck) {
        $this->deck = $deck;
    }

    public function setHand($hand) {
        $this->hand = $hand;
    }

    public function setDiscard($discard) {
        $this->discard = $discard;
    }

    public function getDiscard() {
        return $this->discard;
    }

    public function getPlayed() {
        return $this->played;
    }

    public function getSetAside() {
        return $this->setAside;
    }

    public function revealed() {
        return $this->revealed;
    }

    public function numberOfDrawableCards() {
        return count($this->deck) + count($this->discard);
    }

    public function hasEmptyHand() {
        return ($this->numberOfCards() === 0);
    }

    public function numberOfCards() {
        return count($this->hand);
    }

    public function canDrawCard() {
        return ($this->numberOfDrawableCards() > 0);
    }

    public function hasCard($stub, $where = 'hand') {
        foreach($this->$where as $card) {
            if ($card->stub() === $stub) {
                return true;
            }
        }
        return false;
    }

    public function hasCardsOfType($type, $from = 'hand') {
        $cards = $this->getCardsOfType($from, $type);
        return (count($cards) > 0);
    }

    public function getCards($from) {
        return $this->getCardsOfType($from, 'all');
    }

    public function getCardsOfType($from, $type) {
        $cards = [];
        foreach ($this->$from as $key => $card) {
            if ($card->hasType($type) || $type === 'all') {
                $cards[] = $card;
            }
        }
        return $cards;
    }

    public function hasUnresolvedCard() {
        return ($this->unresolvedCard() !== null);
    }

    public function unresolvedCard() {
        foreach ($this->played as $key => $card) {
            if (!$card->isResolved()) {
                return $card;
            }
        }
        return null;
    }

    private function unresolvedCardIndex() {
        foreach ($this->played as $index => $card) {
            if (!$card->isResolved()) {
                return $index;
            }
        }
    }

    public function getNextStep() {
        if (!$this->hasUnresolvedCard()) {
            return null;
        }
        $card = $this->unresolvedCard();
        return $card->getNextStep();
    }

    public function topCard() {
        $this->createNewDeckIfNecessary();
        if (count($this->deck) === 0) {
            return null;
        }
        return $this->deck[0];
    }

    public function score() {
        $cards = array_merge($this->hand, $this->played, $this->discard);

        $score = 0;
        foreach ($cards as $card) {
            $score += $card->getPoints();
        }
        return $score;
    }

    public function shuffleDeck() {
        shuffle($this->deck);
    }

    public function placeCardOnDeck($stub) {
        array_unshift($this->deck, $this->cardBuilder->build($stub));
    }

    public function revealTopCard() {
        $this->moveCardFromTopOfDeck('revealed');
    }

    public function setAsideTopCard() {
        $this->moveCardFromTopOfDeck('setAside');
    }

    public function drawCards($number) {
        for ($i = 1; $i <= $number; $i++) {
            $this->drawCard();
        }
    }

    public function drawCard() {
        $this->moveCardFromTopOfDeck('hand');
    }

    public function discardCards($stubs) {
        foreach($stubs as $stub) {
            $this->discardCard($stub);
        }
    }

    public function discardCard($stub) {
        $this->moveCard('hand', 'discard', $stub);
    }

    public function playCard($stub) {
        $this->removeCardFrom($stub, 'hand');

        $card = $this->cardBuilder->build($stub);
        $position = $this->unresolvedCardIndex();
        array_splice($this->played, $position+1, 0, array($card));
    }

    public function playVirtualCard($stub) {
        $card = $this->cardBuilder->build($stub);
        $card->markAsVirtual();

        $position = $this->unresolvedCardIndex();
        array_splice($this->played, $position+1, 0, array($card));
    }

    public function trashCard($stub, $location) {
        $this->removeCardFrom($stub, $location);
    }

    public function gainCard($card, $where = 'discard') {
        $this->addCardTo($card, $where);
    }

    public function moveCards($from, $to) {
        $this->moveCardsOfType($from, $to, 'all');
    }

    public function moveCardsOfType($from, $to, $type) {
        foreach($this->$from as $index => $card) {
            if ($card->hasType($type) || $type === 'all') {
                $this->$to[] = $card;
                unset($this->$from[$index]);
            }
        }
    }

    public function moveCardOntoDeck($from, $stub) {
        $this->placeCardOnDeck($stub);
        $this->removeCardFrom($stub, $from);
    }

    public function resolveCard() {
        $this->unresolvedCard()->resolve();

    }

    public function resolveAll() {
        foreach($this->played as $card) {
            $card->resolve();
        }
    }

    public function setNextStep($step) {
        foreach ($this->played as $card) {
            if (!$card->isResolved()) {
                $card->setNextStep($step);
                return;
            }
        }
    }

    private function createNewDeckIfNecessary() {
        if (count($this->deck) === 0) {
            $this->moveCards('discard', 'deck');
            $this->shuffleDeck();
        }
    }

    private function moveCardFromTopOfDeck($to) {
        $this->createNewDeckIfNecessary();
        if (count($this->deck) === 0) {
            return null;
        }
        $this->moveCard('deck', $to, $this->topCard()->stub());
    }

    private function moveCard($from, $to, $stub) {
        $this->addCardTo($stub, $to);
        $this->removeCardFrom($stub, $from);
    }

    private function addCardTo($stub, $location) {
        $this->$location[] = $this->cardBuilder->build($stub);
    }

    public function removeCardFrom($stub, $from) {
        foreach ($this->$from as $key => $card) {
            if ($card->stub() === $stub) {
                unset($this->$from[$key]);
                $this->$from  = array_values($this->$from);
                return;
            }
        }
    }

}