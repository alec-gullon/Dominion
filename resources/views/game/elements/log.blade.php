<?php
    $log = $state->log;
?>

<div class="__log">
@for ($i = $log->currentTurn(); $i >= 1; $i--)
    <h2 class="__log-title">Turn {{ $i }}</h2>
    @foreach ($log->entries()[$i] as $entry)
        <span class="__log-entry">{{ $entry }}</span>
    @endforeach
@endfor
</div>