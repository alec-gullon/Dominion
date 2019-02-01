<?php
    $cards = $state->kingdomCards();
?>

<div class="__common-cards">
    <div class="{{ bem('common-card-group--treasure') }}">
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--treasure') }}">
                G
            </div>
            <div class="__common-card-amount">
                {{ $cards['gold'] }}
            </div>
        </div>
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--treasure') }}">
                S
            </div>
            <div class="__common-card-amount">
                {{ $cards['silver'] }}
            </div>
        </div>
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--treasure') }}">
                C
            </div>
            <div class="__common-card-amount">
                {{ $cards['copper'] }}
            </div>
        </div>
    </div>
    <div class="{{ bem('common-card-group--victory') }}">
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--victory') }}">
                P
            </div>
            <div class="__common-card-amount">
                {{ $cards['province'] }}
            </div>
        </div>
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--victory') }}">
                D
            </div>
            <div class="__common-card-amount">
                {{ $cards['duchy'] }}
            </div>
        </div>
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--victory') }}">
                E
            </div>
            <div class="__common-card-amount">
                {{ $cards['estate'] }}
            </div>
        </div>
    </div>
    <div class="{{ bem('common-card-group--misc') }}">
        <div class="__common-card">
            <div class="{{ bem('common-card-letter--misc') }}">
                C
            </div>
            <div class="__common-card-amount">
                {{ $cards['curse'] }}
            </div>
        </div>
    </div>
</div>