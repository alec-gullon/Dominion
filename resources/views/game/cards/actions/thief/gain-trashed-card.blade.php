<?php
    $trashedCard = App\Game\Factories\CardFactory::build($state->activePlayer()->unresolvedCard()->trashedCard);
?>

@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => 'Do you want to gain the trashed ' . $trashedCard->name . '?'])
@else
    Alec is deciding whether or not to gain the trashed {{ $trashedCard->name }}
@endif