<?php

namespace App\Game\Services\Effects;

class AddBuys extends Base {

    public function effect() {
        $this->state->addBuys($this->params['amount']);
        $this->description();
    }

    public function description() {
        $amount = $this->params['amount'];

        $entry = '.. ' . $this->activePlayerName() . ' gains';
        if ($amount === 1) {
            $entry .= ' a buy';
        } else {
            $entry .= ' ' . $this->numberMappings[$amount] . ' buys';
        }
        $this->addToLog($entry);
    }

}

