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

        if ($amount === 0) {
            $entry = '.. ' . $player->getName() . ' draws nothing';
        } else if ($amount === 1) {
            $entry = '.. ' . $player->getName() . ' draws a card';
        } else {
            $entry = '.. ' . $player->getName() . ' draws ' . $this->numberMappings[$amount] . ' cards';
        }
        $this->addToLog($entry);
    }

}