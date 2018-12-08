<?php
    $player = $state->getSecondaryPlayer();
?>

<?php if ($playerKey === $player->getId()): ?>

<div class="player-prompt">
    Do you reveal a moat?
</div>

<?php if ($player->hasCard('moat')): ?>
<div class="player-option active" data-test-active>
    Yes
</div>
<?php endif; ?>

<div class="player-option active" data-test-active>
    No
</div>

<?php else: ?>

Waiting on player to resolve their moat...

<?php endif; ?>
