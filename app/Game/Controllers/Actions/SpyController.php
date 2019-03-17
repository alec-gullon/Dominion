<?php

namespace App\Game\Controllers\Actions;

class SpyController extends ActionController {

    public function play() {
        $this->drawCards(1);
        $this->addActions(1);

        if ($this->state->hasMoat()) {
            $this->setNextStep('resolve-moat');
            return $this->inputOn();
        }
        $this->setNextStep('reveal-card');
    }

    public function resolveMoat($revealed) {
        $card = $this->activePlayer()->unresolvedCard();
        if ($revealed) {
            $this->addToLog('reveals a Moat', $this->secondaryPlayer());
            $card->moatRevealed = true;
        }
        $this->setNextStep('reveal-card');
    }

    public function revealCard() {
        $activePlayer = $this->activePlayer();
        $card = $activePlayer->unresolvedCard();

        if (!$activePlayer->canDrawCard() && $card->moatRevealed) {
            $this->revealTopCard();
            return $this->resolveCard();
        }
        if (!$activePlayer->canDrawCard()) {
            $this->revealTopCard();
            return $this->setNextStep('reveal-opponent-card');
        }

        $this->revealTopCard();
        $this->setNextStep('discard-card');
        $this->inputOn();
    }

    public function discardCard($choice) {
        $card = $this->activePlayer()->unresolvedCard();
        $revealedCard = $this->activePlayer()->revealed[0]->stub;

        if ($choice) {
            $this->discardRevealedCards();
        } else {
            $this->moveCardOntoDeck('revealed', $revealedCard);
        }

        if ($card->moatRevealed) {
            return $this->resolveCard();
        }
        $this->inputOff();
        return $this->setNextStep('reveal-opponent-card');
    }

    public function revealOpponentCard() {
        $player = $this->secondaryPlayer();
        if (!$player->canDrawCard()) {
            $this->revealTopCard($player);
            return $this->resolveCard();
        }

        $this->revealTopCard($player);
        $this->setNextStep('discard-opponent-card');
        return $this->inputOn();
    }

    public function discardOpponentCard($choice) {
        $player = $this->secondaryPlayer();
        $revealedCard = $player->revealed[0]->stub;

        if ($choice) {
            $this->discardRevealedCards($player);
        } else {
            $this->moveCardOntoDeck('revealed', $revealedCard, $player);
        }
        $this->resolveCard();
    }

    protected function resolveCard() {
        $card = $this->activePlayer()->unresolvedCard();
        $card->moatRevealed = false;
        parent::resolveCard();
    }

}