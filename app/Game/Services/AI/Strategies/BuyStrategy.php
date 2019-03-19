<?php

namespace App\Game\Services\AI\Strategies;

use App\Game\Models\State;

use App\Game\Factories\CardFactory;

class BuyStrategy {

    private $state;

    private $cards;

    const END_GAME_PRIORITY = [
        'province',
        'duchy',
        'gardens',
        'estate'
    ];

    const TERMINAL_PRIORITY = [
        'witch',
        'council-room',
        'militia',
        'mine',
        'library',
        'feast',
        'adventurer',
        'smithy',
        'bureaucrat',
        'remodel',
        'chancellor',
        'moneylender',
        'chapel',
        'moat',
        'woodcutter',
        'workshop',
        'thief',
        'throne-room'
    ];

    const NON_TERMINAL_PRIORITY = [
        'festival',
        'laboratory',
        'market',
        'village'
    ];

    public function __construct(State $state) {
        $this->state = $state;
    }

    public function isRequired() {
        return ($this->state->phase === 'buy' && $this->state->buys > 0);
    }

    public function decision() {
        $cards = array_keys($this->state->remainingKingdomCards());
        $this->cards = CardFactory::buildMultiple($cards);
        $this->filterUnaffordableCards();

        $stub = $this->selectCard();

        if ($stub !== null) {
            return [
                'action' => 'buy',
                'input' => $stub
            ];
        }
        return null;
    }

    private function filterUnaffordableCards() {
        $state = $this->state;
        $this->cards = array_values(array_filter($this->cards, function($card) use ($state) {
            return ($card->value <= $state->coins);
        }));
    }

    private function selectCard() {

        $state = $this->state;
        $player = $state->activePlayer();

        if ($this->state->checkGameOver()) {
            $stub = $this->firstCardInArray(self::END_GAME_PRIORITY);
            if (false !== $stub) {
                return $stub;
            }
            return $this->cheapestCard();
        }

        $stub = $this->firstCardInArray(['province', 'gold']);
        if (false !== $stub) {
            return $stub;
        }

        $numberOfActionIncreasers = $player->totalCardsWithFeature('increasesActions');
        $numberOfTerminals = $player->totalCardsWithFeature('terminal');

        if ($numberOfActionIncreasers >= $numberOfTerminals) {
            $stub = $this->firstCardInArray(self::TERMINAL_PRIORITY);
            if (false !== $stub) {
                return $stub;
            }
        }

        $stub = $this->firstCardInArray(self::NON_TERMINAL_PRIORITY);
        if (false !== $stub) {
            return $stub;
        }

        if ($this->state->coins >= 3 && $this->state->kingdomCards['silver'] > 0) {
            return 'silver';
        }

        return null;
    }

    private function cardExists($stub) {
        foreach ($this->cards as $card) {
            if ($card->stub === $stub) {
                return true;
            }
        }
        return false;
    }

    private function firstCardInArray($stubs) {
        foreach ($stubs as $stub) {
            if ($this->cardExists($stub)) {
                return $stub;
            }
        }
        return false;
    }

    private function cheapestCard() {
        $lowestValue = 10;
        $selectedCard = null;
        foreach ($this->cards as $card) {
            if ($card->stub === 'curse') {
                continue;
            }

            if ($card->value < $lowestValue) {
                $selectedCard = $card;
                $lowestValue = $card->value;
            }
        }
        return $selectedCard->stub;
    }

}