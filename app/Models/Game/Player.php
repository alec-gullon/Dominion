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

    public function getDiscard() {
        return $this->discard;
    }

    public function getPlayed() {
        return $this->played;
    }

    public function getSetAside() {
        return $this->setAside;
    }

    public function getRevealed() {
        return $this->revealed;
    }

    public function canDrawCard() {
        if (count($this->deck) + count($this->discard) > 0) {
            return true;
        }
        return false;
    }

    public function buildDefaultDeck() {
        $deck = [];
        for ($i = 1; $i <= 3; $i++) {
            $deck[] = $this->cardBuilder->build('estate');
        }
        for ($i = 1; $i <= 7; $i++) {
            $deck[] = $this->cardBuilder->build('copper');
        }
        $this->deck = $deck;
        $this->shuffleDeck();
        $this->drawCards(5);
    }

    public function hasCardsOfType($type) {
        foreach ($this->hand as $card) {
            if ($card->hasType($type)) {
                return true;
            }
        }
    }

    public function hasCard($stub, $where = 'hand') {
        foreach($this->$where as $card) {
            if ($card->getStub() === $stub) {
                return true;
            }
        }
        return false;
    }

    public function hasUnresolvedCard() {
        foreach ($this->played as $card) {
            if (!$card->isResolved()) {
                return true;
            }
        }
        return false;
    }

    public function getNextStep() {
        foreach ($this->played as $card) {
            if (!$card->isResolved()) {
                return $card->getNextStep();
            }
        }
    }

    public function getUnresolvedCard() {
        foreach ($this->played as $key => $card) {
            if (!$card->isResolved()) {
                return $card;
            }
        }
    }

    public function countHand() {
        return count($this->hand);
    }

    public function getTopCard() {
        $this->createNewDeckIfNecessary();
        return $this->deck[0];
    }

    public function score() {
        $this->moveCards('hand', 'deck');
        $this->moveCards('discard', 'deck');

        $score = 0;
        foreach($this->deck as $card) {
            $score += $card->getPoints();
        }
        return $score;
    }

    public function shuffleDeck() {
        shuffle($this->deck);
    }

    public function drawCards($number) {
        for ($i = 1; $i <= $number; $i++) {
            $this->drawCard();
        }
    }

    public function playCard($cardStub, $isVirtual = false) {
        $position = $this->getFirstUnresolvedCardKey();

        if ($isVirtual) {
            $card = $this->cardBuilder->build($cardStub);
            $card->markAsVirtual();
        } else {
            foreach ($this->hand as $key => $card) {
                if ($card->getStub() === $cardStub) {
                    unset($this->hand[$key]);
                    $this->hand = array_values($this->hand);
                    break;
                }
            }
        }
        array_splice($this->played, $position+1, 0, array($card));
    }

    public function gainCard($card, $where = 'discard') {
        $whereCopy = $this->$where;
        $whereCopy[] = $this->cardBuilder->build($card);
        $this->$where = $whereCopy;
    }

    public function gainCardOnDeck($stub) {
        array_unshift($this->deck, $this->cardBuilder->build($stub));
    }

    public function trashCard($stub) {
        $location = $this->hand;
        foreach ($location as $key => $card) {
            if ($card->getStub() === $stub) {
                unset($location[$key]);
                $this->hand = array_values($location);
                return;
            }
        }
    }

    public function discardCards($stubs) {
        foreach($stubs as $stub) {
            $this->discardCard($stub);
        }
    }

    public function discardCard($stub) {
        $location = $this->hand;
        foreach ($location as $key => $card) {
            if ($card->getStub() === $stub) {
                $this->discard[] = $card;
                unset($this->hand[$key]);
                $this->hand = array_values($this->hand);
                return;
            }
        }
    }

    public function revealTopCard() {
        $this->createNewDeckIfNecessary();
        $this->revealed[] = $this->deck[0];
        unset($this->deck[0]);
        $this->deck = array_values($this->deck);
    }

    public function moveCards($from, $to) {
        $this->moveCardsOfType($from, $to, 'all');
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

    public function moveCardsOfType($from, $to, $type) {
        $toCopy = $this->$to;
        $fromCopy = $this->$from;
        foreach($this->$from as $key => $card) {
            if ($card->hasType($type) || $type === 'all') {
                $toCopy[] = $card;
                unset($fromCopy[$key]);
            }
        }
        $this->$to = $toCopy;
        $this->$from = $fromCopy;
    }

    public function moveCardsOntoDeck($from) {
        foreach ($this->$from as $card) {
            $this->moveCardOntoDeck($from, $card->getStub());
        }
    }

    public function moveCardOntoDeck($from, $stub) {
        $fromCopy = $this->$from;
        foreach ($this->$from as $key => $card) {
            if ($card->getStub() === $stub) {
                $this->gainCardOnDeck($stub);
                unset($fromCopy[$key]);
                break;
            }
        }
        $this->$from = $fromCopy;
    }

    public function setAsideTopCard() {
        if(count($this->deck) + count($this->discard) === 0) {
            return;
        } else if (count($this->deck) === 0) {
            $this->moveCards('discard', 'deck');
            $this->shuffleDeck();
        }
        $this->setAside[] = $this->deck[0];
        unset($this->deck[0]);
        $this->deck = array_values($this->deck);
    }

    public function resolveCard() {
        foreach ($this->played as $card) {
            if (!$card->isResolved()) {
                $card->resolve();
                return;
            }
        }
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

    private function drawCard() {
        if(count($this->deck) + count($this->discard) === 0) {
            return;
        }
        $this->createNewDeckIfNecessary();
        $this->hand[] = $this->deck[0];
        unset($this->deck[0]);
        $this->deck = array_values($this->deck);
    }

    private function getFirstUnresolvedCardKey() {
        foreach ($this->played as $key => $card) {
            if (!$card->isResolved()) {
                return $key;
            }
        }
    }

    public function numberOfDrawableCards() {
        return count($this->deck) + count($this->discard);
    }

}