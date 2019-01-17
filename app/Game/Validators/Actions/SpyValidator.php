<?php

namespace App\Game\Validators\Actions;

class SpyValidator extends ActionValidator {

    public function resolveMoat($input) {
        return is_bool($input);
    }

    public function discardCard($input) {
        return is_bool($input);
    }

    public function discardOpponentCard($input) {
        return is_bool($input);
    }

}