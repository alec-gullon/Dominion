<?php

namespace Tests\Acceptance\AI;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AITestBase extends TestCase {

    use RefreshDatabase;

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
        $player1->setName('Alec');

        $player2 = new \App\Models\Game\Player('marvin', $cardBuilder, true);

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
        $player2->setName('Marvin');

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

    protected function postUpdate($action, $input = null) {
        $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => $action,
            'input' => $input
        ]);
        $this->game = \App\Models\Game::all()->first();
    }

    protected function assertTurnNumber($turn) {
        $game = unserialize($this->game->object);
        $this->assertEquals($game->turn(), $turn);
    }

}