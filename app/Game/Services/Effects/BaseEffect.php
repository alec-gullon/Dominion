<?php

namespace App\Game\Services\Effects;

use App\Game\Helpers\CardsHelper;
use App\Game\Helpers\StringHelper;
use App\Game\Models\State;
use App\Game\Factories\CardFactory;

/**
 * Base implementation of methods common to Common Card Effect classes. Includes a few small helper classes
 * that link through to other helper classes and avoid repeated use statements.
 *
 * Each effect class can expose up to two methods: an effect class and a description class. An array
 * of parameters can then be passed into the class and these two methods can then be invoked to: invoke the
 * change in state corresponding to the effect and add this to the log or; simply add the description to the
 * log without affecting any state
 */
class BaseEffect {

    /**
     * The mapping to convert integers into written english, i.e., 1 => 'one', 2 => 'two' and so on
     *
     * @var array
     */
    protected $numberMappings;

    /**
     * The state that the class is interested in updating and changing
     *
     * @var \App\Game\Models\State
     */
    protected $state;

    public function __construct(State $state, $params) {
        $this->state = $state;
        $this->numberMappings = config('dominion.number-mappings');

        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * A convenience method to add an $entry to the game's log. Also takes care of prepending the
     * player's name and dots
     *
     * @param   string                      $entry
     * @param   \App\Game\Models\Player     $player
     * @param   int                         $indentation
     */
    protected function addToLog($entry, $player = null, $indentation = 1) {
        if ($player === null) {
            $player = $this->state->activePlayer();
        }
        $entry = $player->name() . ' ' . $entry;
        if ($indentation !== 0) {
            $entry = ' ' . $entry;
        }
        for ($i = 1; $i <= $indentation; $i++) {
            $entry = '..' . $entry;
        }
        $this->state->log()->addEntry($entry);
    }

    /**
     * Accepts an array of instances of Card Models and returns a string which describes this stack of cards
     *
     * @param   array       $cardStack
     *
     * @return  string
     */
    protected function describeCardList($cardStack) {
        $cardStack = CardsHelper::sortCardStackByName($cardStack);
        return StringHelper::describeCardStack($cardStack);
    }

    protected function buildCard($stub) {
        return CardFactory::build($stub);
    }

    protected function secondaryPlayer() {
        return $this->state->secondaryPlayer();
    }

}