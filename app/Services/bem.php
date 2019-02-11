<?php
// @todo just sticking this here, since I'm lazy and it's experimental...
function bem($class) {
    $parts = explode('--', $class);

    $return = '__' . $parts[0];

    for ($i = 1; $i < count($parts); $i++) {
        $return .= ' __' . $parts[0] . '--' . $parts[$i];
    }

    return $return;
}