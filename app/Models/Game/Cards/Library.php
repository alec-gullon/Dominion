<?php

namespace App\Models\Game\Cards;

class Library extends Card {

    protected $value = 5;

    protected $stub = 'library';

    protected $name = 'Library';

    protected $types = array(
        'action'
    );

    protected $steps = array(
        'play',
        'draw-until-action-card',
        'set-aside-card'
    );

    public $numberOfCardsDrawn = 0;

}