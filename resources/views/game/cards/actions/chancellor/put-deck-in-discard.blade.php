@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['title' => 'Put Deck in Discard?'])
@else
    {{ $state->activePlayer()->name() }}
@endif