<?php

namespace collections;

/**
 * Basic mapping function for strings.
 * Simply maps over an array of strings/string-returning functions and 
 * then joins then before returning.
 * 
 * @param  array    $items
 * @param  callable $function
 * @param  string   $glue
 * @return string
 */
function mapJoin(array $items, callable $function, string $glue = ''): string {
    return implode($glue, \__::chain($items)
        ->map($function)
        ->compact()
        ->value());
}
