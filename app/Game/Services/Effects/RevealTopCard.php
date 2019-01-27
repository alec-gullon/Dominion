<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that reveals the top card of a player's deck
 */
class RevealTopCard extends BaseEffect {

    /**
     * The player who is having their top card revealed
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function effect() {
        $this->description();
        if ($this->player->canDrawCard()) {
            $this->player->revealTopCard();
        }
    }

    public function description() {
        if (!$this->player->canDrawCard()) {
            $entry = 'has nothing to reveal';
        } else {
            $card = $this->player->topCard();
            $entry = 'reveals ' . $card->nameWithArticlePrefix() . ' from the top of their deck';
        }

        $this->addToLog($entry, $this->player);
    }

}