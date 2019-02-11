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

    $class = 'game__common-card-letter--' . $card->types()[0];
?>

<div class="game__common-card">
    @if ($isActive)
        <div    class="{{  bem($class . '--active') }}"
                data-action="buy-card"
                data-stub="{{ $stub }}"
        >
            {{ ucfirst(substr($stub, 0, 1)) }}
        </div>
    @else
        <div class="{{  bem($class) }}">
            {{ ucfirst(substr($stub, 0, 1)) }}
        </div>
    @endif
    <div class="game__common-card-amount">
        {{ $cards[$stub] }}
    </div>
</div>