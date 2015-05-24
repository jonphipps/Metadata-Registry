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

    public function perform($args)
    {
        //todo: this part really should be in a _bootstrapDbJob include
        list($schemaId, $importId, $userId, $environment) = $args;
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

        //todo: better error handling and logging
        if ($schemaId) {
            self::processSchema($schemaId, $userId);
        } else {
            //schemaId is not set, so process all of the schemas
            // (we could just process al of the elements, but that would take too much memory)
            $c = new \Criteria();
            $schemas = \SchemaPeer::doSelect($c);
            /** @var \Schema $schema */
            foreach ($schemas as $schema) {
                self::processSchema($schema->getId(), $userId);
            }
        }
    }

    private static function processSchema($schemaId, $userId = null)
    {
        $c = new \Criteria();
        $c->add(\SchemaPropertyPeer::SCHEMA_ID, $schemaId);
        $properties = \SchemaPropertyPeer::doSelect($c);
        /** @var \SchemaProperty $property */
        foreach ($properties as $property) {
            if ( ! $userId) {
                $userId = $property->getUpdatedUserId();
            }
            $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyId();
            /** @var \SchemaPropertyElement $element */
            foreach ($elements as $element) {
                $element->updateReciprocal('updated', $userId, $schemaId);
            }
        }
        unset($properties);
    }

    public function tearDown()
    {
        // Remove environment for this job
    }
}
