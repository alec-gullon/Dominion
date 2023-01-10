<?php

namespace Tests\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\Game;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testValidatesValidId() {
        $this->createUser();

        $response = $this->jsonPost('/user/validate-id/', [
            'guid' => 'alec'
        ]);

        $this->assertEquals($response->valid, true);
    }

    public function testInvalidatesInvalidId() {
        $response = $this->jsonPost('/user/validate-id/', [
            'guid' => 'alec-does-not-exist'
        ]);

        $this->assertEquals($response->valid, false);
    }

    public function testSetsNameProperly() {
        $response = $this->jsonPost('/user/set-name/', [
            'name' => 'Alec'
        ]);

        $user = User::all()->first();

        $this->assertEquals($user->name, 'Alec');
        $this->assertStringContainsString('Hello Alec, welcome to Dominion', $response->view);
    }

    public function testFetchesNameForm() {
        $response = $this->jsonPost('/user/name-form/');

        $this->assertStringContainsString('Before we can get started, you\'re going to need a name...', $response->view);
    }

    public function testFetchesPlayerLobby() {
        $this->createUser();

        $response = $this->jsonPost('/user/player-lobby/', [
            'guid' => 'alec'
        ]);

        $this->assertStringContainsString('Hello Alec, welcome to Dominion', $response->view);
    }

    public function testJoinsGame() {
        $game = new Game();
        $game->object = serialize(resolve('App\Game\Models\State'));
        $game->guid = 'gameGuid';
        $game->save();

        $this->createUser('Alec', $game->id);
        $this->createUser('Lucy');

        $response = $this->jsonPost('/game/join/', [
            'guid' => 'lucy',
            'gameGuid' => 'gameGuid'
        ]);

        $this->assertEquals(count(Game::all()), 1);
        $this->assertStringContainsString('class="game', $response->responses[0]->response->view);
        $this->assertEquals(count($response->responses), 2);
    }

    public function testReturnsNameEntryFormIfUserGuidIsInvalid() {
        $this->createUser('Alec');

        $response = $this->jsonPost('/user/refresh-page/', [
            'guid' => 'an-invalid-guid'
        ]);

        $this->assertEquals($response->action, 'unsetGuid');
    }

}
