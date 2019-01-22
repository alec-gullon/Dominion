<div class="standard-cards">
    <div class="standard-cards__list">
        <?php $stubs = ['estate', 'duchy', 'province']; ?>
        @foreach ($stubs as $stub)
            <?php
                $card = App\Services\Factories\CardFactory::build($stub);
                $class = 'card card--victory';
                if ($gameObserver->canBuy($stub, $playerKey)) {
                    $class = 'card card--victory card--active';
                }
            ?>
            <div class="{{ $class }}">
                {{ $card->getName() }}: {{ $state->kingdomCards()[$stub] }}
            </div>
        @endforeach
    </div>
    <div class="standard-cards__list">
        <?php $stubs = ['copper', 'silver', 'gold']; ?>
        @foreach ($stubs as $stub)
            <?php
                $card = App\Services\Factories\CardFactory::build($stub);
                $class = 'card card--treasure';
                if ($gameObserver->canBuy($stub, $playerKey)) {
                    $class = 'card card--treasure card--active';
                }
            ?>
            <div class="{{ $class }}">
                {{ $card->getName() }}: {{ $state->kingdomCards()[$stub] }}
            </div>
        @endforeach
    </div>
    <div class="standard-cards__list">
        <?php
            $card = App\Services\Factories\CardFactory::build('curse');
            $class = 'card card--curse';
            if ($gameObserver->canBuy($stub, $playerKey)) {
                $class = 'card card--curse card--active';
            }
        ?>
        <div class="{{ $class }}">
            {{ $card->getName() }}: {{ $state->kingdomCards()[$stub] }}
        </div>
    </div>
</div>