<?php

namespace App\Game\Validators\Actions;

class SpyValidator extends ActionValidator {

    public function resolveMoat($input) {
        return true;
    }

    public function discardCard($input) {
        return true;
    }

    public function discardOpponentCard($input) {
        return true;
    }

}