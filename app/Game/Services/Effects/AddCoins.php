<?php

namespace App\Game\Services\Effects;

class AddCoins extends Base {

    public function effect() {
        $this->state->addCoins($this->params['amount']);
        $this->description();
    }

    public function description() {
        $amount = $this->params['amount'];

        $entry = '.. ' . $this->activePlayerName() . ' gains';
        if ($amount === 1) {
            $entry .= ' a coin';
        } else {
            $entry .= ' ' . $this->numberMappings[$amount] . ' coins';
        }
        $this->addToLog($entry);
    }

}

