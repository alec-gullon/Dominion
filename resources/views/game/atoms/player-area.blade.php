<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="__player-area">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        <h2 class="__player-area-title">Select a card to play:</h2>
        <div class="__player-area-options">
            @foreach ($player->hand() as $card)
                @if ($card->hasType('treasure'))
                    <div class="__player-area-option" data-action="play-treasure" data-stub="{{ $card->stub() }}">
                        {{ $card->name() }}
                    </div>
                @endif
            @endforeach
        </div>

        <h2 class="__player-area-title">Or alternatively:</h2>
        <div class="__player-area-options">
            <div class="__player-area-option">Play all treasures</div>
            <div class="__player-area-option" data-action="end-turn">End turn</div>
        </div>
    @else
        @include('game.cards.actions.' . $gameObserver->playerAreaView($state, $playerKey))
    @endif
</div>