<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 11:29 AM */
/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Elementset::class,
    function(Faker\Generator $faker) {
        return [
            'created_user_id'       => getRandomClassId('Access\User\User'),
            'updated_user_id'       => getRandomClassId('Access\User\User'),
            // 'deleted_user_id'       => getRandomClassId('Access\User\User'),
            // 'child_updated_at'      => $faker->dateTimeBetween(),
            // 'child_updated_user_id' => getRandomClassId('Access\User\User'),
            'agent_id'              => getRandomClassId('Project'),
            'label'                 => $faker->sentence(3),
            'name'                  => $faker->sentence(3),
            'note'                  => $faker->text,
            'uri'                   => $faker->url,
            'url'                   => $faker->url,
            'base_domain'           => $faker->url,
            'token'                 => $faker->word,
            'community'             => $faker->word,
            'last_uri_id'           => $faker->randomNumber(),
            'status_id'             => getRandomClassId('Status'),
            'language'              => $faker->languageCode,
            'profile_id'            => 1,
            'ns_type'               => $faker->randomElement(['Hash','Slash']),
            'prefixes'              => [ 'dc', 'dct' ],
            'languages'             => ['en'],
            'repo'                  => $faker->url,
            'spreadsheet'           => $faker->url,
            'worksheet'             => $faker->word,
            'prefix'                => $faker->word,
        ];
    });

$factory->define(App\Models\ElementsetUser::class,
    function(Faker\Generator $faker) {
        return [
            'schema_id'         => getRandomClassId('Elementset'),
            'user_id'           => getRandomClassId('Access\User\User'),
            'is_maintainer_for' => $faker->boolean,
            'is_registrar_for'  => $faker->boolean,
            'is_admin_for'      => $faker->boolean,
            'languages'         => [ 'en' ],
            'default_language'  => $faker->languageCode,
            'current_language'  => $faker->languageCode,
        ];
    });
