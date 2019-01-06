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
    }

    protected function buildGame()
    {
        $game = new \App\Models\Game();
        $state = new \App\Models\Game\State(new \App\Models\Game\Log, new \App\Services\CardBuilder);

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
}
