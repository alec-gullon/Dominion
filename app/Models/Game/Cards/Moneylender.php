<?php

namespace App\Models\Game\Cards;

class Moneylender extends Card {

    protected $value = 3;

    protected $stub = 'moneylender';

    protected $name = 'Moneylender';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'trash-copper'
    );

}