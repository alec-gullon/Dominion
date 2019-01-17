<?php

namespace App\Game\Validators\Actions;

class WitchValidator extends ActionValidator {

    public function resolveMoat($input) {
        return is_bool($input);
    }

}