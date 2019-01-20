<?php

return [
    'kingdom-cards' => [
        'adventurer',
        'bureaucrat',
        'cellar',
        'chancellor',
        'chapel',
        'council-room',
        'feast',
        'festival',
        'garden',
        'laboratory',
        'library',
        'market',
        'militia',
        'mine',
        'moat',
        'moneylender',
        'remodel',
        'smithy',
        'spy',
        'thief',
        'throne-room',
        'village',
        'witch',
        'woodcutter',
        'workshop'
    ],
    'card-aliases' => [
        'remodel' => 'Remodel',
        'workshop' => 'Workshop'
    ],
    'game-routes' => [
        'play-treasure' => 'Treasure@playTreasure',
        'end-turn' => 'Turn@endTurn',
        'buy' => 'Buy@buy',
        'advance-to-buy' => 'Buy@advanceToBuy'
    ]
];