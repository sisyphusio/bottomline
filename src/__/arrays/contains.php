<?php

namespace arrays;

/**
 * Returns true if the collection contains the given value. If the third parameter is
 * true values will be compared in strict mode
 *
 * @param Traversable|array $collection
 * @param mixed $value
 * @param bool $strict
 * @return bool
 */
function contains($collection, $value, $strict = true)
{
    foreach ($collection as $element) {
        if ($value === $element || (!$strict && $value == $element)) {
            return true;
        }
    }

    return false;
}
