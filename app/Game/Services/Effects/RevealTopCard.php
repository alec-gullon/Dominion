<?php

namespace App\Game\Services\Effects;

class RevealTopCard extends Base {

    public function effect() {
        $this->description();
        if ($this->params['player']->canDrawCard()) {
            $this->params['player']->revealTopCard();
        }
    }

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->getName();
        if (!$player->canDrawCard()) {
            $entry .= ' has nothing to reveal';
        } else {
            $card = $player->topCard();
            $entry .= ' reveals ' . $card->nameWithArticlePrefix() . ' from the top of their deck';
        }
        $this->addToLog($entry);
    }

}