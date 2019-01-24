<?php

namespace App\Game\Services\Effects;

class CombinePiles extends Base {

    public function effect() {
        $this->description();
        $this->state->activePlayer()->moveCards(
            $this->params['from'],
            $this->params['to']
        );
    }

    public function description() {
        $entry = '.. '
            . $this->state->activePlayer()->name()
            . ' puts their '
            . $this->params['from']
            . ' into their '
            . $this->params['to'];

        $this->addToLog($entry);
    }

}