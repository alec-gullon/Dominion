<?php
    $stub = $card->stub;
    $type = $card->types[0];
?>

@if ($type === 'treasure')
    <div class="player-area-option game-button highlighted {{ $type }}"
         data-action="play-treasure"
         data-stub="{{ $stub }}"
         data-test="player-area-option"
    >
        {{ $card->name }}
    </div>
@elseif ($type === 'action' && App\Game\Helpers\ViewHelper::canPlayAction($state))
    <div class="player-area-option game-button highlighted {{ $type }}"
         data-action="play-card"
         data-stub="{{ $stub }}"
         data-test="player-area-option"
    >
        {{ $card->name }}
    </div>
@endif