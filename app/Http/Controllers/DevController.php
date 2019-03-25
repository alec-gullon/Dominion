<?php

namespace App\Http\Controllers;

class DevController extends Controller {

    /**
     * Loads in the Digital Pattern Library view
     */
    public function digitalPatternLibrary() {
        return view('dev.digital-pattern-library');
    }

}