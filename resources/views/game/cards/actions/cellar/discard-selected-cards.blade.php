@if ($isActivePlayer)
    <h2 class="player-area-title">Select the cards you want to discard:</h2>
    @include ('game.cards.actions.elements.select-multiple-options', [
        'cards' => $player->hand,
        'submitMessage' => 'Discard Cards'
    ])
@else
    {{ $state->activePlayer()->name }} is discarding cards
@endif
