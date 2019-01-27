<?php

namespace App\Game\Controllers\Actions;

class LibraryController extends ActionController {

    public function play() {
        $this->setNextStep('draw-until-action-card');
    }

    public function drawUntilActionCard() {
        $activePlayer = $this->activePlayer();
        $libraryCard = $activePlayer->unresolvedCard();

        while ($this->canDrawCard()) {
            $card = $activePlayer->topCard();
            if ($card->hasType('action')) {
                $this->setNextStep('set-aside-card');
                return $this->inputOn();
            }
            $libraryCard->numberOfCardsDrawn++;
            $activePlayer->drawCards(1);
        }

        if ($this->nothingLeftToDraw()) {
            $this->addPlayerActionToLog('has nothing left to draw');
        }

        $this->resetNumberOfCardsDrawn();
        $this->discardSetAsideCards();
        $this->resolveCard();
    }

    public function setAsideCard($choice) {
        $libraryCard = $this->activePlayer()->unresolvedCard();

        if ($choice) {
            $this->resetNumberOfCardsDrawn();
            $this->setAsideTopCard();
        } else {
            $libraryCard->numberOfCardsDrawn++;
            $this->activePlayer()->drawCards(1);
        }
        $this->setNextStep('draw-until-action-card');
        $this->inputOff();
    }

    private function resetNumberOfCardsDrawn() {
        $libraryCard = $this->activePlayer()->unresolvedCard();
        if ($libraryCard->numberOfCardsDrawn > 0) {
            $this->drawCardsDescription($libraryCard->numberOfCardsDrawn);
            $libraryCard->numberOfCardsDrawn = 0;
        }
    }

    private function canDrawCard() {
        $activePlayer = $this->activePlayer();
        return ($activePlayer->numberOfCards() < 7 && $activePlayer->canDrawCard());
    }

    private function nothingLeftToDraw() {
        $activePlayer = $this->activePlayer();
        return ($activePlayer->numberOfCards() < 7 && !$activePlayer->canDrawCard());
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->unresolvedCard();
        $card->numberOfCardsDrawn = 0;
        parent::resolveCard();
    }

}