<?php
$player = $state->getActivePlayer();
?>

<?php if ($playerKey === $player->getId()): ?>
    <div>Put Deck in Discard?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving chancellor...
<?php endif; ?>
