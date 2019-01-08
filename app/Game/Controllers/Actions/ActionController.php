<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

    protected $numberMappings = ['no', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

    protected function inputOn() {
        $this->state->togglePlayerInput(true);
    }

    protected function inputOff() {
        $this->state->togglePlayerInput(false);
    }

    protected function activePlayer() {
        return $this->state->getActivePlayer();
    }

    protected function secondaryPlayer() {
        return $this->state->getSecondaryPlayer();
    }

    protected function nextStep($step) {
        $this->activePlayer()->setNextStep($step);
    }

    protected function resolveCard() {
        $this->inputOff();
        $this->activePlayer()->resolveCard();
    }

    protected function addActions($amount) {
        $this->state->addActions($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains an action';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' actions';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function addBuys($amount) {
        $this->state->gainBuys($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->activePlayer()->getName() . ' gains a buy';
        } else {
            $entry = '.. ' . $this->activePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' buys';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function drawCards($amount, $playerKey = null) {
        if ($playerKey === null) {
            $player = $this->activePlayer();
        } else {
            $player = $this->state->getPlayerByKey($playerKey);
        }
        $remainingCards = $player->numberOfDrawableCards();
        $player->drawCards($amount);

        if ($remainingCards < $amount) {
            $amount = $remainingCards;
        }
        $entry = $this->drawcardDescription($amount, $player);
        $this->addToLog($entry);
    }

    protected function drawCardDescription($amount, $player) {
        if ($amount === 0) {
            $entry = '.. ' . $player->getName() . ' draws nothing';
        } else if ($amount === 1) {
            $entry = '.. ' . $player->getName() . ' draws a card';
        } else {
            $entry = '.. ' . $player->getName() . ' draws ' . $this->numberMappings[$amount] . ' cards';
        }
        return $entry;
    }

    protected function discardCards($cards, $playerKey = null) {
        if ($playerKey === null) {
            $player = $this->activePlayer();
        } else {
            $player = $this->state->getPlayerByKey($playerKey);
        }

        $player->discardCards($cards);
        $entry = $this->discardCardsDescription($cards, $player);
        $this->addToLog($entry);
    }

    protected function discardCardsDescription($cards, $player) {
        $cardStack = [];
        foreach ($cards as $stub) {
            $cardStack[] = $this->cardBuilder->build($stub);
        }
        $entry = '.. ' . $player->getName() . ' discards';
        $entry .= $this->describeCardList($cardStack);
        return $entry;
    }

    protected function trashCardsDescription($cards) {
        $entry = '.. ' . $this->activePlayer()->getName() . ' trashes';

        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $cardStack = [];
            foreach ($cards as $stub) {
                $cardStack[] = $this->cardBuilder->build($stub);
            }
            $entry = '.. ' . $this->activePlayer()->getName() . ' trashes';
            $entry .= $this->describeCardlist($cardStack);
        }
        $this->addToLog($entry);
    }

    protected function gainCardDescription($stub) {
        $card = $this->cardBuilder->build($stub);
        $entry = '.. ' . $this->activePlayer()->getName() . ' gains ' . $card->nameWithArticlePrefix();
        $this->addToLog($entry);
    }

    protected function describeRevealedCards($player = null) {
        if ($player === null) {
            $player = $this->activePlayer();
        }
        $entry = '.. ' . $player->getName() . ' reveals';
        $revealedCards = $player->getRevealed();
        $entry .= $this->describeCardList($revealedCards);
        $this->addToLog($entry);
    }

    protected function describeHand($opponentHand = false) {
        if ($opponentHand) {
            $player = $this->state->getSecondaryPlayer();
        } else {
            $player = $this->state->getActivePlayer();
        }
        $cards = $player->getHand();
        $entry = '.. ' . $player->getName() . ' reveals a hand of';
        $entry .= $this->describeCardlist($cards);
        $this->addToLog($entry);
    }

    protected function moveCardOntoDeckFromKingdom($card, $player) {
        $this->state->moveCardOntoDeck($card, $player->getId());

        $entry = '.. ' . $player->getName() . ' places';

        $kingdomCards = $this->state->getKingdomCards();
        if ($kingdomCards[$card] === 0) {
            $entry .= ' nothing on their deck';
        } else {
            $card = $this->cardBuilder->build($card);
            $entry .= ' ' . $card->nameWithArticlePrefix() . ' onto their deck';
        }
        $this->addToLog($entry);
    }

    protected function moveCardOntoDeck($from, $card, $player) {
        $player->moveCardOntoDeck($from, $card);
        $card = $this->cardBuilder->build($card);
        $entry = '.. ' . $player->getName() . ' places ' . $card->nameWithArticlePrefix() . ' onto their deck from their ' . $from;
        $this->addToLog($entry);
    }

    protected function moveCardsOfType($from, $where, $type) {
        $cardsToMove = $this->state->getActivePlayer()->getCardsOfType($from, $type);

        $entry = '.. ' . $this->state->getActivePlayer()->getName();
        if (count($cardsToMove) === 0) {
            $entry .= ' does not put anything';
        } else {
            $entry .= ' puts';
        }
        $entry .= $this->describeCardList($cardsToMove);
        $entry .= ' into their ' . $where;
        $this->state->getLog()->addEntry($entry);

        $this->activePlayer()->moveCardsOfType($from, $where, $type);
    }

    protected function moveCards($from, $where) {
        $this->moveCardsOfType($from, $where, 'all');
    }

    protected function addToLog($entry) {
        $this->state->getLog()->addEntry($entry);
    }

    protected function revealMoat() {
        $this->addToLog('.. ' . $this->secondaryPlayer()->getName() . ' reveals a moat');
    }

    protected function gainCoins($amount) {
        $this->state->addCoins($amount);

        if ($amount === 1) {
            $entry = '.. ' . $this->activePlayer()->getName() . ' gains a coin';
        } else {
            $entry = '.. ' . $this->activePlayer()->getName() . ' gains ' . $this->numberMappings[$amount] . ' coins';
        }
        $this->addToLog($entry);
    }

    private function describeCardList($cards) {
        usort($cards, function($a, $b) {
             if ($a->getName() < $b->getName()) {
                 return -1;
             }
             return 1;
        });

        $cardAmounts = [];
        foreach ($cards as $card) {
            $name = $card->getName();
            if (!isset($cardAmounts[$name])) {
                $cardAmounts[$name] = [
                    'amount' => 0,
                    'card' => $card
                ];
            }
            $cardAmounts[$name]['amount']++;
        }

        $descriptor = '';

        $i = 1;
        foreach ($cardAmounts as $name => $details) {
            $amount = $details['amount'];
            $card = $details['card'];
            if ($amount === 1) {
                $descriptor .= ' ' . $card->nameWithArticlePrefix();
            } else {
                $descriptor  .= ' ' . $this->numberMappings[$amount] . ' ' . $card->pluralFormOfName();
            }

            if ($i === count($cardAmounts) - 1) {
                $descriptor .= ' and';
            } else if ($i < count($cardAmounts) - 1) {
                $descriptor .= ',';
            }

            $i++;
        }
        return $descriptor;
    }

}