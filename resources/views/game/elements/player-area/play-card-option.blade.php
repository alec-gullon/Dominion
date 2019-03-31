@php
    $stub = $card->stub;
    $type = $card->types[0];

    $action = null;
    if ($type === 'treasure') {
        $action = 'play-treasure';
    } else if ($type === 'action' && App\Game\Helpers\ViewHelper::canPlayAction($state)) {
        $action = 'play-card';
    }
@endphp

@if ($action !== null)
    <div class="player-area-option game-button highlighted {{ $type }}"
         data-action="{{ $action }}"
         data-stub="{{ $stub }}"
         data-test="player-area-option"
    >
        {{ $card->name }}
    </div>
@endif