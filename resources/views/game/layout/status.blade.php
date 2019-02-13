<div class="__status">
    <div class="__status-resource">Actions: <span class="__status-amount">{{ $state->actions() }}</span></div>
    <div class="__status-resource">Buys: <span class="__status-amount">{{ $state->buys() }}</span></div>
    <div class="__status-resource">Coins: <span class="__status-amount">{{ $state->coins() }}</span></div>
    <div class="__status-resource">Phase: <span class="__status-amount">{{ ucfirst($state->phase()) }}</span></div>
</div>