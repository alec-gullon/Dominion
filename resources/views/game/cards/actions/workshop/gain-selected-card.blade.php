@php
    $cards = App\Game\Helpers\ViewHelper::cardsWithValueLessThanOrEqualTo($state, 4);
@endphp

@if ($isActivePlayer)
    <h2 class="player-area-title">Select a card to gain:</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>
@else
    {{ $player->name }} is selecting what card they want to gain
@endif


