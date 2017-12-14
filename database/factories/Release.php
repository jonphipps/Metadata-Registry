<?php

use Faker\Generator as Faker;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Release::class, function (Faker $faker) {
    return [
        'user_id'          => getRandomClassId('Access\User\User'),
        'agent_id'         => getRandomClassId('Project'),
        'name'             => $faker->name,
        'body'             => $faker->text,
        'tag_name'         => $faker->word,
        'target_commitish' => 'master',
        'is_draft'         => $faker->boolean,
        'is_prerelease'    => $faker->boolean,
        'github_response'  => 'json',
    ];
});

$factory->define(App\Models\Releasable::class,
    function(Faker $faker) {
        $type = $faker->randomElement([ 'Elementset', 'Vocabulary' ]);

        return [
            'release_id' => $release = getRandomClassId('Release'),
            'releaseable_id' => getRandomClassId($type),
            'releasable_type' => "App\Models\{$type}",
        ];
    });

$factory->state(App\Models\Releasable::class,
    'vocabulary',
    function() {
        return [
            'release_id'      => getRandomClassId('Release'),
            'releaseable_id'  => getRandomClassId('Vocabulary'),
            'releasable_type' => 'App\Models\Vocabulary',
        ];
    });

$factory->state(App\Models\Releasable::class,
    'elementset',
    function() {
        return [
            'release_id'      => getRandomClassId('Release'),
            'releaseable_id'  => getRandomClassId('ElementSet'),
            'releasable_type' => 'App\Models\Elementset',
        ];
    });
