<?php
    $log = $state->log;
?>

<div class="log">
@for ($i = $log->currentTurn(); $i >= 1; $i--)
    <h2 class="log-title">Turn {{ $i }}</h2>
    @foreach ($log->reversedEntries()[$i] as $entry)
        <span class="log-entry">{{ $entry }}</span>
    @endforeach
@endfor
</div>