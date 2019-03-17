<?php

namespace App\Game\Helpers;

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
        return ($card->value() <= $state->coins && $state->phase === 'buy' && $state->buys >= 1);
    }

}