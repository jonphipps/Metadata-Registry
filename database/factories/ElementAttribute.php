<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:53 AM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ElementAttribute::class,
    function(Faker\Generator $faker) {
        return [
            'created_user_id'            => getRandomClassId('Access\User\User'),
            'updated_user_id'            => getRandomClassId('Access\User\User'),
            'deleted_user_id'            => getRandomClassId('Access\User\User'),
            'schema_property_id'         => getRandomClassId('Element'),
            'profile_property_id'        => getRandomElementProfilePropertyId(),
            'object'                     => $faker->text,
            'related_schema_property_id' => getRandomClassId('Element'),
            'language'                   => $faker->languageCode,
            'status_id'                  => getRandomClassId('Status'),
            'is_generated'               => $faker->boolean,
            // obsolete 'is_schema_property'         => $faker->boolean,
        ];
    });
