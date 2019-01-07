<?php

namespace App\Game\Controllers\Actions;

use App\Game\Controllers\StateController;

class ActionController extends StateController {

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
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' gains ' . $amount . ' actions';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function drawCards($amount) {
        $remainingCards = $this->activePlayer()->numberOfDrawableCards();
        $this->activePlayer()->drawCards($amount);

        if ($remainingCards === 0) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws nothing';
        } else if ($remainingCards === 1 || $amount === 1) {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws a card';
        } else {
            $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' draws ' . $amount . ' cards';
        }
        $this->state->getLog()->addEntry($entry);
    }

    protected function describeRevealedCards() {
        $entry = '.. ' . $this->state->getActivePlayer()->getName() . ' reveals';
        $revealedCards = $this->state->getActivePlayer()->getRevealed();
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
        $numberMappings = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

        $i = 1;
        foreach ($cardAmounts as $name => $details) {
            $amount = $details['amount'];
            $card = $details['card'];
            if ($amount === 1) {
                $descriptor .= ' ' . $card->nameWithArticlePrefix();
            } else {
                $descriptor  .= ' ' . $numberMappings[$amount] . ' ' . $card->pluralFormOfName();
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