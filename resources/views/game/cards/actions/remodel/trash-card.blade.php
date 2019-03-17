@if ($activePlayer)
    <h2 class="__player-area-title">Select a treasure card to trash:</h2>
    <div class="__player-area-options">
        @foreach ($player->hand as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $player->name }} is selecting a treasure card to gain
@endif