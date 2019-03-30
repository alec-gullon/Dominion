<?php
    $cards = [];
    foreach ($state->kingdomCards as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->hasType('treasure') && $card->value <= $state->activePlayer()->unresolvedCard()->treasureValue) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    <h2 class="player-area-title">Select a treasure card to gain:</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $player->name }} is selecting a treasure card to gain
@endif