@if ($activePlayer)
    <h2 class="__player-area-title">You draw a <?= $player->topCard()->name() ?>? Do you want to set is aside?</h2>
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
    {{ $state->activePlayer()->name() }} is resolving their Library card...
@endif
