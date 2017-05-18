<?php

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Models\ConceptAttribute;
use Faker\Generator;

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

$factory->define(App\Models\ArcG2t::class,
    function(Faker\Generator $faker) {
        return [
            'g' => $faker->randomNumber(),
            't' => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\ArcId2val::class,
    function(Faker\Generator $faker) {
        return [
            'id'       => $faker->randomNumber(),
            'misc'     => $faker->boolean,
            'val'      => $faker->text,
            'val_type' => $faker->boolean,
        ];
    });

$factory->define(App\Models\ArcO2val::class,
    function(Faker\Generator $faker) {
        return [
            'id'   => $faker->randomNumber(),
            'cid'  => $faker->randomNumber(),
            'misc' => $faker->boolean,
            'val'  => $faker->text,
        ];
    });

$factory->define(App\Models\ArcS2val::class,
    function(Faker\Generator $faker) {
        return [
            'id'   => $faker->randomNumber(),
            'cid'  => $faker->randomNumber(),
            'misc' => $faker->boolean,
            'val'  => $faker->text,
        ];
    });

$factory->define(App\Models\ArcSetting::class,
    function(Faker\Generator $faker) {
        return [
            'k'   => $faker->word,
            'val' => $faker->text,
        ];
    });

$factory->define(App\Models\ArcTriple::class,
    function(Faker\Generator $faker) {
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
    });

$factory->define(App\Models\Batch::class,
    function(Faker\Generator $faker) {
        return [
            // 'run_time'          => $faker->dateTimeBetween(),
            // 'run_description'   => $faker->text,
            // 'object_type'       => $faker->word,
            // 'object_id'         => $faker->randomNumber(),
            // 'event_time'        => $faker->dateTimeBetween(),
            // 'event_type'        => $faker->word,
            // 'event_description' => $faker->text,
            // 'registry_uri'      => $faker->word,
        ];
    });

$factory->define(App\Models\Collection::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'last_updated'    => $faker->dateTimeBetween(),
            // 'created_user_id' => $creator,
            // 'updated_user_id' => $updator,
            // 'vocabulary_id'   => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'name'            => $faker->name,
            // 'uri'             => $faker->word,
            // 'pref_label'      => $faker->word,
            // 'created_by' => $creator,
            // 'updated_by' => $updator,
            // 'deleted_by' => $deletor,
            // 'status_id'       => getRandomStatus($faker),
        ];
    });

$factory->define(App\Models\Concept::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();
        //
        return [
        //     'last_updated'    => $faker->dateTimeBetween(),
        //     'created_user_id' => $creator,
        //     'updated_user_id' => $updator,
        //     'uri'             => $faker->url,
        //     'lexical_alias'   => $faker->text,
        //     'pref_label'      => $faker->word,
        //     'vocabulary_id'   => function() {
        //         return factory(App\Models\Vocabulary::class)->create()->id;
        //     },
        //     'is_top_concept'  => $faker->boolean,
        //     'pref_label_id'   => function() {
        //         return factory(ConceptAttribute::class)->create()->id;
        //     },
        //     'status_id'       => getRandomStatus($faker),
        //     'language'        => $faker->languageCode,
        //     'created_by' => $creator,
        //     'updated_by' => $updator,
        //     'deleted_by' => $deletor,
        ];
    });

$factory->define(App\Models\ConceptAttribute::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'last_updated'        => $faker->dateTimeBetween(),
            // 'created_user_id'     => $creator,
            // 'updated_user_id'     => $updator,
            // 'concept_id'          => function() {
            //     return factory(App\Models\Concept::class)->create()->id;
            // },
            // 'primary_pref_label'  => $faker->boolean,
            // 'skos_property_id'    => $faker->randomNumber(),
            // 'object'              => $faker->text,
            // 'scheme_id'           => $faker->randomNumber(),
            // 'related_concept_id'  => $faker->randomNumber(),
            // 'language'            => $faker->languageCode,
            // 'status_id'           => getRandomStatus($faker),
            // 'is_concept_property' => $faker->boolean,
            'profile_property_id' => getRandomConceptProfilePropertyId($faker)
            // 'is_generated'        => $faker->boolean,
            // 'created_by' => $creator,
            // 'updated_by' => $updator,
            // 'deleted_by' => $deletor,
        ];
    });

$factory->define(App\Models\ConceptAttributeHistory::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();

        return [
            // 'action'              => $faker->word,
            // 'concept_property_id' => function() {
            //     return factory(App\Models\ConceptAttribute::class)->create()->id;
            // },
            // 'concept_id'          => function() {
            //     return factory(App\Models\Concept::class)->create()->id;
            // },
            // 'vocabulary_id'       => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'skos_property_id'    => function() {
            //     return factory(App\Models\SkosProperty::class)->create()->id;
            // },
            // 'object'              => $faker->text,
            // 'scheme_id'           => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'related_concept_id'  => function() {
            //     return factory(App\Models\Concept::class)->create()->id;
            // },
            // 'language'            => $faker->word,
            // 'status_id'           => getRandomStatus($faker),
            // 'created_user_id'     => $creator,
            // 'change_note'         => $faker->text,
            // 'import_id'           => function() {
            //     return factory(App\Models\FileImportHistory::class)->create()->id;
            // },
            // 'profile_property_id' => $faker->randomNumber(),
            // 'created_by'          => $creator,
        ];
    });

$factory->define(App\Models\Discuss::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'created_user_id'            => $creator,
            // 'deleted_user_id'            => $deletor,
            // 'uri'                        => $faker->word,
            // 'schema_id'                  => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'schema_property_id'         => function() {
            //     return factory(App\Models\Element::class)->create()->id;
            // },
            // 'schema_property_element_id' => function() {
            //     return factory(App\Models\ElementAttribute::class)->create()->id;
            // },
            // 'vocabulary_id'              => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'concept_id'                 => function() {
            //     return factory(App\Models\Concept::class)->create()->id;
            // },
            // 'concept_property_id'        => function() {
            //     return factory(App\Models\ConceptAttribute::class)->create()->id;
            // },
            // 'root_id'                    => function() {
            //     return factory(App\Models\Discuss::class)->create()->id;
            // },
            // 'parent_id'                  => function() {
            //     return factory(App\Models\Discuss::class)->create()->id;
            // },
            // 'subject'                    => $faker->word,
            // 'content'                    => $faker->text,
            // 'created_by' => $creator,
            // 'updated_by' => $updator,
            // 'deleted_by' => $deletor,
        ];
    });

$factory->define(App\Models\Element::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'created_user_id'   => $creator,
            // 'updated_user_id'   => $updator,
            // 'deleted_user_id'   => $deletor,
            // 'schema_id'         => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'name'              => $faker->name,
            // 'label'             => $faker->word,
            // 'definition'        => $faker->text,
            // 'comment'           => $faker->text,
            // 'type'              => $faker->word,
            // 'is_subproperty_of' => $faker->randomNumber(),
            // 'parent_uri'        => $faker->word,
            // 'uri'               => $faker->word,
            // 'status_id'         => getRandomStatus($faker),
            // 'language'          => $faker->word,
            // 'note'              => $faker->text,
            // 'domain'            => $faker->word,
            // 'orange'            => $faker->word,
            // 'is_deprecated'     => $faker->boolean,
            // 'url'               => $faker->url,
            // 'lexical_alias'     => $faker->word,
            // 'hash_id'           => $faker->word,
            // 'created_by' => $creator,
            // 'updated_by' => $updator,
            // 'deleted_by' => $deletor,
        ];
    });

$factory->define(App\Models\ElementAttribute::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'created_user_id'            => $creator,
            // 'updated_user_id'            => $updator,
            // 'deleted_user_id'            => $deletor,
            // 'schema_property_id'         => function() {
            //     return factory(App\Models\Element::class)->create()->id;
            // },
            'profile_property_id'        => getRandomElementProfilePropertyId($faker),
            // 'is_schema_property'         => $faker->boolean,
            // 'object'                     => $faker->text,
            // 'related_schema_property_id' => function() {
            //     return factory(App\Models\ProfileProperty::class)->create()->id;
            // },
            // 'language'                   => $faker->languageCode,
            // 'status_id'                  => getRandomStatus($faker),
            // 'is_generated'               => $faker->boolean,
            // 'created_by' => $creator,
            // 'updated_by' => $updator,
            // 'deleted_by' => $deletor,
        ];
    });

$factory->define(App\Models\ElementAttributeHistory::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();

        return [
            // 'created_user_id'            => $creator,
            // 'action'                     => $faker->word,
            // 'schema_property_element_id' => function() {
            //     return factory(App\Models\ElementAttribute::class)->create()->id;
            // },
            // 'schema_property_id'         => function() {
            //     return factory(App\Models\Element::class)->create()->id;
            // },
            // 'schema_id'                  => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'profile_property_id'        => function() {
            //     return factory(App\Models\ProfileProperty::class)->create()->id;
            // },
            // 'object'                     => $faker->text,
            // 'related_schema_property_id' => function() {
            //     return factory(App\Models\Element::class)->create()->id;
            // },
            // 'language'                   => $faker->languageCode,
            // 'status_id'                  => getRandomStatus($faker),
            // 'change_note'                => $faker->text,
            // 'import_id'                  => function() {
            //     return factory(App\Models\FileImportHistory::class)->create()->id;
            // },
            // 'created_by'                 => $creator,
        ];
    });

$factory->define(App\Models\ElementSet::class,
    function(Faker\Generator $faker) {
        /** @var \App\Models\Project $project */
        // $project = function() {
        //     return factory(App\Models\Project::class)->create();
        // };
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'agent_id'              => $project->id,
            // 'project_id'            => $project->id,
            // 'created_user_id'       => $creator,
            // 'updated_user_id'       => $updator,
            // 'deleted_user_id'       => $deletor,
            // 'child_updated_at'      => $faker->dateTimeBetween(),
            // 'child_updated_user_id' => $faker->randomNumber(),
            'label'                 => $faker->sentence(3),
            // 'name'                  => $faker->name,
            // 'note'                  => $faker->text,
            'uri'                   => $faker->url,
            // 'url'                   => $faker->url,
            // 'base_domain'           => $faker->word,
            // 'token'                 => $faker->word,
            // 'community'             => $faker->word,
            // 'last_uri_id'           => $faker->randomNumber(),
            // 'status_id'             => getRandomStatus($faker),
            // 'language'              => $faker->languageCode,
            // 'profile_id'            => 1,
            // 'ns_type'               => $faker->word,
            // 'prefixes'              => $faker->text,
            // 'languages'             => $faker->text,
            // 'repo'                  => $faker->word,
            // 'spreadsheet'           => $faker->word,
            // 'worksheet'             => $faker->word,
            // 'prefix'                => $faker->word,
            // 'created_by'            => $creator->if,
            // 'updated_by'            => $updator,
            // 'deleted_by'            => $deletor,
        ];
    });

$factory->define(App\Models\ElementSetHasUser::class,
    function(Faker\Generator $faker) {
        return [
            // 'schema_id'         => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'user_id'           => getRandomUser(),
            // 'is_maintainer_for' => $faker->boolean,
            // 'is_registrar_for'  => $faker->boolean,
            // 'is_admin_for'      => $faker->boolean,
            // 'languages'         => $faker->text,
            // 'default_language'  => $faker->word,
            // 'current_language'  => $faker->word,
        ];
    });

$factory->define(App\Models\ElementSetHasVersion::class,
    function(Faker\Generator $faker) {
        return [
            // 'name'            => $faker->name,
            // 'created_user_id' => getRandomUser(),
            // 'schema_id'       => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'timeslice'       => $faker->dateTimeBetween(),
            // 'created_by'      => $faker->randomNumber(),
        ];
    });


$factory->define(App\Models\Export::class,
    function(Faker\Generator $faker) {
        $creator = getRandomUser();

        return [
            'user_id'                    => $creator,
            'vocabulary_id'              => function() {
                return factory(App\Models\Vocabulary::class)->create()->id;
            },
            'schema_id'                  => function() {
                return factory(App\Models\ElementSet::class)->create()->id;
            },
            'exclude_deprecated'         => $faker->boolean,
            'include_generated'          => $faker->boolean,
            'include_deleted'            => $faker->boolean,
            'include_not_accepted'       => $faker->boolean,
            'selected_columns'           => serialize([
                $faker->randomDigit,
                $faker->randomDigit
            ]),
            'selected_language'          => $faker->languageCode,
            'published_english_version'  => $faker->word,
            'published_language_version' => $faker->word,
            'last_vocab_update'          => $faker->dateTimeBetween(),
            'profile_id'                 => 2,
            'exported_by'                => $creator,
            'file'                       => $faker->word,
            'map'                        => serialize([
                $faker->randomDigit,
                $faker->randomDigit
            ]),
        ];
    });

$factory->define(App\Models\ExportHistory::class,
    function(Faker\Generator $faker) {
        return [
            // 'user_id'                    => getRandomUser(),
            // 'vocabulary_id'              => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'schema_id'                  => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'exclude_deprecated'         => $faker->boolean,
            // 'include_generated'          => $faker->boolean,
            // 'include_deleted'            => $faker->boolean,
            // 'include_not_accepted'       => $faker->boolean,
            // 'selected_columns'           => $faker->text,
            // 'selected_language'          => $faker->word,
            // 'published_english_version'  => $faker->word,
            // 'published_language_version' => $faker->word,
            // 'last_vocab_update'          => $faker->dateTimeBetween(),
            // 'profile_id'                 => 2,
            // 'file'                       => $faker->word,
            // 'map'                        => $faker->text,
        ];
    });

$factory->define(App\Models\FileImportHistory::class,
    function(Faker\Generator $faker) {
        return [
            // 'source'                => $faker->word,
            // 'map'                   => $faker->text,
            // 'user_id'               => getRandomUser(),
            // 'vocabulary_id'         => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'schema_id'             => function() {
            //     return factory(App\Models\ElementSet::class)->create()->id;
            // },
            // 'file_name'             => $faker->word,
            // 'source_file_name'      => $faker->word,
            // 'file_type'             => $faker->word,
            // 'batch_id'              => function() {
            //     return factory(App\Models\Batch::class)->create()->id;
            // },
            // 'results'               => $faker->text,
            // 'total_processed_count' => $faker->randomNumber(),
            // 'error_count'           => $faker->randomNumber(),
            // 'success_count'         => $faker->randomNumber(),
            // 'token'                 => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\History\History::class,
    function(Faker\Generator $faker) {
        return [
            'type_id'   => $faker->randomNumber(),
            'user_id'   => getRandomUser(),
            'entity_id' => $faker->randomNumber(),
            'icon'      => $faker->word,
            'class'     => $faker->word,
            'text'      => $faker->word,
            'assets'    => $faker->word,
        ];
    });

$factory->define(App\Models\History\HistoryType::class,
    function(Faker\Generator $faker) {
        return [
            'name' => $faker->name,
        ];
    });

$factory->define(App\Models\Lookup::class,
    function(Faker\Generator $faker) {
        return [
            // 'type_id'       => $faker->randomNumber(),
            // 'short_value'   => $faker->word,
            // 'long_value'    => $faker->word,
            // 'display_order' => $faker->randomNumber(),
        ];
    });


$factory->define(App\Models\Prefix::class,
    function(Faker\Generator $faker) {
        return [
            // 'prefix' => $faker->word,
            // 'uri'    => $faker->word,
            // 'rank'   => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\Profile::class,
    function(Faker\Generator $faker) {

        return [
            // 'created_by'  => getRandomUser(),
            // 'updated_by'  => getRandomUser(),
            // 'deleted_by'  => getRandomUser(),
            // 'child_updated_at' => $faker->dateTimeBetween(),
            // 'child_updated_by' => getRandomUser(),
            // 'name'        => $faker->name,
            // 'note'        => $faker->text,
            // 'uri'         => $faker->word,
            // 'url'         => $faker->url,
            // 'base_domain' => $faker->word,
            // 'token'       => $faker->word,
            // 'community'   => $faker->word,
            // 'last_uri_id' => $faker->randomNumber(),
            // 'status_id'   => getRandomStatus($faker),
            // 'language'    => $faker->languageCode,
        ];
    });

$factory->define(App\Models\ProfileProperty::class,
    function(Faker\Generator $faker) {
        return [
            // 'skos_id'                     => $faker->randomNumber(),
            // 'created_by'                  => getRandomUser(),
            // 'updated_by'                  => getRandomUser(),
            // 'deleted_by'                  => getRandomUser(),
            'profile_id'                  => $faker->randomNumber([
                1,
                2
            ]),
            // 'skos_parent_id'              => $faker->randomNumber(),
            // 'name'                        => $faker->name,
            // 'label'                       => $faker->word,
            // 'definition'                  => $faker->text,
            // 'comment'                     => $faker->text,
            // 'type'                        => $faker->word,
            // 'uri'                         => $faker->word,
            // 'status_id'                   => getRandomStatus($faker),
            // 'language'                    => $faker->languageCode,
            // 'note'                        => $faker->text,
            // 'display_order'               => $faker->randomNumber(),
            // 'export_order'                => $faker->randomNumber(),
            // 'picklist_order'              => $faker->randomNumber(),
            // 'examples'                    => $faker->word,
            // 'is_required'                 => $faker->boolean,
            // 'is_reciprocal'               => $faker->boolean,
            // 'is_singleton'                => $faker->boolean,
            // 'is_in_picklist'              => $faker->boolean,
            // 'is_in_export'                => $faker->boolean,
            // 'inverse_profile_property_id' => $faker->randomNumber(),
            // 'is_in_class_picklist'        => $faker->boolean,
            // 'is_in_property_picklist'     => $faker->boolean,
            // 'is_in_rdf'                   => $faker->boolean,
            // 'is_in_xsd'                   => $faker->boolean,
            // 'is_attribute'                => $faker->boolean,
            // 'has_language'                => $faker->boolean,
            // 'is_object_prop'              => $faker->boolean,
            // 'is_in_form'                  => $faker->boolean,
            // 'namespce'                    => $faker->word,
        ];
    });

$factory->define(App\Models\Project::class,
    function(Faker\Generator $faker) {
        $creator = getRandomUser();
        $updator = getRandomUser();
        $deletor = getRandomUser();

        return [
             'name'                => $faker->sentence(3),
             'label'               => $faker->sentence(3),
             'description'         => $faker->text,
             'is_private'          => $faker->boolean,
             'repo'                => $faker->word,
             'url'                 => $faker->url,
             'license'             => $faker->text,
            'uri_strategy'        => $faker->word,
            'uri_type'            => $faker->word,
            'uri_prepend'         => $faker->word,
            'uri_append'          => $faker->word,
            'created_by'          => $creator,
            'updated_by'          => $updator,
            'deleted_by'          => $deletor,
            'starting_number'     => $faker->randomNumber(),
            'license_uri'         => $faker->word,
             'default_language' => $faker->languageCode(),
             'google_sheet_url'    => $faker->url,
        ];
    });

$factory->define(App\Models\ProjectUser::class,
    function(Faker\Generator $faker) {
        $project = factory(App\Models\Project::class)->create();

        return [
            // 'agent_id'        => $project->id,
            // 'project_id'      => $project->id,
            // 'is_registrar_for' => $faker->boolean,
            // 'is_admin_for'     => $faker->boolean,
        ];
    });

$factory->define(App\Models\RdfNamespace::class,
    function(Faker\Generator $faker) {
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();
        //
        return [
        //     'schema_id'       => function() {
        //         return factory(App\Models\ElementSet::class)->create()->id;
        //     },
        //     'created_user_id' => $creator,
        //     'updated_user_id' => $updator,
        //     'token'           => $faker->word,
        //     'note'            => $faker->text,
        //     'uri'             => $faker->word,
        //     'schema_location' => $faker->word,
        //     'created_by' => $creator,
        //     'updated_by' => $updator,
        //     'deleted_by' => $deletor,
        ];
    });


$factory->define(App\Models\SkosProperty::class,
    function(Faker\Generator $faker) {
        return [
            // 'parent_id'      => $faker->randomNumber(),
            // 'inverse_id'     => $faker->randomNumber(),
            // 'name'           => $faker->name,
            // 'uri'            => $faker->word,
            // 'object_type'    => $faker->word,
            // 'display_order'  => $faker->randomNumber(),
            // 'picklist_order' => $faker->randomNumber(),
            // 'label'          => $faker->word,
            // 'definition'     => $faker->text,
            // 'comment'        => $faker->text,
            // 'examples'       => $faker->word,
            // 'is_required'    => $faker->boolean,
            // 'is_reciprocal'  => $faker->boolean,
            // 'is_singleton'   => $faker->boolean,
            // 'is_scheme'      => $faker->boolean,
            // 'is_in_picklist' => $faker->boolean,
        ];
    });

$factory->define(App\Models\Status::class,
    function(Faker\Generator $faker) {
        return [
            // 'display_order' => $faker->randomNumber(),
            // 'display_name'  => $faker->word,
            // 'uri'           => $faker->word,
        ];
    });

$factory->define(App\Models\System\Session::class,
    function(Faker\Generator $faker) {
        return [
            // 'user_id'       => getRandomUser(),
            // 'ip_address'    => $faker->word,
            // 'user_agent'    => $faker->text,
            // 'payload'       => $faker->text,
            // 'last_activity' => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\Vocabulary::class,
    function(Faker\Generator $faker) {
        // $project = factory(App\Models\Project::class)->create();
        // $creator = getRandomUser();
        // $updator = getRandomUser();
        // $deletor = getRandomUser();

        return [
            // 'agent_id'        => $project->id,
            // 'project_id'      => $project->id,
            // 'last_updated'    => $faker->dateTimeBetween(),
            // 'created_user_id' => $creator,
            // 'updated_user_id' => $updator,
            // 'deleted_user_id' => $deletor,
            // 'name'            => $faker->name,
            // 'note'            => $faker->text,
            // 'uri'             => $faker->word,
            // 'url'             => $faker->url,
            // 'base_domain'     => $faker->word,
            // 'token'           => $faker->word,
            // 'community'       => $faker->word,
            // 'last_uri_id'     => $faker->randomNumber(),
            // 'status_id'       => getRandomStatus($faker),
            // 'language'        => $faker->languageCode,
            // 'languages'       => $faker->text,
            // 'profile_id'      => 2,
            // 'ns_type'         => $faker->word,
            // 'prefixes'        => $faker->text,
            // 'repo'            => $faker->word,
            // 'prefix'          => $faker->word,
            // // 'created_by' => $creator,
            // // 'updated_by' => $updator,
            // // 'deleted_by' => $deletor,
            // 'child_updated_by'      => getRandomUser(),
        ];
    });

$factory->define(App\Models\VocabularyHasUser::class,
    function(Faker\Generator $faker) {
        return [
            // 'vocabulary_id'     => function() {
            //     return factory(App\Models\Vocabulary::class)->create()->id;
            // },
            // 'user_id'           => getRandomUser(),
            // 'is_maintainer_for' => $faker->boolean,
            // 'is_registrar_for'  => $faker->boolean,
            // 'is_admin_for'      => $faker->boolean,
            // 'languages'         => $faker->text,
            // 'default_language'  => $faker->languageCode,
            // 'current_language'  => $faker->languageCode,
        ];
    });


$factory->define(User::class,
    function(Faker\Generator $faker) {
        static $password;
        $name = $faker->unique()->userName;

        return [
            'nickname'          => $name,
            'name'              => $name,
            'email'             => $faker->safeEmail,
            'password'          => $password ?: $password = bcrypt('secret'),
            // 'sha1_password'     => '4d62099656182b62337a7b52535f4f1e1a214542',
            // 'salt'              => 'a4f51ef3ff29a5162c98c684581250de',
            'remember_token'    => str_random(10),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            // 'last_updated'         => $faker->dateTimeBetween(),
            // 'salutation'           => $faker->word,
            'first_name'           => $faker->firstName,
            'last_name'            => $faker->lastName,
            // 'want_to_be_moderator' => $faker->boolean,
            // 'is_moderator'         => $faker->boolean,
            // 'is_administrator'     => $faker->boolean,
            // 'deletions'            => $faker->randomNumber(),
            // 'status'               => $faker->boolean,
            // 'culture'              => $faker->word,
            // 'confirmed'            => $faker->boolean,
        ];
    });

$factory->state(User::class,
    'active',
    function() {
        return [
            'status' => 1,
        ];
    });

$factory->state(User::class,
    'inactive',
    function() {
        return [
            'status' => 0,
        ];
    });

$factory->state(User::class,
    'confirmed',
    function() {
        return [
            'confirmed' => 1,
        ];
    });

$factory->state(User::class,
    'unconfirmed',
    function() {
        return [
            'confirmed' => 0,
        ];
    });

/**
 * Roles
 */
$factory->define(Role::class,
    function(Generator $faker) {
        $name = $faker->name;

        return [
            'name'         => $name,
            'display_name' => $name,
            'all'          => 0,
            'sort'         => $faker->numberBetween(1, 100),
        ];
    });

$factory->state(Role::class,
    'admin',
    function() {
        return [
            'all' => 1,
        ];
    });

$factory->defineAs(User::class,
    'super_admin',
    function(Faker\Generator $faker) use ($factory) {
        $user = $factory->raw(App\Models\Element::class);

        return array_merge($user,
            [
                'is_administrator' => true,
            ]);
    });

//INSERT INTO `swregistry`.`Element` (id, created_at, updated_at, deleted_at, created_user_id, updated_user_id, schema_id, name, label, definition, comment, type, is_subproperty_of, parent_uri, uri, status_id, language, note, domain, orange, is_deprecated, url, lexical_alias, hash_id) VALUES ()
$factory->define(App\Models\Element::class,
    function(Faker\Generator $faker) {
        $userIds   = User::all('id')->pluck('id')->toArray();
        $schemaIds = \App\Models\ElementSet::all('id')->pluck('id')->toArray();
        $statusIds = \App\Models\Status::all('id')->pluck('id')->toArray();
        $user_id   = $faker->randomElement($userIds);

        return [
            'status_id' => 1,
        ];
    });

$factory->defineAs(App\Models\Element::class,
    'ElementFull',
    function(Faker\Generator $faker) use ($factory) {
        $element = $factory->raw(App\Models\Element::class);
        $label   = $faker->sentence(3);
        $uri     = $faker->url;

        return array_merge($element,
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
            ]);
    });

$factory->define(App\Models\Access\Permission\Permission::class,
    function(Faker\Generator $faker) {
        return [
            'name'         => $faker->name,
            'display_name' => $faker->word,
            'sort'         => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\Access\Role\Role::class,
    function(Faker\Generator $faker) {
        return [
            'name'         => $faker->name,
            'display_name' => $faker->word,
            'all'          => $faker->boolean,
            'sort'         => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\Access\User\SocialLogin::class,
    function(Faker\Generator $faker) {
        return [
            'user_id'     => getRandomUser(),
            'provider'    => $faker->word,
            'provider_id' => $faker->word,
            'token'       => $faker->word,
            'avatar'      => $faker->word,
        ];
    });

//******************************************
/** used for testing nils-api */
//******************************************

$factory->define(App\Models\Employees::class,
    function(Faker\Generator $faker) {
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
    });

$factory->define(App\Models\Orders::class,
    function(Faker\Generator $faker) {
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
    });

if ( ! function_exists('getNewUser')) {
    function getNewUser($except = [])
    {
        $userIds = User::all('id')->except($except)->pluck('id')->toArray();
        if ($userIds) {
            $faker = \Faker\Factory::create();;

            return $faker->randomElement($userIds);
        }
        $user = factory(User::class, 1)->create();

        return $user->id;
    }
}

if ( ! function_exists('getAgentUser')) {
    function getAgentUser()
    {
        //get the user_ids not associated with an existing agent
        $except = \App\Models\ProjectUser::all('user_id')->pluck('user_id')->toArray();

        return getNewUser($except);
    }
}

if ( ! function_exists('getAgent')) {
    function getAgent($except = [])
    {
        $ids = \App\Models\Project::all('id')->except($except)->pluck('id')->toArray();
        if ($ids) {
            $faker = \Faker\Factory::create();;

            return $faker->randomElement($ids);
        }
        $agent = factory(App\Models\Project::class, 1)->create();

        return $agent->id;
    }
}

if ( ! function_exists('getRandomStatus')) {
    function getRandomStatus(Faker\Generator $faker)
    {
        return $faker->numberBetween(1, 9);
    }
}
if ( ! function_exists('getRandomUser')) {
    function getRandomUser()
    {
        return factory(App\Models\Access\User\User::class)->create()->id;
    }
}

if ( ! function_exists('getRandomElementProfilePropertyId')) {
    function getRandomElementProfilePropertyId(Faker\Generator $faker)
    {
        $ids = \App\Models\ProfileProperty::whereProfileId(1)->get(['id'])->pluck('id')->toArray();

        return $faker->randomElement($ids);
    }
}

if ( ! function_exists('getRandomConceptProfilePropertyId')) {
    function getRandomConceptProfilePropertyId(Faker\Generator $faker)
    {
        $ids = \App\Models\ProfileProperty::whereProfileId(2)->get([ 'id' ])->pluck('id')->toArray();

        return $faker->randomElement($ids);
    }
}
