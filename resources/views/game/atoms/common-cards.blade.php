<?php
    $cards = $state->kingdomCards();
?>

<div class="common-cards">
    <div class="common-card-group treasure-cards">
        <div class="common-card treasure-card">
            <div class="letter">G</div>
            <div class="amount">{{ $cards['gold'] }}</div>
        </div>
        <div class="common-card treasure-card">
            <div class="letter">S</div>
            <div class="amount">{{ $cards['silver'] }}</div>
        </div>
        <div class="common-card treasure-card">
            <div class="letter">C</div>
            <div class="amount">{{ $cards['copper'] }}</div>
        </div>
    </div>
    <div class="common-card-group victory-cards">
        <div class="common-card victory-card">
            <div class="letter">P</div>
            <div class="amount">{{ $cards['province'] }}</div>
        </div>
        <div class="common-card victory-card">
            <div class="letter">D</div>
            <div class="amount">{{ $cards['duchy'] }}</div>
        </div>
        <div class="common-card victory-card">
            <div class="letter">E</div>
            <div class="amount">{{ $cards['estate'] }}</div>
        </div>
    </div>
    <div class="common-card-group misc-cards">
        <div class="common-card curse-card">
            <div class="letter">C</div>
            <div class="amount">{{ $cards['curse'] }}</div>
        </div>
    </div>
</div>