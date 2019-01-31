<?php
    $log = $state->log();
?>

<div class="log">
@for ($i = $log->currentTurn(); $i >= 1; $i--)
    <h2>Turn {{ $i }}</h2>
    @if (isset($log->entries()[$i]))
        @foreach ($log->entries()[$i] as $entry)
            <span>{{ $entry }}</span>
        @endforeach
    @endif
@endfor
</div>