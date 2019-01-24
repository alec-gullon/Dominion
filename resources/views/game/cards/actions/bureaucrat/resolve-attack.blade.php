<?php
    $player = $state->secondaryPlayer();
    $secondaryPlayerKey = $state->secondaryPlayer()->id();
    $cards = $player->hand();
?>

<?php if ($playerKey !== $secondaryPlayerKey): ?>
Waiting for other player to choose a card...
<?php else: ?>
    <?php foreach ($cards as $card): ?>
        <?php if ($card->hasType('victory')) : ?>
            <div class="hand-card" data-test-active>
                <?= $card->name() ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>