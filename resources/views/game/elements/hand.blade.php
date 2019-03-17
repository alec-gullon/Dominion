<div class="__hand">
    <h2 class="__hand-title">Your Hand</h2>
    @foreach ($player->hand as $card)
        <div class="__hand-card game-button --{{ $card->types()[0] }}">{{ $card->name() }}</div>
    @endforeach
</div>