@if ($activePlayer)
    <h2 class="__player-area-title">You reveal a {{ $player->topCard() }} from the top of your deck. Do you want
        to discard it?</h2>
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
    {{ $player->name() }} reveals a {{ $player->topCard() }} from the top of their deck. They are deciding
    whether to discard it or not...
@endif
