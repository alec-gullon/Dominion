<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

/**
 * A further extension of the StateController which adds some methods that the Controllers responsible for
 * resolving action cards need to have. In particular, helper methods to access the states next step, resolve
 * the card and flip input on and off are provided
 */
class ActionController extends StateController {

    /**
     * Sets the flag on the state that indicates it needs player input to an identifying id for one of
     * the players. If $active is true, then the active player id is set, otherwise the secondary player
     * id is set
     *
     * @param   bool    $active
     */
    protected function inputOn($active = true) {
        $id = $this->activePlayer()->id();
        if (!$active) {
            $id = $this->secondaryPlayer()->id();
        }
        $this->state->setAwaitingPlayerInputId($id);
    }

    /**
     * Removes the flag on the state indicating it needs player input so it can focus on resolving card
     * effects
     */
    protected function inputOff() {
        $this->state->setAwaitingPlayerInputId(null);
    }

    /**
     * Sets the next step on the active player's first unresolved card
     *
     * @param   string      $step
     */
    protected function setNextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    /**
     * Marks the active player's first unresolved card as being resolved. There are two possibilities when
     * a card has been resolved: all cards are resolved, or another one needs to be played, which does not require
     * any player input, so the player input flag is flipped off
     */
    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
    }

    /**
     * Records the fact that the player revealed a moat in the game log
     */
    protected function revealMoatDescription() {
        $this->description('RevealMoat');
    }

}