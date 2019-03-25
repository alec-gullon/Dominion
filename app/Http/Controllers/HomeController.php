<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    /**
     * Returns an html shell to the front-end
     *
     * @return  \Illuminate\Http\Response
     */
    public function index() {
        return view('index');
    }

}