<?php

namespace App\Http\Controllers\Game\Actions;

class SpyController extends ActionController {

    public function play() {
        $this->activePlayer()->drawCards(1);
        $this->state->addActions(1);

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
            return $this->resolveCard();
        }
        if (!$activePlayer->canDrawCard()) {
            return $this->nextStep('reveal-opponent-card');
        }

        $activePlayer->revealTopCard();
        $this->nextStep('discard-card');
        return $this->inputOn();
    }

    public function discardCard($choice) {
        $card = $this->activePlayer()->getUnresolvedCard();

        if ($choice) {
            $this->activePlayer()->moveCards('revealed', 'discard');
        } else {
            $this->secondaryPlayer()->moveCardsOntoDeck('revealed');
        }

        if ($card->moatRevealed) {
            return $this->resolveCard();
        }
        $this->inputOff();
        return $this->nextStep('reveal-opponent-card');
    }

    public function revealOpponentCard() {
        $card = $this->activePlayer()->getUnresolvedCard();
        if (!$this->secondaryPlayer()->canDrawCard() && $card->moatRevealed) {
            return $this->resolveCard();
        }

        $this->secondaryPlayer()->revealTopCard();
        $this->nextStep('discard-opponent-card');
        return $this->inputOn();
    }

    public function discardOpponentCard($choice) {
        if ($choice) {
            $this->secondaryPlayer()->moveCards('revealed', 'discard');
        } else {
            $this->secondaryPlayer()->moveCardsOntoDeck('revealed');
        }
        $this->resolveCard();
    }

}