<div class="game-sidebar">
    @if ('hand' === $gameObserver->playerAreaView($state, $playerKey))
        @include('game.player-cards')
    @else
        @include('game.cards.actions.' . $gameObserver->playerAreaView($state, $playerKey))
    @endif
</div>
