<?php
    $cards = [];
    foreach ($state->kingdomCards() as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->valiue() <= 5) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    <h2 class="__player-area-title">Select card you want to gain</h2>
    <div class="__player-area-options">
    @foreach ($cards as $stub => $amount)
        <div    class="__player-area-option"
                data-action="select-option"
                data-option="{{ $card->stub() }}"
        >
            {{ $card->name() }}
        </div>
    @endforeach
@else
    {{ $state->activePlayer() }} is selecting a card to gain...
@endif


<?php
    $cards = $state->kingdomCards();
?>

<?php foreach ($cards as $stub => $amount): $card = App\Game\Factories\CardFactory::build($stub); ?>
    <?php if ($card->value() <= 5): ?>
        <div class="hand-card active" data-test-active>
            <?= $card->name() ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
