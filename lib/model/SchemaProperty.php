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

        public function getLabelForSelect()
        {
            return $this->getName() . " (" . $this->getLanguage() . ") :: " . $this->getLabel() . " -- "
                   . $this->getUri();
        }

        public function getCurrentLanguage()
        {
            $c = new sfCultureInfo(sfContext::getInstance()->getUser()->getCulture());

            return $c->getNativeName();
        }

        /**
         * @return array
         */
        public function getLanguagesForSchema()
        {
            return $this->getSchema()->getLanguages();
        }

        /**
         * @return array
         */
        public function getLanguagesForUser()
        {
            $schemaUser = $this->getSchemaForUser();

            return $schemaUser->getLanguages();
        }

        /**
         * @return string
         */
        public function getUserLanguage()
        {
            $language = '';
            $schemaUser = $this->getSchemaForUser();
            if ($schemaUser) {
                $language = $schemaUser->getDefaultLanguage();
            }
            if ( ! $language) {
                $language = sfContext::getInstance()->getUser()->getCulture();
            }

            return $language;
        }

        /**
         * @return SchemaHasUser
         */
        public function getSchemaForUser()
        {
            $schemaId = $this->getSchemaId();
            $userId = sfContext::getInstance()->getUser()->getSubscriberId();
            $c = new Criteria();
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

        public function __toString()
        {
            return (string) $this->getLabel();
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
         * @return integer
         *
         * @param \Connection $con [optional]
         *
         */
        public function save($con = null)
        {
            $affectedRows = parent::save($con);

            if (sfcontext::hasInstance()) {
                $schema = sfContext::getInstance()->getUser()->getCurrentSchema();
                if ($schema) {
                    /** @var Schema * */
                    $schema->clearProperties();
                    $schema->getSchemaPropertys();
                }
            }

            return $affectedRows;
        }

        public function getMyType()
        {
            return $this->getType();
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
         * @param string $v
         *
         * @return string The uri of the schema
         */
        public function setSchemaUri($v)
        {
            // Since the native PHP type for this column is string,
            // we will cast the input to a string (if it is not).
            if ($v !== null && ! is_string($v)) {
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
        public function getIsSubclassOf()
        {
            if ("class" == $this->getType()) {
                return $this->getIsSubpropertyOf();
            }

            return null;
        }

        /**
         * Sets the subclass id
         *
         * @param      string $v new value
         *
         * @return     void
         */
        public function setIsSubclassOf($v)
        {
            if ("class" == $this->getType()) {
                $this->setIsSubpropertyOf($v);
            }
        }

        /**
         * Overrides setting the value of [is_subproperty_of] column.
         *
         * @param      int $v new value
         *
         * @return     void
         */
        public function setIsSubpropertyOf($v)
        {

            // Since the native PHP type for this column is integer,
            // we will cast the input value to an int (if it is not).
            if ($v !== null && ! is_int($v) && is_numeric($v)) {
                $v = (int) $v;
            }

            $v = (0 == $v) ? null : $v;

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

        $fields = Schema::getProfileArray();
        /** @var $field ProfileProperty */
        foreach ($fields as $field) {
          $fieldIds[sfInflector::underscore($field->getName())]=["id" => $field->getId(), "hasLang" => $field->getHasLanguage()];
        }

        $statusId = $this->getStatusId();

        $con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);

        try {
          //start a transaction
          $con->begin();
          $this->setUpdatedUserId($userId);
          //if the property is new then
          if ($this->isNew()) {
            //set the created user
            $this->setCreatedUserId($userId);
          }

          //FIXME if the status is modified we have to update all of the existing statement statuses -- IF THEY MATCH THE OLD STATUS

          $columns = $this->modifiedColumns;
          //save it last
          $affectedRows = $this->save($con);

          $skipArray = ["is_subproperty_of", "is_subclass_of"];
          foreach ($columns as $column) {
            $fieldName = SchemaPropertyPeer::translateFieldName($column, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME);
            if (in_array($fieldName, $skipArray)) {
              $object = $this->getParentUri();
              if ("class" == $this->getType())
              {
                $fieldName = "is_subclass_of";
                $objectId = $this->getIsSubclassOf();
              }else{
                $fieldName = "is_subproperty_of";
                $objectId = $this->getIsSubpropertyOf();
              }
            }
            else {
              $object = $this->getByName($column, BasePeer::TYPE_COLNAME);
              $objectId = null;
            }
            SchemaPropertyPeer::updateRelatedElements($this, $fieldName, $object, $objectId, $userId, $fieldIds, $statusId, $con);
          }



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
         * @param  SchemaPropertyElement $element
         * @param integer                $userId
         * @param                        $field
         * @param string                 $object
         * @param \Connection            $con
         *
         * @return bool|\SchemaPropertyElement
         */
        public function updateElement(SchemaPropertyElement $element, $userId, $field, $object, $con)
        {
            if ($element) {
                $element->setIsSchemaProperty(true);
                $element->setUpdatedUserId($userId);
                //SchemaPropertyElementPeer::updateElement($schema_property, $element, $userId, $field, $con);

                if ('is_subproperty_of' == $field || 'is_subclass_of' == $field) {
                    if ($this->getIsSubpropertyOf() && empty($object)) {
                        $element->setRelatedSchemaPropertyId($this->getIsSubpropertyOf());
                        $object = $this->getParentUri();
                    }
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
        public function getFieldValue($field)
        {
            try {
                $fieldTest = $this->getByName($field, BasePeer::TYPE_FIELDNAME);
            } catch (PropelException $e) {
                $fieldTest = false;
            }

            return $fieldTest;
        }
    }
