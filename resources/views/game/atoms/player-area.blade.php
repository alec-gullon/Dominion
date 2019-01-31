<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="player-area">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        <h2>Select a card to play:</h2>
        <div class="player-area-options">
            @foreach ($player->hand() as $card)
                <div class="option">
                    {{ $card->name() }}
                </div>
            @endforeach
        </div>

        <h2>Or alternatively:</h2>
        <div class="player-area-options">
            <div class="option">Play all treasures</div>
            <div class="option">End turn</div>
        </div>
    @else
        @include('game.cards.actions.' . $gameObserver->playerAreaView($state, $playerKey))
    @endif
</div>