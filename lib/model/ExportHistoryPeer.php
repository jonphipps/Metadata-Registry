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
