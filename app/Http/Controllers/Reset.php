<?php

namespace App\Http\Controllers;

class Reset extends Controller {

    public function reset() {
        \App\Models\User::truncate();
    }

}