@if ($activePlayer)
    <?php
        $question = 'You draw a ' . $player->topCard()->name . '? Do you want to set this card aside?';
    ?>
    @include('game.cards.actions.elements.yes-no-response', ['question' => $question])
@else
    {{ $state->activePlayer()->name }} is resolving their Library card...
@endif
