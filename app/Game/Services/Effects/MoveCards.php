<?php

namespace App\Game\Services\Effects;

class MoveCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $this->description();
        $player->moveCardsOfType(
            $this->params['from'],
            $this->params['where'],
            $this->params['type']
        );
    }

    public function description() {
        $player = $this->params['player'];
        $from = $this->params['from'];
        $where = $this->params['where'];
        $type = $this->params['type'];

        $cardsToMove = $player->getCardsOfType($from, $type);

        $entry = '.. ' . $player->getName();
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