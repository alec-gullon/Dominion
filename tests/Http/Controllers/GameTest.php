<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\Game;
use App\Models\User;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function testItCreatesAGame() {
        $this->createUser();

        $response = $this->post('/game/create/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('A new game has been set up for you', $response);
        $this->assertEquals(User::first()->game_id, Game::first()->id);
    }

    public function testItCreatesAnAIGame() {
        $this->createUser();

        $response = $this->jsonpost('/game/create/ai/', [
            'guid' => 'alec'
        ]);

        $game = \App\Models\Game::first();
        $state = unserialize($game->object);

        $this->assertStringContainsString('class="game', $response->view);
        $this->assertEquals($state->secondaryPlayer()->isAi, true);
    }

    public function testItUpdatesAGame() {
        $this->createGame();

        $response = $this->jsonpost('/game/update/', [
            'guid' => 'alec',
            'action' => 'play-treasure',
            'input' => 'copper'
        ]);

        $this->assertStringContainsString('Alec plays a Copper', $response->view);
    }

    public function testItUpdatesAnAIGameProperly() {
        $this->createAIGame();

        $response = $this->jsonpost('/game/update/', [
            'guid' => 'alec',
            'action' => 'end-turn',
            'input' => null
        ]);

        $this->assertContains('Turn 3', $response->view);
    }


}
