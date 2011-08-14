<?php

/**
 * schemaprop actions.
 *
 * @package    registry
 * @subpackage schemaprop
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemapropActions extends autoschemapropActions
{
  public function preExecute ()
  {
    $this->getCurrentSchema();
    parent::preExecute();
  }

/**
* Set defaults
*
* @param  SchemaProperty $schemaprop
*/
  public function setDefaults($schemaprop)
  {
    $schemaObj = $this->getCurrentSchema();
    $schemaId = $schemaObj->getId();
    $schemaprop->setSchemaId($schemaId);

    $schemapropParam = $this->getContext()->getRequest()->getParameter('schemaprop');
    if (!$this->getContext()->getRequest()->getErrors() and !isset($schemapropParam['uri']))
    {
      $this->setDefaultUri($schemaprop, $schemaObj);
      $schemaprop->setLabel('');
      //set to the schema defaults
      $schemaprop->setLanguage($schemaObj->getLanguage());
      $schemaprop->setStatusId($schemaObj->getStatusId());
    }

    parent::setDefaults($schemaprop);
  }

  public function setDefaultUri($schemaprop, $schemaObj)
  {
    $schemaDomain = $schemaObj->getUri();
    //URI looks like: agent(base_domain) / schema(token) / schema(next_schemaprop_id) / skos_property_id # schemaprop(next_property_id)
    $trailer = preg_match('%(/|#)$%im', $schemaDomain) ? '' : '/';
    $newURI = $schemaDomain . $trailer;
    //registry base domain is http://metadataregistry.org/uri/
    //schema carries denormalized base_domain from agent

    $schemaprop->setSchemaUri($newURI);
  }

  public function executeEdit()
  {

    /**
    * @todo this is a hack to sidestep issues related to another hack -- subpropertyof and subclass0f must have the same value
    **/
    $schema_property = $this->getRequestParameter('schema_property');

    if ("subclass" == $schema_property['type'])
    {
      $schema_property['is_subproperty_of'] = $schema_property['is_subclass_of'];
    }
    if ("subproperty" == $schema_property['type'])
    {
      $schema_property['is_subclass_of'] = $schema_property['is_subproperty_of'];
    }

    $this->getContext()->getRequest()->setParameter('schema_property', $schema_property);

    parent::executeEdit();
    $schemaObj = $this->getCurrentSchema();
    $schemaprop = $this->schema_property;
    $this->setDefaultUri($schemaprop, $schemaObj);
  }

  public function executeList ()
  {
    //a current schema is required to be in the request URL
    myActionTools::requireSchemaFilter();

    //clear any existing property filters since they don't apply now
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schema_property_history/filters');
    //clear the existing page
    /**
    * @todo clear the existing page only if sort has changed
    **/
    //$this->getUser()->getAttributeHolder()->remove('page', 'sf_admin/schema_property');
    parent::executeList();
  }

  public function executeShowRdf ()
  {
    $ts = strtotime($this->getRequestParameter('ts'));
    $this->timestamp = $ts;
    /** @var SchemaProperty **/
    if (!$this->property)
    {
      $this->property = SchemaPropertyPeer::retrieveByPk($this->getRequestParameter('id'));
    }
    $this->labels = $this->getLabels('show');

    $this->forward404Unless($this->property);
    $this->schema = $this->property->getSchema();
  }

  /**
  * gets the current schema object
  *
  * @return schema current schema object
  */
  public function getCurrentSchema()
  {
    $schema = myActionTools::findCurrentSchema();

    if (!$schema) //we have to do it the hard way
    {
      $this->schemaprop = SchemaPropertyPeer::retrieveByPk($this->getRequestParameter('id'));
      if (isset($this->schemaprop))
      {
        $schema = $this->schemaprop->getSchema();
        if ($schema)
        {
          myActionTools::setLatestSchema($schema);
        }
      }
    }

    $this->forward404Unless($schema,'No Element Set has been selected.');

    $this->schema = $schema;
    $this->schemaID = $schema->getId();

    return $schema;
  }

  public function executeProperties()
  {
    $this->redirect('/schemapropprop/list?schemaprop_id=' . $this->getRequestParameter('id') );
  }

  public function executeGetSchemaPropertyList()
  {
     $schemaId = $this->getRequestParameter('selectedSchemaId');
     $schemapropId = sfContext::getInstance()->getUser()->getAttribute('schemaprop')->getId();
     $results = SchemaPropertyPeer::getSchemaPropertysByVocabID($schemaId, $schemapropId);
     foreach ($results as $myCschemaprop)
     {
        $options[$myCschemaprop->getId()] = $myCschemaprop->getPrefLabel();
     }
     if (!isset($options))
     {
         $options[''] = 'There are no related schemaprops to select';
     }
     $this->schemaprops = $options;
  }

  /**
  * overload schemaSave
  *
  * @return mixed
  * @param  SchemaProperty $schema_property
  */
  protected function saveSchemaProperty($schema_property)
  {
    //if the property is modified then
    if ($schema_property->isModified() || $schema_property->isNew())
    {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $schema_property->setUpdatedUserId($userId);

      //check for changes to subclass/subproperty
      //if property or class then
      if ("class" == $schema_property->getType() or "property" == $schema_property->getType())
      {
        //delete is_subclassof (this also clears subproperty)
        $schema_property->SetIsSubclassOf(null);
        //delete parent_uri
        $schema_property->setParentUri(null);
      }

      if ("class" == $schema_property->getType() or "subclass" == $schema_property->getType())
      {
        //delete domain and range
        $schema_property->setDomain(null);
        $schema_property->setOrange(null);
      }

      $fields = Schema::getProfileFields();
      //add parent_uri to fields
      $fields[] = "parent_uri";

      $con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);

      //did we hand-edit the URI
      if ($schema_property->isColumnModified(SchemaPropertyPeer::PARENT_URI))
      {
        //if we didn't just clear it, null the related IDs
        if (0 != strlen(rtrim($schema_property->getParentUri())))
        {
          $schema_property->SetIsSubclassOf(null);
          $schema_property->setIsSubpropertyOf(null);
        }
      }

      //get the URI for the related property or class
      if ("subclass" == $schema_property->getType())
      {
        $relatedId = $schema_property->getIsSubclassOf();
      }
      if ("subproperty" == $schema_property->getType())
      {
        $relatedId = $schema_property->getIsSubpropertyOf();
      }

      if (isset($relatedId))
      {
        $related = SchemaPropertyPeer::retrieveByPK($relatedId);
        if ($related)
        {
          $relatedUri = $related->getUri();
          $schema_property->setParentUri($related->getUri());
        }
      }

      try
      {
        //start a transaction
        $con->begin();

        //if the property is new then
        if ($schema_property->isNew())
        {
          //set the created user
          $schema_property->setCreatedUserId($userId);

          //save it first
          $affectedRows = $schema_property->save($con);

          if ($affectedRows)
          {
            //create new elements for each part
            foreach ($fields as $id => $field)
            {
              $object = $this->getFieldValue($schema_property, $field);

              if ($object)
              {
                //fix the floating uri problem
                if ('parent_uri' == $field)
                {
                  $key = array_keys($fields, 'is_subproperty_of');
                  $id = count($key) ? $key[0] : null;
                  $field = 'is_subproperty_of';
                }
                //fix the which sub property am I problem
                if ('is_subproperty_of' == $field && 'subclass' == $schema_property->getType())
                {
                  $key = array_keys($fields, 'is_subclass_of');
                  $id = count($key) ? $key[0] : null;
                  $field = 'is_subclass_of';
                }
                $element = SchemaPropertyElementPeer::createElement($schema_property, $userId, $id);
                $element = $this->updateElement($element, $schema_property, $userId, $field, $object, $con);
              }
            }
          }
        }
        else
        {
          //FIXME if the language is modified we have to update all of the existing old languages
          //FIXME if the status is modified we have to update all of the existing old statuses
          //So what really needs to happen is that we leave the language and status blank
          //  and walk up the dependency tree until we find a value:
          //  element language == null
          //    property language = null
          //      schema language == en-us <== this is what we use

          //get all of the existing elements
          $elements =  $schema_property->getSchemaPropertyElementsRelatedBySchemaPropertyId();
          foreach ($fields as $id => $field)
          {
            try
            {
              $column = SchemaPropertyPeer::translateFieldname($field, BasePeer::TYPE_FIELDNAME,BasePeer::TYPE_COLNAME);
            }
            catch (PropelException $e)
            {
              $column = false;
            }

            $object = $this->getFieldValue($schema_property, $field);

            //see if they've been updated
            if ($column && $schema_property->isColumnModified($column))
            {
              //fix the floating uri problem
              if ('parent_uri' == $field)
              {
                $key = array_keys($fields, 'is_subproperty_of');
                $id = count($key) ? $key[0] : null;
                $field = 'is_subproperty_of';
              }
              //fix the which sub property am I problem
              if ('is_subproperty_of' == $field && 'subclass' == $schema_property->getType())
              {
                $key = array_keys($fields, 'is_subclass_of');
                $id = count($key) ? $key[0] : null;
                $field = 'is_subclass_of';
              }
              //find the element
              $foundOne = false;
              foreach ($elements as $element)
              {
                if ($id == $element->getProfilePropertyId())
                {
                  //did we make it null?
                  if (0 === strlen(trim($object)))
                  {
                    //we have to make sure that it's not a subclass or subproperty
                    if (('is_subproperty_of' == $field || 'is_subclass_of' == $field) && $schema_property->getParentUri())
                    {
                      //there's a uri but it doesn't match anything registered
                      //so we have to delete just the reciprocal
                      $element->updateReciprocal('deleted', $con);
                    }
                    else
                    {
                      //delete the element
                      $element->delete($con);
                      $element = false;
                    }
                  }
                  $foundOne = true;
                  break;
                }
              }

              if ($object)
              {
                if (!$foundOne)
                {
                  //we have to create one
                  $element = SchemaPropertyElementPeer::createElement($schema_property, $userId, $id);
                }

                if ($element)
                {
                  $element = $this->updateElement($element, $schema_property, $userId, $field, $object, $con);
                }
              }
            }
          }

          //save it last
          $affectedRows = $schema_property->save($con);

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
    }
  } //saveSchemaProperty

  /**
  * gets the value of a field by name
  *
  * @return mixed
  * @param  SchemaProperty $schema_property
  * @param  string $field name to fetch
  */
  public function getFieldValue(SchemaProperty $schema_property, $field)
  {
    try
    {
      $fieldTest = $schema_property->getByName($field, BasePeer::TYPE_FIELDNAME);
    }
    catch (PropelException $e)
    {
      $fieldTest = false;
    }
    return $fieldTest;
  }

  /**
  * create a new element
  *
  * @return SchemaPropertyElement
  * @param  SchemaPropertyElement $element
  * @param  Connection $con
  */
  public function updateElement(SchemaPropertyElement $element, $schema_property, $userId, $field, $object, $con)
  {
    static $updatedUri;

    if ($element)
    {
      $element->setIsSchemaProperty(true);
      $element->setUpdatedUserId($userId);
      //SchemaPropertyElementPeer::updateElement($schema_property, $element, $userId, $field, $con);

      if ('is_subproperty_of' == $field || 'is_subclass_of' == $field)
      {
        if (!$updatedUri)
        {
          $element->setRelatedSchemaPropertyId($schema_property->getIsSubpropertyOf());
          $object = $schema_property->getParentUri();
          $updatedUri = true;
        }
        Else
        {
          return false;
        }
      }

      $element->setObject($object ? $object : '');

      $element->save($con);

    }

    return $element;
  }
}
