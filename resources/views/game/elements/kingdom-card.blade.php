@php
    $cards = $state->kingdomCards;
@endphp

<div class="kingdom-card" data-test="kingdom-card">
    @if (App\Game\Helpers\ViewHelper::isKingdomCardActive($card, $state))
        <div class="kingdom-card-name game-button highlighted"
             data-action="buy-card"
             data-stub="{{ $card->stub }}"
        >{{ $card->name }}</div>
    @else
        <div class="kingdom-card-name game-button">{{ $card->name }}</div>
    @endif
    <div class="kingdom-card-amount">{{ $cards[$card->stub] }}</div>

    <div class="kingdom-card-description description-box">
        @include ('game.cards.descriptions.' . $card->stub)
    </div>
</div>