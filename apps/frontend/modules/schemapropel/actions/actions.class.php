<?php

  /**
 * schemapropel actions.
 *
 * @property SchemaProperty schema_property
   *
 * @package    registry
 * @subpackage schemapropel
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemapropelActions extends autoSchemapropelActions
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
     * @param SchemaPropertyElement $schema_property_element
     *
     * @throws PropelException
     */
  public function setDefaults($schema_property_element)
  {
    $schemaObj = $this->schema_property->getSchema();
    $language  = sfContext::getInstance()->getUser()->getCulture();
    $userId    = sfContext::getInstance()->getUser()->getSubscriberId();

      if ($userId && $this->getActionName() === 'edit') {
        $schemaUser    = $schemaObj->GetUserForSchema($userId);
        $UserLanguages = is_object($schemaUser) ? $schemaUser->getLanguages() : ['en'];
        $this->getUser()->setAttribute('languages', $UserLanguages);

        if (! in_array($language, $UserLanguages)) {
          $language = $schemaUser->getDefaultLanguage();
          //save the current culture
          $UserCulture = sfContext::getInstance()->getUser()->getCulture();
          $this->getUser()->setAttribute('UserCulture', $UserCulture);
        }

        $this->getUser()->setAttribute('CurrentLanguage', $language);
      }
      $schemaPropertyStatus = $this->schema_property->getStatusId();
      $schema_property_element->setStatusId($schemaPropertyStatus);

    parent::setDefaults($schema_property_element);

    $schemaPropertyId     = $this->schema_property->getId();
    $schema_property_element->setSchemaPropertyId($schemaPropertyId);

    $schema_property_element->setCreatedUserId($userId);
    $schema_property_element->setUpdatedUserId($userId);
  }

    /**
     * @throws PropelException
     */
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

      /** @var ProfileProperty $value */
      foreach ($properties as $value)
      {
        $required[] = $value->getId();
      }

      $this->requiredProperties = $required;
    }

    $this->setFlash('required', $this->requiredProperties);

    if (!isset($this->noEditProperties))
    {
      $noedit = array();
      $schema = $this->schema_property->getSchema();
      $profile = $schema->getProfile();
      $properties = $profile->getNoEditProperties();

      foreach ($properties as $value)
      {
        $noedit[] = $value->getId();
      }

      $this->noEditProperties = $noedit;
    }

    $this->setFlash('noedit', $this->noEditProperties);

    parent::executeList();
  }

  public function executeEdit()
  {
    parent::executeEdit();
    /**
    * @todo this is too hardwired. Ultimately it will need to access a property of the profile
    **/
    $this->setFlash('showList', $this->schema_property_element->getProfilePropertyId() == 6 || $this->schema_property_element->getProfilePropertyId() == 9);
  }

  public function executeCreate()
  {
    //make sure we have the id in the URL
    myActionTools::requireSchemaPropertyFilter();

    parent::executeCreate();
  }

    /**
     * overrides the parent updateSchemaPropertyElementFromRequest function
     */
    protected function updateSchemaPropertyElementFromRequest()
    {
        $schema_property_element = $this->getRequestParameter('schema_property_element');

        if ( ! empty($schema_property_element['related_schema_class_id']) && $schema_property_element['related_schema_class_id']) {
            $schema_property_element['related_schema_property_id'] = $schema_property_element['related_schema_class_id'];
        }
        unset($schema_property_element['related_schema_class_id']);

        //if element profile does not have language set language to empty
        $profile = ProfilePropertyPeer::retrieveByPK($schema_property_element['profile_property_id']);
        if (!$profile->getHasLanguage()) {
            $schema_property_element['language'] ='';
        }
        //lookup uri and set the id if found
        if (empty($schema_property_element['related_schema_property_id']) && ! empty($schema_property_element['object'])) {
            $property = SchemaPropertyPeer::retrieveByUri($schema_property_element['object']);
            if ($property) {
                $schema_property_element['related_schema_property_id'] = $property->getId();
            }
        }
        if (!empty($schema_property_element['related_schema_property_id']) && empty($schema_property_element['object'])) {
            $property = SchemaPropertyPeer::retrieveByPK($schema_property_element['related_schema_property_id']);
            if ($property) {
                $schema_property_element['object'] = $property->getUri();
            }
        }

        $this->getRequest()->setParameter('schema_property_element', $schema_property_element);

        parent::updateSchemaPropertyElementFromRequest();
    }

    /**
     * @param $schema_property_element
     *
     * @return integer
     * @throws PropelException
     */
    protected function saveSchemaPropertyElement($schema_property_element)
  {
    try
    {
      $con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
      //start a transaction
      $con->begin();

      //save it first
      $affectedRows = $schema_property_element->save($con);

      if ($affectedRows && $schema_property_element->getIsSchemaProperty()) {
        $fieldName = sfInflector::underscore($schema_property_element->getProfileProperty($con)->getName());
        //$fields = SchemaPropertyPeer::getFieldNames(BasePeer::TYPE_FIELDNAME);
        //get the property page
        $property = $schema_property_element->getSchemaPropertyRelatedBySchemaPropertyId($con);
        $property->setByName($fieldName, $schema_property_element->getObject(), BasePeer::TYPE_FIELDNAME);
        $property->setUpdatedUserId($schema_property_element->getUpdatedUserId());
        if ('is_subproperty_of' === $fieldName)
        {
          $property->setIsSubpropertyOf($schema_property_element->getRelatedSchemaPropertyId());
        }

        $property->save($con);
      }

      //commit the transaction
      $con->commit();

      return $affectedRows;
    }
    catch (PropelException $e)
    {
        if (null !== $con) {
            $con->rollback();
        }
        throw $e;
    }
  } //saveSchemaPropertyElement

    /**
     * @param $schema_property_element
     *
     * @throws PropelException
     */
    protected function deleteSchemaPropertyElement($schema_property_element)
  {
    /**
    * @todo at some point we need to refuse to delete a required field
    **/
    try
    {
      $con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
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
        if ('is_subproperty_of' === $fieldName)
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
        if (null !== $con) {
            $con->rollback();
        }
        throw $e;
    }

  }

}
