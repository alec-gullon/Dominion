<?php

namespace App\Game\Controllers\Actions;

class MineController extends ActionController {

    public function play() {
        $this->nextStep('trash-treasure');

        if($this->activePlayer()->hasCardsOfType('treasure')) {
            $this->inputOn();
            return;
        }
        $this->addToLog('.. Alec has nothing to trash');
        $this->resolveCard();
    }

    public function trashTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();
        $trashedCard = $this->cardBuilder->build($stub);

        $this->trashCards([$stub]);
        $mineCard->treasureValue = $trashedCard->getValue() + 3;

        $userCanSelectCard = false;

        $cards = $this->state->getKingdomCards();
        foreach ($cards as $stub => $amount) {
            $card = $this->cardBuilder->build($stub);

            if ($card->hasType('treasure') && $card->getValue() <= $mineCard->treasureValue && $amount > 0) {
                $userCanSelectCard = true;
                break;
            }
        }

        if ($userCanSelectCard) {
            $this->nextStep('gain-treasure');
            $this->inputOn();
        } else {
            $this->addToLog('.. Alec has no cards which they can gain');
            $this->resolveCard();
        }
    }

    public function gainTreasure($stub) {
        $mineCard = $this->activePlayer()->getUnresolvedCard();

        $this->gainCard($stub, $this->activePlayer(), 'hand');

        $gainedCard = $this->cardBuilder->build($stub);
        $this->addToLog('.. Alec gains ' . $gainedCard->nameWithArticlePrefix() . ', putting it in their hand');
        $mineCard->treasureValue = 0;
        $this->resolveCard();
    }

}