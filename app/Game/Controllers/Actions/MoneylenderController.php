<?php

namespace App\Game\Controllers\Actions;

class MoneylenderController extends ActionController {

    public function play() {
        $this->setNextStep('trash-copper');
        $this->inputOn();
    }

    public function trashCopper($choice) {
        if ($choice) {
            $this->trashCards(['copper']);
            $this->addCoins(3);
        } else {
            $this->addToLog('does not trash anything');
        }
        $this->resolveCard();
    }

}