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

<div class="game__kingdom-cards">
@for ($amount = 6; $amount >= 2; $amount--)
    @if (isset($cardsByValue[$amount]))
        <div class="game__kingdom-card-group">
            <div class="game__kingdom-card-coin-divider">
                <div class="game__kingdom-card-coin">{{ $amount }}</div>
            </div>
            @foreach ($cardsByValue[$amount] as $card)
                <div class="game__kingdom-card">
                    <div class="game__kingdom-card-name game-button">{{ $card->name() }}</div>
                    <div class="game__kingdom-card-amount">{{ $cards[$card->stub()] }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endfor
</div>