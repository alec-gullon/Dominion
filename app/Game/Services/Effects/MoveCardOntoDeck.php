<?php

namespace App\Game\Services\Effects;

class MoveCardOntoDeck extends Base {

    public function effect() {
        $this->params['player']->moveCardOntoDeck($this->params['from'], $this->params['card']);
        $this->description();
    }

    public function description() {
        $player = $this->params['player'];
        $from = $this->params['from'];
        $card = $this->params['card'];

        $card = $this->cardBuilder->build($card);
        $entry = '.. ' . $player->getName() . ' places ' . $card->nameWithArticlePrefix() . ' onto their deck from their ' . $from;
        $this->addToLog($entry);
    }

}