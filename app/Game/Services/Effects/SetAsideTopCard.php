<?php

namespace App\Game\Services\Effects;

class SetAsideTopCard extends Base {

    public function effect() {
        $this->description();
        $this->state->getActivePlayer()->setAsideTopCard();
    }

    public function description() {
        $card = $this->state->getActivePlayer()->getTopCard();

        $entry = '.. '
            . $this->state->getActivePlayer()->getName()
            . ' sets aside '
            . $card->nameWithArticlePrefix();
        $this->addToLog($entry);
    }

}