<?php
    $player = $state->getActivePlayer();
    $cards = $player->getHand();
?>

<?php if ($playerKey === $player->getId()): ?>
    <?php foreach ($cards as $card): ?>
        <div data-test-active>
            <?= $card->getName(); ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    Player is discarding cards...
<?php endif; ?>
