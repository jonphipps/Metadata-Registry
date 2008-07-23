<?php

/**
 * schemapropel actions.
 *
 * @package    registry
 * @subpackage schemapropel
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemapropelActions extends autoschemapropelActions
{
  /**
  * extends parent preExecute method
  *
  */
  public function preExecute ()
  {
    $this->schema_property = myActionTools::findCurrentSchemaProperty();

    parent::preExecute();
  }

  /**
  * Set the defaults
  *
  * @param  ConceptProperty $schema_property
  */
  public function setDefaults ($schema_property_element)
  {
    $schemaPropertyId = $this->schema_property->getId();
    $schemaPropertyStatus = $this->schema_property->getStatusID();
    $schemaPropertyLanguage = $this->schema_property->getLanguage();
    $user = $this->getUser()->getSubscriberId();

    $schema_property_element->setSchemaPropertyId($schemaPropertyId);
    $schema_property_element->setStatusId($schemaPropertyStatus);
    $schema_property_element->setLanguage($schemaPropertyLanguage);
    $schema_property_element->setCreatedUserId($user);
    $schema_property_element->setUpdatedUserId($user);

    parent::setDefaults($schema_property_element);
  }

  public function executeList ()
  {
    //a current schema is required to be in the request URL
    myActionTools::requireSchemaPropertyFilter();
    /**
    * @todo at some point this has to check to make sure we've stored the correct profile properties
    **/
    if (!isset($this->requiredProperties))
    {
      $schema = $this->schema_property->getSchema();
      $profile = $schema->getProfile();
      $properties = $profile->getRequiredProperties();
      $required = array();

      foreach ($properties as $value)
      {
        $required[] = $value->getId();
      }

      $this->requiredProperties = $required;
    }

    $this->setFlash('required', $this->requiredProperties);

    parent::executeList();
  }

  public function executeEdit()
  {
    parent::executeEdit();
    /**
    * @todo this is too hardwired. Ultimately it will need to access a property of the profile
    **/
    $this->setFlash('showList', 6 == $this->schema_property_element->getProfilePropertyId());
  }

  public function executeCreate()
  {
    //make sure we have the id in the URL
    myActionTools::requireSchemaPropertyFilter();

    parent::executeCreate();
  }

  protected function saveSchemaPropertyElement($schema_property_element)
  {
    $con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);

    try
    {
      //start a transaction
      $con->begin();

      //save it first
      $affectedRows = $schema_property_element->save($con);

      if ($affectedRows)
      {
        //update the property page
        if ($schema_property_element->getIsSchemaProperty())
        {
          $fieldName = $schema_property_element->getProfileProperty($con)->getName();
          $fields = SchemaPropertyPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
          //get the property page
          $property = $schema_property_element->getSchemaPropertyRelatedBySchemaPropertyId($con);
          $property->setByName($fieldName, $schema_property_element->getObject(), BasePeer::TYPE_FIELDNAME);
          $property->setUpdatedUserId($schema_property_element->getUpdatedUserId());
          if ('is_subproperty_of' == $fieldName)
          {
            $property->setRelatedPropertyId($schema_property_element->getRelatedSchemaPropertyId());
          }

          $property->save($con);
        }
      }

      //commit the transaction
      $con->commit();

      return $affectedRows;
    }
    catch (PropelException $e)
    {
      $con->rollback();
      throw $e;
    }
  } //saveSchemaPropertyElement

  protected function deleteSchemaPropertyElement($schema_property_element)
  {
    $con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
    /**
    * @todo at some point we need to refuse to delete a required field
    **/
    try
    {
      //start a transaction
      $con->begin();

      //update the property page
      if ($schema_property_element->getIsSchemaProperty())
      {
        $fieldName = $schema_property_element->getProfileProperty($con)->getName();
        $fields = SchemaPropertyPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
        //get the property page
        $property = $schema_property_element->getSchemaPropertyRelatedBySchemaPropertyId($con);
        $property->setByName($fieldName, '', BasePeer::TYPE_FIELDNAME);
        $property->setUpdatedUserId($schema_property_element->getUpdatedUserId());
        if ('is_subproperty_of' == $fieldName)
        {
          $property->setRelatedPropertyId(null);
        }

        $property->save($con);
      }

      $schema_property_element->delete();

      //commit the transaction
      $con->commit();

    }
    catch (PropelException $e)
    {
      $con->rollback();
      throw $e;
    }

  }

}
