<?php

namespace App\Game\Services\Effects;

use App\Models\Game\State;
use App\Services\CardBuilder;

class Base {

    protected $numberMappings = ['no', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

    protected $state;

    protected $cardBuilder;

    protected $params;

    public function __construct(State $state, CardBuilder $cardBuilder, $params) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
        $this->params = $params;
    }

    protected function addToLog($entry) {
        $this->state->log()->addEntry($entry);
    }

    protected function describeCardList($cards) {
        usort($cards, function($a, $b) {
            if ($a->getName() < $b->getName()) {
                return -1;
            }
            return 1;
        });

        $cardAmounts = [];
        foreach ($cards as $card) {
            $name = $card->getName();
            if (!isset($cardAmounts[$name])) {
                $cardAmounts[$name] = [
                    'amount' => 0,
                    'card' => $card
                ];
            }
            $cardAmounts[$name]['amount']++;
        }

        $descriptor = '';

        $i = 1;
        foreach ($cardAmounts as $name => $details) {
            $amount = $details['amount'];
            $card = $details['card'];
            if ($amount === 1) {
                $descriptor .= ' ' . $card->nameWithArticlePrefix();
            } else {
                $descriptor  .= ' ' . $this->numberMappings[$amount] . ' ' . $card->pluralFormOfName();
            }

            if ($i === count($cardAmounts) - 1) {
                $descriptor .= ' and';
            } else if ($i < count($cardAmounts) - 1) {
                $descriptor .= ',';
            }

            $i++;
        }
        return $descriptor;
    }

}