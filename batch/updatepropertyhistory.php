<?php

/**
 * updatedb batch script
 *
 * This script is used to update the database data as needed
 *
 * @package    registry
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here

//get the concept properties
$foo = new ConceptPropertyPeer();
$selectCriteria = new Criteria(VocabularyPeer::DATABASE_NAME);
$rs = $foo->doSelect($selectCriteria);
foreach ($rs as $conceptProperty)
{
/** @var ConceptProperty **/
$historys = $conceptProperty->getConceptPropertyHistorys();
  if (count($historys) == 0)
  {
    debugbreak;
  }
}


echo("Done!");