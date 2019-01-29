<?php

namespace App\Game\Services\AI\Strategies\Actions;

use App\Game\Factories\CardFactory;
use App\Game\Models\State;

/**
 * Really simple base implementation of behaviour needed to help the AI make a decision with regards
 * to resolving a particular Action card that has been played.
 */
class CardStrategy {

    /**
     * The game state that the decision is being made about
     *
     * @var \App\Game\Models\State
     */
    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    /**
     * For now, we always want to reveal a moat if we are given the opportunity. Technically there
     * are good reasons not to reveal one, if for example the AI can reasonably infer that the player
     * might have attack cards on their next turn and the current attack card has no detrimental effect.
     * But for now, a brain dead approach works fine
     *
     * @return bool
     */
    public function resolveMoat() {
        return true;
    }

    protected function activePlayer() {
        return $this->state->activePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->secondaryPlayer();
    }

    /**
     * Helper method to assist with getting an instance of a Card model
     *
     * @param   string      $stub
     *
     * @return  object
     */
    protected function makeCard($stub) {
        return CardFactory::build($stub);
    }

    /**
     * Given a $cardStack, sorts the $cardStack according to the callback specified by $priorityMethod
     *
     * @param   array       $cardStack
     * @param   string      $priorityMethod
     *
     * @return  array
     */
    protected function prioritiseCards($cardStack, $priorityMethod = 'cardPriority') {
        $prioritisedStack = array_map(function($card) use ($priorityMethod) {
            return [
                'instance' => $card,
                'priority' => $this->$priorityMethod($card)
            ];
        }, $cardStack);

        usort($prioritisedStack, function($a, $b) {
            if ($a['priority'] > $b['priority']) {
                return -1;
            }
            return 1;
        });

        $prioritisedStack = array_map(function($entry) {
            return $entry['instance'];
        }, $prioritisedStack);

        return $prioritisedStack;
    }

    /**
     * Returns the highest prioritised card determined by the prioritiseCards method
     *
     * @param   array       $cardStack
     * @param   string      $priorityMethod
     *
     * @return  array
     */
    protected function prioritisedCard($cardStack, $priorityMethod = 'cardPriority') {
        return $this->prioritiseCards($cardStack, $priorityMethod)[0]->stub();
    }

    /**
     * Takes the remaining cards as defined on the Game state object and returns a CardStack
     * where each stub is converted to a Card instance
     *
     * @return  array
     */
    protected function remainingKingdomCardStack() {
        $cardStack = $this->state->remainingKingdomCards();
        return CardFactory::buildMultiple(array_keys($cardStack));
    }

}