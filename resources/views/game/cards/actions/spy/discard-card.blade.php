<?php
    $player = $state->activePlayer();
    $card = $player->topCard();
?>

<?php if ($playerKey === $player->id()): ?>
    You reveal a <?= $card->name(); ?> from the top of your deck. Do you want to discard it?
    <div data-test-active>
        Yes
    </div>
    <div data-test-active>
        No
    </div>
<?php else: ?>
    Player is resolving their spy card...
<?php endif; ?>
