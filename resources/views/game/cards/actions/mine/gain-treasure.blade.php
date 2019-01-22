<?php
    $player = $state->activePlayer();
    $cards = $state->kingdomCards();
?>

<?php if ($playerKey !== $playerKey): ?>
    Waiting for other player to choose a card to trash...
<?php else: ?>
    <?php foreach ($cards as $stub => $amount): ?>
        <?php if ($amount > 0): $card = App\Services\Factories\CardFactory::build($stub); ?>
            <?php if ($card->getValue() <= $player->unresolvedCard()->treasureValue && $card->hasType('treasure')): ?>
            <div class="active" data-test-active>
                <?= $card->getName(); ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>