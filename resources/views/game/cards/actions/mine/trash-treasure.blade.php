@if ($isActivePlayer)
    <h2 class="player-area-title">Select a treasure card to trash:</h2>
    <div class="player-area-options">
        @foreach ($player->hand as $card)
            @if ($card->hasType('treasure'))
                @include ('game.cards.actions.elements.card-button', ['card' => $card])
            @endif
        @endforeach
    </div>
@else
    {{ $player->name }} is selecting a treasure card to trash
@endif