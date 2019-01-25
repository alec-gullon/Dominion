<?php

namespace App\Game\Services;

use App\Game\Factories\CardFactory;

/**
 * Mini service that generates a random kingdom of 10 cards when a game needs to be created. Also supplies
 * the default cards in their appropriate numbers. The kingdom cards that are approved to be taken
 * under consideration are in the app.dominion config file
 */
class GeneratesRandomKingdom {

    /**
     * An array of approved cards that can be included in new games. Entries
     * are card stubs
     *
     * @var array
     */
    private $approvedCards;

    /**
     * An array of cards that should be included in every dominion game, along
     * with their amounts. Keys are stubs and values are corresponding amounts
     *
     * @var array
     */
    private $baseCards;

    public function __construct() {
        $this->approvedCards = config('dominion.approved-kingdom-cards');
        $this->baseCards = config('dominion.base-cards');
    }

    /**
     * Generates the random kingdom of cards.
     *
     * @return array
     */
    public function generate() {
        $cards = $this->approvedCards;

        $kingdomCards = [];
        for ($i = 1; $i <= 10; $i++) {
            $random = rand(0, count($cards) - 1);
            $kingdomCards[$cards[$random]] = 10;
            unset($cards[$random]);
            $cards = array_values($cards);
        }

        $kingdomCards = $this->setStartingNumbers($kingdomCards);
        $kingdomCards = $this->appendDefaultCards($kingdomCards);

        return $kingdomCards;
    }

    /**
     * Sets the starting numbers of each card in the kingdom. Actions cards start with 10 in each pile,
     * whilst victory cards (e.g., Gardens) start with 8
     *
     * @param   array       $kingdomCards
     *
     * @return  array
     */
    private function setStartingNumbers($kingdomCards) {
        foreach ($kingdomCards as $stub => $amount) {
            $card = CardFactory::build($stub);

            $kingdomCards[$stub] = 10;
            if ($card->hasType('victory')) {
                $kingdomCards[$stub] = 8;
            }
        }
        return $kingdomCards;
    }

    /**
     * Includes the default set of cards in the randomly generated set of kingdom cards
     *
     * @param   array       $kingdomCards
     *
     * @return  mixed
     */
    private function appendDefaultCards($kingdomCards) {
        return array_merge($kingdomCards, $this->baseCards);
    }

}