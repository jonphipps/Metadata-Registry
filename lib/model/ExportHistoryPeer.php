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
            $profile = 1;
        }
        if ($request->getParameter('vocabulary_id')) {
            $profile = 2;
        }
        ProfilePropertyPeer::getProfilePropertiesForCreate();
    }
}
