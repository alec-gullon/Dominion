<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Laboratory card when it has been played
 */
class LaboratoryController extends ActionController {

    /**
     * Adjusts game state in line with a Laboratory card
     */
    public function play() {
        $this->addActions(1);
        $this->drawCards(2);
        $this->resolveCard();
    }

}