<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Game\Factories\CardFactory;

use App\Models\Game;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const STANDARD_KINGDOM_CARDS = [
        'copper' => 30,
        'silver' => 20,
        'gold' => 10,
        'estate' => 8,
        'duchy' => 8,
        'province' => 8,
        'village' => 10,
        'curse' => 10
    ];

    protected function jsonPost($route, $data = []) {
        $response = $this->post($route, $data)->getContent();
        return json_decode($response);
    }

    protected function createUser($name = 'Alec', $gameId = 0 ) {
        $user = new User();
        $user->name = $name;
        $user->guid = lcfirst($name);
        $user->game_id = $gameId;
        $user->save();
    }

    protected function createGame() {
        $game = new Game();
        $state = resolve('App\Game\Models\State');

        $game->object = serialize($state);
        $game->guid = uniqid();

        $player1 = $this->createActivePlayer('Alec');
        $player2 = $this->createSecondaryPlayer('Lucy');

        $state->players = [$player1, $player2];
        $state->activePlayerId = 'alec';
        $state->kingdomCards = self::STANDARD_KINGDOM_CARDS;
        $game->object = serialize($state);
        $game->save();

        $this->createUser('Alec', $game->id);
        $this->createUser('Lucy', $game->id);

    }

    protected function createAIGame() {
        $game = new Game();
        $state = resolve('App\Game\Models\State');

        $game->object = serialize($state);
        $game->guid = uniqid();

        $player1 = $this->createActivePlayer('Alec');
        $player2 = $this->createSecondaryPlayer('Marvin');
        $player2->isAi = true;

        $state->players = [$player1, $player2];
        $state->kingdomCards = self::STANDARD_KINGDOM_CARDS;
        $state->activePlayerId = 'alec';

        $game->object = serialize($state);
        $game->save();

        $this->createUser('Alec', $game->id);

        $this->game = $game;
    }

    private function createActivePlayer($name) {
        $player = new \App\Game\Models\Player(lcfirst($name), $name);
        $player->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        return $player;
    }

    private function createSecondaryPlayer($name) {
        $player = new \App\Game\Models\Player(lcfirst($name), $name);
        $player->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        return $player;
    }
}
