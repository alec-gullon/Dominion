@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => 'Do You Reveal a Moat?'])
@else
    {{ $state->activePlayer() }} is choosing whether or not to reveal a moat
@endif
