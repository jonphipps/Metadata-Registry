<?php

  /**
   * Subclass for representing a row from the 'reg_schema_property' table.
   *
   *
   *
   * @package lib.model
   */
  class SchemaProperty extends BaseSchemaProperty {
    public function hydrate(ResultSet $rs, $startcol = 1) {
      $this->setCulture(sfContext::getInstance()->getUser()->getCulture());

      return parent::hydrate($rs, $startcol);
    }

    public function getCurrentLanguage() {
      $c = new sfCultureInfo(sfContext::getInstance()->getUser()->getCulture());

      return $c->getNativeName();
    }

    /**
     * @return array
     */
    public function getLanguagesForSchema() {
      return $this->getSchema()->getLanguages();
    }

    /**
     * @return array
     */
    public function getLanguagesForUser() {
      $schemaUser = $this->getSchemaForUser();

      return $schemaUser->getLanguages();
    }

    /**
     * @return string
     */
    public function getUserLanguage() {
      $language   = '';
      $schemaUser = $this->getSchemaForUser();
      if ($schemaUser) {
        $language = $schemaUser->getDefaultLanguage();
      }
      if (!$language) {
        $language = sfContext::getInstance()->getUser()->getCulture();
      }

      return $language;
    }

    /**
     * @return SchemaHasUser
     */
    public function getSchemaForUser() {
      $schemaId = $this->getSchemaId();
      $userId   = sfContext::getInstance()->getUser()->getSubscriberId();
      $c        = new Criteria();
      $c->add(SchemaHasUserPeer::SCHEMA_ID, $schemaId);
      $c->add(SchemaHasUserPeer::USER_ID, $userId);

      return SchemaHasUserPeer::doSelectOne($c);
    }

    /**
     * The value for the base schema uri field.
     *
     * @var        string
     */
    protected $schemaUri = '';

    public function __toString() {
      return (string) $this->getLabel();
    }

    /**
     * Gets the created_by_user
     *
     * @return User
     */
    public function getCreatedUser() {
      return $this->getUserRelatedByCreatedUserId();
    } // getCreatedUser

    /**
     * Gets the updated_by_user
     *
     * @return User
     */
    public function getUpdatedUser() {
      return $this->getUserRelatedByUpdatedUserId();
    } // getUpdatedUser

    /**
     * gets the parent property
     *
     * @return SchemaProperty
     */
    public function getParentProperty() {
      return $this->getSchemaPropertyRelatedByIsSubpropertyOf();
    }

    /**
     * clear the properties of the stored schema
     *
     * @return integer
     *
     * @param \Connection $con [optional]
     *
     */
    public function save($con = NULL) {
      $affectedRows = parent::save($con);

      $schema = sfContext::getInstance()->getUser()->getCurrentSchema();
      if ($schema) {
        /** @var Schema * */
        $schema->clearProperties();
        $schema->getSchemaPropertys();
      }

      return $affectedRows;
    }

    public function getMyType() {
      return $this->getType();
    }

    /**
     * get the base schema uri
     *
     * @return string The uri of the schema
     */
    public function getSchemaUri() {
      return $this->schemaUri;
    }

    /**
     * set the property base schema uri
     *
     * @param string $v
     *
     * @return string The uri of the schema
     */
    public function setSchemaUri($v) {
      // Since the native PHP type for this column is string,
      // we will cast the input to a string (if it is not).
      if ($v !== NULL && !is_string($v)) {
        $v = (string) $v;
      }

      if ($this->schemaUri !== $v || $v === '') {
        $this->schemaUri = $v;
      }
    }

    /**
     * Gets the subclass id
     *
     * @return string
     */
    public function getIsSubclassOf() {
      return $this->getIsSubpropertyOf();
    }

    /**
     * Sets the subclass id
     *
     * @param      string $v new value
     *
     * @return     void
     */
    public function SetIsSubclassOf($v) {
      $this->setIsSubpropertyOf($v);
    }

    /**
     * Overrides setting the value of [is_subproperty_of] column.
     *
     * @param      int $v new value
     *
     * @return     void
     */
    public function setIsSubpropertyOf($v) {

      // Since the native PHP type for this column is integer,
      // we will cast the input value to an int (if it is not).
      if ($v !== NULL && !is_int($v) && is_numeric($v)) {
        $v = (int) $v;
      }

      $v = (0 == $v) ? NULL : $v;

      parent::setIsSubpropertyOf($v);
    } // setIsSubpropertyOf()

    /**
     * overload schemaSave
     *
     * @return mixed
     *
     * @param  integer $userId
     *
     * @throws Exception
     * @throws PropelException
     */
    public function saveSchemaProperty($userId) {
      //if the property is modified then
      if ($this->isModified() || $this->isNew()) {
        $this->setUpdatedUserId($userId);

/*        //check for changes to subclass/subproperty
        //if property or class then
        if ("class" == $this->getType() or "property" == $this->getType()) {
          //delete is_subclassof (this also clears subproperty)
          $this->SetIsSubclassOf(NULL);
          //delete parent_uri
          $this->setParentUri(NULL);
        }

        if ("class" == $this->getType() or "subclass" == $this->getType()) {
          //delete domain and range
          $this->setDomain(NULL);
          $this->setOrange(NULL);
        }
*/
        $fields = Schema::getProfileFields();
        //add parent_uri to fields
        $fields[] = "parent_uri";

        $con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);

        //did we hand-edit the URI
        if ($this->isColumnModified(SchemaPropertyPeer::PARENT_URI)) {
          //if we didn't just clear it, null the related IDs
          if (0 != strlen(rtrim($this->getParentUri()))) {
            $this->SetIsSubclassOf(NULL);
            $this->setIsSubpropertyOf(NULL);
          }
        }

        //get the URI for the related property or class
        if ("subclass" == $this->getType()) {
          $relatedId = $this->getIsSubclassOf();
        }
        if ("subproperty" == $this->getType()) {
          $relatedId = $this->getIsSubpropertyOf();
        }

        if (isset($relatedId)) {
          $related = SchemaPropertyPeer::retrieveByPK($relatedId);
          if ($related and $this->getParentUri() != $related->getUri()) {
            $this->setParentUri($related->getUri());
          }
        }

        try {
          //start a transaction
          $con->begin();

          //if the property is new then
          if ($this->isNew()) {
            //set the created user
            $this->setCreatedUserId($userId);

            //save it first
            $affectedRows = $this->save($con);

            if ($affectedRows) {
              //create new elements for each part
              foreach ($fields as $id => $field) {
                $object = $this->getFieldValue($field);

                if ($object) {
                  //fix the floating uri problem
                  if ('parent_uri' == $field) {
                    $key   = array_keys($fields, 'is_subproperty_of');
                    $id    = count($key) ? $key[0] : NULL;
                    $field = 'is_subproperty_of';
                  }
                  //fix the which sub property am I problem
                  if ('is_subproperty_of' == $field && 'subclass' == $this->getType()) {
                    $key   = array_keys($fields, 'is_subclass_of');
                    $id    = count($key) ? $key[0] : NULL;
                    $field = 'is_subclass_of';
                  }
                  $element = SchemaPropertyElementPeer::createElement($this, $userId, $id);
                  $element = $this->updateElement($element, $userId, $field, $object, $con);
                }
              }
            }
          }
          else {
            //FIXME if the language is modified we have to update all of the existing old languages
            //FIXME if the status is modified we have to update all of the existing old statuses
            //So what really needs to happen is that we leave the language and status blank
            //  and walk up the dependency tree until we find a value:
            //  element language == null
            //    property language = null
            //      schema language == en-us <== this is what we use

            //get all of the existing elements for the form and the language
            $c = new Criteria();
            $c->add(SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY, TRUE);
            $language = myActionTools::getEditLanguage();
            $c->add(SchemaPropertyElementPeer::LANGUAGE, $language);
            $elements = $this->getSchemaPropertyElementsRelatedBySchemaPropertyId();
            foreach ($fields as $id => $field) {
              try {
                $column = SchemaPropertyPeer::translateFieldname($field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
              }
              catch(PropelException $e) {
                $column = FALSE;
              }
              //see if they've been updated
              if ($column && $this->isColumnModified($column)) {
                $object = $this->getFieldValue($field);
                //fix the floating uri problem
                if ('parent_uri' == $field) {
                  $key   = array_keys($fields, 'is_subproperty_of');
                  $id    = count($key) ? $key[0] : NULL;
                  $field = 'is_subproperty_of';
                }
                //fix the which sub property am I problem
                if ('is_subproperty_of' == $field && 'subclass' == $this->getType()) {
                  $key   = array_keys($fields, 'is_subclass_of');
                  $id    = count($key) ? $key[0] : NULL;
                  $field = 'is_subclass_of';
                }
                //find the element and make sure it's only for the detail screen
                $foundOne = FALSE;
                /** @var $element \SchemaPropertyElement */
                foreach ($elements as $element) {
                  if ($id == $element->getProfilePropertyId() and TRUE == $element->getIsSchemaProperty()) {
                    //did we make it null?
                    if (0 === strlen(trim($object))) {
                      //we have to make sure that it's not a subclass or subproperty
                      if (('is_subproperty_of' == $field || 'is_subclass_of' == $field)
                          && $this->getParentUri()
                      ) {
                        //there's a uri but it doesn't match anything registered
                        //so we have to delete just the reciprocal
                        $element->updateReciprocal('deleted', $con);
                      }
                      else {
                        //delete the element
                        $element->delete($con);
                        $element = FALSE;
                      }
                    }
                    $foundOne = TRUE;
                    break;
                  }
                }

                if ($object) {
                  if (!$foundOne) {
                    //we have to create one
                    $element = SchemaPropertyElementPeer::createElement($this, $userId, $id);
                  }

                  if ($element) {
                    $element = $this->updateElement($element, $userId, $field, $object, $con);
                  }
                }
              }
            }

            //do it again for i18n
            /** @var $i18n SchemaPropertyI18n */
            $i18n    = $this->getCurrentSchemaPropertyI18n();
            $columns = $i18n->modifiedColumns;

            foreach ($columns as $column) {
              $object     = $i18n->getByName($column, BasePeer::TYPE_COLNAME);
              $columnName = SchemaPropertyI18nPeer::translateFieldName($column, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME);
              $profileId  = array_search($columnName, $fields);
              $element    = SchemaPropertyElementPeer::lookupDetailElement($i18n->getId(), $profileId, $i18n->getCulture());

              if ($element) {
                //did we make it null?
                if (0 === strlen(trim($object))) {
                  //delete the element
                  $element->delete($con);
                  $element = FALSE;
                }
                else {
                  //modify it
                  $element->setObject($object);
                  $element->setUpdatedUserId($userId);
                  $element->save();
                }
              }
              elseif ($profileId) {
                //create one
                $element = SchemaPropertyElementPeer::createElement($this, $userId, $profileId);
                $element->setObject($object);
                $element->setIsSchemaProperty(TRUE);
                $element->save();
              }
            }
          }
          //save it last
          $affectedRows = $this->save($con);

          //commit the transaction
          $con->commit();

          return $affectedRows;
        }
        catch(PropelException $e) {
          $con->rollback();
          throw $e;
        }
      }
    } //saveSchemaProperty

    /**
     * create a new element
     *
     * @param SchemaPropertyElement $element
     * @param integer               $userId
     * @param                       $field
     * @param string                $object
     * @param \Connection           $con
     *
     * @return bool|\SchemaPropertyElement
     */
    public function updateElement(SchemaPropertyElement $element, $userId, $field, $object, $con) {
      //static $updatedUri;

      if ($element) {
        $element->setIsSchemaProperty(TRUE);
        $element->setUpdatedUserId($userId);
        //SchemaPropertyElementPeer::updateElement($schema_property, $element, $userId, $field, $con);

        if ('is_subproperty_of' == $field || 'is_subclass_of' == $field) {
          //if (! $updatedUri) {
          $element->setRelatedSchemaPropertyId($this->getIsSubpropertyOf());
          $object = $this->getParentUri();
          //$updatedUri = true;
          //} Else {
          //return false;
          //}
        }

        $element->setObject($object ? $object : '');

        $element->save($con);
      }

      return $element;
    }

    /**
     * gets the value of a field by name
     *
     * @return mixed
     *
     * @param  string $field name to fetch
     */
    public function getFieldValue($field) {
      try {
        $fieldTest = $this->getByName($field, BasePeer::TYPE_FIELDNAME);
      }
      catch(PropelException $e) {
        $fieldTest = FALSE;
      }

      return $fieldTest;
    }
  }
