<?php

namespace App\Models\Game\Cards;

class Chapel extends Card {

    protected $value = 2;

    protected $stub = 'chapel';

    protected $name = 'Chapel';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'trash-selected-cards'
    );

}