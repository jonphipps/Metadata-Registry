<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var Illuminate\Database\Eloquent\Factory $factory */
if (! function_exists('getRandomConceptProfilePropertyId')) {
    function getRandomConceptProfilePropertyId(array $except = [])
    {
        return getRandomClassId('ProfileProperty', [ 'profile_id', '=', 2 ], $except);
    }
}

if (! function_exists('getRandomElementProfilePropertyId')) {
    function getRandomElementProfilePropertyId(array $except = [])
    {
        return getRandomClassId('ProfileProperty', [ 'profile_id', '=', 1 ], $except);
    }
}

if (! function_exists('getRandomClassId')) {
    /**
     * @param string $classFqn  The fully qualified Model class
     * @param array  $where     Add a where query example: ['profile_id','=', 1]
     * @param array  $except    Don't get these IDs
     * @param int    $count     If creating new Model instances, make this many
     *
     * @return int
     */
    function getRandomClassId($classFqn, array $where = [], array $except = [], $count = 1)
    {
        $faker = \Faker\Factory::create();
        /** @var Model $class */
        $class = "App\Models\\{$classFqn}";
        /** @var Collection $models */
        if (count($where)) {
            $models = $class::where([ $where ])->get()->except($except);
        } else {
            $models = $class::get()->except($except);
        }
        if ($models->count() === 0) {
            $models = factory($class, $count)->create();
        }

        $key = $models->first()->getKeyName();
        return $faker->randomElement($models->pluck($key)->toArray());
    }
}

if (! function_exists('getRandomAction')) {
    function getRandomAction(Faker\Generator $faker)
    {
        return $faker->randomElement(['Added', 'Updated', 'Deleted']);
    }
}
