<?php

namespace App\Game\Models\Cards;

use App\Game\Helpers\StringHelper;

/**
 * A class to represent the base properties of cards in the Dominion game
 */
class Card {

    /**
     * The cards value, represented as an integer
     *
     * @var int
     */
    protected $value;

    /**
     * The types that the card has, represented as an array of string. The possible types in the
     * base game are: 'action', 'attack', 'treasure', 'victory'
     *
     * @var array
     */
    protected $types = [];

    /**
     * The stub that we use to identify the card.
     *
     * @var string
     */
    protected $stub;

    /**
     * The name of the class, as it is communicated to player's of the game
     *
     * @var string
     */
    protected $name = 'Default';

    /**
     * Whether or not the given instance of the card has been resolved. Only of relevance when
     * the card has been played by a player, all cards are automatically unresolved until marked
     * as resolved
     *
     * @var bool
     */
    protected $resolved = false;

    /**
     * The next step that needs to be handled before the card can be marked as resolved. All cards start
     * by needing to be played, so the first step is always 'play'
     *
     * @var string
     */
    protected $nextStep = 'play';

    /**
     * The denomination of the card, i.e., how much money a player gains when playing a treasure card.
     *
     * @todo Arguably shouldn't be part of the base class, will move this out at some point
     *
     * @var int
     */
    protected $denomination = 0;

    /**
     * Whether or not the card is a virtual instance of a card. Virtual cards are not put into a player's discard
     * when they finish their turn, but are instead removed and never seen again
     *
     * @var bool
     */
    protected $isVirtual = false;

    /**
     * Particular aspects of the card that the AI would like to be aware of when making a decision about what
     * to do next
     *
     * @var array
     */
    protected $features = [];

    public function value() {
        return $this->value;
    }

    public function nextStep() {
        return $this->nextStep;
    }

    public function stub() {
        return $this->stub;
    }

    public function denomination() {
        return $this->denomination;
    }

    public function resolved() {
        return $this->resolved;
    }

    public function isVirtual() {
        return $this->isVirtual;
    }

    public function name() {
        return $this->name;
    }

    /**
     * Returns true if the card has the type $type, false otherwise
     *
     * @param   string      $type
     *
     * @return  bool
     */
    public function hasType($type) {
        return in_array($type, $this->types);
    }

    /**
     * Returns true if the card has the feature $feature, false otherwise
     *
     * @param   string  $feature
     *
     * @return  bool
     */
    public function hasFeature($feature) {
        return in_array($feature, $this->features);
    }

    /**
     * Marks the card as being resolved
     */
    public function resolve() {
        $this->resolved = true;
    }

    /**
     * Marks the card as being a virtual card
     */
    public function markAsVirtual() {
        $this->isVirtual = true;
    }

    /**
     * Sets the next step required to resolve the card
     *
     * @param   string  $step
     */
    public function setNextStep($step) {
        $this->nextStep = $step;
    }

    /**
     * Returns the card's name along with either 'an' or 'a' depending on the first
     * letter of the name, e.g., 'an Estate', 'a Duchy'
     *
     * @return  string
     */
    public function nameWithArticlePrefix() {
        $firstCharacter = substr($this->name, 0, 1);
        if (in_array($firstCharacter, ['A', 'E', 'I', 'O', 'U'])) {
            return 'an ' . $this->name;
        }
        return 'a ' . $this->name;
    }

    /**
     * Plural form of the card's name
     *
     * @return  string
     */
    public function pluralFormOfName() {
        return $this->name . 's';
    }

    /**
     * The card's alias, i.e., how the card should be identified in class names. E.g.,
     * CouncilRoom, Estate, ThroneRoom
     *
     * @return  string
     */
    public function alias() {
        return StringHelper::cardAliasFromStub($this->stub);
    }

}