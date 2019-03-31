@php
    $revealedCard = $state->secondaryPlayer()->revealed[0]->nameWithArticlePrefix();
    $question = 'You reveal ' . $revealedCard . ' from the top of their deck. Do you want to discard it?';
@endphp

@if ($isActivePlayer)
    @include('game.cards.actions.elements.yes-no-response', ['question' => $question])
@else
    {{ $state->activePlayer()->name }} reveals {{ $revealedCard }} from the top of your deck. They are deciding whether to discard it or not...
@endif
