<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 6:25 PM */

//TODO: Nearly all of the attributes will be described by Concept Attributes

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define( App\Models\Concept::class,
    function( Faker\Generator $faker ) {
        return [
            'created_user_id' => getRandomClassId('Access\User\User'),
            'updated_user_id' => getRandomClassId('Access\User\User'),
            // 'deleted_by'      => getRandomClassId('Access\User\User'),
            'vocabulary_id'   => getRandomClassId('Vocabulary'),
            'status_id'       => getRandomClassId('Status'),
            'uri'             => $faker->url, //attribute
            'lexical_alias'   => $faker->text, //attribute
            'pref_label_id'   => getRandomClassId('ConceptAttribute'), //attribute
            'pref_label'      => $faker->word, //attribute
            'is_top_concept'  => $faker->boolean, //attribute
            // obsolete 'language'        => $faker->languageCode,
        ];
    } );

