<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:53 AM */

//TODO: Nearly all of the attributes will be described by Element Attributes

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Element::class,
    function(Faker\Generator $faker) {
        return [
            'created_user_id'   => getRandomClassId('Access\User\User'),
            'updated_user_id'   => getRandomClassId('Access\User\User'),
            'deleted_user_id'   => getRandomClassId('Access\User\User'),
            'schema_id'         => getRandomClassId('Elementset'),
            'status_id'         => getRandomClassId('Status'),
            'name'              => $faker->name, //attribute
            'label'             => $faker->text, //attribute
            'definition'        => $faker->text, //attribute
            'comment'           => $faker->text, //attribute
            'type'              => $faker->randomElement(['Property','Class']), //attribute
            'is_subproperty_of' => getRandomClassId('Element'), //attribute
            'parent_uri'        => $faker->url, //attribute
            'uri'               => $faker->url, //attribute
            'lexical_alias'     => $faker->text, //attribute
            'url'               => $faker->url, //attribute
            // obsolete 'language'          => $faker->languageCode,
            // 'note'              => $faker->text,
            // 'domain'            => $faker->word,
            // 'orange'            => $faker->word,
            // obsolete 'is_deprecated'     => $faker->boolean,
            // 'hash_id'           => $faker->word,
        ];
    });
