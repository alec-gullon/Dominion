<div class="__player-area-options">
    @foreach ($cards as $card)
        <div class="__player-area-checkbox button-checkbox">
            <label  class="__label">
                <input  class="__input"
                        type="checkbox"
                        data-option="{{ $card->stub }}"
                />
                <div class="__button game-button --{{ $card->types[0] }}">{{ $card->name }}</div>
            </label>
        </div>
    @endforeach
    <div    class="__player-area-option game-button --highlighted"
            data-action="submit-choices"
    >
        {{ $submitMessage }}
    </div>
</div>