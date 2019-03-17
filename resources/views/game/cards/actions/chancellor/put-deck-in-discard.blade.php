@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => 'Put Deck in Discard?'])
@else
    {{ $state->activePlayer()->name }}
@endif