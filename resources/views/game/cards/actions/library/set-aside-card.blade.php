<?php
$player = $this->state->getActivePlayer();
?>

<?php if ($playerKey === $player->getId()): $card = $player->getTopCard(); ?>
    <div>Next card is a <?= $card->getName() ?>? Do you want to set it aside?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving library...
<?php endif; ?>
