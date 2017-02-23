<?php

use Faker\Generator;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var Illuminate\Database\Eloquent\Factory $factory */

//INSERT INTO `swregistry`.`Agent` (id, created_at, created_at_timestamp, last_updated, deleted_at, org_email, org_name, ind_affiliation, ind_role, address1, address2, city, state, postal_code, country, phone, web_address, type) VALUES ()
$factory->define(
    App\Models\Project::class,
    function (Faker\Generator $faker) {
        return [
          'org_email'       => $faker->companyEmail,
          'org_name'        => $faker->company,
          'ind_affiliation' => $faker->company,
          'ind_role'        => $faker->word,
          'address1'        => $faker->streetAddress,
          'address2'        => $faker->streetAddress,
          'city'            => $faker->city,
          'state'           => $faker->stateAbbr,
          'postal_code'     => $faker->postcode,
          'country'         => $faker->country,
          'phone'           => $faker->phoneNumber,
          'web_address'     => $faker->url,
          'type'            => $faker->randomElement([ 'Individual', 'Organization' ]),
        ];
    }
);

//INSERT INTO `swregistry`.`ProjectHasUser` (id, created_at, updated_at, deleted_at, user_id, agent_id, is_registrar_for, is_admin_for) VALUES ()
$factory->define(
    App\Models\ProjectHasUser::class,
    function (Faker\Generator $faker) {
        xdebug_break();

        return [
          'agent_id'         => getAgent(),
          'user_id'          => getAgentUser(),
          'is_registrar_for' => true,
          'is_admin_for'     => true,
        ];
    }
);

//INSERT INTO `swregistry`.`Concept` (id, created_at, updated_at, deleted_at, last_updated, created_user_id, updated_user_id, uri, pref_label, vocabulary_id, is_top_concept, pref_label_id, status_id, language) VALUES ()
$factory->define(
    App\Models\Concept::class,
    function (Faker\Generator $faker) {
        return [
          'created_user_id' => $faker,
          'updated_user_id' => $faker,
          'uri'             => $faker,
          'pref_label'      => $faker,
          'vocabulary_id'   => $faker,
          'is_top_concept'  => $faker,
          'pref_label_id'   => $faker,
          'status_id'       => $faker,
          'language'        => $faker,
        ];
    }
);

//INSERT INTO `swregistry`.`ConceptAttribute` (id, created_at, updated_at, deleted_at, last_updated, created_user_id, updated_user_id, concept_id, primary_pref_label, skos_property_id, object, scheme_id, related_concept_id, language, status_id, is_concept_property, profile_property_id) VALUES ()
$factory->define(
    App\Models\ConceptAttribute::class,
    function (Faker\Generator $faker) {
        return [
          'created_user_id'     => $faker,
          'updated_user_id'     => $faker,
          'concept_id'          => $faker,
          'primary_pref_label'  => $faker,
          'skos_property_id'    => $faker,
          'object'              => $faker,
          'scheme_id'           => $faker,
          'related_concept_id'  => $faker,
          'language'            => $faker,
          'status_id'           => $faker,
          'is_concept_property' => $faker,
          'profile_property_id' => $faker,
        ];
    }
);

//INSERT INTO `swregistry`.`ConceptAttributeHistory` (id, created_at, action, concept_property_id, concept_id, vocabulary_id, skos_property_id, object, scheme_id, related_concept_id, language, status_id, created_user_id, change_note, import_id) VALUES ()
$factory->define(
    App\Models\ConceptAttributeHistory::class,
    function (Faker\Generator $faker) {
        return [
          'action'              => $faker,
          'concept_property_id' => $faker,
          'concept_id'          => $faker,
          'vocabulary_id'       => $faker,
          'skos_property_id'    => $faker,
          'object'              => $faker,
          'scheme_id'           => $faker,
          'related_concept_id'  => $faker,
          'language'            => $faker,
          'status_id'           => $faker,
          'created_user_id'     => $faker,
          'change_note'         => $faker,
          'import_id'           => $faker,
        ];
    }
);

//INSERT INTO `swregistry`.`FileImportHistory` (id, created_at, map, user_id, vocabulary_id, schema_id, file_name, source_file_name, file_type, batch_id, results, total_processed_count, error_count, success_count) VALUES ()
$factory->define(
    App\Models\FileImportHistory::class,
    function (Faker\Generator $faker) {
        return [
          'action'              => $faker,
          'concept_property_id' => $faker,
          'concept_id'          => $faker,
          'vocabulary_id'       => $faker,
          'skos_property_id'    => $faker,
          'object'              => $faker,
          'scheme_id'           => $faker,
          'related_concept_id'  => $faker,
          'language'            => $faker,
          'status_id'           => $faker,
          'created_user_id'     => $faker,
          'change_note'         => $faker,
          'import_id'           => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`ElementAttribute` (id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_property_id, profile_property_id, is_schema_property, object, related_schema_property_id, language, status_id, is_generated) VALUES ()
$factory->define(
    App\Models\ElementAttribute::class,
    function (Faker\Generator $faker) {
        return [
          'action'              => $faker,
          'concept_property_id' => $faker,
          'concept_id'          => $faker,
          'vocabulary_id'       => $faker,
          'skos_property_id'    => $faker,
          'object'              => $faker,
          'scheme_id'           => $faker,
          'related_concept_id'  => $faker,
          'language'            => $faker,
          'status_id'           => $faker,
          'created_user_id'     => $faker,
          'change_note'         => $faker,
          'import_id'           => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`ElementAttributeHistory` (id, created_at, created_user_id, action, schema_property_element_id, schema_property_id, schema_id, profile_property_id, object, related_schema_property_id, language, status_id, change_note, import_id) VALUES ()
$factory->define(
    App\Models\ElementAttributeHistory::class,
    function (Faker\Generator $faker) {
        return [
          'action'              => $faker,
          'concept_property_id' => $faker,
          'concept_id'          => $faker,
          'vocabulary_id'       => $faker,
          'skos_property_id'    => $faker,
          'object'              => $faker,
          'scheme_id'           => $faker,
          'related_concept_id'  => $faker,
          'language'            => $faker,
          'status_id'           => $faker,
          'created_user_id'     => $faker,
          'change_note'         => $faker,
          'import_id'           => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`ElementSet` (id, agent_id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, child_updated_at, child_updated_user_id, name, note, uri, url, base_domain, token, community, last_uri_id, status_id, language, profile_id, ns_type, prefixes, languages, repo) VALUES ()
$factory->define(
    App\Models\ElementSet::class,
    function (Faker\Generator $faker) {
        $user = getNewUser();

        return [
          'created_user_id'       => $user,
          'updated_user_id'       => $user,
          'child_updated_at'      => '',
          'child_updated_user_id' => '',
          'name'                  => $faker->word,
          'note'                  => $faker->paragraph(),
          'uri'                   => $faker->url,
          'url'                   => $faker->url,
          'base_domain'           => $faker->domainName,
          'token'                 => '',
          'community'             => '',
          'last_uri_id'           => '',
          'status_id'             => getRandomStatus($faker),
          'language'              => $faker->languageCode,
          'profile_id'            => 1,
          'ns_type'               => '',
          'prefixes'              => '',
          'languages'             => '',
          'repo'                  => '',
        ];
    }
);
//INSERT INTO `swregistry`.`ElementSetHasUser` (id, created_at, updated_at, deleted_at, schema_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, languages, default_language, current_language) VALUES ()
$factory->define(
    App\Models\ElementSetHasUser::class,
    function (Faker\Generator $faker) {
        return [
          'schema_id'         => $faker,
          'user_id'           => $faker,
          'is_maintainer_for' => $faker,
          'is_registrar_for'  => $faker,
          'is_admin_for'      => $faker,
          'languages'         => $faker,
          'default_language'  => $faker,
          'current_language'  => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`ElementSetHasVersion` (id, name, created_at, deleted_at, updated_at, created_user_id, schema_id, timeslice) VALUES ()
$factory->define(
    App\Models\ElementSetHasVersion::class,
    function (Faker\Generator $faker) {
        return [
          'name'            => $faker,
          'created_user_id' => $faker,
          'schema_id'       => $faker,
          'timeslice'       => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`Vocabulary` (id, agent_id, created_at, deleted_at, last_updated, created_user_id, updated_user_id, child_updated_at, child_updated_user_id, name, note, uri, url, base_domain, token, community, last_uri_id, status_id, language, languages, profile_id, ns_type, prefixes, repos, repo) VALUES ()
$factory->define(
    App\Models\Vocabulary::class,
    function (Faker\Generator $faker) {
        return [
          'agent_id'              => $faker,
          'created_user_id'       => $faker,
          'updated_user_id'       => $faker,
          'child_updated_at'      => $faker,
          'child_updated_user_id' => $faker,
          'name'                  => $faker,
          'note'                  => $faker,
          'uri'                   => $faker,
          'url'                   => $faker,
          'base_domain'           => $faker,
          'token'                 => $faker,
          'community'             => $faker,
          'last_uri_id'           => $faker,
          'status_id'             => $faker,
          'language'              => $faker,
          'languages'             => $faker,
          'profile_id'            => $faker,
          'ns_type'               => $faker,
          'prefixes'              => $faker,
          'repos'                 => $faker,
          'repo'                  => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`VocabularyHasUser` (id, created_at, updated_at, deleted_at, vocabulary_id, user_id, is_maintainer_for, is_registrar_for, is_admin_for, languages, default_language, current_language) VALUES ()
$factory->define(
    App\Models\VocabularyHasUser::class,
    function (Faker\Generator $faker) {
        return [
          'vocabulary_id'     => $faker,
          'user_id'           => $faker,
          'is_maintainer_for' => $faker,
          'is_registrar_for'  => $faker,
          'is_admin_for'      => $faker,
          'languages'         => $faker,
          'default_language'  => $faker,
          'current_language'  => $faker,
        ];
    }
);
//INSERT INTO `swregistry`.`VocabularyHasVersion` (id, name, created_at, deleted_at, updated_at, created_user_id, vocabulary_id, timeslice) VALUES ()
$factory->define(
    App\Models\VocabularyHasVersion::class,
    function (Faker\Generator $faker) {
        return [
          'name'            => $faker,
          'created_at'      => $faker,
          'deleted_at'      => $faker,
          'updated_at'      => $faker,
          'created_user_id' => $faker,
          'vocabulary_id'   => $faker,
          'timeslice'       => $faker,
        ];
    }
);

//INSERT INTO `swregistry`.`reg_user` (id, created_at, last_updated, deleted_at, nickname, name, salutation, first_name, last_name, email, sha1_password, salt, want_to_be_moderator, is_moderator, is_administrator, deletions, password, culture) VALUES ()
$factory->define(
    User::class,
    function (Faker\Generator $faker) {
        static $password;
      $name = $faker->unique()->userName;

        return [
          'nickname'          => $name,
          'name'              => $name,
          'email'             => $faker->safeEmail,
          'password'          => $password ?: $password = bcrypt('secret'),
          'sha1_password'     => '4d62099656182b62337a7b52535f4f1e1a214542',
          'salt'              => 'a4f51ef3ff29a5162c98c684581250de',
          'remember_token'    => str_random(10),
          'confirmation_code' => md5(uniqid(mt_rand(), true)),
        ];
    }
);

$factory->state(
    User::class,
    'active',
    function () {
        return [
          'status' => 1,
        ];
    }
);

$factory->state(
    User::class,
    'inactive',
    function () {
        return [
          'status' => 0,
        ];
    }
);

$factory->state(
    User::class,
    'confirmed',
    function () {
        return [
          'confirmed' => 1,
        ];
    }
);

$factory->state(
    User::class,
    'unconfirmed',
    function () {
        return [
          'confirmed' => 0,
        ];
    }
);

/**
 * Roles
 */
$factory->define(
    Role::class,
    function (Generator $faker) {
        return [
          'name' => $faker->name,
          'all'  => 0,
          'sort' => $faker->numberBetween(1, 100),
        ];
    }
);

$factory->state(
    Role::class,
    'admin',
    function () {
        return [
          'all' => 1,
        ];
    }
);

$factory->defineAs(
    User::class,
    'super_admin',
    function (Faker\Generator $faker) use ($factory) {
        $user = $factory->raw(App\Models\Element::class);

        return array_merge(
            $user,
            [
              'is_administrator' => true,
            ]
        );
    }
);

//INSERT INTO `swregistry`.`Element` (id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_id, name, label, definition, comment, type, is_subproperty_of, parent_uri, uri, status_id, language, note, domain, orange, is_deprecated, url, lexical_alias, hash_id) VALUES ()
$factory->define(
    App\Models\Element::class,
    function (Faker\Generator $faker) {
        $userIds   = User::all('id')->pluck('id')->toArray();
        $schemaIds = \App\Models\ElementSet::all('id')->pluck('id')->toArray();
        $statusIds = \App\Models\Status::all('id')->pluck('id')->toArray();
        $user_id   = $faker->randomElement($userIds);

        return [
          'created_user_id' => $user_id,
          'updated_user_id' => $user_id,
          'schema_id'       => $faker->randomElement($schemaIds),
          'status_id'       => $faker->randomElement($statusIds),
        ];
    }
);

$factory->defineAs(
    App\Models\Element::class,
    'ElementFull',
    function (Faker\Generator $faker) use ($factory) {
        $element = $factory->raw(App\Models\Element::class);
        $label   = $faker->words;
        $uri     = $faker->url;

        return array_merge(
            $element,
            [
              'name'              => $faker->word,
              'label'             => $label,
              'definition'        => $faker->sentence(),
              'comment'           => $faker->sentence(),
              'type'              => 'property',
              'is_subproperty_of' => '',
              'parent_uri'        => '',
              'uri'               => $uri,
              'language'          => 'en',
              'note'              => $faker->sentence(),
              'domain'            => $faker->url,
              'orange'            => $faker->url,
              'is_deprecated'     => false,
              'url'               => $faker->url,
              'lexical_alias'     => $uri . '/' . str_slug($label),
            ]
        );
    }
);

//******************************************
/** used for testing nils-api */
//******************************************

$factory->define(
    App\Models\Employees::class,
    function (Faker\Generator $faker) {
        return [
          'company'         => $faker->company,
          'last_name'       => $faker->lastName,
          'first_name'      => $faker->firstName,
          'email_address'   => $faker->email,
          'job_title'       => $faker->word,
          'business_phone'  => $faker->phoneNumber,
          'home_phone'      => $faker->phoneNumber,
          'mobile_phone'    => $faker->phoneNumber,
          'fax_number'      => $faker->phoneNumber,
          'address'         => $faker->streetAddress,
          'city'            => $faker->city,
          'state_province'  => $faker->state,
          'zip_postal_code' => $faker->postcode,
          'country_region'  => $faker->country,
          'web_page'        => $faker->url,
          'notes'           => $faker->sentence,
        ];
    }
);

$factory->define(
    App\Models\Orders::class,
    function (Faker\Generator $faker) {
        $employeeIds = \App\Models\Employees::all('id')->pluck('id')->toArray();

        return [
          'employee_id'          => $faker->randomElement($employeeIds),
          'customer_id'          => $faker->numberBetween(1, 100),
          'order_date'           => $faker->dateTimeThisMonth,
          'shipped_date'         => $faker->dateTimeThisMonth,
          'shipper_id'           => $faker->numberBetween(1, 100),
          'ship_name'            => $faker->name,
          'ship_address'         => $faker->address,
          'ship_city'            => $faker->city,
          'ship_state_province'  => $faker->state,
          'ship_zip_postal_code' => $faker->postcode,
          'ship_country_region'  => $faker->country,
          'shipping_fee'         => $faker->randomFloat(2),
          'taxes'                => $faker->randomFloat(2),
          'payment_type'         => $faker->word,
          'paid_date'            => $faker->dateTimeThisMonth,
          'notes'                => $faker->sentence,
          'tax_rate'             => $faker->randomFloat(2),
          'status_id'            => $faker->numberBetween(1, 100),
        ];
    }
);

if (! function_exists('getNewUser')) {
    function getNewUser($except = [])
    {
        $userIds = User::all('id')->except($except)->pluck('id')->toArray();
        if ($userIds) {
            $faker = \Faker\Factory::create();
            ;

            return $faker->randomElement($userIds);
        }
        $user = factory(User::class, 1)->create();

        return $user->id;
    }
}

if (! function_exists('getAgentUser')) {
    function getAgentUser()
    {
        //get the user_ids not associated with an existing agent
        $except = \App\Models\ProjectHasUser::all('user_id')->pluck('user_id')->toArray();

        return getNewUser($except);
    }
}

if (! function_exists('getAgent')) {
    function getAgent($except = [])
    {
        $ids = \App\Models\Project::all('id')->except($except)->pluck('id')->toArray();
        if ($ids) {
            $faker = \Faker\Factory::create();
            ;

            return $faker->randomElement($ids);
        }
        $agent = factory(App\Models\Project::class, 1)->create();

        return $agent->id;
    }
}
$factory->define(
    App\Models\ArcG2t::class,
    function (Faker\Generator $faker) {
        return [
          'g' => $faker->randomNumber(),
          't' => $faker->randomNumber(),
        ];
    }
);

$factory->define(
    App\Models\ArcId2val::class,
    function (Faker\Generator $faker) {
        return [
          'id'       => $faker->randomNumber(),
          'misc'     => $faker->boolean,
          'val'      => $faker->text,
          'val_type' => $faker->boolean,
        ];
    }
);

$factory->define(
    App\Models\ArcO2val::class,
    function (Faker\Generator $faker) {
        return [
          'id'   => $faker->randomNumber(),
          'cid'  => $faker->randomNumber(),
          'misc' => $faker->boolean,
          'val'  => $faker->text,
        ];
    }
);

$factory->define(
    App\Models\ArcS2val::class,
    function (Faker\Generator $faker) {
        return [
          'id'   => $faker->randomNumber(),
          'cid'  => $faker->randomNumber(),
          'misc' => $faker->boolean,
          'val'  => $faker->text,
        ];
    }
);

$factory->define(
    App\Models\ArcSetting::class,
    function (Faker\Generator $faker) {
        return [
          'k'   => $faker->word,
          'val' => $faker->text,
        ];
    }
);

$factory->define(
    App\Models\ArcTriple::class,
    function (Faker\Generator $faker) {
        return [
          't'         => $faker->randomNumber(),
          's'         => $faker->randomNumber(),
          'p'         => $faker->randomNumber(),
          'o'         => $faker->randomNumber(),
          'o_lang_dt' => $faker->randomNumber(),
          'o_comp'    => $faker->word,
          's_type'    => $faker->boolean,
          'o_type'    => $faker->boolean,
          'misc'      => $faker->boolean,
        ];
    }
);

$factory->define(
    App\Models\Batch::class,
    function (Faker\Generator $faker) {
        return [
          'run_time'          => $faker->dateTimeBetween(),
          'run_description'   => $faker->text,
          'object_type'       => $faker->word,
          'object_id'         => $faker->randomNumber(),
          'event_time'        => $faker->dateTimeBetween(),
          'event_type'        => $faker->word,
          'event_description' => $faker->text,
          'registry_uri'      => $faker->word,
        ];
    }
);

$factory->define(
    App\Models\Collection::class,
    function (Faker\Generator $faker) {
        return [
          'last_updated'    => $faker->dateTimeBetween(),
          'created_user_id' => factory(User::class)->create()->id,
          'updated_user_id' => factory(User::class)->create()->id,
          'vocabulary_id'   => factory(App\Models\Vocabulary::class)->create()->id,
          'name'            => $faker->name,
          'uri'             => $faker->word,
          'pref_label'      => $faker->word,
          'status_id'       => factory(App\Models\Status::class)->create()->id,
        ];
    }
);

$factory->define(
    App\Models\Discuss::class,
    function (Faker\Generator $faker) {
        return [
          'created_user_id'            => factory(User::class)->create()->id,
          'deleted_user_id'            => factory(User::class)->create()->id,
          'uri'                        => $faker->word,
          'schema_id'                  => factory(App\Models\ElementSet::class)->create()->id,
          'schema_property_id'         => factory(App\Models\Element::class)->create()->id,
          'schema_property_element_id' => factory(App\Models\ElementAttribute::class)->create()->id,
          'vocabulary_id'              => factory(App\Models\Vocabulary::class)->create()->id,
          'concept_id'                 => factory(App\Models\Concept::class)->create()->id,
          'concept_property_id'        => factory(App\Models\ConceptAttribute::class)->create()->id,
          'root_id'                    => factory(App\Models\Discuss::class)->create()->id,
          'parent_id'                  => factory(App\Models\Discuss::class)->create()->id,
          'subject'                    => $faker->word,
          'content'                    => $faker->text,
        ];
    }
);

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
          'uri'    => $faker->word,
          'rank'   => $faker->randomNumber(),
        ];
    }
);

$factory->define(
    App\Models\Profile::class,
    function (Faker\Generator $faker) {
        return [
          'agent_id'         => $faker->randomNumber(),
          'created_by'       => $faker->randomNumber(),
          'updated_by'       => $faker->randomNumber(),
          'deleted_by'       => $faker->randomNumber(),
          'child_updated_at' => $faker->dateTimeBetween(),
          'child_updated_by' => $faker->randomNumber(),
          'name'             => $faker->name,
          'note'             => $faker->text,
          'uri'              => $faker->word,
          'url'              => $faker->url,
          'base_domain'      => $faker->word,
          'token'            => $faker->word,
          'community'        => $faker->word,
          'last_uri_id'      => $faker->randomNumber(),
          'status_id'        => factory(App\Models\Status::class)->create()->id,
          'language'         => $faker->word,
        ];
    }
);

$factory->define(
    App\Models\ProfileProperty::class,
    function (Faker\Generator $faker) {
        return [
          'skos_id'                     => $faker->randomNumber(),
          'created_by'                  => $faker->randomNumber(),
          'updated_by'                  => $faker->randomNumber(),
          'deleted_by'                  => $faker->randomNumber(),
          'profile_id'                  => factory(App\Models\Profile::class)->create()->id,
          'skos_parent_id'              => $faker->randomNumber(),
          'name'                        => $faker->name,
          'label'                       => $faker->word,
          'definition'                  => $faker->text,
          'comment'                     => $faker->text,
          'type'                        => $faker->word,
          'uri'                         => $faker->word,
          'status_id'                   => $faker->randomNumber(),
          'language'                    => $faker->word,
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
          'inverse_profile_property_id' => $faker->randomNumber(),
          'is_in_class_picklist'        => $faker->boolean,
          'is_in_property_picklist'     => $faker->boolean,
          'is_in_rdf'                   => $faker->boolean,
          'is_in_xsd'                   => $faker->boolean,
          'is_attribute'                => $faker->boolean,
          'has_language'                => $faker->boolean,
          'is_object_prop'              => $faker->boolean,
          'is_in_form'                  => $faker->boolean,
          'namespace'                   => $faker->word,
        ];
    }
);

$factory->define(
    App\Models\RdfNamespace::class,
    function (Faker\Generator $faker) {
        return [
          'schema_id'       => factory(App\Models\ElementSet::class)->create()->id,
          'created_user_id' => $faker->randomNumber(),
          'updated_user_id' => $faker->randomNumber(),
          'token'           => $faker->word,
          'note'            => $faker->text,
          'uri'             => $faker->word,
          'schema_location' => $faker->word,
        ];
    }
);

$factory->define(
    App\Models\Resource::class,
    function (Faker\Generator $faker) {
        return [];
    }
);

$factory->define(
    App\Models\SkosProperty::class,
    function (Faker\Generator $faker) {
        return [
          'parent_id'      => $faker->randomNumber(),
          'inverse_id'     => $faker->randomNumber(),
          'name'           => $faker->name,
          'uri'            => $faker->word,
          'object_type'    => $faker->word,
          'display_order'  => $faker->randomNumber(),
          'picklist_order' => $faker->randomNumber(),
          'label'          => $faker->word,
          'definition'     => $faker->text,
          'comment'        => $faker->text,
          'examples'       => $faker->word,
          'is_required'    => $faker->boolean,
          'is_reciprocal'  => $faker->boolean,
          'is_singleton'   => $faker->boolean,
          'is_scheme'      => $faker->boolean,
          'is_in_picklist' => $faker->boolean,
        ];
    }
);

$factory->define(
    App\Models\Status::class,
    function (Faker\Generator $faker) {
        return [
          'display_order' => $faker->randomNumber(),
          'display_name'  => $faker->word,
          'uri'           => $faker->word,
        ];
    }
);

if (! function_exists('getRandomStatus')) {
    function getRandomStatus(Faker\Generator $faker)
    {
        return $faker->numberBetween(1, 9);
    }
}
