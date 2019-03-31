@if ($isActivePlayer)

    @php
        $cards = App\Game\Helpers\ViewHelper::cardsWithValueLessThanOrEqualTo(
            $state,
            $player->unresolvedCard()->gainValue
        )
    @endphp

    <h2 class="player-area-title">Select a card to gain:</h2>
    <div class="player-area-options">
        @foreach ($cards as $card)
            @include ('game.cards.actions.elements.card-button', ['card' => $card])
        @endforeach
    </div>

@else
    {{ $state->secondaryPlayer()->name }} is selecting what card to gain
@endif