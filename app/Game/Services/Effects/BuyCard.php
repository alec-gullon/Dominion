<?php

namespace App\Game\Services\Effects;

class BuyCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer(
            $this->params['card']
        );
        $this->description();
    }

    public function description() {
        $card = $this->params['card'];

        $player = $this->state->activePlayer();
        $description = '.. ' . $player->getName() . ' buys ' . $this->cardBuilder->build($card)->nameWithArticlePrefix();
        $this->addToLog($description);
    }

}