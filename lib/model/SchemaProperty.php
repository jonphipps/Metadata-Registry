<?php

/**
 * Subclass for representing a row from the 'reg_schema_property' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaProperty extends BaseSchemaProperty
{
  public function __toString()
  {
    return $this->getLabel();
  }

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    return $this->getUserRelatedByCreatedUserId();

  } // getCreatedUser

  /**
  * Gets the updated_by_user
  *
  * @return User
  */
  public function getUpdatedUser()
  {
    return $this->getUserRelatedByUpdatedUserId();

  } // getUpdatedUser

  /**
  * gets the parent property
  *
  * @return SchemaProperty
  */
  public function getParentProperty()
  {
    return $this->getSchemaPropertyRelatedByIsSubpropertyOf();
  }
}
