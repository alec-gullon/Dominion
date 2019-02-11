<?php
    $log = $state->log();
?>

<div class="game__log">
@for ($i = $log->currentTurn(); $i >= 1; $i--)
    <h2 class="game__log-title">Turn {{ $i }}</h2>
    @if (isset($log->entries()[$i]))
        @for ($j = count($log->entries()[$i]) - 1; $j >= 0; $j--)
            <span class="game__log-entry">{{ $log->entries()[$i][$j] }}</span>
        @endfor
    @endif
@endfor
</div>