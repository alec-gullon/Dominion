<?php
    $cards = $state->kingdomCards;
    $cardsByValue = [];

    foreach ($cards as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if (($card->hasType('action') || $card->stub === 'gardens')) {
            if (!isset($cardsByValue[$card->value])) {
                $cardsByValue[$card->value] = [];
            }
            $cardsByValue[$card->value][] = $card;
        }
    }
?>

<div class="kingdom-cards">
@for ($amount = 6; $amount >= 2; $amount--)
    @if (isset($cardsByValue[$amount]))
        <div class="kingdom-card-group">
            <div class="coin-divider">
                <div class="coin">{{ $amount }}</div>
            </div>
            @foreach ($cardsByValue[$amount] as $card)
                @include ('game.elements.kingdom-card', ['card' => $card])
            @endforeach
        </div>
    @endif
@endfor
</div>