@if ($activePlayer)
    <h2 class="__player-area-title">Select a card to play:</h2>
    <div class="__player-area-options">
        @foreach ($player->hand as $card)
            @include('game.elements.player-area.play-card-option', ['card' => $card])
        @endforeach
    </div>

    <h2 class="__player-area-title">Or alternatively:</h2>
    <div class="__player-area-options">
        @if ($player->hasCardsOfType('treasure'))
            <div class="__player-area-option game-button --white --highlighted" data-action="play-all-treasures">Play all treasures</div>
        @endif
        <div class="__player-area-option game-button --white --highlighted" data-action="end-turn">End turn</div>
    </div>
@endif