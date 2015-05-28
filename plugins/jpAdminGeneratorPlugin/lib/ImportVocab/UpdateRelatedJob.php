<?php
/**
 * Created by jonphipps, on 2015-05-22 at 5:48 PM
 * for the registry.dev project
 */

namespace ImportVocab;

class UpdateRelatedJob
{
    public function setUp()
    {
        set_time_limit(0);
    }

    /**
     * @param $args
     *
     * @throws \PropelException
     */
    public function perform($args)
    {
        list($environment) = $args;

        //todo: this part really should be in a _bootstrapDbJob include
        // Set up environment for this job
        define('SF_ROOT_DIR', realpath(dirname(__file__) . '/../../../..'));
        define('SF_APP', 'frontend');
        define('SF_ENVIRONMENT', $environment);
        define('SF_DEBUG', false);

//initialize composer
        require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
// initialize symfony
        require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR
                     . 'config' . DIRECTORY_SEPARATOR . 'config.php');
// initialize database manager
        $databaseManager = new \sfDatabaseManager();
        $databaseManager->initialize();
        $connection = \Propel::getConnection();

        //todo: this should be setup to run on a cron

        //update lexical aliases

        $query = <<<SQL
update reg_schema_property_element
set related_schema_property_id = schema_property_id
WHERE profile_property_id = 27
and related_schema_property_id is NULL
SQL;
        $statement = $connection->prepareStatement($query);
        $affectedRows = $statement->executeUpdate();
        echo $affectedRows;

        //update all of the related_schema_property_id

        $query = <<<SQL
update reg_schema_property_element as e, reg_schema_property as p
set e.related_schema_property_id = p.id
WHERE e.object = p.uri
and (e.related_schema_property_id <> p.id or e.related_schema_property_id is NULL)
SQL;
        $statement = $connection->prepareStatement($query);
        $affectedRows = $statement->executeUpdate();
        echo $affectedRows;
    }

    public function tearDown()
    {
        // Remove environment for this job
    }
}
