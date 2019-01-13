<?php

namespace App\Game\Services\Effects;

class AddBuys extends Base {

    public function effect() {
        $amount = $this->params['amount'];
        $this->state->addBuys($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains a buy';
        } else {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' buys';
        }
        $this->addToLog($entry);
    }

}

