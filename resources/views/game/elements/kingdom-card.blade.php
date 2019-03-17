<div class="__kingdom-card">
    @if (App\Game\Helpers\ViewHelper::isKingdomCardActive($card, $state))
        <div class="__kingdom-card-name game-button --highlighted"
             data-action="buy-card"
             data-stub="{{ $card->stub }}"
        >{{ $card->name }}</div>
    @else
        <div class="__kingdom-card-name game-button">{{ $card->name }}</div>
    @endif
    <div class="__kingdom-card-amount">{{ $cards[$card->stub] }}</div>

    <div class="__kingdom-card-description description-box">
        @include ('game.cards.descriptions.' . $card->stub)
    </div>
</div>