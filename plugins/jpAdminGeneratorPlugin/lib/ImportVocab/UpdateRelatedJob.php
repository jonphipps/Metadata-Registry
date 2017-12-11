<?php
/**
 * Created by jonphipps, on 2015-05-22 at 5:48 PM
 * for the registry.test project
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
        list($environment, $importId) = $args;

        if ( ! defined('SF_ENVIRONMENT')) {
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
        }

        $connection = \Propel::getConnection();

        //todo: this should be setup to run on a cron

        //update the reciprocals and inverse
        if ($importId) {
            $c = new \Criteria();
            $c->add(\SchemaPropertyElementHistoryPeer::IMPORT_ID, $importId);
            $historyList = \SchemaPropertyElementHistoryPeer::doSelect($c);
            /** @var \SchemaPropertyElementHistory $history */
            foreach ($historyList as $history) {
                $element = $history->getSchemaPropertyElement();
                if ($element) {
                    //don't generate reciprocals for generated elements
                    if (!$element->getIsGenerated()) {
                        $element->importId = $importId;
                        $element->updateReciprocal($history->getAction(), $history->getCreatedUserId(),
                              $history->getSchemaId());
                    }
                }
            }
        }

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

        //update all of the property parent_id

        $query = <<<SQL
UPDATE reg_schema_property as propa, reg_schema_property as propb
set propa.is_subproperty_of = propb.id
where propa.parent_uri is not NULL
and propa.is_subproperty_of is NULL
and propa.parent_uri = propb.uri;
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
