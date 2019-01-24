<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class MoveCardOntoDeck extends Base {

    public function effect() {
        $this->description();
        $this->params['player']->moveCardOntoDeck(
            $this->params['card'],
            $this->params['from']
        );
    }

    public function description() {
        $player = $this->params['player'];
        $from = $this->params['from'];
        $card = CardFactory::build($this->params['card']);

        $entry = '.. ' . $player->name();
        if ($from === 'revealed') {
            $entry .= ' places the ' . $card->name() . ' on top of their deck';
        } else {
            $entry .= ' places ' . $card->nameWithArticlePrefix() . ' onto their deck from their ' . $from;
        }
        $this->addToLog($entry);
    }

}