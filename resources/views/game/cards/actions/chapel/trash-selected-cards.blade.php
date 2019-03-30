@if ($activePlayer)
    <h2 class="player-area-title">Select cards to trash</h2>
    @include ('game.cards.actions.elements.select-multiple-options', [
        'cards' => $player->hand,
        'submitMessage' => 'Trash Cards'
    ])
@else
    {{ $state->activePlayer()->name }} is selecting cards to trash
@endif
