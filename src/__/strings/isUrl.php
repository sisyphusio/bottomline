<?php

namespace strings;

/**
 * Is string valid url?
 * - if string is parse-able and only missing the protocol, the protocol is added and then returned.
 *
 * @param  string  $string
 * @return boolean
 */
function isUrl($string)
{
    $parse = parse_url($string);
    if (!isset($parse[ 'scheme' ])) {
        if (strpos($string, '//') === 0) {
            $string = str_replace('//', '', $string);
        }
        
        $string = "https://{$string}";
    }

    return filter_var($string, FILTER_VALIDATE_URL) !== false;
}
