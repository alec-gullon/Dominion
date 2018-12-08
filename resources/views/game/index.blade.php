<div class="game">
    <div class="game-board">
        @include('game.kingdom-cards')
        <div class="game-main">
            @include('game.key-stats')
            @include('game.standard-cards')
        </div>
    </div>
    @include('game.sidebar')
</div>