<div class="game game-root">
    @if ($state->isResolved)
        @include('game.layout.game-end')
    @else
        @include('game.layout.top')
        @include('game.layout.status')
        @include('game.layout.bottom')
    @endif
</div>