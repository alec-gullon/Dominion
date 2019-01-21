<?php

namespace App\Game\Services\AI\Detectives;

class Thief extends CardDetective {

    public function resolveMoat() {
        return [
            'action' => 'provide-input',
            'input' => true
        ];
    }

    public function resolveAttack() {
        $revealedCards = $this->state->secondaryPlayer()->revealed();

        $stub = $revealedCards[0]->stub();
        if ($revealedCards[0]->getValue() < $revealedCards[1]->getValue()) {
            $stub = $revealedCards[1]->stub();
        }

        return [
            'action' => 'provide-input',
            'input' => $stub
        ];
    }

    public function gainTrashedCard() {
        $thiefCard = $this->state->activePlayer()->unresolvedCard();

        $card = $this->cardBuilder->build($thiefCard->trashedCard);

        $gainCard = false;
        if ($card->getValue() >= 3) {
            $gainCard = true;
        }

        return [
            'action' => 'provide-input',
            'input' => $gainCard
        ];
    }

}