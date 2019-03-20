@if ($activePlayer)
    <?php
        $title = 'You reveal ' . $player->revealed[0]->nameWithArticlePrefix() . ' from the top of your deck. Do you want to discard it?';
    ?>
    @include('game.cards.actions.elements.yes-no-response', ['question' => $title])
@else
    {{ $state->activePlayer()->name }} reveals {{ $state->activePlayer()->revealed[0]->nameWithArticlePrefix() }} from the top of their deck. They are deciding whether to discard it or not...
@endif
