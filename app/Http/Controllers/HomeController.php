<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game\Models;

class HomeController extends Controller {

    public function index() {
        /**
         * We render a html wrapper to start with, then we can make an ajax request if the player is in a game
         * or a form where they can enter their name
         */
        return view('index');
    }

    /**
     * When a player follows a link to join a game, they call this method. This dumps a simple form on the page, that
     * either prompts the user to establish an identity, or links the player with the given game and then redirects to
     * the home page
     */
    public function join($guid) {
        $game = Game::where('guid', $guid)->first();

        return view('join', ['gameId' => $game->guid]);
    }

}