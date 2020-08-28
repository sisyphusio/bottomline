<?php

namespace strings;

use Doctrine\Common\Inflector\Inflector;

/**
 * Get the singular form of an English word.
 *
 * @param string $value
 *
 * @return string
 */
function singular($value)
{
    return Inflector::singularize($value);
}
