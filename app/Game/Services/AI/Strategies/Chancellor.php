<?php

namespace App\Game\Services\AI\Strategies;

class Chancellor extends CardStrategy {

    public function putDeckInDiscard() {
        return true;
    }

}