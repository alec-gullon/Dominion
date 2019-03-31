<?php

namespace App\Game\Helpers;

use App\Game\Factories\CardFactory;

/**
 * Helper class that provides some methods related to decisions that need to be made about
 * state when generating a view of the game
 */
class ViewHelper {

    /**
     * Returns true if the player can presently play an action card, due to being in the correct
     * phase and having the correct number of actions
     *
     * @param   \App\Game\Models\State  $state
     *
     * @return  bool
     */
    public static function canPlayAction($state) {
        return ($state->phase === 'action') && ($state->actions > 0);
    }

    /**
     * Returns true if the selected kingdom card should be marked as active due to it being the buy phase
     * and the player having enough resources to by the card
     *
     * @param   object                  $card
     * @param   \App\Game\Models\State   $state
     *
     * @return bool
     */
    public static function isKingdomCardActive($card, $state) {
        return (
            $card->value <= $state->coins &&
            $state->phase === 'buy' &&
            $state->buys >= 1 &&
            $state->kingdomCards[$card->stub] > 0
        );
    }

    public static function kingdomCardsByValue($state) {
        $cards = $state->kingdomCards;

        $cardsByValue = [];
        foreach ($cards as $stub => $amount) {
            $card = CardFactory::build($stub);
            if (!($card->hasType('action') && $card->stub !== 'gardens')) {
                continue;
            }

            $value = $card->value;
            if (!isset($cardsByValue[$value])) {
                $cardsByValue[$value] = [];
            }
            $cardsByValue[$value][] = $card;
        }

        return $cardsByValue;
    }

    public static function cardsWithValueLessThanOrEqualTo($state, $value, $type = 'all') {
        $cards = [];
        foreach ($state->kingdomCards as $stub => $amount) {
            $card = CardFactory::build($stub);
            if ($amount > 0 && $card->value <= $value) {
                if ($type === 'all' || $card->hasType($type)) {
                    $cards[] = $card;
                }
            }
        }
        return $cards;
    }

    public static function isActivePlayer($state, $player) {
        return ($state->activePlayer()->id === $player->id);
    }

}