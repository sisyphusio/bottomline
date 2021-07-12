<?php

namespace strings;

/**
 * Join
 * 
 * @param  array $pieces
 * @param  string $glue 
 * @return string
 */
function join(array $pieces, string $glue = ''): string {
    if (is_array( $pieces ) && is_string( $glue )) {
        return implode($glue, $pieces);
    }

    throw new \Exception("Variables are incorrectly types. Pieces, {$pieces}, should be an array, and Glue, {$glue}, should be a string");

    return '';
}
