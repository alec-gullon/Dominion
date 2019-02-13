<?php
    $cards = $state->kingdomCards();
    $card = App\Game\Factories\CardFactory::build($stub);

    $isActive = false;
    if (    $state->phase() === 'buy'
        &&  $card->value() <= $state->coins()
        &&  $state->buys() > 0
        &&  $cards[$stub] > 0
    ) {
        $isActive = true;
    }
?>

<div class="__common-card">
    @if ($isActive)
        <div    class="__common-card-letter --highlighted --{{ $card->types()[0] }}"
                data-action="buy-card"
                data-stub="{{ $stub }}"
        >
            {{ ucfirst(substr($stub, 0, 1)) }}
        </div>
    @else
        <div class="__common-card-letter --{{ $card->types()[0] }}">
            {{ ucfirst(substr($stub, 0, 1)) }}
        </div>
    @endif
    <div class="__common-card-amount">
        {{ $cards[$stub] }}
    </div>
</div>