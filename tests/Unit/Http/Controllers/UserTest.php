<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testSetsNameCorrectly() {
        $response = $this->post('/user/set-name/', [
            'name' => 'Alec'
        ])->getContent();

        $this->assertContains('Hello Alec, welcome to Dominion.', $response);
    }

    public function testUserJoinsGameCorrectly() {
        $this->buildGame();

        $response = $this->post('/user/join-game/', [
            'guid' => 'lucy',
            'gameHash' => 'game-hash'
        ])->getContent();

        $game = \App\Models\Game::all()->first();

        $this->assertEquals(count($game->users), 2);
        $this->assertContains('Coins: 0', $response);
    }

    public function testRefreshesPageCorrectlyWhenUserInGame() {
        $this->buildGame();

        $this->post('/user/join-game/', [
            'guid' => 'lucy',
            'gameHash' => 'game-hash'
        ]);

        $response = $this->post('/user/refresh-page/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('Coins: 0', $response);
    }

    public function testRefreshesPageCorrectlyWhenUserWaitingForAnotherPlayer() {
        $this->buildGame();

        $response = $this->post('/user/refresh-page/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('A new game has been set up for you', $response);
    }

    public function testRefreshesPageCorrectlyWhenUserNotInGame() {
        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = 0;
        $user->guid = 'alec';
        $user->save();

        $response = $this->post('/user/refresh-page/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('Hello Alec, welcome to Dominion.', $response);
        $this->assertContains("data-action='start-ai-game'", $response);
    }

    public function testRefreshesPageCorrectlyWhenUserIsInAIGame() {
        $this->buildAIGame();

        $response = $this->post('/user/refresh-page/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('Turn: 1', $response);
    }

    protected function buildGame()
    {
        $game = new \App\Models\Game();
        $state = new \App\Models\Game\State(new \App\Models\Game\Log, new \App\Services\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = 'game-hash';
        $game->save();

        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = $game->id;
        $user->guid = 'alec';
        $user->save();

        $user = new \App\Models\User();
        $user->name = 'Lucy';
        $user->game_id = 0;
        $user->guid = 'lucy';
        $user->save();
    }

    protected function buildAIGame() {
        $game = new \App\Models\Game();
        $state = new \App\Models\Game\State(new \App\Models\Game\Log, new \App\Services\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Models\Game\Player('alec');

        $player2 = new \App\Models\Game\Player('marvin', true);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId('alec');
        $game->object = serialize($state);
        $game->save();

        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = $game->id;
        $user->guid = 'alec';
        $user->save();

        $this->game = $game;
    }
}
