<?php

namespace App\Game\Services\Effects;

class BuyCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer($this->params['card']);
        $this->description();
    }

    public function description() {
        $card = $this->cardBuilder->build($this->params['card']);

        $description = '.. '
            . $this->activePlayerName()
            . ' buys '
            . $card->nameWithArticlePrefix();

        $this->addToLog($description);
    }

}