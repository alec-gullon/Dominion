<?php

namespace App\Game\Services;

use App\Game\Factories\CardFactory;

class GeneratesRandomKingdom {

    public function generate() {
        $cards = config('dominion.approved-kingdom-cards');

        $kingdomCards = [];
        for ($i = 1; $i <= 10; $i++) {
            $random = rand(0, count($cards) - 1);
            $kingdomCards[$cards[$random]] = 10;
            unset($cards[$random]);
            $cards = array_values($cards);
        }

        $kingdomCards = $this->determineStartingNumbers($kingdomCards);
        $kingdomCards = $this->attachDefaultCards($kingdomCards);

        return $kingdomCards;
    }

    private function determineStartingNumbers($kingdomCards) {
        foreach ($kingdomCards as $stub => $amount) {
            $card = CardFactory::build($stub);
            $kingdomCards[$stub] = 10;
            if ($card->hasType('victory')) {
                $kingdomCards[$stub] = 8;
            }
        }
        return $kingdomCards;
    }

    private function attachDefaultCards($kingdomCards) {
        $kingdomCards['estate'] = 8;
        $kingdomCards['duchy'] = 8;
        $kingdomCards['province'] = 8;

        $kingdomCards['copper'] = 30;
        $kingdomCards['silver'] = 20;
        $kingdomCards['gold'] = 10;

        $kingdomCards['curse'] = 10;

        return $kingdomCards;
    }

}