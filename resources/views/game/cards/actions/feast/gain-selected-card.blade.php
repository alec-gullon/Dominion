@php
    $cards = App\Game\Helpers\ViewHelper::cardsWithValueLessThanOrEqualTo($state, 5);
@endphp

@if ($isActivePlayer)
    <h2 class="player-area-title">Select card you want to gain</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $state->activePlayer() }} is selecting a card to gain...
@endif
