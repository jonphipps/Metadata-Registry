<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:54 AM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(
    App\Models\Export::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'                    => getRandomClassId('Access\User\User'),
            'vocabulary_id'              => getRandomClassId('Vocabulary'),
            'schema_id'                  => getRandomClassId('Elementset'),
            'exclude_deprecated'         => $faker->boolean,
            'include_generated'          => $faker->boolean,
            'include_deleted'            => $faker->boolean,
            'include_not_accepted'       => $faker->boolean,
            'selected_columns'           => serialize([ $faker->randomDigit, $faker->randomDigit, ]),
            'selected_language'          => $faker->languageCode,
            'published_english_version'  => $faker->word,
            'published_language_version' => $faker->word,
            'last_vocab_update'          => $faker->dateTimeBetween(),
            'profile_id'                 => getRandomClassId('Profile'),
            'file'                       => $faker->word,
            'map'                        => serialize([ $faker->randomDigit, $faker->randomDigit, ]),
        ];
    }
);

$factory->define(
    App\Models\Import::class,
    function (Faker\Generator $faker) {
        return [
            'source_file_name' => $faker->word,
            'source'           => $faker->randomElement(['Google', 'upload']),
            'map'              => serialize([ $faker->randomDigit, $faker->randomDigit, ]),
            'user_id'          => getRandomClassId('Access\User\User'),
            'file_name'        => $faker->word,
            'file_type'        => 'csv',
            // 'results'               => $faker->text,
            // 'total_processed_count' => $faker->randomNumber(),
            // 'error_count'           => $faker->randomNumber(),
            // 'success_count'         => $faker->randomNumber(),
            'batch_id'         => getRandomClassId('Batch'),
            'vocabulary_id'    => getRandomClassId('Vocabulary'),
            'schema_id'        => getRandomClassId('Elementset'),
            'token'            => $faker->randomNumber(),
        ];
    }
);
