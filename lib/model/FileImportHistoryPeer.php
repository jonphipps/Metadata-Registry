<?php

/**
 * Subclass for performing query and update operations on the 'reg_file_import_history' table.
 *
 *
 *
 * @package lib.model
 */
class FileImportHistoryPeer extends BaseFileImportHistoryPeer
{
    /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function  retrieveByLastFilePath($filePath)
  {
    $criteria = new Criteria();
    $criteria->add(self::FILE_NAME, $filePath);
    $criteria->addDescendingOrderByColumn(self::CREATED_AT);

    return self::doSelectOne($criteria);

  }

}
