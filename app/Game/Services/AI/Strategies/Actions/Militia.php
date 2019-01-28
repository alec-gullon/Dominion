<?php

namespace App\Game\Services\AI\Strategies\Actions;

class Militia extends CardStrategy {

    public function resolveAttack() {
        $cardsToDiscard = [];
        $valuesInHand = [];
        $handCards = $this->state->secondaryPlayer()->hand();

        $numberOfCardsToDiscard = count($handCards) - 3;
        foreach ($handCards as $key => $card) {
            if (count($cardsToDiscard) === $numberOfCardsToDiscard) {
                break;
            }
            if ($card->hasType('victory')) {
                $cardsToDiscard[] = $key;
            }

            if (!in_array($card->value(), $valuesInHand)) {
                $valuesInHand[] = $card->value();
            }
        }

        sort($valuesInHand);

        foreach ($valuesInHand as $value) {
            if (count($cardsToDiscard) === $numberOfCardsToDiscard) {
                break;
            }
            foreach ($handCards as $key => $card) {
                if (count($cardsToDiscard) === $numberOfCardsToDiscard) {
                    break;
                }
                if (in_array($key, $cardsToDiscard)) {
                    continue;
                }
                if ($card->value() === $value) {
                    $cardsToDiscard[] = $key;
                }
            }
        }

        $stubsToDiscard = [];
        foreach ($cardsToDiscard as $key) {
            $stubsToDiscard[] = $handCards[$key]->stub();
        }

        return $stubsToDiscard;
    }

}