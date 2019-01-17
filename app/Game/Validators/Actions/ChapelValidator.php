<?php

namespace App\Game\Validators\Actions;

class ChapelValidator extends ActionValidator {

    public function trashSelectedCards($input) {
        return true;
    }

}