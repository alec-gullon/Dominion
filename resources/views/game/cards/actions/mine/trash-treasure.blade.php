<?php
$player = $state->activePlayer();
$cards = $player->getHand();
?>

<?php if ($playerKey !== $playerKey): ?>
    Waiting for other player to choose a card to trash...
<?php else: ?>
    <?php foreach ($cards as $card): ?>
        <?php if ($card->hasType('treasure')) : ?>
            <div class="hand-card" data-test-active>
                <?= $card->getName() ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>