<?php

namespace arrays;

/**
 * Sorts a collection with a user-defined function, optionally preserving array keys
 *
 * @param Traversable|array $collection
 * @param callable $callback
 * @param bool $preserveKeys
 * @return array
 */
function sort($collection, callable $callback, bool $preserveKeys = false)
{
    $array = ($collection instanceof Traversable)
        ? \iterator_to_array($collection)
        : $collection;

    $fn = $preserveKeys ? 'uasort' : 'usort';

    // $fn($array, fn ($left, $right) => $callback( $left, $right, $collection ));

    $fn($array, function ($left, $right) use ($callback, $collection) {
        return $callback($left, $right, $collection);
    });

    return $array;
}
