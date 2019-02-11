<?php
    $cards = $state->kingdomCards();
?>

<h2 class="game__player-area-title">Select a card to gain:</h2>
<div class="game__player-area-options">
    <?php foreach ($cards as $stub => $amount): $card = App\Game\Factories\CardFactory::build($stub); ?>
        <?php if ($card->value() <= 4): ?>
            <div class="{{ bem('game-button--active') }} game__player-area-option"
                 data-action="select-option"
                 data-option="<?= $card->stub() ?>"
            >
                <?= $card->name() ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
