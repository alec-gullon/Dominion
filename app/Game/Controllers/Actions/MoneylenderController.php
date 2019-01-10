<?php

namespace App\Game\Controllers\Actions;

class MoneylenderController extends ActionController {

    public function play() {
        $this->nextStep('trash-copper');
        $this->inputOn();
    }

    public function trashCopper($choice) {
        if ($choice) {
            $this->trashCards(['copper']);
            $this->addCoins(3);
        } else {
            $this->addPlayerActionToLog('does not trash anything');
        }
        $this->resolveCard();
    }

}