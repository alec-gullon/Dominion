<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserJoinsGameCorrectly()
    {
        $this->buildGame();

        $response = $this->post('/user/join-game/', [
            'guid' => 'lucy',
            'gameHash' => 'game-hash'
        ])->getContent();

        $this->assertContains('Coins: 0', $response);
    }

    protected function buildGame()
    {
        $game = new \App\Models\Game();
        $state = new \App\Models\Game\State();

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
