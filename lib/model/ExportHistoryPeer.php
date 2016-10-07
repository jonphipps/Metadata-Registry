<?php

/**
 * Subclass for performing query and update operations on the 'reg_export_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExportHistoryPeer extends BaseExportHistoryPeer
{

  public static $CSV_TYPES = [
      2 => 'Populated import template',
      1 => 'Empty import template',
      3 => 'Sparse (just the populated attribute columns)',
      4 => 'Full (includes empty attribute columns)',
  ];

    public static function getProfileColumns()
    {
        $request = sfContext::getInstance()->getRequest();
        if ($request->getParameter('schema_id')) {
            $profileId = 1;
        }
        if ($request->getParameter('vocabulary_id')) {
            $profileId = 2;
        }
        return ProfilePropertyPeer::getProfilePropertiesForExport($profileId);
    }


  public static function getOptionsforCsvType()
  {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $select_options = self::$CSV_TYPES;

    //non-members don't get to have nice things
    if (!$userId) {
      unset( $select_options[1] );
      unset( $select_options[2] );
    }

    return $select_options;

  }


  public static function getLastExportForUser($userId)
  {
    $c=new Criteria();
    $c->add(ExportHistoryPeer::USER_ID, $userId);
    $c->addDescendingOrderByColumn(ExportHistoryPeer::CREATED_AT);

    return self::doSelectOne($c);

  }
}
