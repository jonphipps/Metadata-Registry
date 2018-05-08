<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 9:44 AM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(
    App\Models\ConceptAttributeHistory::class,
    function (Faker\Generator $faker) {
        return [
            'created_by'          => getRandomClassId('Access\User\User'),
            'action'              => getRandomAction($faker),
            'concept_property_id' => getRandomClassId('ConceptAttribute'),
            'concept_id'          => getRandomClassId('Concept'),
            'vocabulary_id'       => getRandomClassId('Vocabulary'),
            // obsolete 'skos_property_id'    => $faker->randomNumber(),
            'object'              => $faker->text,
            // obsolete 'scheme_id'           => $faker->randomNumber(),
            'related_concept_id'  => getRandomClassId('Concept'),
            'language'            => $faker->languageCode,
            'status_id'           => getRandomClassId('Status'),
            'created_user_id'     => getRandomClassId('Access\User\User'),
            'change_note'         => $faker->text,
            'import_id'           => getRandomClassId('Import'),
            'profile_property_id' => getRandomConceptProfilePropertyId(),
        ];
    }
);
