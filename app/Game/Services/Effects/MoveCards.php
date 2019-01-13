<?php

namespace App\Game\Services\Effects;

class MoveCards extends Base {

    public function effect() {
        $this->description();
        $this->state->activePlayer()->moveCardsOfType(
            $this->params['from'],
            $this->params['where'],
            $this->params['type']
        );
    }

    public function description() {
        $from = $this->params['from'];
        $where = $this->params['where'];
        $type = $this->params['type'];

        $cardsToMove = $this->state->activePlayer()->getCardsOfType($from, $type);

        $entry = '.. ' . $this->state->activePlayer()->getName();
        if (count($cardsToMove) === 0) {
            $entry .= ' does not put anything';
        } else {
            $entry .= ' puts';
        }
        $entry .= $this->describeCardList($cardsToMove);
        $entry .= ' into their ' . $where;
        $this->addToLog($entry);
    }

}