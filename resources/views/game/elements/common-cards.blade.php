<div class="game__common-cards">
    <div class="{{ bem('game__common-card-group--treasure') }}">
        @include('game.elements.common-card', ['stub' => 'gold'])
        @include('game.elements.common-card', ['stub' => 'silver'])
        @include('game.elements.common-card', ['stub' => 'copper'])
    </div>
    <div class="{{ bem('game__common-card-group--victory') }}">
        @include('game.elements.common-card', ['stub' => 'province'])
        @include('game.elements.common-card', ['stub' => 'duchy'])
        @include('game.elements.common-card', ['stub' => 'estate'])
    </div>
    <div class="{{ bem('game__common-card-group--misc') }}">
        @include('game.elements.common-card', ['stub' => 'curse'])
    </div>
</div>