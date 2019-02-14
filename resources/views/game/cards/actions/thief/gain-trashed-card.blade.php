<?php
    $trashedCard = App\Game\Factories\CardFactory::build($player->unresolvedCard()->stub());
?>

@if ($activePlayer)
    <h2 class="__player-area-title">Do you want to gain the trashed {{ $trashedCard->name() }}?</h2>
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
    {{ $player->name() }} is deciding whether or not to gain the trashed card (a {{ $trashedCard->name() }}).
@endif