<?php
    $class = 'game-button--active--' . $card->types()[0];

    $action = 'play-card';
    if ($card->hasType('treasure')) {
        $action = 'play-treasure';
    }
?>

<div class="{{ bem($class) }} game__player-area-option" data-action="{{ $action }}" data-stub="{{ $card->stub() }}">
    {{ $card->name() }}
</div>