<?php

namespace arrays;

function every ($collection, callable $callback = null) {
    foreach ($collection as $index => $element) {
        if (!$callback($element, $index, $collection)) {
            return false;
        }
    }

    return true;
}
