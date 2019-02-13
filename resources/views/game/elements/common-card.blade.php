<?php
    $cards = $state->kingdomCards();
    $card = App\Game\Factories\CardFactory::build($stub);

    $isActive = ($state->phase() === 'buy') &&  ($card->value() <= $state->coins()) &&  ($state->buys() > 0) &&  ($cards[$stub] > 0);
    $type = $card->types()[0];
    $letter = ucfirst(substr($stub, 0 ,1));
?>

<div class="__common-card">
    @if ($isActive)
        <div    class="__common-card-letter --highlighted --{{ $type }}"
                data-action="buy-card"
                data-stub="{{ $stub }}"
        >
            {{ $letter }}
        </div>
    @else
        <div class="__common-card-letter --{{ $type }}">
            {{ $letter }}
        </div>
    @endif
    <div class="__common-card-amount">
        {{ $cards[$stub] }}
    </div>
</div>