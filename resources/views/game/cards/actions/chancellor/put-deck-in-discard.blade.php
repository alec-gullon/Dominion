<?php
$player = $state->activePlayer();
?>

<?php if ($playerKey === $player->id()): ?>
    <div>Put Deck in Discard?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving chancellor...
<?php endif; ?>
