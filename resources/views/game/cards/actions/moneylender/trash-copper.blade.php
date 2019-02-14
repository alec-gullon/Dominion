@if ($activePlayer)
    <h2 class="__player-area-title">Trash a copper from your hand?</h2>
    <div class="__player-area-options">
        @if ($player->hasCard('copper'))
            <div    class="__player-area-option"
                    data-action="select-option"
                    data-option="true"
            >
                Yes
            </div>
        @endif
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="false"
        >
            No
        </div>
    </div>
@else
    {{ $state->activePlayer()->name() }} is choosing whether or not to trash a Copper...
@endif
