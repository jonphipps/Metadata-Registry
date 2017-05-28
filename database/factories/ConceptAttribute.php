<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 6:25 PM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define( App\Models\ConceptAttribute::class,
    function( Faker\Generator $faker ) {
        return [
            'created_user_id'     => getRandomClassId('Access\User\User'),
            'updated_user_id'     => getRandomClassId('Access\User\User'),
            // 'deleted_by'          => getRandomClassId('Access\User\User'),
            'concept_id'          => getRandomClassId( 'Concept' ),
            // obsolete 'primary_pref_label'  => $faker->boolean,
            'object'              => $faker->text,
            'related_concept_id'  => getRandomClassId( 'Concept' ),
            'language'            => $faker->word,
            'status_id'           =>getRandomClassId('Status'),
            // obsolete 'is_concept_property' => $faker->boolean,
            'profile_property_id' => getRandomClassId( 'ProfileProperty' ),
            'is_generated'        => $faker->boolean,
        ];
    } );
