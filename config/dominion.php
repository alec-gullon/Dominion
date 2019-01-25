<?php

return [
    'approved-kingdom-cards' => [
        'village',
        'smithy',
        'woodcutter',
        'witch',
        'council-room',
        'market',
        'festival',
        'adventurer',
        'laboratory',
        'gardens'
    ],
    'routes' => [
        'play-treasure' => 'Treasure@playTreasure',
        'end-turn' => 'Turn@endTurn',
        'buy' => 'Buy@buy',
        'advance-to-buy' => 'Buy@advanceToBuy',
        'play-card' => 'Card@play'
    ],
    'number-mappings' => [
        0 => 'no',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten'
    ]
];