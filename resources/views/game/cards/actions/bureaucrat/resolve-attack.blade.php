@if ($activePlayer)
    {{ $state->secondaryPlayer()->name() }} is selecting a card
@else
    <h2 class="__player-area-title">Select a victory card to place on your deck:</h2>
    @foreach ($player->hand() as $card)
        @if ($card->hasType('victory'))
            <div    class="__player-area-option game-button --highlighted"
                    data-action="select-option"
                    data-option="{{ $card->stub() }}"
            >
                {{ $card->name() }}
            </div>
        @endif
    @endforeach
@endif