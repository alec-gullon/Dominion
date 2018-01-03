<?php

namespace App\Models\Game;

class Log {

    private $entries = [];

    private $currentTurn = 1;

    public function addEntry($entry) {
        if (!isset($this->entries[$this->currentTurn])) {
            $this->entries[$this->currentTurn] = [];
        }
        $this->entries[$this->currentTurn][] = $entry;
    }

    public function flattenedEntries() {
        $flattenedEntries = [];
        foreach ($this->entries as $turn => $turnEntries) {
            foreach ($turnEntries as $turnEntry) {
                $flattenedEntries[] = $turnEntry;
            }
        }
        return $flattenedEntries;
    }

}