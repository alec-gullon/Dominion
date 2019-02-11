<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="game__player-area">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        <h2 class="game__player-area-title">Select a card to play:</h2>
        <div class="game__player-area-options">
            @foreach ($player->hand() as $card)
                @if ($card->hasType('treasure'))
                    @include('game.elements.player-area.play-card-option', ['card' => $card])
                @endif

                @if ($card->hasType('action') && $state->phase() === 'action' && $state->actions() > 0)
                    @include('game.elements.player-area.play-card-option', ['card' => $card])
                @endif
            @endforeach
        </div>

        <h2 class="game__player-area-title">Or alternatively:</h2>
        <div class="game__player-area-options">
            <div class="{{ bem('game-button--white--active') }} game__player-area-option">Play all treasures</div>
            <div class="{{ bem('game-button--white--active') }} game__player-area-option" data-action="end-turn">End turn</div>
        </div>
    @else
        @include('game.cards.actions.' . $gameObserver->playerAreaView($state, $playerKey))
    @endif
</div>