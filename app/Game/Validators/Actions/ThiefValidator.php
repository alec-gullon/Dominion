<?php

namespace App\Game\Validators\Actions;

class ThiefValidator extends ActionValidator {

    public function resolveMoat($input) {
        return is_bool($input);
    }

    public function resolveAttack($input) {
        $revealedCards = $this->state->secondaryPlayer()->revealed();
        foreach ($revealedCards as $card) {
            if ($card->stub() === $input) {
                return true;
            }
        }
        return false;
    }

    public function gainTrashedCard($input) {
        return is_bool($input);
    }

}