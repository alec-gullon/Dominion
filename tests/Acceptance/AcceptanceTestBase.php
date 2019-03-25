<?php

namespace Tests\Acceptance;

use App\Game\Factories\CardFactory;

use Tests\TestCase;

class AcceptanceTestBase extends TestCase
{

    const KINGDOM_CARDS = [
        'copper' => 30,
        'silver' => 20,
        'gold' => 10,
        'estate' => 8,
        'duchy' => 8,
        'province' => 8,
        'village' => 10,
        'curse' => 10
    ];

    public $updater;

    protected function updateGame() {
        $this->updater->resolve();
    }

    protected function playCard($stub) {
        $this->update('play-card', $stub);
    }

    protected function playTreasure($stub) {
        $this->update('play-treasure', $stub);
    }

    protected function provideInput($input) {
        $this->update('provide-input', $input);
    }

    protected function update($action, $input = null) {
        $this->updater->update($action, $input);
        $this->updater->resolve();
    }

    protected function buildGame()
    {
        $game = new \App\Models\Game();
        $state = new \App\Game\Models\State(new \App\Game\Models\Log, new \App\Game\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Game\Models\Player('alec', 'Alec');

        $player1 = $this->setActivePlayerStartingCards($player1);
        $player1->name = 'Alec';

        $player2 = new \App\Game\Models\Player('lucy', 'Lucy');

        $player2 = $this->setSecondaryPlayerStartingCards($player2);
        $player2->name = 'Lucy';

        $state->players = [$player1, $player2];
        $state->activePlayerId = 'alec';
        $state->kingdomCards = self::KINGDOM_CARDS;

        $this->updater = resolve('App\Game\Services\Updater');
        $this->updater->setState($state);
    }

    protected function buildGameWithAI()
    {
        $game = new \App\Models\Game();
        $state = new \App\Game\Models\State(new \App\Game\Models\Log, new \App\Game\Factories\CardFactory);

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $player1 = new \App\Game\Models\Player('alec', 'Alec');

        $player1 = $this->setActivePlayerStartingCards($player1);
        $player1->name = 'Alec';

        $player2 = new \App\Game\Models\Player('marvin', 'Marvin', true);

        $player2 = $this->setSecondaryPlayerStartingCards($player2);
        $player2->name = 'Marvin';

        $state->players = [$player1, $player2];
        $state->activePlayerId = 'alec';
        $state->kingdomCards = self::KINGDOM_CARDS;

        $this->updater = resolve('App\Game\Services\Updater');
        $this->updater->setState($state);
    }

    protected function playVirtualCard($card) {
        $state = $this->state();
        $player = $state->activePlayer();
        $player->playVirtualCard($card);
        $this->updateGame();
    }

    protected function setNumberOfCardsRemaining($stub, $amount) {
        $state = $this->state();
        $cards = $state->kingdomCards;
        $cards[$stub] = $amount;

        $state->kingdomCards = $cards;
        $this->updater->setState($state);
    }

    protected function buildGameWithMoat() {
        $this->buildGame();
        $state = $this->state();

        $kingdomCards = $state->kingdomCards;
        $kingdomCards['moat'] = 10;

        $state->kingdomCards = $kingdomCards;
        $this->updater->setState($state);
    }

    protected function setHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->hand = $hand;
        $this->updater->setState($state);
    }

    protected function setOpponentHand($shorthand) {
        $hand = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->secondaryPlayer()->hand = $hand;
        $this->updater->setState($state);
    }

    protected function setDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->deck = $deck;
        $this->updater->setState($state);
    }

    protected function setDiscard($shorthand) {
        $discard = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->activePlayer()->discard = $discard;
        $this->updater->setState($state);
    }

    protected function setOpponentDeck($shorthand) {
        $deck = $this->buildCardStackFromShorthand($shorthand);
        $state = $this->state();
        $state->secondaryPlayer()->deck = $deck;
        $this->updater->setState($state);
    }

    private function buildCardStackFromShorthand($shorthand) {
        $stack = [];
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
        $player = $this->state()->activePlayer();

        $existingStubs = [];
        foreach ($player->hand as $card) {
            $existingStubs[] = $card->getStub();
        }
        $this->assertContains($stub, $existingStubs);
    }

    protected function assertHandSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->hand), $size);
    }

    protected function assertOpponentHandSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->hand), $size);
    }

    protected function assertDeckSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->deck), $size);
    }

    protected function assertOpponentDeckSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->deck), $size);
    }

    protected function assertDiscardSize($size) {
        $player = $this->state()->activePlayer();
        $this->assertEquals(count($player->discard), $size);
    }

    protected function assertOpponentDiscardSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->discard), $size);
    }

    protected function assertActions($actions) {
        $state = $this->state();
        $this->assertEquals($state->actions, $actions);
    }

    protected function assertNumberOfPlayed($number) {
        $state = $this->state();
        $this->assertEquals(count($state->activePlayer()->played), $number);
    }

    protected function assertNumberOfBuys($number) {
        $state = $this->state();
        $this->assertEquals($state->buys, $number);
    }

    protected function assertNumberOfCoins($coins) {
        $state = $this->state();
        $this->assertEquals($state->coins, $coins);
    }

    protected function assertTrashSize($size) {
        $state = $this->state();
        $this->assertEquals(count($state->trash), $size);
    }

    protected function assertAllCardsResolved() {
        $state = $this->state();
        $this->assertEquals($state->activePlayer()->hasUnresolvedCard(), false);
    }

    protected function assertNumberOfRemainingCards($stub, $number) {
        $state = $this->state();
        $this->assertEquals($state->kingdomCards[$stub], $number);
    }

    protected function assertNumberOfSetAside($number) {
        $state = $this->state();
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

    protected function assertPhase($phase) {
        $state = $this->state();
        $this->assertEquals($state->phase, $phase);
    }

    protected function log() {
        return $this->state()->log;
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
        $this->assertEquals($game->turn, $turn);
    }

    protected function assertGameOver() {
        $game = $this->state();
        $this->assertEquals($game->isResolved, true);
    }

    protected function state() {
        return $this->updater->state();
    }

    protected function setKingdomCards($kingdom) {
        $state = $this->state();
        $state->kingdomCards = $kingdom;
        $this->updater->setState($state);
    }

    protected function assertTotalNumberOfCardsForOpponent($amount) {
        $player = $this->state()->secondaryPlayer();
        $total = count($player->hand)
            + count($player->discard)
            + count($player->deck);
        $this->assertEquals($amount, $total);
    }

    protected function assertOpponentsNumberOfRemainingCards($stub, $amount) {
        $player = $this->state()->secondaryPlayer();

        $amountInPlay = 0;
        $hand = $player->hand;
        foreach ($hand as $card) {
            if ($card->stub === $stub) {
                $amountInPlay++;
            }
        }

        $deck = $player->deck;
        foreach ($deck as $card) {
            if ($card->stub === $stub) {
                $amountInPlay++;
            }
        }

        $discard = $player->discard;
        foreach ($discard as $card) {
            if ($card->stub === $stub) {
                $amountInPlay++;
            }
        }

        $this->assertEquals($amount, $amountInPlay);
    }

    protected function assertOpponentDiscardContains($stub) {
        $discard = $this->state()->secondaryPlayer()->discard;

        $isTrue = false;
        foreach ($discard as $card) {
            if ($card->stub === $stub) {
                $isTrue = true;
            }
        }

        $this->assertEquals($isTrue, true);
    }

    protected function assertNextStep($step) {
        $nextStep = $this->state()->activePlayer()->getNextStep();
        $nextStep = explode('/', $nextStep)[1];
        $this->assertEquals($nextStep, $step);
    }

    protected function assertOpponentRevealedSize($size) {
        $player = $this->state()->secondaryPlayer();
        $this->assertEquals(count($player->revealed), $size);
    }

    protected function setActivePlayerStartingCards($player) {
        $player->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        return $player;
    }

    protected function setSecondaryPlayerStartingCards($player) {
        $player->deck = [
            CardFactory::build('estate'),
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        $player->hand = [
            CardFactory::build('estate'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper'),
            CardFactory::build('copper')
        ];
        return $player;
    }
}
