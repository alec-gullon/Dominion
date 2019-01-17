<?php

namespace App\Game\Validators\Actions;

class RemodelValidator extends ActionValidator {

    public function trashCard($input) {
        return true;
    }

    public function gainSelectedCard($input) {
        return true;
    }

}