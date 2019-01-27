<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that controls the placement of one card pile into another
 */
class CombinePiles extends BaseEffect {

    /**
     * Which pile will be left empty after the effect is resolved
     *
     * @var string
     */
    protected $from;

    /**
     * Which pile will have more cards in it after the effect is resolved
     *
     * @var string
     */
    protected $to;

    public function effect() {
        $this->description();
        $this->state->activePlayer()->moveCards($this->from, $this->to);
    }

    public function description() {
        $entry = 'puts their ' . $this->from . ' into their ' . $this->to;
        $this->addToLog($entry);
    }

}