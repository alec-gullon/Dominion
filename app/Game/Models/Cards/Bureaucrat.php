<?php

namespace App\Game\Models\Cards;

/**
 * Class representation of a Bureaucrat card from the Dominion card game
 */
class Bureaucrat extends Card {

    protected $value = 3;

    protected $stub = 'bureaucrat';

    protected $name = 'Bureaucrat';

    protected $types = [
        'action',
        'attack'
    ];

}