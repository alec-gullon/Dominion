@if ($activePlayer)
    <?php
        $title = 'You reveal a ' . $state->secondaryPlayer()->topCard() . ' from the top of teir deck. Do you want to discard it?';
    ?>
    @include('game.cards.actions.elements.yes-no-response', ['title' => $title])
@else
    {{ $player->name() }} reveals a {{ $state->secondaryPlayer()->topCard() }} from the top of your deck. They are deciding
    whether to discard it or not...
@endif
