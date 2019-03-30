@if ($activePlayer)
    {{ $state->secondaryPlayer()->name }} is selecting a card
@else
    <h2 class="player-area-title">Select a victory card to place on your deck:</h2>
    <div class="player-area-options">
        @foreach ($player->hand as $card)
            @if ($card->hasType('victory'))
                @include ('game.cards.actions.elements.card-button', ['card' => $card])
            @endif
        @endforeach
    </div>
@endif