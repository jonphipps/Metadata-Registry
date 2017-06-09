<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-06-06,  Time: 1:58 PM
 *
 * @param string $class
 * @param array  $attributes
 *
 * @return App\Models\$class
 */
function create(string $class, array $attributes = [])
{
    return factory($class)->create($attributes);
}

/**
 * @param string $class
 * @param array  $attributes
 *
 * @return App\Models\$class
 */
function make(string $class, array $attributes = [])
{
    return factory($class)->make($attributes);
}
