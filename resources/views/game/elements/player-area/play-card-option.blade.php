<?php
    $class = 'game-button--active--' . $card->types()[0];
?>

@if ($card->hasType('treasure'))
    <div class="{{ bem($class) }} game__player-area-option" data-action="play-treasure" data-stub="{{ $card->stub() }}">
        {{ $card->name() }}
    </div>
@elseif ($card->hasType('action') && $state->phase() === 'action' && $state->actions() > 0)
    <div class="{{ bem($class) }} game__player-area-option" data-action="play-card" data-stub="{{ $card->stub() }}">
        {{ $card->name() }}
    </div>
@endif