@if ($isActivePlayer)

    @php
        $cards = App\Game\Helpers\ViewHelper::cardsWithValueLessThanOrEqualTo(
            $state,
            $player->unresolvedCard()->treasureValue,
            'treasure'
        )
    @endphp

    <h2 class="player-area-title">Select a treasure card to gain:</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>

@else
    {{ $player->name }} is selecting a treasure card to gain
@endif