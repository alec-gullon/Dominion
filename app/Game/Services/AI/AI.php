<?php

namespace App\Game\Services\AI;

use App\Game\Helpers\StringHelper;

use App\Game\Factories\CardFactory;

class AI {

    private $state;

    private $gameAnalyser;

    public function __construct(GameAnalyser $gameAnalyser) {
        $this->gameAnalyser = $gameAnalyser;
    }

    public function setState($state) {
        $this->state = $state;
        $this->gameAnalyser->setState($state);
    }

    public function decision() {

        if ($this->state->activePlayer()->hasUnresolvedCard()) {
            $alias = $this->state->activePlayer()->unresolvedCard()->alias();
            $nextStep = $this->state->activePlayer()->getNextStep();
            $method = StringHelper::methodFromNextStep($nextStep);

            $strategy = 'App\Game\Services\AI\Strategies\\' . $alias;
            $strategy = new $strategy($this->state);
            return [
                'action' => 'provide-input',
                'input' => $strategy->$method()
            ];
        }

        // if we aren't resolving a card, start by playing an action card if possible
        if ($this->gameAnalyser->canPlayActionCard()) {
            // play anything that gives actions first
            $handCards = $this->state->activePlayer()->getCardsOfType('hand', 'action');
            foreach ($handCards as $card) {
                if ($card->hasFeature('increasesActions')) {
                    return [
                        'action' => 'play-card',
                        'input' => $card->stub()
                    ];
                }
            }

            // play anything that assaults the other player
            foreach ($handCards as $card) {
                if ($card->hasType('attack')) {
                    return [
                        'action' => 'play-card',
                        'input' => $card->stub()
                    ];
                }
            }

            // play anything else
            return [
                'action' => 'play-card',
                'input' => $handCards[0]->stub()
            ];
        }

        // if we've got this far, time to play a treasure card if we have one
        if ($this->gameAnalyser->canPlayTreasureCard()) {
            $treasureCards = $this->state->activePlayer()->getCardsOfType('hand', 'treasure');
            return [
                'action' => 'play-treasure',
                'input' => $treasureCards[0]->stub()
            ];
        }

        // now we buy something if we can
        if ($this->gameAnalyser->canBuyCard()) {
            if ($this->state->coins() >= 3) {
                return [
                    'action' => 'buy',
                    'input' => 'silver'
                ];
            }
        }

        return [
            'action' => 'end-turn',
            'input' => null
        ];
    }

}