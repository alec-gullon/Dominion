<?php

namespace App\Game\Services\Effects;

class GainCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer(
            $this->params['card'],
            $this->params['location'],
            $this->params['player']->getId()
        );
        $this->description();
    }

    public function description() {
        $card = $this->params['card'];
        $player = $this->params['player'];
        $location = $this->params['location'];

        $entry = '.. ' . $player->getName();
        if ($this->state->getKingdomCards()[$card] === 0) {
            if ($location === 'deck') {
                $entry .= ' places nothing on their deck';
            } else {
                $entry .= ' gains nothing';
            }
        } else {
            $card = $this->cardBuilder->build($card);
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