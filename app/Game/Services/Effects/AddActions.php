<?php

namespace App\Game\Services\Effects;

class AddActions extends Base {

    public function effect() {
        $this->state->addActions($this->params['amount']);
        $this->description();
    }

    public function description() {
        $amount = $this->params['amount'];

        $entry = '.. ' . $this->activePlayerName() . ' gains';
        if ($amount === 1) {
            $entry .= ' an action';
        } else {
            $entry .= ' ' . $this->numberMappings[$amount] . ' actions';
        }
        $this->addToLog($entry);
    }

}