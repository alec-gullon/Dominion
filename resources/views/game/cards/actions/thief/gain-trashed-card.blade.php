@php
    $card = App\Game\Factories\CardFactory::build($state->activePlayer()->unresolvedCard()->trashedCard);
@endphp

@if ($isActivePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => 'Do you want to gain the trashed ' . $card->name . '?'])
@else
    Alec is deciding whether or not to gain the trashed {{ $card->name }}
@endif