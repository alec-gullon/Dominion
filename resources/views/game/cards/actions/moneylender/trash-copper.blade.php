<?php
    $player = $state->activePlayer();
?>

<?php if ($playerKey === $player->id()): ?>
    <div>Trash a copper from your hand?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving moneylender...
<?php endif; ?>
