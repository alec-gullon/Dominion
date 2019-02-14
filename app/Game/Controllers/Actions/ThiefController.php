<?php

namespace App\Game\Controllers\Actions;

class ThiefController extends ActionController {

    public function play() {
        if ($this->state->hasMoat()) {
            $this->setNextStep('resolve-moat');
            return $this->inputOn();
        }
        $this->setNextStep('reveal-cards');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            $this->revealMoatDescription();
            return $this->resolveCard();
        }
        $this->setNextStep('resolve-attack');
        $this->inputOff();
    }

    public function revealCards() {
        $card = $this->activePlayer()->unresolvedCard();
        $this->revealTopCard($this->secondaryPlayer());
        $this->revealTopCard($this->secondaryPlayer());

        $treasureCards = $this->secondaryPlayer()->getCardsOfType('revealed', 'treasure');

        if (count($treasureCards) === 2) {
            $this->setNextStep('resolve-attack');
            return $this->inputOn();
        } else if (count($treasureCards) === 1) {
            $card->trashedCard = $treasureCards[0]->stub();
            $this->setNextStep('gain-trashed-card');
            return $this->inputOn();
        }
        $this->moveCards('revealed', 'discard', 'all', $this->secondaryPlayer());
        $this->resolveCard();
    }

    public function resolveAttack($stub) {
        $card = $this->activePlayer()->unresolvedCard();
        $card->trashedCard = $stub;

        $this->setNextStep('gain-trashed-card');
        $this->inputOn();
    }

    public function gainTrashedCard($choice) {
        $card = $this->activePlayer()->unresolvedCard();
        $trashedCard = $this->buildCard($card->trashedCard);

        if ($choice) {
            $this->activePlayer()->gainCard($card->trashedCard);
            $this->secondaryPlayer()->removeCardFrom($card->trashedCard, 'revealed');
            $this->addToLog(
                'puts the ' . $trashedCard->name() . ' in ' . $this->activePlayer()->name() . '\'s discard',
                $this->secondaryPlayer()
            );
        } else {
            $this->state->trashCard($card->trashedCard, 'revealed', $this->secondaryPlayer());
            $this->addToLog(
                'trashes the ' . $trashedCard->name() . ' from their revealed', $this->secondaryPlayer()
            );
        }

        $this->discardRevealedCards($this->secondaryPlayer());

        $card->trashedCard = null;
        $this->resolveCard();
    }

}