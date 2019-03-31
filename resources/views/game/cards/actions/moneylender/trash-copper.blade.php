@if ($isActivePlayer)
    <h2 class="player-area-title">Trash a Copper from your hand?</h2>
        <div class="player-area-options">
            @if ($player->hasCard('copper'))
                <div    class="player-area-option game-button highlighted"
                        data-action="select-option"
                        data-option="true"
                >
                    Yes
                </div>
            @endif
            <div    class="player-area-option game-button highlighted"
                    data-action="select-option"
                    data-option="false"
            >
                No
            </div>
        </div>

@else
    {{ $state->activePlayer()->name }} is choosing whether or not to trash a Copper...
@endif
