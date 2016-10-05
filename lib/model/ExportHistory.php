<?php

/**
 * Subclass for representing a row from the 'reg_export_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExportHistory extends BaseExportHistory
{

  private  $SaveAsDefault;

  /**
   * @return array
   * @throws PropelException
   */
    public function getLanguagesNoDefault()
    {
        if ($this->getSchemaId()) {
            return $this->getSchema()->getLanguagesNoDefault();
        }
        if ($this->getVocabularyId()) {
            return $this->getVocabulary()->getLanguagesNoDefault();
        }

        return [];

    }


  /**
   * @return mixed
   */
  public function getSaveAsDefault()
  {
    return $this->SaveAsDefault;
  }


  /**
   * @param mixed $SaveAsDefault
   */
  public function setSaveAsDefault($SaveAsDefault)
  {
    $this->SaveAsDefault = $SaveAsDefault;
  }


  /**
   * @return array
   */
  public function getSelectedColumns()
  {
    return unserialize(parent::getSelectedColumns());
  }


  /**
   * @param array $v
   */
  public function setSelectedColumns($v)
  {
    parent::setSelectedColumns(serialize($v));
  }


  public function getSelectedColumnsToString()
  {
    $columnString = '';
    $columns = $this->getSelectedColumns();
    if ($columns) {
      foreach ($columns as $column) {
        $profileProperty = ProfilePropertyPeer::retrieveByPK($column);
        if ($profileProperty) {
          $columnString .= $profileProperty->getLabel() . ", ";
        }
      }
      $columnString = rtrim($columnString,", ");
    }
    return $columnString;
  }


  public function getCsvTypeToString()
  {
    return ExportHistoryPeer::$CSV_TYPES[$this->getCsvType()];
  }
}
