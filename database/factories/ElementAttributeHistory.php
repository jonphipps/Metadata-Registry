<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:52 AM */
/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\ElementAttributeHistory::class,
    function(Faker\Generator $faker) {
        return [
            'created_user_id'            => getRandomClassId('Access\User\User'),
            'action'                     => $faker->word,
            'schema_property_element_id' => getRandomClassId('ElementAttribute'),
            'schema_property_id'         => getRandomClassId('Element'),
            'schema_id'                  => getRandomClassId('Elementset'),
            'profile_property_id'        => getRandomElementProfilePropertyId(),
            'object'                     => $faker->text,
            'related_schema_property_id' => getRandomClassId('Element'),
            'language'                   => $faker->languageCode,
            'status_id'                  => getRandomClassId('Status'),
            // obsolete 'change_note'                => $faker->text,
            'import_id'                  => getRandomClassId('Import'),
        ];
    });
