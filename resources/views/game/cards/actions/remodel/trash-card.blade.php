@if ($activePlayer)
    <h2 class="__player-area-title">Select a treasure card to trash:</h2>
    @foreach ($player->hand() as $card)
        <div    class="__player-area-option game-button --highlighted"
                data-action="select-option"
                data-option="{{ $card->stub() }}"
        >
            {{ $card->name() }}
        </div>
    @endforeach
@else
    {{ $player->name() }} is selecting a treasure card to gain
@endif