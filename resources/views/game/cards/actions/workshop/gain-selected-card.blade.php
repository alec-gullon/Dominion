<?php
    $cards = $state->kingdomCards();
?>

<?php foreach ($cards as $stub => $amount): $card = App\Game\Factories\CardFactory::build($stub); ?>
    <?php if ($card->value() <= 4): ?>
        <div class="hand-card active" data-action="select-option" data-option="<?= $card->stub() ?>">
            <?= $card->name() ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
