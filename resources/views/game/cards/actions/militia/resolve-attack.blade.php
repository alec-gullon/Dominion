@if (!$activePlayer)
    <h2 class="__player-area-title">Select cards to discard from your hand</h2>
    <div class="militia-discard-options">
        <div class="__player-area-options">
            @foreach ($state->secondaryPlayer()->hand as $card)
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
        </div>
        <div class="__player-area-options">
            <div    class="__player-area-option game-button --highlighted"
                    data-action="submit-choices"
                    style="display: none;"
            >
                Discard Cards
            </div>
        </div>
    </div>
@else
    {{ $state->activePlayer()->name }} is selecting cards to discard
@endif