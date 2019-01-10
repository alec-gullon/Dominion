<?php

namespace App\Game\Controllers\Actions;

class LibraryController extends ActionController {

    public function play() {
        $this->nextStep('reveal-cards');
    }

    public function revealCards() {
        $libraryCard = $this->activePlayer()->getUnresolvedCard();

        $activePlayer = $this->activePlayer();
        while ($activePlayer->countHand() < 7 && $activePlayer->canDrawCard()) {
            $card = $activePlayer->getTopCard();
            if ($card->hasType('action')) {
                $this->nextStep('set-aside-card');
                $this->inputOn();
                return;
            }
            $libraryCard->numberOfCardsDrawn++;
            $activePlayer->drawCards(1);
        }

        if ($activePlayer->countHand() < 7 && !$activePlayer->canDrawCard()) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has nothing left to draw');
        }

        $this->resetNumberOfCardsDrawn();
        $this->discardSetAsideCards();
        $this->resolveCard();
    }

    public function setAsideCard($choice) {
        $libraryCard = $this->activePlayer()->getUnresolvedCard();

        if ($choice) {
            $card = $this->activePlayer()->getTopCard();
            $this->resetNumberOfCardsDrawn();
            $this->addToLog('.. Alec sets aside ' . $card->nameWithArticlePrefix());
            $this->activePlayer()->setAsideTopCard();
        } else {
            $libraryCard->numberOfCardsDrawn++;
            $this->activePlayer()->drawCards(1);
        }
        $this->nextStep('reveal-cards');
        $this->inputOff();
    }

    private function resetNumberOfCardsDrawn() {
        $libraryCard = $this->activePlayer()->getUnresolvedCard();
        if ($libraryCard->numberOfCardsDrawn > 0) {
            $this->drawCardsDescription($libraryCard->numberOfCardsDrawn);
            $libraryCard->numberOfCardsDrawn = 0;
        }
    }

}