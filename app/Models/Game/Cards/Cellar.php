<?php

namespace App\Models\Game\Cards;

class Cellar extends Card {

    protected $value = 2;

    protected $stub = 'cellar';

    protected $name = 'Cellar';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'discard-selected-cards'
    );

}