<?php

namespace App\Game\Controllers\Actions;

class SpyController extends ActionController {

    public function play() {
        $this->drawCards(1);
        $this->addActions(1);

        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn();
        }
        $this->nextStep('reveal-card');
    }

    public function resolveMoat($revealed) {
        $card = $this->activePlayer()->getUnresolvedCard();
        if ($revealed) {
            $this->addPlayerActionToLog('reveals a Moat', $this->secondaryPlayer());
            $card->moatRevealed = true;
        }
        $this->nextStep('reveal-card');
    }

    public function revealCard() {
        $activePlayer = $this->activePlayer();
        $card = $activePlayer->getUnresolvedCard();

        if (!$activePlayer->canDrawCard() && $card->moatRevealed) {
            $this->revealTopCard();
            return $this->resolveCard();
        }
        if (!$activePlayer->canDrawCard()) {
            $this->revealTopCard();
            return $this->nextStep('reveal-opponent-card');
        }

        $this->revealTopCard();
        $this->nextStep('discard-card');
        $this->inputOn();
    }

    public function discardCard($choice) {
        $card = $this->activePlayer()->getUnresolvedCard();
        $revealedCard = $this->activePlayer()->getRevealed()[0]->getStub();

        if ($choice) {
            $this->discardRevealedCards();
        } else {
            $this->moveCardOntoDeck('revealed', $revealedCard);
        }

        if ($card->moatRevealed) {
            return $this->resolveCard();
        }
        $this->inputOff();
        return $this->nextStep('reveal-opponent-card');
    }

    public function revealOpponentCard() {
        $player = $this->secondaryPlayer();
        if (!$player->canDrawCard()) {
            $this->revealTopCard($player);
            return $this->resolveCard();
        }

        $this->revealTopCard($player);
        $this->nextStep('discard-opponent-card');
        return $this->inputOn();
    }

    public function discardOpponentCard($choice) {
        $player = $this->secondaryPlayer();
        $revealedCard = $player->getRevealed()[0]->getStub();

        if ($choice) {
            $this->discardRevealedCards($player);
        } else {
            $this->moveCardOntoDeck('revealed', $revealedCard, $player);
        }
        $this->resolveCard();
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->getUnresolvedCard();
        $card->moatRevealed = false;
        parent::resolveCard();
    }

}