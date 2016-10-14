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


  public static function getLastExportForUser($userId, $profileId)
  {
    $c=new Criteria();
    $c->add(ExportHistoryPeer::USER_ID, $userId);
    $c->add(ExportHistoryPeer::PROFILE_ID, $profileId);
    $c->addDescendingOrderByColumn(ExportHistoryPeer::CREATED_AT);

    return self::doSelectOne($c);

  }
}
