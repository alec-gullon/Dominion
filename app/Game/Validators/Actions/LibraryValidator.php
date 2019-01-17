<?php

namespace App\Game\Validators\Actions;

class LibraryValidator extends ActionValidator {

    public function setAsideCard($input) {
        return is_bool($input);
    }

}