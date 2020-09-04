<?php

namespace arrays;

function some($collection, callable $callback = null) {
    foreach ($collection as $index => $element) {
        if ($callback($element, $index, $collection)) {
            return true;
        }
    }

    return false;
}
