<?php

namespace App\Game\Validators\Actions;

use App\Game\Models\State;
use App\Game\Factories\CardFactory;

class ActionValidator {

    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    protected function checkInputSubsetOfCardStack($input, $stack) {
        $matchedKeys = [];

        foreach ($input as $stub) {
            $matchFound = false;
            foreach ($stack as $key => $card) {
                if ($card->stub() === $stub && !in_array($key, $matchedKeys)) {
                    $matchedKeys[] = $key;
                    $matchFound = true;
                    break;
                }
            }
            if (!$matchFound) {
                return false;
            }
        }
        return true;
    }

    protected function makeCard($stub) {
        return CardFactory::build($stub);
    }

}