<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class GainCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer(
            $this->params['stub'],
            $this->params['location'],
            $this->params['player']->id()
        );
        $this->description();
    }

    public function description() {
        $card = $this->params['stub'];
        $player = $this->params['player'];
        $location = $this->params['location'];

        $entry = '.. ' . $player->name();
        if ($this->state->kingdomCards()[$card] === 0) {
            if ($location === 'deck') {
                $entry .= ' places nothing on their deck';
            } else {
                $entry .= ' gains nothing';
            }
        } else {
            $card = CardFactory::build($card);
            $entry .= ' gains ' . $card->nameWithArticlePrefix();

            if ($location === 'deck') {
                $entry .= ', putting it on top of their deck';
            } else if ($location === 'hand') {
                $entry .= ', putting it in their hand';
            }
        }

        $this->addToLog($entry);
    }

}