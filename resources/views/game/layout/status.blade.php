<div class="status">
    <div class="status-resource">Actions: <span class="status-amount">{{ $state->actions }}</span></div>
    <div class="status-resource">Buys: <span class="status-amount">{{ $state->buys }}</span></div>
    <div class="status-resource">Coins: <span class="status-amount">{{ $state->coins }}</span></div>
    <div class="status-resource">Phase: <span class="status-amount">{{ ucfirst($state->phase) }}</span></div>
</div>