<?php

namespace App\Game\Services\Effects;

class DrawCards extends Base {

    public function effect() {
        $amount = $this->params['amount'];
        $player = $this->params['player'];

        $remainingCards = $player->numberOfDrawableCards();
        $player->drawCards($amount);

        if ($remainingCards < $amount) {
            $this->params['amount'] = $remainingCards;
        }
        $this->description();
    }

    public function description() {
        $amount = $this->params['amount'];
        $player = $this->params['player'];

        $entry = '.. ' . $player->name();
        if ($amount === 0) {
            $entry .= ' draws nothing';
        } else if ($amount === 1) {
            $entry .= ' draws a card';
        } else {
            $entry .= ' draws ' . $this->numberMappings[$amount] . ' cards';
        }

        $this->addToLog($entry);
    }

}