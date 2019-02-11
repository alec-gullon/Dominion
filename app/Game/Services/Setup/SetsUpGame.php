<?php

namespace App\Game\Services\Setup;

use App\Game\Factories\CardFactory;
use App\Game\Models\Player;
use App\Game\Services\GeneratesRandomKingdom;

/**
 * Base implementation of behaviour required to set up a new game. Contains common methods
 * required when setting up a game between two players or against an AI
 */
class SetsUpGame {

    /**
     * Instance of service class that is responsible for building a random kingdom
     * for a new game
     *
     * @var \App\Game\Services\GeneratesRandomKingdom
     */
    protected $generatesRandomKingdom;

    public function __construct(GeneratesRandomKingdom $generatesRandomKingdom) {
        $this->generatesRandomKingdom = $generatesRandomKingdom;
    }

    /**
     * Builds an array of card Models that represents the game's default deck: three Estates
     * and seven Coppers
     *
     * @return array
     */
    protected function defaultDeck() {
        $deck = [];
        for ($i = 1; $i <= 3; $i++) {
            $deck[] = CardFactory::build('estate');
        }
        for ($i = 1; $i <= 7; $i++) {
            $deck[] = CardFactory::build('copper');
        }
        return $deck;
    }

    /**
     * Sets up a brand new player from scratch and returns them
     *
     * @todo Eek, a wild new appears! Should be extracted to a factory class
     *
     * @param   string      $id
     * @param   string      $name
     * @param   bool        $isAi
     *
     * @return  \App\Game\Models\Player
     */
    protected function setUpPlayer($id, $name, $isAi = false) {
        $player = new Player($id, $name, $isAi);
        $player->setDeck($this->defaultDeck());
        $player->shuffleDeck();
        $player->drawCards(5);
        return $player;
    }

}