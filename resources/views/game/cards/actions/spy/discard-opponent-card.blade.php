<?php
    $player = $state->secondaryPlayer();
    $card = $player->topCard();
?>

@if (false)

<?php if ($playerKey === $player->getId()): ?>
    You reveal a <?= $card->getName(); ?> from the top of their deck. Do you want to discard it?
    <div data-test-active>
        Yes
    </div>
    <div data-test-active>
        No
    </div>
<?php else: ?>
    Player is resolving their spy card...
<?php endif; ?>

@endif
