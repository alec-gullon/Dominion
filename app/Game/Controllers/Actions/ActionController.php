<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected $numberMappings = ['no', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

    protected function inputOn() {
        $this->state->togglePlayerInput(true);
    }

    protected function inputOff() {
        $this->state->togglePlayerInput(false);
    }

    protected function activePlayer() {
        return $this->state->activePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->secondaryPlayer();
    }

    protected function nextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
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

    protected function moveCards($from, $where, $type = 'all') {
        $this->effect('MoveCards', compact('from', 'where', 'type'));
    }

    protected function moveCardOntoDeck($from, $card, $player = null) {
        $this->effect('MoveCardOntoDeck', compact('from', 'card', 'player'));
    }

    protected function combinePiles($from, $to) {
        $this->effect('CombinePiles', compact('from', 'to'));
    }

    protected function setAsideTopCard() {
        $this->effect('SetAsideTopCard');
    }

    protected function revealTopCard($player = null) {
        $this->effect('RevealTopCard', compact('player'));
    }

}