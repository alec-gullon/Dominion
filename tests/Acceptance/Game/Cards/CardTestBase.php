<?php

namespace Tests\Acceptance\Game\Cards;

use App\Game\Services\Updater;
use App\Game\Factories\CardFactory;

use Tests\Acceptance\AcceptanceTestBase;

class CardTestBase extends AcceptanceTestBase
{
    protected function updateGame() {
        $updater = resolve('\App\Game\Services\Updater');
        $updater->setState($this->state());
        $updater->resolve();
        $this->game->object = serialize($updater->state());
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
        $state = new \App\Game\Models\State(new \App\Game\Models\Log, new \App\Game\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Game\Models\Player('alec', 'Alec');

        $player1->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player1->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player1->name = 'Alec';

        $player2 = new \App\Game\Models\Player('lucy', 'Lucy');

        $player2->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player2->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player2->name = 'Lucy';

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId('alec');
        $state->setKingdomCards([
            'copper' => 30,
            'silver' => 20,
            'gold' => 10,
            'estate' => 8,
            'duchy' => 8,
            'province' => 8,
            'village' => 10,
            'curse' => 10
        ]);
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
        $state->setAwaitingPlayerInputId(null);
        $this->game->object = serialize($state);
        $this->game->save();
        $this->updateGame();
    }

    protected function setNumberOfCardsRemaining($stub, $amount) {
        $state = unserialize($this->game->object);
        $cards = $state->kingdomCards();
        $cards[$stub] = $amount;

        $state->setKingdomCards($cards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function buildGameWithMoat() {
        $this->buildGame();
        $state = unserialize($this->game->object);

        $kingdomCards = $state->kingdomCards();
        $kingdomCards['moat'] = 10;

        $state->setKingdomCards($kingdomCards);
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->hand = $hand;
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->secondaryPlayer()->hand = $hand;
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->deck = $deck;
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setDiscard($shorthand) {
        $discard = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->activePlayer()->discard = $discard;
        $this->game->object = serialize($state);
        $this->game->save();
    }

    protected function setOpponentDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = unserialize($this->game->object);
        $state->secondaryPlayer()->deck = $deck;
        $this->game->object = serialize($state);
        $this->game->save();
    }

    private function buildCardStackFromShorthand($shorthand) {
        $stack = [];
        $cardFactory = new \App\Game\Factories\CardFactory();
        foreach($shorthand as $stub) {
            $parts = explode('@', $stub);
            if (empty($parts[1])) {
                $parts[1] = 1;
            } else {
                $parts[1] = (integer) $parts[1];
            }

            for ($i = 1; $i <= $parts[1]; $i++) {
                $stack[] = CardFactory::build($parts[0]);
            }
        }
        return $stack;
    }

    protected function assertHasCard($stub) {
        $player = unserialize($this->game->object)->activePlayer();

        $existingStubs = [];
        foreach ($player->hand as $card) {
            $existingStubs[] = $card->getStub();
        }
        $this->assertContains($stub, $existingStubs);
    }

    protected function assertHandSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->hand), $size);
    }

    protected function assertOpponentHandSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->hand), $size);
    }

    protected function assertDeckSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->deck), $size);
    }

    protected function assertOpponentDeckSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->deck), $size);
    }

    protected function assertOpponentRevealedSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->revealed), $size);
    }

    protected function assertDiscardSize($size) {
        $player = unserialize($this->game->object)->activePlayer();
        $this->assertEquals(count($player->discard), $size);
    }

    protected function assertOpponentDiscardSize($size) {
        $player = unserialize($this->game->object)->secondaryPlayer();
        $this->assertEquals(count($player->discard), $size);
    }

    protected function assertActions($actions) {
        $state = unserialize($this->game->object);
        $this->assertEquals($state->actions(), $actions);
    }

    protected function assertNumberOfPlayed($number) {
        $state = unserialize($this->game->object);
        $this->assertEquals(count($state->activePlayer()->played), $number);
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
        $this->assertEquals(count($state->activePlayer()->setAside), $number);
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
        $nextStep = $this->state()->activePlayer()->getNextStep();
        $nextStep = explode('/', $nextStep)[1];
        $this->assertEquals($nextStep, $step);
    }
}
