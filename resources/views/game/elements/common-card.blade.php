@php
    $amount = $state->kingdomCards[$stub];
    $card = App\Game\Factories\CardFactory::build($stub);
    $active = App\Game\Helpers\ViewHelper::isKingdomCardActive($card, $state);
    $type = $card->types[0];
    $letter = ucfirst(substr($stub, 0 ,1));
@endphp

<div    class="common-card {{ $type }} @if ($active) highlighted @endif"
        data-test="common-card"
>
    <div    class="letter {{ $type }}"
            @if ($active)
            data-action="buy-card"
            data-stub="{{ $stub }}"
            @endif
    >
        {{ $letter }}
    </div>
    <div class="amount">
        {{ $amount }}
    </div>

    <div class="common-card-description description-box">
        @include ('game.cards.descriptions.' . $stub)
    </div>
</div>