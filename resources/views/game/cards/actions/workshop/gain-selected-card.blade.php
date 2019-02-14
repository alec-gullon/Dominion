<?php
    $cards = [];
    foreach ($state->kingdomCards() as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->value() <= 4) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    <h2 class="__player-area-title">Select a card to gain:</h2>
    <div class="__player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $player->name() }} is selecting what card they want to gain
@endif


