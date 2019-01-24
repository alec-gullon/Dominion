<?php
    $player = $state->activePlayer();
    $cards = $player->hand();
?>

<?php if ($playerKey === $player->id()): ?>
    <?php foreach ($cards as $card): ?>
        <div data-test-active>
            <?= $card->name(); ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    Player is resolving chapel...
<?php endif; ?>
