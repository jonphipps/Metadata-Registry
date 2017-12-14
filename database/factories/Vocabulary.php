<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:54 AM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Vocabulary::class,
    function(Faker\Generator $faker) {
        return [
            'agent_id'              => getRandomClassId('Project'),
            'created_user_id'       => getRandomClassId('Access\User\User'),
            'updated_user_id'       => getRandomClassId('Access\User\User'),
            'deleted_user_id'       => getRandomClassId('Access\User\User'),
            //'child_updated_at'      => $faker->dateTimeBetween(),
            'child_updated_user_id' => getRandomClassId('Access\User\User'),
            'name'                  => $faker->sentence(3),
            'note'                  => $faker->text,
            'uri'                   => $faker->word,
            'url'                   => $faker->url,
            'base_domain'           => $faker->url,
            'token'                 => $faker->word,
            'community'             => $faker->word,
            'last_uri_id'           => $faker->randomNumber(),
            'status_id'             => getRandomClassId('Status'),
            'language'              => $faker->languageCode,
            'languages'             => [ 'en' ],
            'profile_id'            => 2,
            'ns_type'               => $faker->word,
            'prefixes'              => [ 'dc', 'dct' ],
            'repo'                  => $faker->url,
            'prefix'                => $faker->word,
        ];
    });

$factory->define(App\Models\VocabularyUser::class,
    function(Faker\Generator $faker) {
        return [
            'vocabulary_id'     => getRandomClassId('Vocabulary'),
            'user_id'           => getRandomClassId('Access\User\User'),
            'is_maintainer_for' => $faker->boolean,
            'is_registrar_for'  => $faker->boolean,
            'is_admin_for'      => $faker->boolean,
            'languages'         => [ 'en' ],
            'default_language'  => $faker->languageCode,
            'current_language'  => $faker->languageCode,
        ];
    });

