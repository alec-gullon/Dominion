<?php

namespace App\Game\Validators\Actions;

class MilitiaValidator extends ActionValidator {

    public function resolveMoat($input) {
        return true;
    }

    public function resolveAttack($input) {
        return true;
    }

}