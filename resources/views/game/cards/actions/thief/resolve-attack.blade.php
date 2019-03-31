@php
    $revealedCards = $state->secondaryPlayer()->revealed;
@endphp

@if ($isActivePlayer)
    <h2 class="player-area-title">
        {{ $state->secondaryPlayer()->name }} reveals a {{ $revealedCards[0]->name }} and a {{ $revealedCards[1]->name }} from the top of their deck. Which do you trash?
    </h2>
    <div class="player-area-options">
        @include ('game.cards.actions.elements.card-button', ['card' => $revealedCards[0]])
        @include ('game.cards.actions.elements.card-button', ['card' => $revealedCards[1]])
    </div>
@else
    You reveal a {{ $revealedCards[0]->name }} and a {{ $revealedCards[1]->name }} from the top of your deck. Alec is deciding which one to trash...
@endif