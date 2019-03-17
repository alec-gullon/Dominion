@if ($activePlayer)
    {{ $state->secondaryPlayer()->name }} is choosing what cards to discard...
@else
    <h2 class="__player-area-title">Select the cards you want to discard:</h2>
    @foreach ($state->secondaryPlayer->hand as $card)
        <div    class="__player-area-option game-button --highlighted"
                data-option="{{ $card->stub }}"
        >
            {{ $card->name }}
        </div>
    @endforeach
    <div class="__player-area-option game-button --highlighted">
        Discard Cards
    </div>
@endif