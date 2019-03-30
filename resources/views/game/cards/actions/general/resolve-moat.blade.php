@if (!$activePlayer)
    <h2 class="player-area-title">Do you reveal a Moat?</h2>
    <div class="player-area-options">
        @if ($state->secondaryPlayer()->hasCard('moat'))
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
    {{ $state->activePlayer()->name }} is choosing whether or not to reveal a moat
@endif
