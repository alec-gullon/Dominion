<?php
    $player = $state->getPlayerByKey($playerKey);
?>

<h1 class="game-sidebar__prompt">
    Cards in Hand
</h1>

@foreach ($player->getHand() as $card)
    @if ($gameObserver->isHandCardActive($card, $playerKey))
        <div class="card card--active" data-action="play-treasure" data-stub="<?= $card->getStub() ?>">
            <?= $card->getName() ?>
        </div>
    @else
        <div class="card">
            <?= $card->getName() ?>
        </div>
    @endif
@endforeach

@if ($playerKey === $state->getActivePlayerKey())
    <div class="card card--active" data-test-active>
        End Turn
    </div>
@endif