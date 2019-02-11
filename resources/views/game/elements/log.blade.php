<?php
    $log = $state->log();
?>

<div class="game__log">
@for ($i = $log->currentTurn(); $i >= 1; $i--)
    <h2 class="game__log-title">Turn {{ $i }}</h2>
    @if (isset($log->entries()[$i]))
        @foreach ($log->entries()[$i] as $entry)
            <span class="game__log-entry">{{ $entry }}</span>
        @endforeach
    @endif
@endfor
</div>