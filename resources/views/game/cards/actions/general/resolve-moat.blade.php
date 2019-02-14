@if ($activePlayer)
    <h2 class="__player-area-title">Do you reveal a moat?</h2>
    <div class="__player-area-options">
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="true"
        >
            Yes
        </div>
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="false"
        >
            No
        </div>
    </div>
@else
    {{ $state->activePlayer() }} is choosing whether or not to reveal a moat
@endif
