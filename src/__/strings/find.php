<?php

namespace strings;

/**
 * Find one or more needles in one or more haystacks.
 *
 * @param array|string $string        The haystack(s) to search in
 * @param array|string $needle        The needle(s) to search for
 * @param bool         $caseSensitive Whether the function is case sensitive or not
 * @param bool         $absolute      Whether all needle need to be found or whether one is enough
 *
 * @return bool Found or not
 */
function find($string, $needle, $caseSensitive = false, $absolute = false) {
    
    // If several needles
    if (is_array($needle) or is_array($string)) {
        $sliceFrom = $string;
        $sliceTo = $needle;

        if (is_array($needle)) {
            $sliceFrom = $needle;
            $sliceTo = $string;
        }

        $found = 0;
        foreach ($sliceFrom as $need) {
            if (find($sliceTo, $need, $absolute, $caseSensitive)) {
                ++$found;
            }
        }

        return ($absolute) ? count($sliceFrom) === $found : $found > 0;
    }

    // If not case sensitive
    if (!$caseSensitive) {
        $string = strtolower($string);
        $needle = strtolower($needle);
    }

    // If string found
    $pos = strpos($string, $needle);

    return !($pos === false);
}
