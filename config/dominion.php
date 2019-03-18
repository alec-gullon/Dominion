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
        'gardens',
        'workshop',
        'cellar'
    ],
    'base-cards' => [
        'copper' => 30,
        'curse' => 10,
        'duchy' => 8,
        'estate' => 8,
        'gold' => 10,
        'province' => 8,
        'silver' => 20
    ],
    'routes' => [
        'play-treasure' => 'Treasure@playTreasure',
        'play-all-treasures' => 'Treasure@playAll',
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