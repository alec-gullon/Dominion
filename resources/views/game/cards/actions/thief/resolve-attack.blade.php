<?php
    $revealedCards = $state->secondaryPlayer()->revealed();
?>

@if ($activePlayer)
    <h2 class="__player-area-title">{{ $state->secondaryPlayer()->name() }} reveals a {{ $revealedCards[0]->name() }}
    and a {{ $revealedCards[1]->name() }} from the top of their deck. Which do you trash?</h2>
    <div class="__player-area-options">
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="{{ $revealedCards[0]->stub() }}"
        >
            {{ $revealedCards[0]->name() }}
        </div>
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="{{ $revealedCards[1]->stub() }}"
        >
            {{ $revealedCards[1]->name() }}
        </div>
    </div>
@else
    {{ $player->name() }} reveals a {{ $revealedCards[0]->name() }} and a {{ $revealedCards[1]->name() }} from the
    top of your deck. They are deciding which to trash...
@endif