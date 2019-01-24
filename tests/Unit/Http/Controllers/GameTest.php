<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Services\Factories\CardFactory;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function testItUpdatesAGameProperly() {
        $this->buildGame();

        $response = $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => 'play-treasure',
            'input' => 'copper'
        ])->getContent();

        $this->assertContains('Coins: 1', $response);
    }

    public function testItCreatesAGame()
    {
        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = 0;
        $user->guid = 'alec';
        $user->save();

        $response = $this->post('/game/create/', [
            'guid' => 'alec'
        ])->getContent();

        $this->assertContains('A new game has been set up for you', $response);
    }

    public function testItCreatesAnAIGame() {
        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = 0;
        $user->guid = 'alec';
        $user->save();

        $response = $this->post('/game/create-ai-game/', [
            'guid' => 'alec'
        ])->getContent();

        $games = \App\Models\Game::all();

        $this->assertContains('Coins: 0', $response);
        $this->assertEquals(count($games), 1);
    }

    public function testItUpdatesAnAIGameProperly() {
        $this->buildAIGame();

        $response = $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => 'end-turn',
            'input' => null
        ])->getContent();
        $response = json_decode($response);

        $this->assertEquals(count($response->responses), 1);
        $this->assertContains('Turn: 3', $response->responses[0]->response->view);
    }

    protected function buildGame() {
        $game = new \App\Models\Game();
        $state = new \App\Game\Models\State(new \App\Game\Models\Log, new \App\Services\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Game\Models\Player('alec');

        $player1->setDeck([
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);
        $player1->setHand([
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);

        $player2 = new \App\Game\Models\Player('lucy');

        $player2->setDeck([
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);
        $player2->setHand([
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId('alec');
        $game->object = serialize($state);
        $game->save();

        $user = new \App\Models\User();
        $user->name = 'Alec';
        $user->game_id = $game->id;
        $user->guid = 'alec';
        $user->save();

        $user = new \App\Models\User();
        $user->name = 'Lucy';
        $user->game_id = $game->id;
        $user->guid = 'lucy';
        $user->save();

        $this->game = $game;
    }

    protected function buildAIGame() {
        $game = new \App\Models\Game();
        $state = new \App\Game\Models\State(new \App\Game\Models\Log, new \App\Services\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Game\Models\Player('alec');

        $player1->setDeck([
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);
        $player1->setHand([
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);

        $player2 = new \App\Game\Models\Player('marvin', true);

        $player2->setDeck([
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);
        $player2->setHand([
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ]);

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
