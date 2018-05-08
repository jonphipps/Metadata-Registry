<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 10:54 AM */

use App\Models\Project;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(
    App\Models\Project::class,
    function (Faker\Generator $faker) {
        return [
            'created_by'       => getRandomClassId('Access\User\User'),
            'updated_by'       => getRandomClassId('Access\User\User'),
            // 'deleted_by'       => getRandomClassId('Access\User\User'),
            'title'            => $faker->sentence(3),
            'description'      => $faker->text,
            'is_private'       => $faker->boolean,
            'repo'             => $faker->url,
            'license_uri'      => $faker->url,
            'license'          => $faker->text,
            'url'              => $faker->url,
            'base_domain'      => $faker->url,
            'namespace_type'   => $faker->randomElement(['Hash','Slash']),
            'uri_strategy'     => 'Numeric',
            'uri_prepend'      => $faker->word,
            'uri_append'       => $faker->word,
            'starting_number'  => $faker->randomNumber(),
            'default_language' => $faker->languageCode,
            'languages'        => [ 'en' ],
            'prefixes'         => [ 'dc', 'dct' ],
            'google_sheet_url' => $faker->url,
            // obsolete 'web_address'      => $faker->url,
            // obsolete 'org_email'         => $faker->companyEmail,
            // obsolete 'ind_affiliation'  => $faker->word,
            // obsolete 'ind_role'         => $faker->word,
            // obsolete 'address1'         => $faker->streetAddress,
            // obsolete 'address2'         => $faker->streetAddress,
            // obsolete 'city'             => $faker->city,
            // obsolete 'state'            => $faker->word,
            // obsolete 'postal_code'      => $faker->postcode,
            // obsolete 'country'          => $faker->country,
            // obsolete 'phone'            => $faker->phoneNumber,
            // obsolete 'type'             => $faker->word,
            // obsolete 'name'             => $faker->name,
            // obsolete 'label'            => $faker->word,
        ];
    }
);

$factory->state(
    Project::class,
    'private',
    [
        'is_private' => true,
    ]
);

$factory->state(
    Project::class,
    'public',
    [
        'is_private' => false,
    ]
);

$factory->define(
    App\Models\ProjectUser::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'           => getRandomClassId('Access\User\User'),
            'agent_id'          => getRandomClassId('Project'),
            'is_registrar_for'  => $faker->boolean,
            'is_admin_for'      => $faker->boolean,
            'is_maintainer_for' => $faker->boolean,
            'authorized_as'     => $faker->randomElement([ 0,1,2,3 ]),
            'languages'         => ['en'],
            'default_language'  => $faker->languageCode,
            'current_language'  => $faker->languageCode,
        ];
    }
);
