<?php

namespace arrays;

/**
 * Find item in array (first)
 *
 * @param  array $array
 * @param  Closure $closure
 * @return mixed $found
 */
function findKey ($array, $closure) {
    foreach ($array as $key => $value) {
        if ($closure($value, $key)) {
            return $key;
        }
    }

    return;
}
