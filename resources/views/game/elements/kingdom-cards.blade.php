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
            <div class="__coin-divider">
                <div class="__coin">{{ $amount }}</div>
            </div>
            @foreach ($cardsByValue[$amount] as $card)
                <div class="__kingdom-card">
                    @if (App\Game\Helpers\ViewHelper::isKingdomCardActive($card, $state))
                        <div class="__kingdom-card-name game-button --highlighted"
                             data-action="buy-card"
                             data-stub="{{ $card->stub() }}"
                        >{{ $card->name() }}</div>
                    @else
                        <div class="__kingdom-card-name game-button">{{ $card->name() }}</div>
                    @endif
                    <div class="__kingdom-card-amount">{{ $cards[$card->stub()] }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endfor
</div>