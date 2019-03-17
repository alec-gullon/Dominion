<?php
    $cards = $state->kingdomCards;
    $card = App\Game\Factories\CardFactory::build($stub);

    $isActive = ($state->phase === 'buy') &&  ($card->value <= $state->coins) &&  ($state->buys > 0) &&  ($cards[$stub] > 0);
    $type = $card->types[0];
    $letter = ucfirst(substr($stub, 0 ,1));
?>

@if (isset($cards[$stub]))
    <div class="common-card @if ($isActive) --highlighted @endif --{{ $type }}">
        @if ($isActive)
            <div    class="__letter"
                    data-action="buy-card"
                    data-stub="{{ $stub }}"
            >
                {{ $letter }}
            </div>
        @else
            <div class="__letter --{{ $type }}">
                {{ $letter }}
            </div>
        @endif
        <div class="__amount">
            {{ $cards[$stub] }}
        </div>

        <div class="__common-card-description description-box">
            @include ('game.cards.descriptions.' . $stub)
        </div>
    </div>
@endif