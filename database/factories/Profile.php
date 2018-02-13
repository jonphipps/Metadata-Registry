<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 11:52 AM */

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(
    App\Models\Lookup::class,
    function (Faker\Generator $faker) {
        return [
            'type_id'       => $faker->randomNumber(),
            'short_value'   => $faker->word,
            'long_value'    => $faker->word,
            'display_order' => $faker->randomNumber(),
        ];
    }
);

$factory->define(
    App\Models\Prefix::class,
    function (Faker\Generator $faker) {
        return [
            'prefix' => $faker->word,
            'uri'    => $faker->url,
            'rank'   => $faker->randomNumber(),
        ];
    }
);

$factory->define(
    App\Models\Profile::class,
    function (Faker\Generator $faker) {
        return [
            'created_by'       => getRandomClassId('Access\User\User'),
            'updated_by'       => getRandomClassId('Access\User\User'),
            // 'deleted_by'       => getRandomClassId('Access\User\User'),
            // 'child_updated_at' => $faker->dateTimeBetween(),
            // 'child_updated_by' => getRandomClassId('Access\User\User'),
            'name'             => $faker->name,
            'note'             => $faker->text,
            'uri'              => $faker->url,
            'url'              => $faker->url,
            'base_domain'      => $faker->url,
            'token'            => $faker->word,
            'community'        => $faker->word,
            'last_uri_id'      => $faker->randomNumber(),
            'status_id'        => getRandomClassId('Status'),
            'language'         => $faker->languageCode,
        ];
    }
);

$factory->define(
    App\Models\ProfileProperty::class,
    function (Faker\Generator $faker) {
        return [
            'created_by'                  => getRandomClassId('Access\User\User'),
            'updated_by'                  => getRandomClassId('Access\User\User'),
            'deleted_by'                  => getRandomClassId('Access\User\User'),
            'profile_id'                  => getRandomClassId('Profile'),
            'name'                        => $faker->name,
            'label'                       => $faker->word,
            'definition'                  => $faker->text,
            'comment'                     => $faker->text,
            'type'                        => $faker->randomElement(['Property','Class','Concept']),
            'uri'                         => $faker->url,
            'status_id'                   => getRandomClassId('Status'),
            'language'                    => $faker->languageCode,
            'note'                        => $faker->text,
            'display_order'               => $faker->randomNumber(),
            'export_order'                => $faker->randomNumber(),
            'picklist_order'              => $faker->randomNumber(),
            'examples'                    => $faker->word,
            'is_required'                 => $faker->boolean,
            'is_reciprocal'               => $faker->boolean,
            'is_singleton'                => $faker->boolean,
            'is_in_picklist'              => $faker->boolean,
            'is_in_export'                => $faker->boolean,
            'inverse_profile_property_id' => getRandomClassId('ProfileProperty'),
            'is_in_class_picklist'        => $faker->boolean,
            'is_in_property_picklist'     => $faker->boolean,
            'is_in_rdf'                   => $faker->boolean,
            'is_in_xsd'                   => $faker->boolean,
            'is_attribute'                => $faker->boolean,
            'has_language'                => $faker->boolean,
            'is_object_prop'              => $faker->boolean,
            'is_in_form'                  => $faker->boolean,
            'namespce'                    => $faker->url,
            // obsolete 'skos_id'                     => $faker->randomNumber(),
            // obsolete 'skos_parent_id'              => $faker->randomNumber(),
        ];
    }
);
