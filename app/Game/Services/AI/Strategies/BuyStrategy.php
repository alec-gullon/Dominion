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

        if ($state->checkGameOver()) {
            $stub = $this->firstCardInArray(self::END_GAME_PRIORITY);
            if ($stub) {
                return $stub;
            }
            return $this->cheapestCard();
        }

        if ($this->shouldBuyProvince()) {
            return 'province';
        }
        if ($this->shouldBuyDuchy()) {
            return 'duchy';
        }
        if ($this->shouldBuyGold()) {
            return 'gold';
        }

        if ($this->shouldBuyActionCard()) {
            $stub = $this->chooseActionCard();
            if ($stub) {
                return $stub;
            }
        };

        if ($this->shouldBuySilver()) {
            return 'silver';
        }

        return null;
    }

    private function chooseActionCard() {
        $player = $this->state->activePlayer();

        $numberOfActionIncreasers = $player->totalCardsWithFeature('increasesActions');
        $numberOfTerminals = $player->totalCardsWithFeature('terminal');

        if ($numberOfActionIncreasers >= $numberOfTerminals - 1) {
            $stub = $this->firstCardInArray(self::TERMINAL_PRIORITY);
            if ($stub) {
                return $stub;
            }
        }

        return $this->firstCardInArray(self::NON_TERMINAL_PRIORITY);
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

    private function shouldBuyProvince() {
        return ($this->state->coins >= 8
            && $this->state->turn >= 12
            && $this->state->hasCard('province')
        );
    }

    private function shouldBuyDuchy() {
        return ($this->state->coins >= 5
            && $this->state->kingdomCards['province'] <= 2
            && $this->state->hasCard('duchy')
        );
    }

    private function shouldBuyGold() {
        return ($this->state->coins >= 6 && $this->state->hasCard('gold'));
    }

    private function shouldBuyActionCard() {
        return ($this->state->activePlayer()->coinDensity() >= 0.7);
    }

    private function shouldBuySilver() {
        return ($this->state->coins >= 3 && $this->state->hasCard('silver'));
    }

}