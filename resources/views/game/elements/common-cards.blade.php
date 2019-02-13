<div class="__common-cards">
    <div class="__common-card-group --treasure">
        @include('game.elements.common-card', ['stub' => 'gold'])
        @include('game.elements.common-card', ['stub' => 'silver'])
        @include('game.elements.common-card', ['stub' => 'copper'])
    </div>
    <div class="__common-card-group --victory">
        @include('game.elements.common-card', ['stub' => 'province'])
        @include('game.elements.common-card', ['stub' => 'duchy'])
        @include('game.elements.common-card', ['stub' => 'estate'])
    </div>
    <div class="__common-card-group --misc">
        @include('game.elements.common-card', ['stub' => 'curse'])
    </div>
</div>