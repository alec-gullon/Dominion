@if ($activePlayer)
    <?php
        $title = 'You reveal a ' . $player->topCard() . ' from the top of your deck. Do you want to discard it?';
    ?>
    @include('game.cards.actions.elements.yes-no-response', ['title' => $title])
@else
    {{ $player->name() }} reveals a {{ $player->topCard() }} from the top of their deck. They are deciding
    whether to discard it or not...
@endif
