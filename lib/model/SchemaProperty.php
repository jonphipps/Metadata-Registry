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
  /**
   * The value for the base schema uri field.
   * @var        string
   */
  protected $schemaUri = '';

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

  /**
  * clear the properties of the stored schema
  *
  * @return return_type
  * @param  var_type $var
  */
  public function save($con = null)
  {
    $affectedRows = parent::save($con);

    $schema = sfContext::getInstance()->getUser()->getCurrentSchema();
    if ($schema)
    {
      /** @var Schema **/
      $schema->clearProperties();
      $schema->getSchemaPropertys();
    }

    return $affectedRows;
  }

  /**
  * get the base schema uri
  *
  * @return string The uri of the schema
  */
  public function getSchemaUri()
  {
    return $this->schemaUri;
  }

  /**
  * set the property base schema uri
  *
  * @return string The uri of the schema
  */
  public function setSchemaUri($v)
  {
    // Since the native PHP type for this column is string,
    // we will cast the input to a string (if it is not).
    if ($v !== null && !is_string($v)) {
      $v = (string) $v;
    }

    if ($this->schemaUri !== $v || $v === '') {
      $this->schemaUri = $v;
    }
  }

}
