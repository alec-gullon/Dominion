<?php
    $cards = $state->kingdomCards();
?>

<div class="kingdom">
@for ($i = 6; $i >= 2; $i--)
    @foreach ($cards as $stub => $amount)
        <?php $card = App\Game\Factories\CardFactory::build($stub); ?>
        @if ($card->value() === $i)
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
            <?php $card = App\Game\Factories\CardFactory::build($stub); ?>
            @if ($card->value() === $i)
                @if ($gameObserver->canBuy($stub, $playerKey))
                    <div class="card card--active" data-action="buy-card" data-stub="<?= $card->stub() ?>">
                        {{ $card->name() }}: {{ $amount }}
                        @include('game.cards.descriptions.' . $stub, ['amount' => $amount, 'active' => true])
                    </div>
                @else
                    <div class="card">
                        {{ $card->name() }}: {{ $amount }}
                        @include('game.cards.descriptions.' . $stub, ['amount' => $amount, 'active' => false])
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endfor
</div>