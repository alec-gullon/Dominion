<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected function inputOn() {
        $this->state->togglePlayerInput(true);
    }

    protected function inputOff() {
        $this->state->togglePlayerInput(false);
    }

    protected function activePlayer() {
        return $this->state->getActivePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->getSecondaryPlayer();
    }

    protected function nextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
    }

    protected function addActions($amount) {
        $this->state->addActions($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains an action';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains ' . $amount . ' actions';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function drawCards($amount) {
        $remainingCards = $this->activePlayer()->numberOfDrawableCards();
        $this->activePlayer()->drawCards($amount);

        if ($remainingCards === 0) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws nothing';
        } else if ($remainingCards === 1 || $amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws a card';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws ' . $amount . ' cards';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function describeRevealedCards() {
        $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' reveals';

        $revealedCards = $this->state->getActivePlayer()->getRevealed();
        for ($i = 0; $i < count($revealedCards); $i++) {
            if ($i === count($revealedCards) - 1) {
                $entry .= ' and';
            }
            $entry .= ' ' . $revealedCards[$i]->nameWithArticlePrefix();
            if ($i < count($revealedCards) - 2) {
                $entry .= ',';
            }
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function moveCardsOfType($from, $where, $type) {
        $cardsToMove = $this->state->getActivePlayer()->getCardsOfType($from, $type);

        $entry = '.. ' . $this->state->getActivePlayer()->getName();
        if (count($cardsToMove) === 0) {
            $entry .= ' does not put anything';
        } else {
            $entry .= ' puts';
        }
        for ($i = 0; $i < count($cardsToMove); $i++) {
            if ($i === count($cardsToMove) - 1 && $i !== 0) {
                $entry .= ' and';
            }
            $entry .= ' ' . $cardsToMove[$i]->nameWithArticlePrefix();
            if ($i < count($cardsToMove) - 2) {
                $entry .= ',';
            }
        }
        $entry .= ' into their ' . $where;
        $this->state->getLog()->addEntry($entry);

        $this->activePlayer()->moveCardsOfType($from, $where, $type);
    }

    protected function moveCards($from, $where) {
        $this->moveCardsOfType($from, $where, 'all');
    }

    public function addToLog($entry) {
        $this->state->getLog()->addEntry($entry);
    }

}