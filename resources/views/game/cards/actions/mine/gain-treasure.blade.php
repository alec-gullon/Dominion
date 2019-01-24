<?php
    $player = $state->activePlayer();
    $cards = $state->kingdomCards();
?>

<?php if ($playerKey !== $playerKey): ?>
    Waiting for other player to choose a card to trash...
<?php else: ?>
    <?php foreach ($cards as $stub => $amount): ?>
        <?php if ($amount > 0): $card = App\Game\Factories\CardFactory::build($stub); ?>
            <?php if ($card->value() <= $player->unresolvedCard()->treasureValue && $card->hasType('treasure')): ?>
            <div class="active" data-test-active>
                <?= $card->name(); ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>