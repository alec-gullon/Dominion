<?php

namespace App\Game\Validators;

use App\Game\Models\State;
use App\Game\Factories\CardFactory;

/**
 * Validates user input in relation to certain methods on the BureaucratController class
 */
class BuyValidator {

    /**
     * The game state that the input should be checked against
     *
     * @var \App\Game\Models\State
     */
    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    /**
     * Takes the users input and confirms that they can actually buy the selected card and they
     * should be buying anything in the first place
     *
     * @param   mixed      $input
     *
     * @return  bool
     */
    public function buy($input) {
        if ($this->state->buys === 0) {
            return false;
        }
        if (!isset($this->state->kingdomCards[$input])) {
            return false;
        }

        $card = CardFactory::build($input);
        if ($card->value > $this->state->coins) {
            return false;
        }

        return $this->state->hasCard($input);
    }

}