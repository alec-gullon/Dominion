<?php

namespace App\Game\Services\Effects;

class AddActions extends Base {

    public function effect() {
        $amount = $this->params['amount'];
        $this->state->addActions($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains an action';
        } else {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' actions';
        }
        $this->addToLog($entry);
    }

}