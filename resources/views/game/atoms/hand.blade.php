<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="__hand">
    <h2 class="__hand-title">Your Hand</h2>
    @foreach ($player->hand() as $card)
        <?php
            if ($card->hasType('victory')) {
                $type = 'victory';
            } else if ($card->hasType('treasure')) {
                $type = 'treasure';
            } else if ($card->stub() === 'curse') {
                $type = 'curse';
            } else {
                $type = 'action';
            }
        ?>
        <div class="{{ bem('hand-card--' . $type) }}">{{ $card->name() }}</div>
    @endforeach
</div>