<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;


class GameTest extends TestCase
{
    use RefreshDatabase;

    public function testItUpdatesAGameProperly()
    {
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

        $this->assertContains('Coins: 0', $response);
    }

    protected function buildGame()
    {
        $game = new \App\Models\Game();
        $state = new \App\Models\Game\State(new \App\Models\Game\Log, new \App\Services\CardBuilder);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $cardBuilder = new \App\Services\CardBuilder();

        $player1 = new \App\Models\Game\Player('alec', $cardBuilder);

        $player1->setDeck([
            $cardBuilder->build('estate'),
            $cardBuilder->build('estate'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper')
        ]);
        $player1->setHand([
            $cardBuilder->build('estate'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper')
        ]);

        $player2 = new \App\Models\Game\Player('lucy', $cardBuilder);

        $player2->setDeck([
            $cardBuilder->build('estate'),
            $cardBuilder->build('estate'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper')
        ]);
        $player2->setHand([
            $cardBuilder->build('estate'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper'),
            $cardBuilder->build('copper')
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
}
