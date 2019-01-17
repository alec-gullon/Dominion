<?php

namespace App\Game\Validators\Actions;

use App\Models\Game\State;

class ActionValidator {

    protected $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

}