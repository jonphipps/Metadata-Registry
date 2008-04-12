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
  * override parent save function
  *
  * @return return_type
  * @param  var_type $var
  */
  public function save($con = null)
  {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $this->setUpdatedUserId($userId);

    //if it's a subproperty and there's a related_property_id, but not related_property, we fill in the related propert

    /**
    * @todo $fields needs to come from an application profile for schemas, or the vocabulary
    **/
    $fields = array(
    1 => 'name',
    2 => 'label',
    3 => 'definition',
    4 => 'type',
    5 => 'comment',
    6 => 'related_property',
    7 => 'note');

    //if the property is modified then
    if ($this->isModified())
    {
      //if the property is new then
      if ($this->isNew())
      {
        //set the created user
        $this->setCreatedUserId($userId);
        //create new elements for each part
        foreach ($fields as $id => $field)
        {
          if ($this->getByName($field, BasePeer::TYPE_FIELDNAME))
          {
            $this->createElement($userId, $id, $field);
          }
        }
      }
      else
      {
        //if the language is modified we have to update all of the existing old languages
        //if the status is modified we have to update all of the existing old statuses
        //get all of the existing elements
        $elements = $this->getSchemaPropertyElements();
        foreach ($fields as $id => $field)
        {
          $column = BasePeer::translateFieldname('SchemaProperty',$field, BasePeer::TYPE_FIELDNAME,BasePeer::TYPE_COLNAME);
          //see if they've been updated
          if ($this->isColumnModified($column))
          {
            //find the element
            $foundOne = false;
            foreach ($elements as $element)
            {
              if ($id == $element->getProfilePropertyId())
              {
                $this->updateElement($element, $userId, $id, $field);
                $foundOne = true;
                break;
              }
            }
            if (!$foundOne)
            {
              //we have to create one
              $this->createElement($userId, $id, $field);
            }
          }
        }
      }
    }

    $ret = parent::save($con);

    return;
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
  * create and add an individual element
  *
  * @return return_type
  * @param  var_type $var
  */
  public function createElement($userId, $id, $field)
  {
    $element = new SchemaPropertyElement();
    $element->setCreatedUserId($userId);
    $element->setIsSchemaProperty(true);
    $element->setLanguage($this->getLanguage());
    $element->setStatusId($this->getStatusId());

    $this->updateElement($element, $userId, $id, $field);
    //add it to the property
    $this->addSchemaPropertyElement($element);
  }

  /**
  * update an individual element
  *
  * @return return_type
  * @param  var_type $var
  */
  public function updateElement($element, $userId, $id, $field)
  {
    $element->setUpdatedUserId($userId);
    $element->setObject($this->getByName($field, BasePeer::TYPE_FIELDNAME));
    $element->setProfilePropertyId($id);
    //if this is a subproperty
    if ('subproperty' == $this->getType())
    {
      if ('related_property' == $field )
      {
        $element->setRelatedSchemaPropertyId($this->getRelatedPropertyId());
      }
    }
  }
}
