<?php

namespace App\Game\Validators\Actions;

class MineValidator extends ActionValidator {

    public function trashTreasure($input) {
        return true;
    }

    public function gainTreasure($input) {
        return true;
    }

}