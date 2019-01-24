<?php

namespace App\Game\Services\Effects;

class MoveCards extends Base {

    public function effect() {
        $this->description();
        $this->params['player']->moveCardsOfType(
            $this->params['from'],
            $this->params['where'],
            $this->params['type']
        );
    }

    public function description() {
        $player = $this->params['player'];

        $cardsToMove = $player->getCardsOfType(
            $this->params['from'],
            $this->params['type']
        );

        $entry = '.. ' . $player->name();
        if (count($cardsToMove) === 0) {
            $entry .= ' does not put anything';
        } else {
            $entry .= ' puts';
        }
        $entry .= $this->describeCardList($cardsToMove);
        $entry .= ' into their ' . $this->params['where'];
        $this->addToLog($entry);
    }

}