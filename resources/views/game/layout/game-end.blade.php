@php
    $players = $state->players;

    $winner = $players[0];
    $loser = $players[1];
    if ($players[1]->score() > $players[0]->score()) {
        $winner = $players[1];
        $loser = $players[0];
    }

    $heading = 'Congratulations, you are the winner!';
    if ($winner->id !== $playerKey) {
        $heading = 'Unlucky, Marvin beat you this time!';
    }
@endphp

<div class="__game-end">
    @include('game.elements.score-card', [
        'heading' => $heading,
        'rows' => [
            [
                'name' => $winner->name,
                'score' => $winner->score()
            ],
            [
                'name' => $loser->name,
                'score' => $loser->score()
            ]
        ]
    ])

    <button class="button" data-action='start-ai-game'>Start a new game</button>
</div>