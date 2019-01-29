<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Witch card that has been played
 */
class WitchStrategy extends CardStrategy {

    /**
     * We need the method stubbed out so that the router can invoke it, but there are no
     * special considerations for this case
     *
     * @return bool
     */
    public function resolveMoat() {
        return parent::resolveMoat();
    }

}