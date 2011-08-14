<?php

/**
 * Subclass for performing query and update operations on the 'reg_batch' table.
 *
 *
 *
 * @package lib.model
 */
class BatchPeer extends BaseBatchPeer
{
  /**
  * creates a new Batch log record
  *
  * @return return_type
  * @param  var_type $var
  */
  public function createBatchRecord($batchTime, $batchDescription, $objectType, $eventDescription, $eventType, $objectId = null, $registryURI = '')
  {
    $batchRecord = new Batch();
    $batchRecord->setRunTime($batchTime);
    $batchRecord->setRunDescription($batchDescription);
    $batchRecord->setObjectType($objectType);
    $batchRecord->setObjectId($objectId);
    $batchRecord->setEventTime(time());
    $batchRecord->setEventDescription($eventDescription);
    $batchRecord->setEventType($eventType);
    $batchRecord->setRegistryUri($registryURI);

    return $batchRecord->save();

  }

}
