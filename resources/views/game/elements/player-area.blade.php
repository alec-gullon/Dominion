<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="__player-area">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        <h2 class="__player-area-title">Select a card to play:</h2>
        <div class="__player-area-options">
            @foreach ($player->hand() as $card)
                @include('game.elements.player-area.play-card-option', ['card' => $card])
            @endforeach
        </div>

        <h2 class="__player-area-title">Or alternatively:</h2>
        <div class="__player-area-options">
            <div class="__player-area-option game-button --white --highlighted">Play all treasures</div>
            <div class="__player-area-option game-button --white --highlighted" data-action="end-turn">End turn</div>
        </div>
    @else
        @include('game.cards.actions.' . $gameObserver->playerAreaView($state, $playerKey))
    @endif
</div>