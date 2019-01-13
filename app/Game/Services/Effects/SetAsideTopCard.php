<?php

namespace App\Game\Services\Effects;

class SetAsideTopCard extends Base {

    public function effect() {
        $this->description();
        $this->state->activePlayer()->setAsideTopCard();
    }

    public function description() {
        $card = $this->state->activePlayer()->topCard();

        $entry = '.. '
            . $this->state->activePlayer()->getName()
            . ' sets aside '
            . $card->nameWithArticlePrefix();
        $this->addToLog($entry);
    }

}