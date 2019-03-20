<div class="player-area-options">
    @foreach ($cards as $card)
        <div    class="player-area-checkbox button-checkbox"
                data-test="player-area-checkbox"
        >
            <label  class="label">
                <input  class="input"
                        type="checkbox"
                        data-option="{{ $card->stub }}"
                />
                <div class="button game-button {{ $card->types[0] }}">{{ $card->name }}</div>
            </label>
        </div>
    @endforeach
</div>
<div class="player-area-options">
    <div    class="player-area-option game-button highlighted"
            data-action="submit-choices"
    >
        {{ $submitMessage }}
    </div>
</div>