<div class="game__status">
    <div class="game__status-resource">Actions: <span class="game__status-amount">{{ $state->actions() }}</span></div>
    <div class="game__status-resource">Buys: <span class="game__status-amount">{{ $state->buys() }}</span></div>
    <div class="game__status-resource">Coins: <span class="game__status-amount">{{ $state->coins() }}</span></div>
    <div class="game__status-resource">Phase: <span class="game__status-amount">{{ ucfirst($state->phase()) }}</span></div>
</div>