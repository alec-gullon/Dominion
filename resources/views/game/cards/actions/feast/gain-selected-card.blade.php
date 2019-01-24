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
