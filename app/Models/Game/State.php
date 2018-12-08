<?php

namespace App\Models\Game;

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

    private $activePlayerKey = 'alec';

    private $actions = 1;

    private $buys = 1;

    private $turn = 1;

    private $needPlayerInput = true;

    private $isResolved = false;

    private $phase = 'action';

    public function setPlayers($players) {
        $this->players = $players;
    }

    public function setPhase($phase) {
        $this->phase = $phase;
    }

    public function getPhase() {
        return $this->phase;
    }

    public function getBuys() {
        return $this->buys;
    }

    public function getKingdomCards() {
        return $this->kingdom;
    }

    public function setKingdom($kingdom) {
        $this->kingdom = $kingdom;
    }

    public function getActions() {
        return $this->actions;
    }

    public function getPlayerByKey($key) {
        foreach ($this->players as $player) {
            if ($key === $player->getId()) {
                return $player;
            }
        }
    }

    public function getActivePlayer() {
        foreach($this->players as $player) {
            if ($this->activePlayerKey === $player->getId()) {
                return $player;
            }
        }
    }

    public function getActivePlayerKey() {
        return $this->activePlayerKey;
    }

    public function getSecondaryPlayer() {
        foreach($this->players as $player) {
            if ($this->activePlayerKey !== $player->getId()) {
                return $player;
            }
        }
    }

    public function getSecondaryPlayerKey() {
        foreach($this->players as $player) {
            if ($this->activePlayerKey !== $player->getId()) {
                return $player->getId();
            }
        }
    }

    public function setActivePlayerKey($key) {
        $this->activePlayerKey = $key;
    }

    public function getCoins() {
        return $this->coins;
    }

    public function setCoins($coins) {
        $this->coins = $coins;
    }

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

    public function setBuys($buys) {
        $this->buys = $buys;
    }

    public function deductBuys($amount) {
        $this->buys = $this->buys - $amount;
    }

    public function gainBuys($amount) {
        $this->buys = $this->buys + $amount;
    }

    public function getTrash() {
        return $this->trash;
    }

    public function moveCardToPlayer($card, $where = 'discard', $playerKey = null) {
        if (null === $playerKey) {
            $playerKey = $this->getActivePlayerKey();
        }
        foreach ($this->players as $player) {
            if ($playerKey === $player->getId()) {
                $player->gainCard($card, $where);
            }
        }
        $this->kingdom[$card] = $this->kingdom[$card] - 1;
    }

    public function moveCardOntoDeck($card, $playerKey = null) {
        if (null === $playerKey) {
            $playerKey = $this->getActivePlayerKey();
        }
        foreach ($this->players as $player) {
            if ($playerKey === $player->getid()) {
                $player->gainCardOnDeck($card);
            }
        }
        $this->kingdom[$card] = $this->kingdom[$card] - 1;
    }

    public function advanceTurn() {
        $this->phase = 'action';
        $this->turn++;
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
        if ($emptyPiles >= 3) {
            return true;
        }
        return false;
    }

    public function trashCards($stubs) {
        foreach($stubs as $stub) {
            $this->trashCard($stub);
        }
    }

    public function trashCard($stub, $where = 'hand') {
        $this->trash[] = $stub;
        $this->getActivePlayer()->trashCard($stub, $where);
    }

    public function hasMoat() {
        return isset($this->kingdom['moat']);
    }

    public function togglePlayerInput($bool) {
        $this->needPlayerInput = $bool;
    }

    public function needPlayerInput() {
        return $this->needPlayerInput;
    }

    public function resolveGame() {
        $this->isResolved = true;
    }

    public function isResolved() {
        return $this->isResolved;
    }

    public function getTurn() {
        return $this->turn;
    }

}