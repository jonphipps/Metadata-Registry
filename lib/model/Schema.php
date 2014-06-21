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
  /**
   * @return Status[]
   */
  public static function getStatusArray() {
    $statusArray = [];
    $c           = new Criteria();
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

    return $statusArray;
  }

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
   * @param SchemaProperty     $property
   * @param Criteria           $cLang
   * @param  ProfileProperty[] $propArray
   * @param  Status[]          $statusArray
   * @param  bool              $languageArray
   *
   * @internal param Criteria $clang
   *
   * @return array
   */
  public function getResourceArray(SchemaProperty $property, Criteria $cLang, $propArray, $statusArray, $languageArray, $languageDefault) {
    //todo: remove hard coded registry URLs
    $resourceArray                = [];
    $resourceArray["@id"]         = $property->getUri();
    $resourceArray["isDefinedBy"] = array(
      //here we need the related object, but we don't always have it
      "@id"          => $this->getUri(),
      "url"          => "http://metadataregistry.org/schema/show/id/" . $this->getId() . ".html",
      "label"        => $this->getName()
    );
    $resourceArray["url"]         = "http://metadataregistry.org/schemaprop/show/id/" . $property->getId() . ".html";

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
          //we're putting language related elements in a language specific array
          self::addToGraph($resourceArray[ $ppi ][ $element->getLanguage() ], $element->getObject(), $pproperty->getIsSingleton());
        }
        else {
          self::addToGraph($resourceArray[ $ppi ], $element->getObject(), $pproperty->getIsSingleton());
        }
      }
      else {
        $array = array();
        if ("status" !== $ppi) {
          $object = $element->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
          if (!$object) {
            //there wasn't an ID so we look it up by the URI
            $object = SchemaPropertyPeer::retrieveByUri($element->getObject());
            if ($object)
            {
              //we now have an ID
              //todo: save the related ID so we don't have to look it up again
              //todo: log that we did this
              //$element->setRelatedSchemaPropertyId($object->getId());
              //$element->save();
            }
          }
          if ($object) {
            //we got an object somehow
            //todo: refactor this to build a language array for lexicalalias and label if uselanguagearray is true
            //we'll need to get the array of available languages for the schema and do a for/next
            $object->setCulture($languageDefault);
            $array = array(
              "@id"          => $object->getUri(),
              "lexicalAlias" => $object->getLexicalUri(),
              //"url"          => $object->getUrl(),
              "url"          => "http://metadataregistry.org/schemaprop/show/id/" . $object->getId() . ".html",
              "label"        => $object->getLabel()
            );
          }
          else {
            $array = array(
              //here we need the related object, but we don't always have it
              "@id"          => $element->getObject()
            );
          }
        }
        else {
          //it's a status
          $status = $statusArray[ $element->getObject() ];
          $array  = array(
            "@id"          => $status[3],
            "lexicalAlias" => "http://metadataregistry.org/uri/RegStatus/" . $status[6],
            "url"          => "http://metadataregistry.org/concept/show/id/$status[4].html",
            "label"        => $status[6]
          );
          //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
        }
        self::addToGraph($resourceArray[ $ppi ], $array, $pproperty->getIsSingleton());
      }
    }
    //todo: remove this bit of data cleanup
    if (isset($resourceArray["@type"]))
    {
      if (in_array($resourceArray["@type"], array("subproperty", "property"))) {
        $resourceArray["@type"] = "Property";
      }
      else if (in_array($resourceArray["@type"], array("subclass", "class"))) {
        $resourceArray["@type"] = "Class";
      }
    }

    ksort($resourceArray, SORT_FLAG_CASE | SORT_NATURAL);
    return $resourceArray;
  }

  /**
   * @param array $graph
   * @param array $value
   * @param bool  $isSingleton
   *
   * @return array|mixed
   */
  private static function addToGraph(&$graph, $value, $isSingleton) {
    if ($isSingleton) {
      //we should raise/log an error here if graph is already populated and we're overwriting it
      $graph = $value;
    }
    else {
      $graph[] = $value;
    }
  }

  /**
   * @param int $profileId The id of the application profile. defaults to '1'
   *
   * @return ProfileProperty[]
   */
  public static function getPropertyArray($profileId = 1) {
    //init the array
    /** @var ProfileProperty[] $propArray */
    $propArray = [];

    //get the profile properties
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::PROFILE_ID, $profileId);
    /** @var ProfileProperty[] $ProfileProps */
    $ProfileProps = ProfilePropertyPeer::doSelect($c);
    foreach ($ProfileProps as $prop) {
      $propArray[ $prop->getId() ] = $prop;
    }
    //todo: figure out a better way to set the rdf:type property. probably in the data
    /** This is the id of rdf:type, which isn't used directly  */
    $propArray[4]->setName("@type");
    $propArray[4]->setLabel("@type");

    return $propArray;
  }

  /**
   * @param string $lang
   *
   * @return string
   */public static function getJsonLdContext($lang = null) {
      $language='';
      if ($lang)
      {
        $language = '    "@language": "' . $lang . '",' . PHP_EOL;
      }
      return '{' . PHP_EOL . $language . <<<EOT
    "dc": "http://purl.org/dc/elements/1.1/",
    "rdac": "http://rdaregistry.info/Elements/c/",
    "rdaa": "http://rdaregistry.info/Elements/a/",
    "rdau": "http://rdaregistry.info/Elements/u/",
    "rdaw": "http://rdaregistry.info/Elements/w/",
    "rdae": "http://rdaregistry.info/Elements/e/",
    "rdam": "http://rdaregistry.info/Elements/m/",
    "rdai": "http://rdaregistry.info/Elements/i/",
    "rdf": "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
    "rdfs": "http://www.w3.org/2000/01/rdf-schema#",
    "reg": "http://metadataregistry.org/uri/profile/RegAp/",
    "regstat": "http://metadataregistry.org/uri/RegStatus/",
    "skos": "http://www.w3.org/2004/02/skos/core#",
    "owl": "http://www.w3.org/2002/07/owl#",
    "disjointWith": {
      "@id": "owl:disjointWith",
      "@type": "@id"
    },
    "equivalentClass": {
      "@id": "owl:equivalentClass",
      "@type": "@id"
    },
    "equivalentProperty": {
      "@id": "owl:equivalentProperty",
      "@type": "@id"
    },
    "inverseOf": {
      "@id": "owl:inverseOf",
      "@type": "@id"
    },
    "propertyDisjointWith": {
      "@id": "owl:propertyDisjointWith",
      "@type": "@id"
    },
    "sameAs": {
      "@id": "owl:sameAs",
      "@type": "@id"
    },
    "Property": {
      "@id": "rdf:Property",
      "@type": "@id"
    },
    "Class": {
      "@id": "rdf:Class",
      "@type": "@id"
    },
    "comment": {
      "@id": "rdfs:comment",
      "@type": "@id"
    },
    "domain": {
      "@id": "rdfs:domain",
      "@type": "@id"
    },
    "isDefinedBy": {
      "@id": "rdfs:isDefinedBy",
      "@type": "@id"
    },
    "label": "rdfs:label",
    "range": {
      "@id": "rdfs:range",
      "@type": "@id"
    },
    "subClassOf": {
      "@id": "rdfs:subClassOf",
      "@type": "@id"
    },
    "subPropertyOf": {
      "@id": "rdfs:subPropertyOf",
      "@type": "@id"
    },
    "lexicalAlias": {
      "@id": "reg:lexicalAlias",
      "@type": "@id"
    },
    "hasSubproperty": {
      "@id": "reg:hasSubproperty",
      "@type": "@id"
    },
    "hasSubclass": {
      "@id": "reg:hasSubclass",
      "@type": "@id"
    },
    "unconstrained": {
      "@id": "reg:hasUnconstrained",
      "@type": "@id"
    },
    "name": "reg:name",
    "status": {
      "@id": "reg:status",
      "@type": "@id"
    },
    "url": {
      "@id": "reg:url",
      "@type": "@id"
    },
    "altLabel": "skos:altLabel",
    "broadMatch": {
      "@id": "skos:broadMatch",
      "@type": "@id"
    },
    "closeMatch": {
      "@id": "skos:closeMatch",
      "@type": "@id"
    },
    "definition": "skos:definition",
    "narrowMatch": {
      "@id": "skos:narrowMatch",
      "@type": "@id"
    },
    "scopeNote": "skos:scopeNote"
  }
EOT;
  }

  /**
   * @param $languageArray
   * @param $languageDefault
   *
   * note: if $languageArray is set to false there must be a default language
   *       so $languageDefault is always set to the schema default language if empty
   *
   * @return Criteria
   */
  public function getCriteriaForLanguage($languageArray = TRUE, $languageDefault = "") {
    //always set to the schema default language if empty
    if ("" == $languageDefault) {
      $languageDefault = $this->getLanguage();
    }
    $cLang = new Criteria();
    //skip URI
    $cLang->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, 13, Criteria::NOT_EQUAL);
    //if we want a single language we have to select for it
    if (!$languageArray) {
      $cLang->add(SchemaPropertyElementPeer::LANGUAGE, $languageDefault);
    }

    return $cLang;
  }

}
