<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Smithy card when it has been played
 */
class SmithyController extends ActionController {

    /**
     * Adjusts game state in line with a Smithy card
     */
    public function play() {
        $this->drawCards(3);
        $this->resolveCard();
    }

}