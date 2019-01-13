<?php
    $player = $state->secondaryPlayer();
    $secondaryPlayerKey = $state->secondaryPlayer()->getId();
    $cards = $player->getHand();
?>

<?php if ($playerKey !== $secondaryPlayerKey): ?>
Waiting for other player to choose a card...
<?php else: ?>
    <?php foreach ($cards as $card): ?>
        <?php if ($card->hasType('victory')) : ?>
            <div class="hand-card" data-test-active>
                <?= $card->getName() ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>