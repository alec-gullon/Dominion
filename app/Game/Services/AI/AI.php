<?php

namespace App\Game\Services\AI;

use App\Game\Models\State;

/**
 * The AI that can be subbed in for a human Dominion player. The decision method analyses the current state
 * and attempts to make an informed decision about what should be done next in the game if the AI is playing.
 * In order to make this decision, the AI runs through an ordered checklist of strategies to consider, until
 * nothing seems valid, at which point it ends its turn
 */
class AI {

    /**
     * The game state that the AI analyses when making its decision
     *
     * @var \App\Game\Models\State
     */
    private $state;

    /**
     * The ordered checklist of classes used when the AI makes its decision.
     *
     * @var array
     */
    private $checklist = [
        'ActionStrategy',
        'PlayStrategy',
        'TreasureStrategy',
        'BuyStrategy'
    ];

    public function setState(State $state) {
        $this->state = $state;
    }

    /**
     * The AI's decision based on the current game state. Returns an indexed array that
     * chooses a value for the action and a value for the input that is then passed to
     * the Game Updater
     *
     * @return array
     */
    public function decision() {

        foreach ($this->checklist as $strategy) {
            $strategyClassAlias = '\App\Game\Services\AI\Strategies\\' . $strategy;
            $strategy = new $strategyClassAlias($this->state);
            if ($strategy->isRequired()) {
                return $strategy->decision();
            }
        }

        return [
            'action' => 'end-turn',
            'input' => null
        ];
    }

}