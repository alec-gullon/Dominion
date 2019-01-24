<?php
    $player = $state->activePlayer();
    $cards = $player->hand();
?>

<?php if ($playerKey !== $playerKey): ?>
    Waiting for other player to choose a card to trash...
<?php else: ?>
    <?php foreach ($cards as $card): ?>
        <div class="hand-card" data-test-active>
            <?= $card->name() ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>