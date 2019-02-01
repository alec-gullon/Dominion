<?php
    $cards = $state->kingdomCards();
    $cardsByValue = [];

    foreach ($cards as $stub => $amount) {
        $card = App\Game\Factories\CardFactory::build($stub);
        if (($card->hasType('action') || $card->stub() === 'gardens')) {
            if (!isset($cardsByValue[$card->value()])) {
                $cardsByValue[$card->value()] = [];
            }
            $cardsByValue[$card->value()][] = $card;
        }
    }
?>

<div class="__kingdom-cards">
@for ($amount = 6; $amount >= 2; $amount--)
    @if (isset($cardsByValue[$amount]))
        <div class="__kingdom-card-group">
            <div class="__kingdom-card-coin-divider">
                <div class="__kingdom-card-coin">{{ $amount }}</div>
            </div>
            @foreach ($cardsByValue[$amount] as $card)
                <div class="__kingdom-card">
                    <div class="__kingdom-card-name">{{ $card->name() }}</div>
                    <div class="__kingdom-card-amount">{{ $cards[$card->stub()] }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endfor
</div>