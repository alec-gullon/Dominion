<?php

namespace App\Game\Controllers\Actions;

class SpyController extends ActionController {

    public function play() {
        $this->drawCards(1);
        $this->addActions(1);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            $this->inputOn();
            return;
        }
        $this->nextStep('reveal-card');
    }

    public function resolveMoat($revealed) {
        $card = $this->activePlayer()->getUnresolvedCard();
        if ($revealed) {
            $card->moatRevealed = true;
        }
        $this->nextStep('reveal-card');
    }

    public function revealCard() {
        $activePlayer = $this->activePlayer();
        $card = $activePlayer->getUnresolvedCard();
        if (!$activePlayer->canDrawCard() && $card->moatRevealed) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has no cards to reveal');
            return $this->resolveCard();
        }
        if (!$activePlayer->canDrawCard()) {
            $this->addToLog('.. ' . $this->activePlayer()->getName() . ' has no cards to reveal');
            return $this->nextStep('reveal-opponent-card');
        }

        $activePlayer->revealTopCard();
        $this->describeRevealedCards();
        $this->nextStep('discard-card');
        return $this->inputOn();
    }

    public function discardCard($choice) {
        $card = $this->activePlayer()->getUnresolvedCard();
        $revealedCard = $this->activePlayer()->getRevealed()[0];

        if ($choice) {
            $this->activePlayer()->moveCards('revealed', 'discard');
            $this->addToLog($this->discardCardsDescription([$revealedCard->getStub()], $this->activePlayer()));
        } else {
            $this->activePlayer()->moveCardsOntoDeck('revealed');
            $this->addToLog('.. '
                . $this->activePlayer()->getName()
                . ' places the '
                . $revealedCard->getName()
                . ' on top of their deck'
            );
        }

        if ($card->moatRevealed) {
            return $this->resolveCard();
        }
        $this->inputOff();
        return $this->nextStep('reveal-opponent-card');
    }

    public function revealOpponentCard() {
        if (!$this->secondaryPlayer()->canDrawCard()) {
            $this->addToLog('.. ' . $this->secondaryPlayer()->getName() . ' has no cards to reveal');
            return $this->resolveCard();
        }

        $this->secondaryPlayer()->revealTopCard();
        $this->describeRevealedCards($this->secondaryPlayer());
        $this->nextStep('discard-opponent-card');
        return $this->inputOn();
    }

    public function discardOpponentCard($choice) {
        $revealedCard = $this->secondaryPlayer()->getRevealed()[0];
        if ($choice) {
            $this->secondaryPlayer()->moveCards('revealed', 'discard');
            $this->addToLog($this->discardCardsDescription([$revealedCard->getStub()], $this->secondaryPlayer()));
        } else {
            $this->secondaryPlayer()->moveCardsOntoDeck('revealed');
            $this->addToLog('.. '
                . $this->secondaryPlayer()->getName()
                . ' places the '
                . $revealedCard->getName()
                . ' on top of their deck'
            );
        }
        $this->resolveCard();
    }

}