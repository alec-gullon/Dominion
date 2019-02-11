<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="game__player-area">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        <h2 class="game__player-area-title">Select a card to play:</h2>
        <div class="game__player-area-options">
            @foreach ($player->hand() as $card)
                @if ($card->hasType('treasure') || $card->hasType('action'))
                    <?php $class = 'game-button--active--' . $card->types()[0]; ?>
                    <div class="{{ bem($class) }} game__player-area-option" data-action="play-treasure" data-stub="{{ $card->stub() }}">
                        {{ $card->name() }}
                    </div>
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