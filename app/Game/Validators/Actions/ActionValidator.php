<?php

namespace App\Game\Validators\Actions;

use App\Game\Factories\CardFactory;
use App\Game\Helpers\CardsHelper;
use App\Game\Models\State;

/**
 * Base behaviour of validation related to input provided by a user in order to resolve
 * an action cards steps
 */
class ActionValidator {

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
     * Small helper method that provides access to the helper method on CardsHelper without requiring
     * dozens of use statements
     *
     * @param   array       $stubs
     * @param   array       $stack
     *
     * @return  bool
     */
    protected function checkStubsAreSubsetOfCardStack($stubs, $stack) {
        return CardsHelper::checkStubsAreSubsetOfCardStack($stubs, $stack);
    }

    /**
     * Small helper method that provides a nicer syntax for building a card from a given stub.
     * Means we only need a single use statement in one file
     *
     * @param   string      $stub
     *
     * @return  object
     */
    protected function makeCard($stub) {
        return CardFactory::build($stub);
    }

}