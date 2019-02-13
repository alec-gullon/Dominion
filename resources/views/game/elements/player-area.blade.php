<?php
    $playerAreaView = 'game.elements.player-area.play-card-from-hand';
    $nextStep = $state->activePlayer()->getNextStep();
    if (null !== $nextStep) {
        $playerAreaView = 'game.cards.actions.' . $nextStep;
    }
?>

<div class="__player-area">
    @include($playerAreaView)
</div>