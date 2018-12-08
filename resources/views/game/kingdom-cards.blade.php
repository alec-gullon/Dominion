<?php
    $cards = $state->getKingdomCards();
?>

<div class="kingdom">
@for ($i = 6; $i >= 2; $i--)
    @foreach ($cards as $stub => $amount)
        <?php $card = $cardBuilder->build($stub); ?>
        @if ($card->getValue() === $i)
            <div class="kingdom__divider">
                <div class="kingdom__coin-wrapper">
                    <div class="kingdom__coin">{{ $i }}</div>
                </div>
            </div>
            @break
        @endif
    @endforeach

    <div class="kingdom__card-group">
        @foreach ($cards as $stub => $amount)
            <?php $card = $cardBuilder->build($stub); ?>
            @if ($card->getValue() === $i)
                @if ($gameObserver->canBuy($stub, $playerKey))
                    <div class="card card--active" data-action="buy-card" data-stub="<?= $card->getStub() ?>">
                        {{ $card->getName() }}: {{ $amount }}
                        @include('game.cards.descriptions.' . $stub, ['amount' => $amount, 'active' => true])
                    </div>
                @else
                    <div class="card">
                        {{ $card->getName() }}: {{ $amount }}
                        @include('game.cards.descriptions.' . $stub, ['amount' => $amount, 'active' => false])
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endfor
</div>