<?php
    $cards = $state->kingdomCards();
?>

<?php foreach ($cards as $stub => $amount): $card = App\Services\Factories\CardFactory::build($stub); ?>
    <?php if ($card->getValue() <= 4): ?>
        <div class="hand-card active" data-action="select-option" data-option="<?= $card->stub() ?>">
            <?= $card->getName() ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
