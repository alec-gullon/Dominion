<?php
$player = $this->state->getActivePlayer();
?>

<?php if ($playerKey === $player->getId()): ?>
    <div>Trash a copper from your hand?</div>
    <div data-test-active>Yes</div>
    <div data-test-active>No</div>
<?php else: ?>
    Player is resolving moneylender...
<?php endif; ?>
