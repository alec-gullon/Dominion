<?php
    $cards = [];
    foreach ($state->kingdomCards() as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if ($amount > 0 && $card->value() <= $player->unresolvedCard()->gainValue) {
            $cards[] = $card;
        }
    }
?>

@if ($activePlayer)
    @foreach ($cards as $card)
        <div    class="__player-area-option game-button --highlighted"
                data-action="select-option"
                data-option="{{ $card->stub() }}"
        >
            {{ $card->name() }}
        </div>
    @endforeach
@else
    {{ $player->name() }} is selecting what card to gain
@endif