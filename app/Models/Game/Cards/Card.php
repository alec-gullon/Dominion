<?php

namespace App\Models\Game\Cards;

class Card {

    protected $value;

    protected $points = 0;

    protected $types = array();

    protected $stub = 'default';

    protected $name = 'Default';

    protected $steps = array();

    protected $resolved = false;

    protected $nextStep = 'play';

    protected $denomination = 0;

    protected $isVirtual = false;

    public function getValue() {
        return $this->value;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getTypes() {
        return $this->types;
    }

    public function hasType($type) {
        return in_array($type, $this->types);
    }

    public function getNextStep() {
        return $this->stub . '/' . $this->nextStep;
    }

    public function getStub() {
        return $this->stub;
    }

    public function getDenomination() {
        return $this->denomination;
    }

    public function resolve() {
        $this->resolved = true;
    }

    public function isResolved() {
        return $this->resolved;
    }

    public function markAsVirtual() {
        $this->isVirtual = true;
    }

    public function isVirtual() {
        return $this->isVirtual;
    }

    public function setNextStep($step) {
        $this->nextStep = $step;
    }

    public function getName() {
        return $this->name;
    }

}