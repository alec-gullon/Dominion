<?php

namespace App\Game\Models;

use App\Game\Factories\CardFactory;

/**
 * Class to represent the overall state of a Dominion game in progress
 */
class State {

    /**
     * A description of the cards in the kingdom, i.e., cards in the game that do not belong
     * to a given player or have not been trashed. Represented as an array of key => value entries, where
     * the keys are stubs that represent a particular card and the values are the number remaining
     * in game e.g.,
     *
     * $this->kingdom = [
     *     'estate' => 8,
     *     'village' => 10
     * ]
     *
     * @var array
     */
    private $kingdomCards = [];

    /**
     * Array of cards that have been trashed by players during the game. Entries are instances of
     * \App\Game\Models\Cards models
     *
     * @var array
     */
    private $trash = [];

    /**
     * Array of players in the game. Entries are instances of \App\Game\Models\Player model
     *
     * @var array
     */
    private $players = [];

    /**
     * The id of the player that is currently taking their turn, also known as the "active player"
     *
     * @var string
     */
    private $activePlayerId;

    /**
     * The id of the player that is currently responsible for providing some form of input in response
     * to a card played by the active player. If no such data needs to be noted, this value is set
     * to null
     *
     * @var null|string
     */
    private $awaitingPlayerInputId = null;

    /**
     * The number of coins the current player has on their turn. Always a non-negative integer
     *
     * @var int
     */
    private $coins = 0;

    /**
     * The number of actions the current player has on their turn. Always a non-negative integer
     *
     * @var int
     */
    private $actions = 1;

    /**
     * The number of buys the current player has on their turn. Always a non-negative integer
     * @var int
     */
    private $buys = 1;

    /**
     * How many turns have been carried out so far in this game.
     *
     * @var int
     */
    private $turn = 1;

    /**
     * What phase we are at in the given turn. Should be either 'action' or 'buy'
     *
     * @var string
     */
    private $phase = 'action';

    /**
     * Set to true when a game has been fully resolved, all turns have been played and a winner
     * has been declared
     *
     * @var bool
     */
    private $isResolved = false;

    /**
     * The historical game log, updated when players take actions and things occur in response
     * to these actions
     *
     * @var \App\Game\Models\Log
     */
    private $log;

    public function __construct(Log $log) {
        $this->log = $log;
    }

    public function log() {
        return $this->log;
    }

    public function phase() {
        return $this->phase;
    }

    public function kingdomCards() {
        return $this->kingdomCards;
    }

    public function actions() {
        return $this->actions;
    }

    public function coins() {
        return $this->coins;
    }

    public function buys() {
        return $this->buys;
    }

    public function turn() {
        return $this->turn;
    }

    public function trash() {
        return $this->trash;
    }

    public function isResolved() {
        return $this->isResolved;
    }

    public function players() {
        return $this->players;
    }

    public function activePlayerId() {
        return $this->activePlayerId;
    }

    public function setPlayers($players) {
        $this->players = $players;
    }

    public function setPhase($phase) {
        $this->phase = $phase;
    }

    public function setKingdomCards($kingdomCards) {
        $this->kingdomCards = $kingdomCards;
    }

    public function setActivePlayerId($id) {
        $this->activePlayerId = $id;
    }

    public function setAwaitingPlayerInputId($id) {
        $this->awaitingPlayerInputId = $id;
    }

    /**
     * Gets the player who is currently carrying out their turn
     *
     * @return  \App\Game\Models\Player
     */
    public function activePlayer() {
        return $this->getPlayerById($this->activePlayerId);
    }

    /**
     * Gets the player who is currently not taking their turn
     *
     * @return  \App\Game\Models\Player
     */
    public function secondaryPlayer() {
        foreach($this->players as $player) {
            if ($this->activePlayerId !== $player->id) {
                return $player;
            }
        }
    }

    /**
     * Gets the player in the game whose id matches the supplied $id
     *
     * @param   string      $id
     *
     * @return  \App\Game\Models\Player
     */
    public function getPlayerById($id) {
        foreach ($this->players as $player) {
            if ($id === $player->id) {
                return $player;
            }
        }
    }

    /**
     * Determines whether or not the game would be declared finished once the current turn
     * is finished. A game is declared finished if the Province pile has been depleted or if
     * three non-Province piles have been depleted.
     *
     * @return  bool
     */
    public function checkGameOver() {
        if ($this->kingdomCards['province'] === 0) {
            return true;
        }
        $emptyPiles = 0;
        foreach ($this->kingdomCards as $count) {
            if ($count === 0) {
                $emptyPiles++;
            }
        }
        return ($emptyPiles >= 3);
    }

    /**
     * Returns true if there are any Moat cards in the game (even if there are none in the kingdom)
     *
     * @return bool
     */
    public function hasMoat() {
        return isset($this->kingdomCards['moat']);
    }

    /**
     * Checks to see if there are cards specified by $stub in the kingdom
     *
     * @param   string      $stub
     *
     * @return  bool
     */
    public function hasCard($stub) {
        return ($this->kingdomCards[$stub] > 0);
    }

    /**
     * Returns true if the state requires some player input before anything else can proceed
     *
     * @return  bool
     */
    public function needPlayerInput() {
        return ($this->awaitingPlayerInputId !== null);
    }

    public function remainingKingdomCards() {
        $remainingKingdomCards = [];
        foreach ($this->kingdomCards as $stub => $amount) {
            if ($amount > 0) {
                $remainingKingdomCards[$stub] = $amount;
            }
        }
        return $remainingKingdomCards;
    }

    /**
     * Returns how much the cheapest available card in the kingdom costs. If $type equals 'all', then
     * all cards are considered, otherwise just cards that have the type $type are considered. Returns null
     * if there are no cards of the given type
     *
     * @param string $type
     * @return int|mixed|null
     */
    public function cheapestCardAmount($type = 'all') {
        $cheapest = null;
        foreach ($this->kingdomCards as $stub => $amount) {
            $card = CardFactory::build($stub);
            if (    $amount > 0
                && ($type === 'all' || $card->hasType($type))
            ) {
                if ($cheapest === null) {
                    $cheapest = $card->value();
                }
                $cheapest = min($cheapest, $card->value());
            }
        }
        return $cheapest;
    }

    public function addCoins($coins) {
        $this->coins += $coins;
    }

    public function deductCoins($coins) {
        $this->coins -= $coins;
    }

    public function addActions($actions) {
        $this->actions += $actions;
    }

    public function deductActions($actions) {
        $this->actions -= $actions;
    }

    public function addBuys($buys) {
        $this->buys += $buys;
    }

    public function deductBuys($buys) {
        $this->buys -= $buys;
    }

    /**
     * Takes the card specified by $stub and moves it from its kingdom to the specified player. If
     * $playerId is set to the empty string, then defaults to moving this card to the active player,
     * otherwise the  id of a specific player should be provided. The $location parameter specifies
     * where the player should place the new card
     *
     * @param   string     $stub
     * @param   string     $location
     * @param   string     $playerId
     */
    public function moveCardToPlayer($stub, $location = 'discard', $playerId = '') {
        if ($this->kingdomCards[$stub] <= 0) {
            return;
        }
        if ('' === $playerId) {
            $playerId = $this->activePlayerId();
        }
        $player = $this->getPlayerById($playerId);
        $player->gainCard($stub, $location);
        $this->kingdomCards[$stub] = $this->kingdomCards[$stub] - 1;
    }

    /**
     * Sets various parameters of the state to their default values in preparation of a fresh
     * turn, gives the player a fresh hand and increments the turn counter
     */
    public function advanceTurn() {
        $this->phase = 'action';
        $this->actions = 1;
        $this->coins = 0;
        $this->buys = 1;

        $this->activePlayer()->moveCards('hand', 'discard');
        $this->activePlayer()->moveCards('played', 'discard');
        $this->activePlayer()->drawCards(5);

        $this->activePlayerId = $this->secondaryPlayer()->id;

        $this->turn++;
        $this->log->setCurrentTurn($this->turn);
    }

    /**
     * Adds cards specified by the $stubs array into the games central trash pile. $stubs should
     * be an array of card stubs. The location refers to where the active player should remove these
     * cards from
     *
     * @param   array       $stubs
     * @param   string      $location
     */
    public function trashCards($stubs, $location = 'hand') {
        foreach($stubs as $stub) {
            $this->trashCard($stub, $location);
        }
    }

    /**
     * Adds the card specified by the $stub string into the games central trash pile. The $location
     * input specifies where the specified $player should remove the same card from. If $player is
     * set to null, then the active player is used
     *
     * @param   string                      $stub
     * @param   string                      $location
     * @param   \App\Game\Models\Player     $player
     */
    public function trashCard($stub, $location = 'hand', $player = null) {
        if ($player === null) {
            $player = $this->activePlayer();
        }
        $this->trash[] = CardFactory::build($stub);
        $player->trashCard($stub, $location);
    }

    /**
     * Mark the game as being resolved
     */
    public function resolveGame() {
        $this->isResolved = true;
    }

    /**
     * Returns true if:
     *
     *      -   a card is being resolved and the game is waiting player input from an AI
     *          to proceed
     *      -   all cards have been resolved and the active player is an AI
     *
     * @return bool
     */
    public function aiPlaying() {
        $player = $this->activePlayer();
        if ($this->awaitingPlayerInputId) {
            $player = $this->getPlayerById($this->awaitingPlayerInputId);
        }
        return $player->isAi;
    }

}