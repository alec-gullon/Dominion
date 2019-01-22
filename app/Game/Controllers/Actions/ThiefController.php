<?php

namespace App\Game\Controllers\Actions;

class ThiefController extends ActionController {

    public function play() {
        if ($this->state->hasMoat()) {
            $this->nextStep('resolve-moat');
            return $this->inputOn();
        }
        $this->nextStep('reveal-cards');
    }

    public function resolveMoat($revealed) {
        if ($revealed) {
            return $this->revealMoat($revealed);
        }
        $this->nextStep('resolve-attack');
        $this->inputOff();
    }

    public function revealCards() {
        $card = $this->activePlayer()->unresolvedCard();
        $this->revealTopCard($this->secondaryPlayer());
        $this->revealTopCard($this->secondaryPlayer());

        $treasureCards = $this->secondaryPlayer()->getCardsOfType('revealed', 'treasure');

        if (count($treasureCards) === 2) {
            $this->nextStep('resolve-attack');
            return $this->inputOn();
        } else if (count($treasureCards) === 1) {
            $card->trashedCard = $treasureCards[0]->stub();
            $this->nextStep('gain-trashed-card');
            return $this->inputOn();
        }
        $this->moveCards('revealed', 'discard', 'all', $this->secondaryPlayer());
        $this->resolveCard();
    }

    public function resolveAttack($stub) {
        $card = $this->activePlayer()->unresolvedCard();
        $card->trashedCard = $stub;

        $this->nextStep('gain-trashed-card');
        $this->inputOn();
    }

    public function gainTrashedCard($choice) {
        $card = $this->activePlayer()->unresolvedCard();
        $trashedCard = $this->buildCard($card->trashedCard);

        if ($choice) {
            $this->activePlayer()->gainCard($card->trashedCard);
            $this->secondaryPlayer()->removeCardFrom($card->trashedCard, 'revealed');
            $this->addPlayerActionToLog(
                'puts the ' . $trashedCard->getName() . ' in ' . $this->activePlayer()->getName() . '\'s discard',
                $this->secondaryPlayer()
            );
        } else {
            $this->state->trashCard($card->trashedCard, 'revealed', $this->secondaryPlayer());
            $this->addPlayerActionToLog(
                'trashes the ' . $trashedCard->getName() . ' from their revealed', $this->secondaryPlayer()
            );
        }

        $this->discardRevealedCards($this->secondaryPlayer());

        $this->resolveCard();
    }

}