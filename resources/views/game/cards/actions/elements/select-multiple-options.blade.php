<div class="__player-area-options">
    @foreach ($cards as $card)
        <div class="__player-area-checkbox">
            <label  class="__player-area-checkbox-label">
                <input  class="__player-area-checkbox-input"
                        type="checkbox"
                        data-option="{{ $card->stub() }}"
                />
                <div class="__player-area-checkbox-text game-button">{{ $card->name() }}</div>
            </label>
        </div>
    @endforeach
    <div    class="__player-area-option game-button --highlighted"
            data-action="submit-choices"
    >
        {{ $submitMessage }}
    </div>
</div>