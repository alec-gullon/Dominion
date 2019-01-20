<?php

namespace Tests\Acceptance;

use App\Game\Services\Updater;
use App\Services\CardBuilder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcceptanceTestBase extends TestCase
{
    use RefreshDatabase;

    protected function updateGame() {
        $updater = new Updater($this->state(), new CardBuilder);
        $updater->resolve();
        $this->game->object = serialize($updater->getState());
        $this->game->save();
    }

    protected function playCard($stub) {
        $this->postUpdate('play-card', $stub);
    }

    protected function playTreasure($stub) {
        $this->postUpdate('play-treasure', $stub);
    }

    protected function provideInput($input) {
        $this->postUpdate('provide-input', $input);
    }

    protected function postUpdate($action, $input = null) {
        $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => $action,
            'input' => $input
        ]);
        $this->game = \App\Models\Game::all()->first();
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
        $player1->setName('Alec');

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
        $player2->setName('Lucy');

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

    protected function buildGameWithAI()
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

    protected function playVirtualCard($card) {
        $state = $this->state();
        $player = $state->activePlayer();
        $player->playVirtualCard($card);
        $state->togglePlayerInput();
        $this->game->object = serialize($state);
        $this->game->save();
        $this->updateGame();
    }

    protected function setNumberOfCardsRemaining($stub, $amount) {
        $state = $this->state();
        $cards = $state->kingdomCards();
        $cards[$stub] = $amount;

        $state->setKingdom($cards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function buildGameWithMoat() {
        $this->buildGame();
        $state = $this->state();

        $kingdomCards = $state->kingdomCards();
        $kingdomCards['moat'] = 10;

        $state->setKingdom($kingdomCards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->setHand($hand);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->secondaryPlayer()->setHand($hand);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->setDeck($deck);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDiscard($shorthand) {
        $discard = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->setDiscard($discard);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->secondaryPlayer()->setDeck($deck);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    private function buildCardStackFromShorthand($shorthand) {
        $stack = [];
        $cardBuilder = new \App\Services\CardBuilder();
        foreach($shorthand as $stub) {
            $parts = explode('@', $stub);
            if (empty($parts[1])) {
                $parts[1] = 1;
            } else {
                $parts[1] = (integer) $parts[1];
            }

            for ($i = 1; $i <= $parts[1]; $i++) {
                $stack[] = $cardBuilder->build($parts[0]);
            }
        }
        return $stack;
    }

    protected function assertHasCard($stub) {
        $player = $this->state()->activePlayer();

        $existingStubs = [];
        foreach ($player->getHand() as $card) {
            $existingStubs[] = $card->getStub();
        }
        $this->assertContains($stub, $existingStubs);
    }

    protected function assertHandSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->getHand()), $size);
    }

    protected function assertOpponentHandSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->getHand()), $size);
    }

    protected function assertDeckSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->getDeck()), $size);
    }

    protected function assertOpponentDeckSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->getDeck()), $size);
    }

    protected function assertDiscardSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->getDiscard()), $size);
    }

    protected function assertOpponentDiscardSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->getDiscard()), $size);
    }

    protected function assertActions($actions) {
        $state = $this->state();
        $this->assertEquals($state->actions(), $actions);
    }

    protected function assertNumberOfPlayed($number) {
        $state = $this->state();
        $this->assertEquals(count($state->activePlayer()->getPlayed()), $number);
    }

    protected function assertNumberOfBuys($number) {
        $state = $this->state();
        $this->assertEquals($state->buys(), $number);
    }

    protected function assertNumberOfCoins($coins) {
        $state = $this->state();
        $this->assertEquals($state->coins(), $coins);
    }

    protected function assertTrashSize($size) {
        $state = $this->state();
        $this->assertEquals(count($state->trash()), $size);
    }

    protected function assertAllCardsResolved() {
        $state = $this->state();
        $this->assertEquals($state->activePlayer()->hasUnresolvedCard(), false);
    }

    protected function assertNumberOfRemainingCards($stub, $number) {
        $state = $this->state();
        $this->assertEquals($state->kingdomCards()[$stub], $number);
    }

    protected function assertNumberOfSetAside($number) {
        $state = $this->state();
        $this->assertEquals(count($state->activePlayer()->getSetAside()), $number);
    }

    protected function assertLogContains($lines) {
        $log = $this->log();
        $entries = $log->flattenedEntries();
        $intersect = array_intersect($lines, $entries);
        $this->assertEquals(count($lines), count($intersect));
    }

    protected function assertLogDoesNotContain($lines) {
        $log = $this->log();
        $entries = $log->flattenedEntries();
        $intersect = array_intersect($lines, $entries);
        $this->assertEquals(0, count($intersect));
    }

    protected function assertPhase($phase) {
        $state = $this->state();
        $this->assertEquals($state->phase(), $phase);
    }

    protected function log() {
        return $this->state()->log();
    }

    protected function getPlayer() {
        return $this->state()->activePlayer();
    }

    protected function assertLogCountEquals($count) {
        $log = $this->log();
        $entries = $log->flattenedEntries();
        $this->assertEquals($count, count($entries));
    }

    protected function assertTurnNumber($turn) {
        $game = $this->state();
        $this->assertEquals($game->turn(), $turn);
    }

    protected function assertGameOver() {
        $game = $this->state();
        $this->assertEquals($game->isResolved(), true);
    }

    protected function state() {
        return unserialize($this->game->object);
    }

    protected function setKingdom($kingdom) {
        $state = $this->state();
        $state->setKingdom($kingdom);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function assertTotalNumberOfCardsForOpponent($amount) {
        $player = $this->state()->secondaryPlayer();
        $total = count($player->getHand())
            + count($player->getDiscard())
            + count($player->getDeck());
        $this->assertEquals($amount, $total);
    }

    protected function assertOpponentsNumberOfRemainingCards($stub, $amount) {
        $player = $this->state()->secondaryPlayer();

        $amountInPlay = 0;
        $hand = $player->getHand();
        foreach ($hand as $card) {
            if ($card->stub() === $stub) {
                $amountInPlay++;
            }
        }

        $deck = $player->getDeck();
        foreach ($deck as $card) {
            if ($card->stub() === $stub) {
                $amountInPlay++;
            }
        }

        $discard = $player->getDiscard();
        foreach ($discard as $card) {
            if ($card->stub() === $stub) {
                $amountInPlay++;
            }
        }

        $this->assertEquals($amount, $amountInPlay);
    }
}