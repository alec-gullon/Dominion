<?php
    $cards = $state->getKingdomCards();
?>

<?php foreach ($cards as $stub => $amount): $card = $cardBuilder->build($stub); ?>
    <?php if ($card->getValue() <= 5): ?>
        <div class="hand-card active" data-test-active>
            <?= $card->getName() ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>