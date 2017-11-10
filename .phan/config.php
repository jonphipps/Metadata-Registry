<?php

use \Phan\Config;

/**
 * This configuration will be read and overlaid on top of the
 * default configuration. Command line arguments will be applied
 * after this file is read.
 */
return [

    // A list of directories that should be parsed for class and
    // method information. After excluding the directories
    // defined in exclude_analysis_directory_list, the remaining
    // files will be statically analyzed for errors.
    //
    // Thus, both first-party and third-party code being used by
    // your application should be included in this list.
    'directory_list'                  => [
        'app',
        'apps',
        'cache/frontend/prod',
        'lib',
        'plugins/jpAdminGeneratorPlugin',
        'resources',
        'routes',
        'vendor',
    ],
    // A regular expression to match files to be excluded
    // from parsing and analysis and will not be read at all.
    //
    // This is useful for excluding groups of test or example
    // directories/files, unanalyzable files, or files that
    // can't be removed for whatever reason.
    // (e.g. '@Test\.php$@', or '@vendor/.*/(tests|Tests)/@')
    'exclude_file_regex' => '@^vendor/.*/(tests|Tests)/@',

    // A file list that defines files that will be excluded
    // from parsing and analysis and will not be read at all.
    //
    // This is useful for excluding hopelessly unanalyzable
    // files that can't be removed for whatever reason.
    'exclude_file_list'  => [
        'apps/frontend/lib/Reg_ARC2_Store.php',
        'lib/symfony/addon/bridge/sfZendFrameworkBridge.class.php',
        'lib/symfony/cache/sfProcessCache.class.php',
        'lib/symfony/config/vendor/composer/autoload_real.php',
        'lib/symfony/controller/sfController.class.php',
        'lib/symfony/exception/sfStopException.class.php',
        'lib/symfony/log/sfLogger/sfWebDebugLogger.class.php',
        'lib/symfony/util/sfYaml.class.php',
        'lib/symfony/vendor/pake/pakeYaml.class.php',
        'lib/symfony/vendor/propel-generator/classes/propel/engine/database/model/Table.php',
        'plugins/jpAdminGeneratorPlugin/lib/spec/ImportVocab/ExportVocabSpec.php',
    ],

    // A directory list that defines files that will be excluded
    // from static analysis, but whose class and method
    // information should be included.
    //
    // Generally, you'll want to include the directories for
    // third-party code (such as "vendor/") in this list.
    //
    // n.b.: If you'd like to parse but not analyze 3rd
    //       party code, directories containing that code
    //       should be added to both the `directory_list`
    //       and `exclude_analysis_directory_list` arrays.
    'exclude_analysis_directory_list' => [
        'apps/frontend/modules/administrator/',
        'apps/frontend/modules/agent',
        'apps/frontend/modules/agentuser',
        'apps/frontend/modules/discuss',
        'apps/frontend/modules/moderator',
        'apps/frontend/modules/profile',
        'apps/frontend/modules/profileprop',
        'apps/frontend/modules/schemaversion',
        'apps/frontend/modules/user',
        'lib/symfony/config/vendor/kint-php/',
        'lib/symfony/vendor/creole/drivers',
        'lib/symfony/vendor/phing/',
        'lib/symfony/vendor/propel-generator/',
        'plugins/jpAdminGeneratorPlugin/data/generator/sfPropelAdmin/default/skeleton',
        'plugins/jpAdminGeneratorPlugin/data/generator/sfPropelCrud/default/skeleton',
        'plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/',
        'plugins/jpAdminGeneratorPlugin/lib/vendor/propel-generator/classes/propel/engine/builder/',
        'vendor/',
    ],
    // If true, missing properties will be created when
    // they are first seen. If false, we'll report an
    // error message.
    'allow_missing_properties'      => true,

    // Allow null to be cast as any type and for any
    // type to be cast to null.
    'null_casts_as_any_type'        => true,

    // If true, seemingly undeclared variables in the global
    // scope will be ignored. This is useful for projects
    // with complicated cross-file globals that you have no
    // hope of fixing.
    'ignore_undeclared_variables_in_global_scope' => true,

    // Backwards Compatibility Checking
    'backward_compatibility_checks' => true,

    // Run a quick version of checks that takes less
    // time
    'quick_mode'                    => true,

    // Only emit critical issues
    'minimum_severity'              => 10,

    // A set of fully qualified class-names for which
    // a call to parent::__construct() is required
    'parent_constructor_required'   => [],

    // Add any issue types (such as 'PhanUndeclaredMethod')
    // here to inhibit them from being reported
    'suppress_issue_types' => [
        'PhanPluginMixedKeyNoKey',  // FunctionSignatureMap.php has many of these, intentionally.
        // 'PhanUndeclaredFunction',
        'PhanUndeclaredClassMethod',
        'PhanUndeclaredClassConstant',
        // 'PhanUndeclaredClass',
        // 'PhanUndeclaredTrait',
        // 'PhanUndeclaredClassInstanceof',
        // 'PhanUndeclaredExtendedClass',
        // 'PhanUndeclaredClassCatch',
        // 'PhanUndeclaredInterface',
        // 'PhanNonClassMethodCall',
    ],

];
