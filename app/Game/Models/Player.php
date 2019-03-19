<?php

namespace App\Game\Models;

use App\Game\Factories\CardFactory;

/**
 * Class to represent the state of a Dominion Player
 */

class Player {

    /**
     * The id used to identify the player. Set on instantiation of the class
     *
     * @var string
     */
    public $id;

    /**
     * An optional name to use when referring to this player
     *
     * @var string
     */
    public $name;

    /**
     * The cards that the player has played
     *
     * @var array
     */
    public $played = [];

    /**
     * The cards in the player's hand
     *
     * @var array
     */
    public $hand = [];

    /**
     * The cards that the player has in their discard pile
     *
     * @var array
     */
    public $discard = [];

    /**
     * The cards that the player has in their deck. The topmost card is the first entry of the array,
     * i.e., $this->deck[0].
     *
     * @var array
     */
    public $deck = [];

    /**
     * The cards that the player has currently revealed due to a card effect
     *
     * @var array
     */
    public $revealed = [];

    /**
     * The cards that the player has set aside due to a card effect
     *
     * @var array
     */
    public $setAside = [];

    /**
     * Whether or not the player is a real player controlled by a user, or an artificial
     * intelligence
     *
     * @var bool
     */
    public $isAi;

    public function __construct($id, $name, $isAi = false) {
        $this->id = $id;
        $this->name = $name;
        $this->isAi = $isAi;
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

    /**
     * Whether or not the player has the given card in the given location.
     *
     * @param   string  $stub
     * @param   string  $where
     *
     * @return  bool
     */
    public function hasCard($stub, $where = 'hand') {
        foreach($this->$where as $card) {
            if ($card->stub === $stub) {
                return true;
            }
        }
        return false;
    }

    /**
     * Whether or not the player has any cards of the provided type in the given location
     *
     * @param   string  $type
     * @param   string  $from
     *
     * @return  bool
     */
    public function hasCardsOfType($type, $from = 'hand') {
        $cards = $this->getCardsOfType($from, $type);
        return (count($cards) > 0);
    }

    /**
     * Returns those cards that have the given type in the specified location
     *
     * @param   string  $from
     * @param   string  $type
     *
     * @return  array
     */
    public function getCardsOfType($from, $type) {
        $cards = [];
        foreach ($this->$from as $key => $card) {
            if ($card->hasType($type) || $type === 'all') {
                $cards[] = $card;
            }
        }
        return $cards;
    }

    /**
     * Returns true if the player has a card in play that is yet to be resolved
     *
     * @return bool
     */
    public function hasUnresolvedCard() {
        return ($this->unresolvedCard() !== null);
    }

    /**
     * Returns the next played card that needs to be resolved, or null if there is no such card
     *
     * @return mixed|null
     */
    public function unresolvedCard() {
        foreach ($this->played as $key => $card) {
            if (!$card->resolved) {
                return $card;
            }
        }
        return null;
    }

    /**
     * Return the next step that needs to be resolved on the player's first unresolved card, or null
     * otherwise
     *
     * @return null
     */
    public function getNextStep() {
        if (!$this->hasUnresolvedCard()) {
            return null;
        }
        $card = $this->unresolvedCard();
        return $card->stub . '/' . $card->nextStep;
    }

    /**
     * Returns the top card of the player's deck, or null otherwise
     *
     * @return mixed|null
     */
    public function topCard() {
        $this->createNewDeckIfNecessary();
        if (count($this->deck) === 0) {
            return null;
        }
        return $this->deck[0];
    }

    /**
     * The total number of victory points the player has in their deck
     *
     * @return int
     */
    public function score() {
        $numberOfCardsInDeck = count($this->deck);

        $cards = array_merge($this->hand, $this->played, $this->discard, $this->deck);

        $score = 0;
        foreach ($cards as $card) {
            $score += $card->points;
            if ($card->stub === 'gardens') {
                $score += $card->points($numberOfCardsInDeck);
            }
        }

        return $score;
    }

    public function totalCardsWithFeature($feature) {
        $cards = array_merge($this->hand, $this->played, $this->discard, $this->deck);

        $total = 0;
        foreach ($cards as $card) {
            if ($card->hasFeature($feature)) {
                $total++;
            }
        }
        return $total;
    }

    /**
     * Shuffles the player's deck
     */
    public function shuffleDeck() {
        shuffle($this->deck);
    }

    /**
     * Builds a fresh instance of the card corresponding to the $stub and places it on the player's deck
     *
     * @param   string      $stub
     */
    public function placeCardOnDeck($stub) {
        array_unshift($this->deck, CardFactory::build($stub));
    }

    /**
     * Takes the top card of the player's deck and moves it their revealed area
     */
    public function revealTopCard() {
        $this->moveCardFromTopOfDeck('revealed');
    }

    /**
     * Takes the top card of the player's deck and moves it to their set aside area
     */
    public function setAsideTopCard() {
        $this->moveCardFromTopOfDeck('setAside');
    }

    /**
     * Takes the top card of the player's deck and moves it to their hand
     */
    public function drawCard() {
        $this->moveCardFromTopOfDeck('hand');
    }

    /**
     * Moves the given $number of cards from the top of the player's deck to their hand
     *
     * @param   int         $number
     */
    public function drawCards($number) {
        for ($i = 1; $i <= $number; $i++) {
            $this->drawCard();
        }
    }

    /**
     * Looks in the player's hand and discards the first instance of a card with a stub matching $stub
     *
     * @param   string      $stub
     */
    public function discardCard($stub) {
        $this->moveCard($stub, 'hand', 'discard');
    }

    /**
     * Looks in the player's hand and discards as many card's that have a stub matching one
     * in the $stubs array. If there are multiple instance's of the same stub, discards cards up
     * to that amount, e.g., discard's up to two coppers if 'copper' appears twice in $stubs
     * array
     *
     * @param   array       $stubs
     */
    public function discardCards($stubs) {
        foreach($stubs as $stub) {
            $this->discardCard($stub);
        }
    }

    /**
     * Removes a card with a stub matching $stub from the player's hand and builds a fresh instance
     * of that card in the player's hand. Places this new instance after the first unresolved card,
     * to maintain card order when a card is played in response to another card's effect
     * (e.g., throne room)
     *
     * @param   string      $stub
     */
    public function playCard($stub) {
        $this->removeCardFrom($stub, 'hand');

        $card = CardFactory::build($stub);
        $position = $this->unresolvedCardIndex();
        array_splice($this->played, $position+1, 0, [$card]);
    }

    /**
     * Places a virtual copy of the card matching the given $stub in the player's played area. No
     * need to remove any card from the player's hand. Used when playing a Feast in response to a
     * Throne Room
     *
     * @param   string      $stub
     */
    public function playVirtualCard($stub) {
        $card = CardFactory::build($stub);
        $card->isVirtual = true;

        $position = $this->unresolvedCardIndex();
        array_splice($this->played, $position+1, 0, [$card]);
    }

    /**
     * Removes a card matching the given $stub from the provided $location
     *
     * @param   string      $stub
     * @param   string      $location
     */
    public function trashCard($stub, $location = 'hand') {
        $this->removeCardFrom($stub, $location);
    }

    /**
     * Adds a card corresponding to the given $stub to the provided $location
     *
     * @param   string      $stub
     * @param   string      $location
     */
    public function gainCard($stub, $location = 'discard') {
        $this->addCardTo($stub, $location);
    }

    /**
     * Moves all the card's that reside in the location designated by $from to the location
     * designated by $to. Examples of such locations include 'hand', 'deck', 'discard' and
     * so on
     *
     * @param   string      $from
     * @param   string      $to
     */
    public function moveCards($from, $to) {
        $this->moveCardsOfType($from, $to, 'all');
    }

    /**
     * Moves all the card's that have the specified $type from the location specified by $from
     * to the location specified by $to$. Examples: 'hand', 'deck', 'discard' and so on
     *
     * @param   string      $from
     * @param   string      $to
     * @param   string      $type
     */
    public function moveCardsOfType($from, $to, $type) {
        foreach($this->$from as $index => $card) {
            if ($card->hasType($type) || $type === 'all') {
                $this->$to[] = $card;
                unset($this->$from[$index]);
            }
        }
    }

    /**
     * Moves the first instance of the card specified by $stub that resides in the location designated
     * by $from and places it on top of the player' deck
     *
     * @param   string      $stub
     * @param   string      $location
     */
    public function moveCardOntoDeck($stub, $location) {
        $this->placeCardOnDeck($stub);
        $this->removeCardFrom($stub, $location);
    }

    /**
     * Finds the first instance of the card specified by $stub that resides in the location designated
     * bby $from and deletes it from this location
     *
     * @param   string      $stub
     * @param   string      $location
     */
    public function removeCardFrom($stub, $location) {
        foreach ($this->$location as $key => $card) {
            if ($card->stub === $stub) {
                unset($this->$location[$key]);
                $this->$location  = array_values($this->$location);
                return;
            }
        }
    }

    /**
     * Builds an instance of the card specified by $stub and adds it to the location designated by
     * $location
     *
     * @param   string      $stub
     * @param   string      $location
     */
    private function addCardTo($stub, $location) {
        $this->$location[] = CardFactory::build($stub);
    }

    /**
     * Resolves the first unresolved card in the player's played pile
     */
    public function resolveCard() {
        $this->unresolvedCard()->resolved = true;
    }

    /**
     * Resolves every card in the player's played pile
     */
    public function resolveAll() {
        foreach($this->played as $card) {
            $card->resolved = true;
        }
    }

    /**
     * Finds the first unresolved card in the player's played pile and sets its next step to be equal to
     * $step
     *
     * @param   string      $step
     *
     * @return  void
     */
    public function setNextStep($step) {
        foreach ($this->played as $card) {
            if (!$card->resolved) {
                return $card->nextStep = $step;
            }
        }
    }

    /**
     * Helper function to create a fresh deck by shuffling the player's discard, if this is necessary, for example
     * if access to the top card of the player's deck is required
     */
    private function createNewDeckIfNecessary() {
        if (count($this->deck) === 0) {
            $this->moveCards('discard', 'deck');
            $this->shuffleDeck();
        }
    }

    /**
     * Takes the top card of the player's deck and moves it to the location designated by $location, if
     * this is actually possible
     *
     * @param   string      $location
     */
    private function moveCardFromTopOfDeck($location) {
        $this->createNewDeckIfNecessary();
        if (count($this->deck) === 0) {
            return;
        }
        $this->moveCard($this->topCard()->stub, 'deck', $location);
    }

    /**
     * Moves the first instance of a card specified by $stub from the location designated by $from to the
     * location designated by $to
     *
     * @param   string        $stub
     * @param   string        $from
     * @param   string        $to
     */
    private function moveCard($stub, $from, $to) {
        $this->addCardTo($stub, $to);
        $this->removeCardFrom($stub, $from);
    }

    /**
     * Returns the index of the first unresolved card in the player's played area, or null otherwise
     *
     * @return  int|null
     */
    private function unresolvedCardIndex() {
        foreach ($this->played as $index => $card) {
            if (!$card->resolved) {
                return $index;
            }
        }
        return null;
    }

}