<?php
    $player = $state->getPlayerById($playerKey);
?>

<div class="game__hand">
    <h2 class="game__hand-title">Your Hand</h2>
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
        <div class="game__hand-card {{ bem('game-button--' . $type) }}">{{ $card->name() }}</div>
    @endforeach
</div>