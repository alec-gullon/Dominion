@if ($activePlayer)
    <?php
        $question = 'You reveal ' . $state->secondaryPlayer()->revealed[0]->nameWithArticlePrefix() . ' from the top of their deck. Do you want to discard it?';
    ?>
    @include('game.cards.actions.elements.yes-no-response', ['question' => $question])
@else
    {{ $state->activePlayer()->name }} reveals {{ $state->secondaryPlayer()->revealed[0]->nameWithArticlePrefix() }} from the top of your deck. They are deciding whether to discard it or not...
@endif
