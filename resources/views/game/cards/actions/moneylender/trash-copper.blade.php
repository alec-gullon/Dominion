@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['title' => 'Trash a Copper from your hand?'])
@else
    {{ $state->activePlayer()->name }} is choosing whether or not to trash a Copper...
@endif
