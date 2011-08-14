<?php
/**
 * loadrdf batch script
 *
 * This script is used to update the RDF triplestore as needed
 *
 * @package    registry
 * @subpackage batch
 * @version    $Id$
 */

//optionally set the server name and host name
//host_name will be the server to retrieve the vocabularies from
//server_name will set the correct environment: sandbox or production
//sandbox.metadataregistry.org or metadataregistry.org
if (isset($argv[1]))
{
  $_SERVER['HTTP_HOST'] = $argv[1];
}
if (isset($argv[2]))
{
  $_SERVER['SERVER_NAME'] = $argv[2];
}
//debugbreak();

require_once(dirname(__FILE__).'/../config/arc_config.php');

/* instantiation */
//creates a special registry-extended store, using a custom ARC2::getStore
$store = new Reg_ARC2_Store($arc_config, new stdClass());

if (!$store->isSetup())
	{
    $store->setUp();
	}

//get the batch log
$batchTime = time();
$batchDescription = "Updating 3store - " . $_SERVER['HTTP_HOST'] . ": " . $_SERVER['SERVER_NAME'];

$batchLog = new BatchPeer();

//get the vocabularies
$foo = new VocabularyPeer();
$selectCriteria = new Criteria(VocabularyPeer::DATABASE_NAME);
$rs = $foo->doSelect($selectCriteria);

$batchObjectType = "vocabulary";
$result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, "Starting Vocabulary run", "init");

//foreach vocabulary
/** @var Vocabulary $vocabulary **/
foreach ($rs as $vocabulary)
{
  $query = 'LOAD <http://' . $_SERVER['HTTP_HOST'] . '/vocabulary/show/id/' . $vocabulary->getId(). '.rdf> INTO <' . $vocabulary->getUri() . '>';
  $result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, $query, "query", $vocabulary->getId(), $vocabulary->getUri());
  $store->clearErrors();
  $rs = $store->query($query);
  if ($errs = $store->getErrors())
    {
      foreach ($errs as $key => $value)
      {
        $result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, $value, "error", $vocabulary->getId(), $vocabulary->getUri());
      }
    };
}

$result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, "Finish Vocabulary run", "finish");

//get the element sets
$foo = new SchemaPeer();
$selectCriteria = new Criteria(SchemaPeer::DATABASE_NAME);
$rs = $foo->doSelect($selectCriteria);


$batchObjectType = "schema";
$result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, "Starting Element Set run", "init");

//foreach vocabulary
/** @var Schema $vocabulary **/
foreach ($rs as $vocabulary)
{
  $query = 'LOAD <http://' . $_SERVER['HTTP_HOST'] . '/schema/show/id/' . $vocabulary->getId(). '.rdf> INTO <' . $vocabulary->getUri() . '>';
  $result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, $query, "query", $vocabulary->getId(), $vocabulary->getUri());
  $store->clearErrors();
  $rs = $store->query($query);
  if ($errs = $store->getErrors())
    {
      foreach ($errs as $key => $value)
      {
        $result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, $value, "error", $vocabulary->getId(), $vocabulary->getUri());
      }
    };
}

$result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, "Finish Element Set run", "finish");
$result = $batchLog->createBatchRecord($batchTime, $batchDescription, $batchObjectType, "Stopping", "stop");

exit(0);

?>