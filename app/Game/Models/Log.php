<?php

namespace App\Game\Models;

/**
 * A log of actions and moments of interest that have occurred within a given game of Dominion
 */
class Log {

    /**
     * The collection of entries that are in the log. Each key is an integer representing a turn number,
     * which then references an array of strings that are entries. These entries within the array
     * are organised with the oldest at the beginning and newest at the end. For example:
     *
     * $entries = [
     *      1 => [
     *          'Alec plays a Village',
     *          '.. Alec gains two actions',
     *          '.. Alec draws a card'
     *      ]
     * ]
     *
     * @var array
     */
    private $entries = [];

    /**
     * The turn that new entries should be recorded against
     *
     * @var int
     */
    private $currentTurn;

    public function __construct() {
        $this->setCurrentTurn(1);
    }

    public function entries() {
        return $this->entries;
    }

    public function currentTurn() {
        return $this->currentTurn;
    }

    public function setCurrentTurn($turn) {
        $this->currentTurn = $turn;
        if (!isset($this->entries[$turn])) {
            $this->entries[$turn] = [];
        }
    }

    /**
     * Adds an entry to the log against the current turn
     *
     * @param   string      $entry
     */
    public function addEntry($entry) {
        if (!isset($this->entries[$this->currentTurn])) {
            $this->entries[$this->currentTurn] = [];
        }
        $this->entries[$this->currentTurn][] = $entry;
    }

    /**
     * Returns a flat array of entries within the private $entries variable, without any reference
     * to turn numbers
     *
     * @return  array
     */
    public function flattenedEntries() {
        $flattenedEntries = [];
        foreach ($this->entries as $turnEntries) {
            foreach ($turnEntries as $turnEntry) {
                $flattenedEntries[] = $turnEntry;
            }
        }
        return $flattenedEntries;
    }

}