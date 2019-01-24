<?php
    $player = $state->getPlayerById($playerKey);
?>

<h1 class="game-sidebar__prompt">
    Cards in Hand
</h1>

@foreach ($player->hand() as $card)
    @if ($gameObserver->isHandCardActive($card, $playerKey))
        <?php
            if ($card->hasType('action')) {
                $action = 'play-card';
            } else {
                $action = 'play-treasure';
            }
        ?>
        <div class="card card--active" data-action="<?= $action ?>" data-stub="<?= $card->stub() ?>">
            <?= $card->name() ?>
        </div>
    @else
        <div class="card">
            <?= $card->name() ?>
        </div>
    @endif
@endforeach

@if ($playerKey === $state->activePlayerId())
    <div class="card card--active" data-action="end-turn">
        End Turn
    </div>
@endif