<div class="hand">
    <h2 class="hand-title">Your Hand</h2>
    @foreach ($player->hand as $card)
        <div    class="hand-card game-button {{ $card->types[0] }}"
                data-test="hand-card"
        >
            {{ $card->name }}
        </div>
    @endforeach
</div>