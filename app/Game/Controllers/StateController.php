<?php

namespace App\Game\Controllers;

use App\Game\Factories\CardFactory;
use App\Game\Models\State;
use App\Game\Helpers\StringHelper;

/**
 * A base implementation of behaviour that any controller responsible for updating and changing
 * game state would want to have access to
 *
 * Most of these methods give access to the common "Card Effect" classes, which coordinate
 * changing the state and updating the in game log. For more bespoke effects, there are
 * various helper methods that provide access to various parts of the state
 */
class StateController {

    /**
     * The state that the controller is going to focus on modifying
     *
     * @var \App\Game\Models\State
     */
    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    /**
     * Helper method that grabs the active player from the state
     *
     * @return \App\Game\Models\Player
     */
    protected function activePlayer() {
        return $this->state->activePlayer();
    }

    /**
     * Helper method that grabs the secondary player from the state
     *
     * @return \App\Game\Models\Player
     */
    protected function secondaryPlayer() {
        return $this->state->secondaryPlayer();
    }

    /**
     * Adds the provided $entry to the state's log. Prepends the player name before the
     * provided entry. The input $indentation determines how many".."'s appear before the
     * entry: e.g.,
     *
     * "Alec played a Copper" vs.
     * ".. Alec gains a Village"
     *
     * @param   string                              $entry
     * @param   \App\Game\Models\Player|null        $player
     * @param   int                                 $indentation
     */
    protected function addToLog($entry, $player = null, $indentation = 1) {
        if ($player === null) {
            $player = $this->activePlayer();
        }
        $entry = StringHelper::createPlayerActionEntry($entry, $player, $indentation);
        $this->state->log->addEntry($entry);
        return;
    }

    /**
     * Instantiates the service given by $effectClass and then uses it to take care of an in game
     * card effect that is sufficiently common to warrant extraction. The $params argument
     * is passed to $effectClass. If $params includes reference to a player and this value is set
     * to null then the active player is inserted into $params
     *
     * @param   object      $effectClassAlias
     * @param   array       $params
     */
    protected function effect($effectClassAlias, $params = array()) {
        $effectClass = $this->buildEffectClass($effectClassAlias, $params);
        $effectClass->effect();
    }

    /**
     * Instantiates the service given by $effectClass and then uses it to describe an in game card
     * effect that is sufficiently common to warrant extraction. The $params argument is passed to
     * $effectClass. If $params includes reference to a player and this value is set to null then
     * the active player is inserted into $params
     *
     * @param   object      $effectClassAlias
     * @param   array       $params
     */
    protected function description($effectClassAlias, $params = array()) {
        $effectClass = $this->buildEffectClass($effectClassAlias, $params);
        $effectClass->description();
    }

    /**
     * Logs the fact that the active player has played the card represented by the $stub
     *
     * @param   string      $stub
     */
    protected function playCard($stub) {
        $this->effect('PlayCard', compact('stub'));
    }

    /**
     * Plays all the cards of a particular type from the player's hand
     *
     * @param   string      $type
     */
    protected function playCardsOfType($type) {
        $this->effect('PlayAllOfType', compact('type'));
    }

    /**
     * Adds the $amount of actions to the active player's current total
     *
     * @param   int         $amount
     */
    protected function addActions($amount) {
        $this->effect('AddActions', compact('amount'));
    }

    /**
     * Adds the $amount of buys to the active player's current total
     *
     * @param   int         $amount
     */
    protected function addBuys($amount) {
        $this->effect('AddBuys', compact('amount'));
    }

    /**
     * Adds the $amount of coins to the active player's current total
     *
     * @param   int         $amount
     */
    protected function addCoins($amount) {
        $this->effect('AddCoins', compact('amount'));
    }

    /**
     * Draws the given $amount of cards for the selected $player
     *
     * @param   int                             $amount
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function drawCards($amount, $player = null) {
        $this->effect('DrawCards', compact('player','amount'));
    }

    /**
     * Describes the event of the given $player drawing the given $amount of cards
     *
     * @param   int                             $amount
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function drawCardsDescription($amount, $player = null) {
        $this->description('DrawCards', compact('player', 'amount'));
    }

    /**
     * Discards the selected cards represented by $stubs from the selected $player's hand
     *
     * @param   array                           $stubs
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function discardCards($stubs, $player = null) {
        $this->effect('DiscardCards', compact('player', 'stubs'));
    }

    /**
     * Discards any cards the selected $player has revealed
     *
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function discardRevealedCards($player = null) {
        $this->effect('DiscardRevealedCards', compact('player'));
    }

    /**
     * Discards the active player's set aside cards
     */
    protected function discardSetAsideCards() {
        $this->effect('DiscardSetAsideCards');
    }

    /**
     * Trashes cards given by $stubs from the active player's hand
     *
     * @param   array       $stubs
     */
    protected function trashCards($stubs) {
        $this->effect('TrashCards', compact('stubs'));
    }

    /**
     * Describes the event of the active player trashing the cards represented by $stubs from
     * their hand
     *
     * @param   array       $stubs
     */
    protected function trashCardsDescription($stubs) {
        $this->description('TrashCards', compact('stubs'));
    }

    /**
     * Takes the card represented by $stub and moves it from the kingdom to the $location
     * corresponding to the selected $player, if such a card exists. If $location equals
     * 'deck', the card is placed on top of the player's deck
     *
     * @param   string                          $stub
     * @param   \App\Game\Models\Player|null    $player
     * @param   string                          $location
     */
    protected function gainCard($stub, $player = null, $location = 'discard') {
        $this->effect('GainCard', compact('stub', 'player', 'location'));
    }

    /**
     * Describes the cards that the player has currently revealed
     *
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function describeRevealedCards($player = null) {
        $this->description('DescribeRevealedCards', compact('player'));
    }

    /**
     * Describes the cards that the $player has in their hand
     *
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function describeHand($player = null) {
        $this->description('DescribeHand', compact('player'));
    }

    /**
     * Moves the cards from $from to $where, of the given $type and for the selected $player.
     * If $type equals 'all' all cards are moved from $from
     *
     * @param   string                          $from
     * @param   string                          $where
     * @param   string                          $type
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function moveCards($from, $where, $type = 'all', $player = null) {
        $this->effect('MoveCards', compact('from', 'where', 'type', 'player'));
    }

    /**
     * Takes the card represented by $stub and moves it from the player location specified by
     * $from onto the player's deck
     *
     * @param   string                          $from
     * @param   string                          $stub
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function moveCardOntoDeck($from, $stub, $player = null) {
        $this->effect('MoveCardOntoDeck', compact('from', 'stub', 'player'));
    }

    /**
     * Combines the two piles represented by $from and $to for the selected $player. E.g.,
     * a Chancellor putting deck into discard
     *
     * @param   string                          $from
     * @param   string                          $to
     * @param   \App\Game\Models\Player|null    $player
     */
    protected function combinePiles($from, $to, $player = null) {
        $this->effect('CombinePiles', compact('from', 'to', 'player'));
    }

    /**
     * Sets aside the top card of the active player
     */
    protected function setAsideTopCard() {
        $this->effect('SetAsideTopCard');
    }

    /**
     * Reveals the selected player's top card
     *
     * @param \App\Game\Models\Player|null    $player
     */
    protected function revealTopCard($player = null) {
        $this->effect('RevealTopCard', compact('player'));
    }

    /**
     * Buys the card represented by $stub and moves it into the player's kingdom
     *
     * @param   string      $stub
     */
    protected function buyCard($stub) {
        $this->effect('BuyCard', compact('stub'));
    }

    /**
     * Convenience method to build cards without requiring dozens of redundant use statements
     *
     * @param   string      $stub
     *
     * @return  object
     */
    protected function buildCard($stub) {
        return CardFactory::build($stub);
    }

    /**
     * Builds the Effect class represented by the $effectClassAlias and sets the parameters for
     * this instantiation. If the 'player' key is set to null in the $params argument, then
     * the active player is inserted in its place
     *
     * @param   string      $effectClassAlias
     * @param   array       $params
     *
     * @return  object
     */
    private function buildEffectClass($effectClassAlias, $params = array()) {
        if (array_key_exists('player', $params) && $params['player'] === null) {
            $params['player'] = $this->activePlayer();
        }
        $effectClassAlias = '\App\Game\Services\Effects\\' . $effectClassAlias;
        return new $effectClassAlias($this->state, $params);
    }

}