<?php
    $cards = [];
    foreach ($state->kingdomCards as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->value <= 5) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    <h2 class="player-area-title">Select card you want to gain</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $state->activePlayer() }} is selecting a card to gain...
@endif
