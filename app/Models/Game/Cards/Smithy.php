<?php

namespace App\Models\Game\Cards;

class Smithy extends Card {

    protected $value = 4;

    protected $stub = 'smithy';

    protected $name = 'Smithy';

    protected $type = array(
        'action'
    );

    protected $steps = array(
        'play'
    );

}