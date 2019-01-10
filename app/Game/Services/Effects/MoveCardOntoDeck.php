<?php

namespace App\Game\Services\Effects;

class MoveCardOntoDeck extends Base {

    public function effect() {
        $this->description();
        $this->params['player']->moveCardOntoDeck($this->params['from'], $this->params['card']);
    }

    public function description() {
        $player = $this->params['player'];
        $from = $this->params['from'];
        $card = $this->params['card'];

        $card = $this->cardBuilder->build($card);

        $entry = '.. ' . $player->getName();
        if ($from === 'revealed') {
            $entry .= ' places the ' . $card->getName() . ' on top of their deck';
        } else {
            $entry .= ' places ' . $card->nameWithArticlePrefix() . ' onto their deck from their ' . $from;
        }
        $this->addToLog($entry);
    }

}