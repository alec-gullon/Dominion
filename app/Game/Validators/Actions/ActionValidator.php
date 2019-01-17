<?php

namespace App\Game\Validators\Actions;

use App\Models\Game\State;
use App\Services\CardBuilder;

class ActionValidator {

    protected $state;

    protected $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
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

}