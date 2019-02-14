<div class="__player-area-options">
    @foreach ($cards as $card)
        <input      class="__player-area-option game-button --highlighted"
                    type="checkbox"
                    data-option="{{ $card->stub() }}"
        >
        {{ $card->name() }}
        </input>
    @endforeach
    <div    class="__player-area-option game-button --highlighted"
            data-action="submit-choices"
    >
        {{ $submitMessage }}
    </div>
</div>