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

<div class="kingdom-cards">
@for ($amount = 6; $amount >= 2; $amount--)
    @if (isset($cardsByValue[$amount]))
        <div class="kingdom-card-group">
            <div class="kingdom-card-coin-divider">
                <div class="kingdom-card-coin">{{ $amount }}</div>
            </div>
            @foreach ($cardsByValue[$amount] as $card)
                <div class="kingdom-card">
                    <div class="name">{{ $card->name() }}</div>
                    <div class="amount">{{ $cards[$card->stub()] }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endfor
</div>