<?php

namespace arrays;

function zip (...$args) {
    $callback = null;
    if (\is_callable(\end($args))) {
        $callback = \array_pop($args);
    }

    $result = [];
    foreach ((array) \reset($args) as $index => $value) {
        $zipped = [];

        foreach ($args as $arg) {
            $zipped[] = isset($arg[$index]) ? $arg[$index] : null;
        }

        if ($callback !== null) {
            $zipped = $callback(...$zipped);
        }

        $result[$index] = $zipped;
    }

    return $result;
}
