@if ($activePlayer)
    <h2 class="__player-area-title">Select a card to play:</h2>
    <div class="__player-area-options">
        @foreach ($player->hand as $card)
            @include('game.elements.player-area.play-card-option', ['card' => $card])
        @endforeach
    </div>

    <h2 class="__player-area-title">Or alternatively:</h2>
    <div class="__player-area-options">
        <div class="__player-area-option game-button --white --highlighted">Play all treasures</div>
        <div class="__player-area-option game-button --white --highlighted" data-action="end-turn">End turn</div>
    </div>
@endif