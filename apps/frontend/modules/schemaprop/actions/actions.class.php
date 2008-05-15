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
    //$this->getCurrentSchema();
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
      $schemaDomain = $schemaObj->getBaseDomain();
      $schemaToken = $schemaObj->getToken();
      //URI looks like: agent(base_domain) / schema(token) / schema(next_schemaprop_id) / skos_property_id # schemaprop(next_property_id)
      $vSlash = preg_match('@(/$)@i', $schemaDomain) ? '' : '/';
      $tSlash = preg_match('@(/$)@i', $schemaToken ) ? '' : '/';
      $newURI = $schemaDomain . $vSlash . $schemaToken . $tSlash;
      //registry base domain is http://metadataregistry.org/uri/
      //next_schemaprop_id is always initialized to 100000, allowing for 999,999 schemaprops
      //schema carries denormalized base_domain from agent

      $schemaprop->setSchemaUri($newURI);
      $schemaprop->setLabel('');
      //set to the schema defaults
      $schemaprop->setLanguage($schemaObj->getLanguage());
      $schemaprop->setStatusId($schemaObj->getStatusId());
    }

    parent::setDefaults($schemaprop);
  }

  public function executeList ()
  {
    //a current schema is required to be in the request URL
    myActionTools::requireSchemaFilter();

    //clear any existing property filters since they don't apply now
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schemapprop/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/schemapprop_history/filters');
    parent::executeList();
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
      }
    }

    $this->forward404Unless($schema,'No schema has been selected.');

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

  protected function saveSchemaProperty($schema_property)
  {
    //if the property is modified then
    if ($schema_property->isModified() || $schema_property->isNew())
    {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $schema_property->setUpdatedUserId($userId);

      $fields = Schema::getProfileFields();
      $con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);

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
              $fieldTest = $this->getFieldValue($schema_property, $field);

              if ($fieldTest)
              {
                $object = $this->getFieldValue($schema_property, $field);
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
              //find the element
              $foundOne = false;
              foreach ($elements as $element)
              {
                if ($id == $element->getProfilePropertyId())
                {
                  //did we make it null?
                  if (0 === strlen(trim($object)))
                  {
                    //delete the element
                    $element->delete($con);
                    $element = false;
                  }
                  $foundOne = true;
                  break;
                }
              }

              if (!$foundOne)
              {
                //we have to create one
                $element = SchemaPropertyElementPeer::createElement($schema_property, $userId, $id);
              }

              $element = $this->updateElement($element, $schema_property, $userId, $field, $object, $con);

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
    if ($element)
    {
      $element->setIsSchemaProperty(true);
      $element->setUpdatedUserId($userId);
      //SchemaPropertyElementPeer::updateElement($schema_property, $element, $userId, $field, $con);

      if ('is_subproperty_of' == $field)
      {
        $element->setRelatedSchemaPropertyId($schema_property->getIsSubpropertyOf());
        $element->setObject('');
      }
      else
      {
        $element->setObject($object ? $object : '');
      }

      $element->save($con);
    }

    return $element;
  }
}
