<?php

/**
 * Subclass for performing query and update operations on the 'reg_status' table.
 *
 * 
 *
 * @package lib.model
 */ 
class StatusPeer extends BaseStatusPeer
{

  /**
   * @return array
   * @throws PropelException
   */
  public static function getStatusForSelect()
  {
    $statuses = [];
    $c        = new Criteria();
    /** @var Status[] $results */
    $results = self::doSelect($c);
    foreach ($results as $value) {
      $statuses[$value->getId()] = $value->getDisplayName();
    }

    return $statuses;
  }
} // StatusPeer
