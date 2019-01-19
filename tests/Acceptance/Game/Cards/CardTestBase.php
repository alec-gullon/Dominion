<?php

namespace Tests\Acceptance\Game\Cards;

use App\Game\Services\Updater;
use App\Services\CardBuilder;

use Tests\Acceptance\Game\GameTestBase;

class CardTestBase extends GameTestBase
{
    protected function updateGame() {
        $updater = new Updater(unserialize($this->game->object), new CardBuilder);
        $updater->resolve();
        $this->game->object = serialize($updater->getState());
        $this->game->save();
    }

    protected function playCard($stub) {
        $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => 'play-card',
            'input' => $stub
        ]);

        $this->game = \App\Models\Game::all()->first();
    }

    protected function provideInput($input) {
        $this->post('/game/update/', [
            'guid' => 'alec',
            'action' => 'provide-input',
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

    protected function playVirtualCard($card) {
        $state = unserialize($this->game->object);
        $player = $state->activePlayer();
        $player->playVirtualCard($card);
        $state->togglePlayerInput(false);
        $this->game->object = serialize($state);
        $this->game->save();
        $this->updateGame();
    }

    protected function setNumberOfCardsRemaining($stub, $amount) {
        $state = unserialize($this->game->object);
        $cards = $state->kingdomCards();
        $cards[$stub] = $amount;

        $state->setKingdom($cards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function buildGameWithMoat() {
        $this->buildGame();
        $state = unserialize($this->game->object);

        $kingdomCards = $state->kingdomCards();
        $kingdomCards['moat'] = 10;

        $state->setKingdom($kingdomCards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->setHand($hand);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->secondaryPlayer()->setHand($hand);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->setDeck($deck);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDiscard($shorthand) {
        $discard = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->setDiscard($discard);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
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
        $player = unserialize($this->game->object)->activePlayer();

        $existingStubs = [];
        foreach ($player->getHand() as $card) {
            $existingStubs[] = $card->getStub();
        }
        $this->assertContains($stub, $existingStubs);
    }

    protected function assertHandSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->getHand()), $size);
    }

    protected function assertOpponentHandSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->getHand()), $size);
    }

    protected function assertDeckSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->getDeck()), $size);
    }

    protected function assertOpponentDeckSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->getDeck()), $size);
    }

    protected function assertOpponentRevealedSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->revealed()), $size);
    }

    protected function assertDiscardSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->getDiscard()), $size);
    }

    protected function assertOpponentDiscardSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->getDiscard()), $size);
    }

    protected function assertActions($actions) {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->actions(), $actions);
    }

    protected function assertNumberOfPlayed($number) {
        $state = unserialize($this->game->object);
        $this->assertEquals(count($state->activePlayer()->getPlayed()), $number);
    }

    protected function assertNumberOfBuys($number) {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->buys(), $number);
    }

    protected function assertNumberOfCoins($coins) {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->coins(), $coins);
    }

    protected function assertTrashSize($size) {
        $state = unserialize($this->game->object);
        $this->assertEquals(count($state->trash()), $size);
    }

    protected function assertAllCardsResolved() {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->activePlayer()->hasUnresolvedCard(), false);
    }

    protected function assertNumberOfRemainingCards($stub, $number) {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->kingdomCards()[$stub], $number);
    }

    protected function assertNumberOfSetAside($number) {
        $state = unserialize($this->game->object);
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

    protected function log() {
        return unserialize($this->game->object)->log();
    }

    protected function state() {
        return unserialize($this->game->object);
    }

    protected function getPlayer() {
        return unserialize($this->game->object)->activePlayer();
    }

    protected function assertLogCountEquals($count) {
        $log = $this->log();
        $entries = $log->flattenedEntries();
        $this->assertEquals($count, count($entries));
    }

    protected function assertNextStep($step) {
        $nextStep = $this->state()->activePlayer()->unresolvedCard()->getNextStep();
        $nextStep = explode('/', $nextStep)[1];
        $this->assertEquals($nextStep, $step);
    }
}
