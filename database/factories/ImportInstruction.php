<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 9:44 AM */

use App\Models\Concept;
use App\Models\Element;
use App\Models\ImportInstruction;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ImportInstruction::class, function($faker) {
    /** @var \Faker\Generator $faker */
    return [
            'import_id'              => getRandomClassId('Import'),
            'action'                 => $faker->randomElement([
                'updated',
                'added',
                'deleted',
                'force_deleted',
                'generated',
            ]),

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

$factory->state(ImportInstruction::class,
    'element',
    function($faker) {
        $propertyId = getRandomElementProfilePropertyId();
        $resourceId = getRandomClassId('Element');
        return [
            'profile_property_id' => $propertyId,
            'profile_property_label' => \App\Models\ProfileProperty::find($propertyId)->label,
            'resource_id' => $resourceId,
            'resource_label' => Element::find($resourceId)->label,
        ];
    });

//define a vocabulary import
$factory->state(ImportInstruction::class,
    'concept',
    function($faker) {
        $propertyId = getRandomConceptProfilePropertyId();
        $resourceId = getRandomClassId('Concept');

        return [
            'profile_property_id'    => $propertyId,
            'profile_property_label' => \App\Models\ProfileProperty::find($propertyId)->label,
            'resource_id'            => $resourceId,
            'resource_label'         => Concept::find($resourceId)->label,
        ];
    });
