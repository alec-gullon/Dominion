<?php

namespace App\Models\Game;

use App\Services\CardBuilder;

class State {

    private $players = array();

    private $kingdom = array(
        'copper' => 30,
        'silver' => 20,
        'gold' => 10,
        'estate' => 8,
        'duchy' => 8,
        'province' => 8,
        'village' => 10,
        'curse' => 10
    );

    private $trash = array();

    private $coins = 0;

    private $activePlayerId = 'alec';

    private $actions = 1;

    private $buys = 1;

    private $turn = 1;

    private $needPlayerInput = true;

    private $isResolved = false;

    private $phase = 'action';

    private $log;

    private $cardBuilder;

    public function __construct(Log $log, CardBuilder $cardBuilder) {
        $this->log = $log;
        $this->cardBuilder = $cardBuilder;
    }

    /**
     * GETTERS AND SETTERS
     */

    public function log() {
        return $this->log;
    }

    public function buys() {
        return $this->buys;
    }

    public function phase() {
        return $this->phase;
    }

    public function kingdomCards() {
        return $this->kingdom;
    }

    public function actions() {
        return $this->actions;
    }

    public function coins() {
        return $this->coins;
    }

    public function trash() {
        return $this->trash;
    }

    public function turn() {
        return $this->turn;
    }

    public function isResolved() {
        return $this->isResolved;
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

    public function setKingdom($kingdom) {
        $this->kingdom = $kingdom;
    }

    public function setActivePlayerId($id) {
        $this->activePlayerId = $id;
    }

    /**
     * QUERY METHODS
     */

    public function getPlayerById($id) {
        foreach ($this->players as $player) {
            if ($id === $player->getId()) {
                return $player;
            }
        }
    }

    public function activePlayer() {
        return $this->getPlayerById($this->activePlayerId);
    }

    public function secondaryPlayer() {
        foreach($this->players as $player) {
            if ($this->activePlayerId !== $player->getId()) {
                return $player;
            }
        }
    }

    public function isGameOver() {
        if ($this->kingdom['province'] === 0) {
            return true;
        }
        $emptyPiles = 0;
        foreach ($this->kingdom as $count) {
            if ($count === 0) {
                $emptyPiles++;
            }
        }
        return ($emptyPiles >= 3);
    }

    public function hasMoat() {
        return isset($this->kingdom['moat']);
    }

    public function needPlayerInput() {
        return $this->needPlayerInput;
    }

    public function cheapestCardAmount($type = 'all') {
        $cheapest = 1000;
        foreach ($this->kingdom as $stub => $amount) {
            $card = $this->cardBuilder->build($stub);
            if (    $amount > 0
                && ($type === 'all' || $card->hasType($type))
            ) {
                $cheapest = min($cheapest, $card->getValue());
            }
        }
        if ($cheapest === 1000) {
            $cheapest = null;
        }
        return $cheapest;
    }

    /**
     * ACTIVE METHODS
     */

    public function addCoins($coins) {
        $this->coins = $this->coins + $coins;
    }

    public function deductCoins($amount) {
        $this->coins = $this->coins - $amount;
    }

    public function addActions($actions) {
        $this->actions += $actions;
    }

    public function deductActions($actions) {
        $this->actions -= $actions;
    }

    public function addBuys($amount) {
        $this->buys = $this->buys + $amount;
    }

    public function deductBuys($amount) {
        $this->buys = $this->buys - $amount;
    }

    public function moveCardToPlayer($card, $where = 'discard', $playerId = null) {
        if ($this->kingdom[$card] <= 0) {
            return;
        }
        if (null === $playerId) {
            $playerId = $this->activePlayerId();
        }
        $player = $this->getPlayerById($playerId);
        $player->gainCard($card, $where);
        $this->kingdom[$card] = $this->kingdom[$card] - 1;
    }

    public function advanceTurn() {
        $this->phase = 'action';
        $this->turn++;
    }

    public function trashCards($stubs, $where = 'hand') {
        foreach($stubs as $stub) {
            $this->trashCard($stub, $where);
        }
    }

    public function trashCard($stub, $where = 'hand') {
        $this->trash[] = $stub;
        $this->activePlayer()->trashCard($stub, $where);
    }

    public function togglePlayerInput($bool) {
        $this->needPlayerInput = $bool;
    }

    public function resolveGame() {
        $this->isResolved = true;
    }

}