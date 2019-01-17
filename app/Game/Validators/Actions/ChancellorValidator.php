<?php

namespace App\Game\Validators\Actions;

class ChancellorValidator extends ActionValidator {

    public function putDeckInDiscard($input) {
        return is_bool($input);
    }

}