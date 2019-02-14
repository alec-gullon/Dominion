@if ($activePlayer)
    <h2 class="__player-area-title">Select cards to trash</h2>
    <div class="__player-area-options">
        @foreach ($player->hand() as $card)
            <div    class="__player-area-option"
                    data-option="{{ $card->stub() }}"
            >
                {{ $card->name() }}
            </div>
        @endforeach
    </div>
@else
    {{ $state->activePlayer()->name() }} is selecting cards to trash
@endif
