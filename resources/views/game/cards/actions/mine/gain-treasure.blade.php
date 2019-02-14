<?php
    $cards = [];
    foreach ($state->kingdomCards as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->hasType('treasure')) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    <h2 class="__player-area-title">Select a treasure card to gain:</h2>
    @foreach ($cards as $card)
        <div    class="__player-area-option game-button --highlighted"
                data-action="select-option"
                data-option="{{ $card->stub() }}"
        >
            {{ $card->name() }}
        </div>
    @endforeach
@else
    {{ $player->name() }} is selecting a treasure card to gain
@endif