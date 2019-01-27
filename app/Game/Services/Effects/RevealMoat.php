<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that describes revealing a moat
 */
class RevealMoat extends BaseEffect {

    public function description() {
        $this->addToLog( 'reveals a Moat', $this->secondaryPlayer());
    }

}