<?php

/**
 * Subclass for representing a row from the 'reg_schema' table.
 *
 *
 *
 * @package lib.model
 */
class Schema extends BaseSchema
{
  public function __toString()
  {
    return $this->getName();
  }

  /**
   * Get the [languages] column value.
   *
   * @return     string
   */
  public function getLanguages()
  {
    //this deliberately returns the default language if languages is empty
    return ($this->languages) ? unserialize($this->languages) : [$this->language];
  }

  /**
   * @param int $userId
   *
   * @return bool|array
   */
  public function getLanguagesForUser($userId)
  {
    $schemaUser = $this->GetUserForSchema($userId);
    return $schemaUser ? $schemaUser->getLanguages() : false;
  }

  /**
   * @param $userId
   *
   * @return bool|SchemaHasUser
   */
  public function GetUserForSchema($userId)
  {
    $c = new Criteria();
    $c->add(SchemaHasUserPeer::USER_ID, $userId);

    $schemaUser = $this->getSchemaHasUsers($c);
    return isset($schemaUser[0]) ? $schemaUser[0] : false;
  }
  /**
   * Set the value of [languages] column.
   *
   * @param      string $v new value
   *
   * @return     void
   */
  public function setLanguages($v)
  {

    // Since the native PHP type for this column is string,
    // we will serialize the input to a string (if it is not).
    if ($v !== null) {
      $v = serialize($v);
    }

    parent::setLanguages($v);
  } // setLanguages()

  public function save($con = null)
  {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    if ($userId)
    {
      $this->setUpdatedUserId($userId);
      if ($this->isNew())
      {
        $this->setCreatedUserId($userId);
      }
    }

    $con = Propel::getConnection();
    try
    {
      $con->begin();

      $ret = parent::save($con);

      // update schema_has_user table
      $schemaId = $this->getId();
      $mode = sfContext::getInstance()->getRequest()->getParameter('action');
      if ($userId && $schemaId)
      {
        //see if there's already an entry in the table and if not, add it
        $criteria = new Criteria();
        $criteria->add(SchemaHasUserPeer::USER_ID, $userId);
        $SchemaHasUsersColl = $this->getSchemaHasUsers($criteria, $con);

        if (!count($SchemaHasUsersColl))
        {
          $schemaUser = new SchemaHasUser();
          $schemaUser->setSchemaId($schemaId);
          $schemaUser->setUserId($userId);
          $schemaUser->setIsRegistrarFor(true);
          $schemaUser->setIsAdminFor(true);
          $schemaUser->setIsMaintainerFor(true);
          $schemaUser->save($con);
        }

      }

      $con->commit();

      return $ret;

    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    $user = $this->getUserRelatedByCreatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getCreatedUser

  /**
  * Gets the updated_by_user
  *
  * @return User
  */
  public function getUpdatedUser()
  {
    $user = $this->getUserRelatedByUpdatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getUpdatedUser

  /**
   * get the schema fields profile
   *
   * @return array The fields
   */
  public static function getProfileArray() {
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::PROFILE_ID, 1);

    return ProfilePropertyPeer::doSelect($c);
  }

  /**
   * get the schema fields array (field_id => field name)
   *
   * @return array The fields
   */
  public static function getProfileFields() {
    $properties = self::getProfileArray();
    $fieldsNew  = array();
    foreach ($properties as $property) {
      $fieldsNew[ $property->getId() ] = sfInflector::underscore($property->getName());
    }
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
      7 => 'note'
    );

    return $fieldsNew;
  }

  /**
  * clears the properties
  *
  */
  public function clearProperties()
  {
    $this->collSchemaPropertys = null;
  }

  /**
  * gets just the properties, ordered by name
  *
  * @return array SchemaProperty
  */
  public function getProperties()
  {
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'property');
    $c->addOr(SchemaPropertyPeer::TYPE,'subproperty');
    $c->addJoin(SchemaPropertyI18nPeer::ID,BaseSchemaPropertyPeer::ID);
    $c->addAscendingOrderByColumn(SchemaPropertyI18nPeer::NAME);

    return $this->getSchemaPropertysJoinStatus($c);
  }

  /**
  * gets just the classes, ordered by name
  *
  * @return array SchemaProperty
  */
  public function getClasses()
  {
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'class');
    $c->addOr(SchemaPropertyPeer::TYPE,'subclass');
    $c->addJoin(SchemaPropertyI18nPeer::ID,BaseSchemaPropertyPeer::ID);
    $c->addAscendingOrderByColumn(SchemaPropertyi18nPeer::NAME);

    return $this->getSchemaPropertysJoinStatus($c);
  }

  /**
   * @param boolean $languageArray
   * @param string  $languageDefault
   * @param integer $pageLimit
   *
   * note: if $languageArray is set to false there must be a default language
   *       so $languageDefault is always set to the schema default language if empty
   *
   * @return array
   */
  public function publish($languageArray = TRUE, $languageDefault = "", $pageLimit = NULL) {
    //todo: add option for paging
    //todo: add option for single language
    //todo: add option for language array (with or without single language)
    //todo: check for singleton

    if ("" == $languageDefault) {
      $languageDefault = $this->getLanguage();
    }
    //open a file for write

    //init the array
    /** @var ProfileProperty[] $propArray */
    $propArray = [];
    /** @var Status[] $statusArray */
    $statusArray = [];
    $rdfArray    = [];

    //get the profile properties
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::PROFILE_ID, 1);
    /** @var ProfileProperty[] $ProfileProps */
    $ProfileProps = ProfilePropertyPeer::doSelect($c);
    foreach ($ProfileProps as $prop) {
      $propArray[ $prop->getId() ] = $prop;
    }
    //todo: figure out a better way to set the rdf:type property. probably in the data
    /** This is the id of rdf:type, which isn't used directly  */
    $propArray[4]->setName("@type");

    $c = new Criteria();
    $c->addJoin(StatusPeer::DISPLAY_NAME, ConceptI18nPeer::PREF_LABEL);
    $c->addJoin(ConceptI18nPeer::ID, ConceptPeer::ID);
    $c->add(ConceptPeer::VOCABULARY_ID, 31);
    StatusPeer::addSelectColumns($c);
    ConceptI18nPeer::addSelectColumns($c);
    $stati = StatusPeer::doSelectRS($c);
    /** @var Status[] $stati */
    foreach ($stati as $stat) {
      $statusArray[ $stat[0] ] = $stat;
    }

    //get a list of the resources
    /** @var SchemaProperty[] $properties */
    $properties = $this->getSchemaPropertys();
    $cLang = new Criteria();
    $cLang->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, 13, Criteria::NOT_EQUAL);
    if (!$languageArray)
    {
      $cLang->add(SchemaPropertyElementPeer::LANGUAGE, $languageDefault);
    }
    //foreach resource
    foreach ($properties as $property) {
      $resourceArray        = [];
      $resourceArray["@id"] = $property->getUri();
      /** @var SchemaPropertyElement $element */
      foreach ($property->getSchemaPropertyElementsRelatedBySchemaPropertyId($cLang) as $element) {
        if (in_array($statusArray[ $element->getStatusId() ][2], ["Deprecated", "Not Approved"])) {
          continue;
        }
        /** @var string $ppi */
        $pproperty = $propArray[ $element->getProfilePropertyId() ];
        $ppi       = $pproperty->getLabel();
        //id
        if (!$pproperty->getIsObjectProp()) {
          if ($pproperty->getHasLanguage() && $languageArray) {
              $resourceArray[ $ppi ][ $element->getLanguage() ] = $element->getObject();
          }
          else {
            //$resourceArray[ $ppi ][] = $element->getObject();
            $resourceArray[ $ppi ] = self::addToGraph($element->getObject(), $pproperty->getIsSingleton());
          }
        }
        else {
          $array = array();
          if ("status" !== $ppi) {
            $object = $element->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
            if ($object) {
              $array = array(
                //here we need the related object, but we don't always have it
                "@id"          => $element->getObject(),
                "lexicalAlias" => $object->getLexicalUri(),
                "url"          => $object->getUrl(),
                "label"        => $object->getLabel()
              );
              //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
            }
            else {
              $object = SchemaPropertyPeer::retrieveByUri($element->getObject());
              if ($object) {
                $array = array(
                  //here we need the related object, but we don't always have it
                  "@id"          => $element->getObject(),
                  "lexicalAlias" => $object->getLexicalUri(),
                  "url"          => $object->getUrl(),
                  "label"        => $object->getLabel()
                );
                //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());

                //save it so we don't have to look again
                //$element->setRelatedSchemaPropertyId($object->getId());
                //$element->save();
              }
              else {
                $array = array(
                  //here we need the related object, but we don't always have it
                  "@id"          => $element->getObject(),
                  "lexicalAlias" => "",
                  "url"          => "",
                  "label"        => ""
                );
                //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
              }
            }
          }
          else {
            $status                  = $statusArray[ $element->getObject() ];
            $array = array(
              "@id"          => $status[3],
              "lexicalAlias" => "http://metadataregistry.org/uri/RegStatus/" . $status[6],
              "url"          => "http://metadataregistry.org/concept/show/id/$status[4].html",
              "label"        => $status[6]
            );
            //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
          }
          $resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
        }
      }
      //add it to the array
      $rdfArray["@graph"][] = $resourceArray;
    }

    return $rdfArray;
    //get all of the elements as an array
    //foreach property
    //if the value is an object properties
    //get the object and make an array of the returned values
    //get all of the object properties
  }

  /**
   * @param mixed $value
   * @param bool  $isSingleton
   *
   * @return array|mixed

   */
  private static function addToGraph($value, $isSingleton) {
    return ($isSingleton) ? $value : array($value);
  }
}
