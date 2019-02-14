@if ($activePlayer)
    <h2 class="__player-area-title">Select a treasure card to trash:</h2>
    <div class="__player-area-options">
        @foreach ($player->hand() as $card)
            @if ($card->hasType('treasure'))
                <div    class="__player-area-option game-button --highlighted"
                        data-action="select-option"
                        data-option="{{ $card->stub() }}"
                >
                    {{ $card->name() }}
                </div>
            @endif
        @endforeach
    </div>
@else
    {{ $player->name() }} is selecting a treasure card to trash
@endif