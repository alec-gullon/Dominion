<?php

namespace App\Game\Services\Effects;

class RevealMoat extends Base {

    public function description() {
        $this->addToLog('.. ' . $this->state->secondaryPlayer()->name() . ' reveals a Moat');
    }

}