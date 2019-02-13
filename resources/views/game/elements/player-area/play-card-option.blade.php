@if ($card->hasType('treasure'))
    <div class="__player-area-option game-button --highlighted --{{ $card->types()[0] }}" data-action="play-treasure" data-stub="{{ $card->stub() }}">
        {{ $card->name() }}
    </div>
@elseif ($card->hasType('action') && $state->phase() === 'action' && $state->actions() > 0)
    <div class="__player-area-option game-button --highlighted --{{ $card->types()[0] }}" data-action="play-card" data-stub="{{ $card->stub() }}">
        {{ $card->name() }}
    </div>
@endif