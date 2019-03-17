<?php
    $trashedCard = App\Game\Factories\CardFactory::build($player->unresolvedCard()->stub);
?>

@if ($activePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['title' => 'Do you want to gain the trashed' . $trashedCard->name])
@else
    {{ $player->name }} is deciding whether or not to gain the trashed card (a {{ $trashedCard->name }}).
@endif