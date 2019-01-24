<?php
$player = $state->activePlayer();
?>

<?php if ($playerKey === $player->id()): $card = $player->topCard(); ?>
    <div>Next card is a <?= $card->name() ?>? Do you want to set it aside?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving library...
<?php endif; ?>
