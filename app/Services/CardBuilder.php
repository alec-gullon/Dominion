<?php

namespace App\Services;

class CardBuilder {

    public function build($card) {
        $parts = explode('-', $card);
        $composed = 'App\Models\Game\Cards\\';
        foreach($parts as $part) {
            $composed .= ucfirst($part);
        }
        return new $composed();
    }

}