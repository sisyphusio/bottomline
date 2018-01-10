<?php

namespace collections;

/**
 * Return a new collection with the item set at index to given value.
 * Index can be a path of nested indexes.
 *
 * If a portion of path doesn't exist, it's created. Arrays are created for missing
 * index in an array; objects are created for missing property in an object.
 *
 ** __::set(['foo' => ['bar' => 'ter']], 'foo.baz.ber', 'fer');
 ** // → '['foo' => ['bar' => 'ter', 'baz' => ['ber' => 'fer']]]'
 *
 * @param array|object $collection collection of values
 * @param string  $path key or index
 * @param mixed   $value the value to set at position $key
 * @throws \Exception if the path consists of a non collection and strict is set to false
 *
 * @return array|object the new collection with the item set
 *
 */
function set($collection, $path, $value = null)
{
    $set_object = function ($object, $key, $value) {
        $newObject = clone $object;
        $newObject->$key = $value;
        return $newObject;
    };
    $set_array = function ($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    };
    $setter = \__::isObject($collection) ? $set_object : $set_array;

    if ($path === null) {
        return $collection;
    }

    $portions = \__::split($path, '.', 2);
    $key  = $portions[0];

    if (\count($portions) === 1) {
        $collection = call_user_func_array($setter, [$collection, $key, $value]);
    } else {
        if (
            !\__::has($collection, $key)
            || (\__::isObject($collection) && !\__::isObject(\__::get($collection, $key)))
            || (\__::isArray($collection) && !\__::isArray(\__::get($collection, $key)))
        ) {
            $collection = call_user_func_array(
                $setter,
                [$collection, $key, \__::isObject($collection) ? new \stdClass : []]
            );
        }
        $collection = call_user_func_array(
            $setter,
            // TODO Use __::join(__::drop($portions), '.')
            [$collection, $key, set(\__::get($collection, $key), $portions[1], $value)]
        );
    }

    return $collection;
}
