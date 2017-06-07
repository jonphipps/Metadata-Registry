<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 9:44 AM */

use App\Models\ImportInstruction;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ImportInstruction::class,
    function(Faker\Generator $faker) {
        return [
            'import_id'              => getRandomClassId('Import'),
            'action'                 => getRandomAction($faker->randomElement([
                'updated',
                'added',
                'deleted',
                'force_deleted',
                'generated',
            ])),

            //different for concept and schema
            'profile_property_id'    => getRandomConceptProfilePropertyId(),
            //get the correct label
            'profile_property_label' => getRandomConceptProfilePropertyId(),

            'concept_property_id'        => getRandomClassId('ConceptAttribute'),
            'schema_property_element_id' => getRandomClassId('ElementAttribute'),

            //different for elementset and vocabulary
            'resource_id'                => getRandomClassId('Concept'),
            'resource_label'             => $faker->text,

            'before_value' => $faker->text,
            'after_value'  => $faker->text,
            'language'     => $faker->languageCode,
        ];
    });

//define an elementset import
$factory->defineAs(ImportInstruction::class,
    'ElementImportInstruction',
    function(Faker\Generator $faker) use ($factory) {
        $importInstruction = $factory->raw(ImportInstruction::class);

        return array_merge($importInstruction,
            [
                'profile_property_id'    => getRandomElementProfilePropertyId(),
                //get the correct label
                'profile_property_label' => 'label',
                'resource_id'            => getRandomClassId('Element'),
            ]);
    });

//define a vocabulary import
$factory->defineAs(ImportInstruction::class,
    'ConceptImportInstruction',
    function(Faker\Generator $faker) use ($factory) {
        $importInstruction = $factory->raw(ImportInstruction::class);

        return array_merge($importInstruction,
            [
                'profile_property_id'    => getRandomConceptProfilePropertyId(),
                //get the correct label
                'profile_property_label' => 'label',
                'resource_id'            => getRandomClassId('Concept'),
            ]);
    });
