<?php

namespace collections;

/**
 * @internal
 *
 * @param \Traversable $iterable
 * @param \Closure|null $closure Closure to filter the array
 *
 * @return \Generator
 */
function filterIterable($iterable, \Closure $closure = null)
{
    foreach (\__::getIterator($iterable) as $key => $value) {
        if ($closure) {
            if ($closure($value)) {
                yield $value;
            }
        } elseif ($value) {
            yield $value;
        }
    }
}

/**
 * Returns the values in the collection that pass the truth test.
 *
 * When `$closure` is set to null, this function will automatically remove falsey
 * values. When `$closure` is given, then values where the closure returns false
 * will be removed.
 *
 * **Usage**
 *
 * ```php
 * $a = [
 *     ['name' => 'fred',   'age' => 32],
 *     ['name' => 'maciej', 'age' => 16]
 * ];
 *
 * __::filter($a, function($n) {
 *     return $n['age'] > 24;
 * });
 * ```
 *
 * **Result**
 *
 * ```
 * [['name' => 'fred', 'age' => 32]]
 * ```
 *
 * @param array|\Traversable         $iterable   Array to filter
 * @param \Closure|null $closure Closure to filter the array
 *
 * @since 0.2.0 iterable objects are now supported
 *
 * @throws \InvalidArgumentException when an non-array or non-traversable object
 *     is given for $iterable.
 *
 * @return array|\Generator When given a `\Traversable` object for `$iterable`,
 *     a generator will be returned. Otherwise, an array will be returned.
 */
function filter($iterable, \Closure $closure = null)
{
    if (is_array($iterable)) {
        $values = [];
        foreach ($iterable as $value) {
            if ($closure) {
                if ($closure($value)) {
                    $values[] = $value;
                }
            } elseif ($value) {
                $values[] = $value;
            }
        }
        return $values;
    }

    return filterIterable($iterable, $closure);
}
