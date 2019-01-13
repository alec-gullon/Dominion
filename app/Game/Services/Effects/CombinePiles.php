<?php

namespace App\Game\Services\Effects;

class CombinePiles extends Base {

    public function effect() {
        $this->description();
        $this->state->getActivePlayer()->moveCards(
            $this->params['from'],
            $this->params['to']
        );
    }

    public function description() {
        $from = $this->params['from'];
        $where = $this->params['to'];

        $entry = '.. '
            . $this->state->getActivePlayer()->getName()
            . ' puts their '
            . $from
            . ' into their '
            . $where;
        $this->addToLog($entry);
    }

}