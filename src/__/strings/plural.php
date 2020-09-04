<?php

namespace strings;

use Doctrine\Common\Inflector\Inflector;

/**
 * Get the plural form of an English word.
 *
 * @param string $value
 * @return string
 */
function plural($value)
{
    return Inflector::pluralize($value);
}
