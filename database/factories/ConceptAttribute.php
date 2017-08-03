<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-26,  Time: 6:25 PM */

use App\Models\Concept;
use App\Models\ConceptAttribute;

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
            'language'            => $faker->languageCode,
            'status_id'           =>getRandomClassId('Status'),
            // obsolete 'is_concept_property' => $faker->boolean,
            'profile_property_id' => getRandomClassId( 'ProfileProperty' ),
            'is_generated'        => $faker->boolean,
        ];
    } );

$factory->state(App\Models\ConceptAttribute::class,
    'resource',
    function() {
        $id      = getRandomClassId('Concept');
        /** @var Concept $concept */
        $concept = Concept::find($id);
        return [
            'language' =>null,
            'related_concept_id' => $id,
            'object' => $concept->uri,
            'is_generated' => false,
        ];
    });
$factory->state(ConceptAttribute::class,
    'has_reciprocal',
    function() {
        return [
            'profile_property_id' => 16,
        ];
    });
$factory->state(ConceptAttribute::class,
    'has_inverse',
    function() {
        return [
            'profile_property_id' => 35,
        ];
    });
