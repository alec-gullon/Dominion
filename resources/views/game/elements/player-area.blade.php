<?php
    $playerAreaView = 'game.elements.player-area.play-card-from-hand';
    $nextStep = $state->activePlayer()->getNextStep();
    if (null !== $nextStep) {
        if (strpos($nextStep, 'resolve-moat')) {
            $playerAreaView = 'game.cards.actions.general.resolve-moat';
        } else {
            $playerAreaView = 'game.cards.actions.' . $nextStep;
        }
    }
?>

<div class="player-area">
    @include($playerAreaView, [
        'isActivePlayer' => App\Game\Helpers\ViewHelper::isActivePlayer($state, $player)
    ])
</div>