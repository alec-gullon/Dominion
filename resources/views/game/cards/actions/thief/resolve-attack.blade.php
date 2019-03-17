<?php
    $revealedCards = $state->secondaryPlayer()->revealed;
?>

@if ($activePlayer)
    <h2 class="__player-area-title">{{ $state->secondaryPlayer()->name }} reveals a {{ $revealedCards[0]->name() }}
    and a {{ $revealedCards[1]->name() }} from the top of their deck. Which do you trash?</h2>
    <div class="__player-area-options">
        @include ('game.cards.actions.elements.card-button', ['card' => $revealedCards[0]])
        @include ('game.cards.actions.elements.card-button', ['card' => $revealedCards[1]])
    </div>
@else
    {{ $player->name }} reveals a {{ $revealedCards[0]->name() }} and a {{ $revealedCards[1]->name() }} from the
    top of your deck. They are deciding which to trash...
@endif