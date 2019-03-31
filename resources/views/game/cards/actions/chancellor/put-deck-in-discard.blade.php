@if ($isActivePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => 'Put Deck in Discard?'])
@else
    {{ $state->activePlayer()->name }} is deciding whether or not to discard their deck
@endif