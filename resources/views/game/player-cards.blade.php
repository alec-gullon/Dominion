<?php
    $player = $state->getPlayerByKey($playerKey);
?>

<h1 class="game-sidebar__prompt">
    Cards in Hand
</h1>

@foreach ($player->getHand() as $card)
    @if ($gameObserver->isHandCardActive($card, $playerKey))
        <?php
            if ($card->hasType('action')) {
                $action = 'play-card';
            } else {
                $action = 'play-treasure';
            }
        ?>
        <div class="card card--active" data-action="<?= $action ?>" data-stub="<?= $card->getStub() ?>">
            <?= $card->getName() ?>
        </div>
    @else
        <div class="card">
            <?= $card->getName() ?>
        </div>
    @endif
@endforeach

@if ($playerKey === $state->getActivePlayerKey())
    <div class="card card--active" data-action="end-turn">
        End Turn
    </div>
@endif