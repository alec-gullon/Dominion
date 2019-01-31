<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="hand">
    <h2>Your Hand</h2>
    @foreach ($player->hand() as $card)
        <?php
            if ($card->hasType('victory')) {
                $class = 'victory';
            } else if ($card->hasType('treasure')) {
                $class = 'treasure';
            } else if ($card->stub() === 'curse') {
                $class = 'curse';
            } else {
                $class = 'action';
            }
        ?>
        <div class="hand-card hand-card--{{ $class }}">{{ $card->name() }}</div>
    @endforeach
</div>