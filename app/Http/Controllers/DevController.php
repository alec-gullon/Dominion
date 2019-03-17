<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game\Services\Updater;
use App\Game\Services\Setup\SetsUpAIGame;

use App\Game\Models\State;
use App\Models\Game as GameModel;

use App\Http\Renderers\GameRenderer;

use App\Pommel\Src\Pommel;

class DevController extends Controller {

    public function viewDigitalPatternLibrary(Request $request) {
        return view('dev.digital-pattern-library');
    }

    public function pommel() {
        $pommel = new Pommel;
        $pommel->render();
    }

}