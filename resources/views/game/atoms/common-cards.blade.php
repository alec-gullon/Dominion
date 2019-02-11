<?php
    $cards = $state->kingdomCards();
?>

<div class="game__common-cards">
    <div class="{{ bem('game__common-card-group--treasure') }}">
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--treasure') }}">
                G
            </div>
            <div class="game__common-card-amount">
                {{ $cards['gold'] }}
            </div>
        </div>
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--treasure') }}">
                S
            </div>
            <div class="game__common-card-amount">
                {{ $cards['silver'] }}
            </div>
        </div>
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--treasure') }}">
                C
            </div>
            <div class="game__common-card-amount">
                {{ $cards['copper'] }}
            </div>
        </div>
    </div>
    <div class="{{ bem('game__common-card-group--victory') }}">
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--victory') }}">
                P
            </div>
            <div class="game__common-card-amount">
                {{ $cards['province'] }}
            </div>
        </div>
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--victory') }}">
                D
            </div>
            <div class="game__common-card-amount">
                {{ $cards['duchy'] }}
            </div>
        </div>
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--victory') }}">
                E
            </div>
            <div class="game__common-card-amount">
                {{ $cards['estate'] }}
            </div>
        </div>
    </div>
    <div class="{{ bem('game__common-card-group--misc') }}">
        <div class="game__common-card">
            <div class="{{ bem('game__common-card-letter--misc') }}">
                C
            </div>
            <div class="game__common-card-amount">
                {{ $cards['curse'] }}
            </div>
        </div>
    </div>
</div>