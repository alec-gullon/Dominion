<?php

namespace App\Game\Validators\Actions;

class ThroneRoomValidator extends ActionValidator {

    public function duplicateCard($input) {
        return true;
    }

}