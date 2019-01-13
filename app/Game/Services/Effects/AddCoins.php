<?php

namespace App\Game\Services\Effects;

class AddCoins extends Base {

    public function effect() {
        $amount = $this->params['amount'];
        $this->state->addCoins($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains a coin';
        } else {
            $entry = '.. ' . $this->state->activePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' coins';
        }
        $this->addToLog($entry);
    }

}

