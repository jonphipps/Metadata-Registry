<?php

/**
 * Subclass for representing a row from the 'reg_schema_property_element' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElement extends BaseSchemaPropertyElement
{
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function save($con = null)
  {
    if ($this->isModified())
    {
      if ($this->isNew())
      {
        $action = 'added';
      }
      //this is untested since we don't allow this kind of delete
      elseif ($this->isDeleted())
      {
        $action = 'force_deleted';
      }
      else
      {
        $action = 'updated';
      }

      //do the history
      $history = new SchemaPropertyElementHistory();

      if ($action == 'updated' && $this->getDeletedAt())
      {
        $action = 'deleted';
      }

      $history->setAction($action);
      $history->setProfilePropertyId($this->getProfilePropertyId());
      $history->setSchemaId($this->getSchemaProperty()->getSchemaId());
      $history->setSchemaPropertyId($this->getSchemaPropertyId());
      $history->setRelatedSchemaPropertyId($this->getRelatedSchemaPropertyId());
      $history->setObject($this->getObject());
      $history->setLanguage($this->getLanguage());
      $history->setStatusId($this->getStatusId());
      $history->setCreatedUserId($this->getUpdatedUserId());
      $history->setCreatedAt($this->getUpdatedAt());

      $this->addSchemaPropertyElementHistory($history);

      //continue with save
      parent::save();
    }
  }
}
