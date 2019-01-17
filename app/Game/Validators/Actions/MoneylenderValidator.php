<?php

namespace App\Game\Validators\Actions;

class MoneylenderValidator extends ActionValidator {

    public function trashCopper($input) {
        return is_bool($input);
    }

}