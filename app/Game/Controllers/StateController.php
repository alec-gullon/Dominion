<?php

namespace App\Game\Controllers;

use App\Models\Game\State;
use App\Services\CardBuilder;

class StateController {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    protected function activePlayer() {
        return $this->state->activePlayer();
    }

    protected function addToLog($entry) {
        $this->state->log()->addEntry($entry);
    }

    protected function addPlayerActionToLog($log, $player = null) {
        if ($player === null) {
            $player = $this->activePlayer();
        }
        $this->addToLog('.. ' . $player->getName() . ' ' . $log);
    }

    protected function effect($effectClass, $params = array()) {
        if (array_key_exists('player', $params) && $params['player'] === null) {
            $params['player'] = $this->activePlayer();
        }
        $effectClass = '\App\Game\Services\Effects\\' . $effectClass;
        $effectClass = new $effectClass($this->state, $this->cardBuilder, $params);
        $effectClass->effect();
    }

    protected function description($effectClass, $params = array()) {
        if (array_key_exists('player', $params) && $params['player'] === null) {
            $params['player'] = $this->activePlayer();
        }
        $effectClass = '\App\Game\Services\Effects\\' . $effectClass;
        $effectClass = new $effectClass($this->state, $this->cardBuilder, $params);
        $effectClass->description();
    }

    protected function revealMoat() {
        $this->addPlayerActionToLog('reveals a Moat', $this->secondaryPlayer());
        $this->resolveCard();
    }

    protected function addActions($amount) {
        $this->effect('AddActions', compact('amount'));
    }

    protected function addBuys($amount) {
        $this->effect('AddBuys', compact('amount'));
    }

    protected function addCoins($amount) {
        $this->effect('AddCoins', compact('amount'));
    }

    protected function drawCards($amount, $player = null) {
        $this->effect('DrawCards', compact('player','amount'));
    }

    protected function drawCardsDescription($amount, $player = null) {
        $this->description('DrawCards', compact('player', 'amount'));
    }

    protected function discardCards($cards, $player = null) {
        $this->effect('DiscardCards', compact('player', 'cards'));
    }

    protected function discardRevealedCards($player = null) {
        $this->effect('DiscardRevealedCards', compact('player'));
    }

    protected function discardSetAsideCards() {
        $this->effect('DiscardSetAsideCards');
    }

    protected function trashCards($cards) {
        $this->effect('TrashCards', compact('cards'));
    }

    protected function trashCardsDescription($cards) {
        $this->description('TrashCards', compact('cards'));
    }

    protected function gainCard($card, $player = null, $location = 'discard') {
        $this->effect('GainCard', compact('card', 'player', 'location'));
    }

    protected function describeRevealedCards($player = null) {
        $this->description('DescribeRevealedCards', compact('player'));
    }

    protected function describeHand($player = null) {
        $this->description('DescribeHand', compact('player'));
    }

    protected function moveCards($from, $where, $type = 'all', $player = null) {
        $this->effect('MoveCards', compact('from', 'where', 'type', 'player'));
    }

    protected function moveCardOntoDeck($from, $card, $player = null) {
        $this->effect('MoveCardOntoDeck', compact('from', 'card', 'player'));
    }

    protected function combinePiles($from, $to, $player = null) {
        $this->effect('CombinePiles', compact('from', 'to', 'player'));
    }

    protected function setAsideTopCard() {
        $this->effect('SetAsideTopCard');
    }

    protected function revealTopCard($player = null) {
        $this->effect('RevealTopCard', compact('player'));
    }

    protected function buyCard($card) {
        $this->effect('BuyCard', compact('card'));
    }

}