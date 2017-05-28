<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 6:11 PM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define( App\Models\Batch::class,
    function( Faker\Generator $faker ) {
        return [
            'run_time'          => $faker->dateTimeBetween(),
            'run_description'   => $faker->text,
            'object_type'       => $faker->word,
            'object_id'         => $faker->randomNumber(),
            'event_time'        => $faker->dateTimeBetween(),
            'event_type'        => $faker->word,
            'event_description' => $faker->text,
            'registry_uri'      => $faker->word,
        ];
    } );
