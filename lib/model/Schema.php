<?php

/**
 * Subclass for representing a row from the 'reg_schema' table.
 *
 *
 *
 * @package lib.model
 */
class Schema extends BaseSchema {

    /**
     * @param $foo
     * @return array
     */
    protected static function buildColumnArray( $foo )
    {
        $bar = array();
        if ( count( $foo ) )
        {
            foreach ( $foo as $value )
            {
                foreach ( $value as $key => $langArray )
                {
                    /** @var \ProfileProperty $profile */
                    $profile                = ProfilePropertyPeer::retrieveByPK( $key );
                    $order                  = $profile->getExportOrder();
                    $bar[$order]['profile'] = $profile;
                    $bar[$order]['id']      = $key;

                    foreach ( $langArray as $lang => $count )
                    {
                        if ( $profile->getHasLanguage() )
                        {
                            if ( ! isset( $bar[$order]['languages'][$lang] ) )
                            {
                                $bar[$order]['languages'][$lang] = 1;
                            }
                            else if ( $bar[$order]['languages'][$lang] < $count )
                            {
                                $bar[$order]['languages'][$lang] = $count;
                            }
                        }
                        else
                        {
                            if ( ! isset( $bar[$order]['count'] ) )
                            {
                                $bar[$order]['count'] = 1;
                            }
                            else if ( $bar[$order]['count'] < $count )
                            {
                                $bar[$order]['count'] = $count;
                            }
                        }
                    }
                }
            }
        }

        ksort($bar, SORT_NUMERIC);
        return $bar;
    }

  /**
   * @return Status[]
   */
  public static function getStatusArray() {
    $statusArray = [];
    $c           = new Criteria();
    $c->addJoin(StatusPeer::DISPLAY_NAME, ConceptPeer::PREF_LABEL);
    $c->add(ConceptPeer::VOCABULARY_ID, 31);
    StatusPeer::addSelectColumns($c);
    ConceptPeer::addSelectColumns($c);
    $stati = StatusPeer::doSelectRS($c);
    /** @var Status[] $stati */
    foreach ($stati as $stat) {
      $statusArray[ $stat[0] ] = $stat;
    }
    return $statusArray;
  }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
  //todo: make $lexicalarray a class
    /**
     * @var array
     */
    private $lexicalArray = array();

    /**
     * @return array
     */
    public function getLexicalArray() {
    return $this->lexicalArray;
  }
  /**
   * @param string $lexicalUri
   * @param string $targetUri
   * @param string $code
   */
  public function setLexicalArray($lexicalUri, $targetUri, $code) {
    $this->lexicalArray[ $lexicalUri ] = array("targetUri" => $targetUri, "code" => $code);
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

    /**
     * @param null $con
     * @return int
     * @throws Exception
     * @throws PropelException
     */
    public function save( $con = null )
    {
        $userId = sfContext::getInstance()->getUser()->getSubscriberId();
        if ( $userId )
        {
            $this->setUpdatedUserId( $userId );
            if ( $this->isNew() )
            {
                $this->setCreatedUserId( $userId );
            }
        }

        $con = Propel::getConnection();
        try
        {
            $con->begin();

            $ret = parent::save( $con );

            // update schema_has_user table
            $schemaId = $this->getId();
            $mode     = sfContext::getInstance()->getRequest()->getParameter( 'action' );
            if ( $userId && $schemaId )
            {
                //see if there's already an entry in the table and if not, add it
                $criteria = new Criteria();
                $criteria->add( SchemaHasUserPeer::USER_ID, $userId );
                $SchemaHasUsersColl = $this->getSchemaHasUsers( $criteria, $con );

                if ( ! count( $SchemaHasUsersColl ) )
                {
                    $schemaUser = new SchemaHasUser();
                    $schemaUser->setSchemaId( $schemaId );
                    $schemaUser->setUserId( $userId );
                    $schemaUser->setIsRegistrarFor( true );
                    $schemaUser->setIsAdminFor( true );
                    $schemaUser->setIsMaintainerFor( true );
                    $schemaUser->save( $con );
                }
            }

            $con->commit();

            return $ret;
        }
        catch( Exception $e )
        {
            $con->rollback();
            throw $e;
        }
    }


    /**
     * @return string
     * @throws Exception
     *
     * check if there's an errant trailing /# on the uri
     * if there is, set the ns_type to match it and return the URI
     * else
     * set the trailing string based on the ns_type property
     * append to the uri and return
     */
    public function getNamespace()
    {
        $uri = self::getUri();
        $trailer = substr($uri, -1);
        $nstrailer =  self::getNsType() == 'slash'  ?  "/" :  "#";

        if ($uri and rtrim($uri,"/#") === $uri) {
            return $uri . $nstrailer;
        }
        if ($trailer === $nstrailer) {
            return $uri;
        }
        if ($trailer == "/" and $nstrailer != '/') {
            self::setNsType('slash');
        }
        if ($trailer == "#" and $nstrailer != '#') {
            self::setNsType('hash');
        }
        return $uri;
    }

    /**
     * Gets the created_by_user
     *
     * @return User
     */
    public function getCreatedUser()
    {
        $user = $this->getUserRelatedByCreatedUserId();
        if ( $user )
        {
            return $user->getUser();
        }

        return false;
    } // getCreatedUser

    /**
     * Gets the updated_by_user
     *
     * @return User
     */
    public function getUpdatedUser()
    {
        $user = $this->getUserRelatedByUpdatedUserId();
        if ( $user )
        {
            return $user->getUser();
        }
        return false;
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
    public static function getProfileFields()
    {
        $c = new Criteria();
        $c->add( ProfilePropertyPeer::PROFILE_ID, 1 );
        $properties = ProfilePropertyPeer::doSelect( $c );
        $fieldsNew  = array();
        /** @var \ProfileProperty $property */
        foreach ( $properties as $property )
        {
            $fieldsNew[$property->getId()] = sfInflector::underscore( $property->getName() );
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
      *@param bool $excludeDeprecated
     * @param bool $includeGenerated
     *
*@return array SchemaProperty
     */
    public function getProperties($excludeDeprecated = false, $includeGenerated = false)
    {
        $c = new Criteria();
        $c->add( SchemaPropertyPeer::TYPE, 'property' );
        $c->addAscendingOrderByColumn( SchemaPropertyPeer::NAME );
        if ($excludeDeprecated)
        {
            $c->add(\SchemaPropertyPeer::STATUS_ID, 8, \Criteria::NOT_EQUAL);
        }
         return $this->getSchemaPropertysJoinStatus( $c );
    }

    /**
     * gets just the classes, ordered by name

     *
*@param bool $excludeDeprecated
     * @param bool $includeGenerated
     *
*@return array SchemaProperty
     */
    public function getClasses($excludeDeprecated = false, $includeGenerated = false)
    {
        $c = new Criteria();
        $c->add( SchemaPropertyPeer::TYPE, 'class' );
        if ($excludeDeprecated)
        {
            $c->add(\SchemaPropertyPeer::STATUS_ID, 8, \Criteria::NOT_EQUAL);
        }
        $c->addAscendingOrderByColumn( SchemaPropertyPeer::NAME );
        return $this->getSchemaPropertysJoinStatus( $c );
    }

    /**
     * @return array
     */
    public function getPropertyElements( ){
        $c = new Criteria();
        $c->add(SchemaPropertyPeer::SCHEMA_ID, $this->getId());
        $c->addAscendingOrderByColumn(SchemaPropertyPeer::URI);
        return SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($c);
    }

    /**
     * @return array
     */
    public function findLanguages()
    {
        $c = new Criteria();
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $this->getId() );
        $c->clearSelectColumns();
        $c->addSelectColumn( BaseSchemaPropertyElementPeer::LANGUAGE );
        $c->setDistinct();
        $c->addJoin( SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID );

        $foo     = array();
        $results = SchemaPropertyElementPeer::doSelectRS( $c );
        foreach ( $results as $result )
        {
            $foo[] = $result[0];
        }

        return $foo;
    }

    /**
     * @return array
     */
    public function findUsedProfileProperties()
    {
        $c = new Criteria();
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $this->getId() );
        $c->clearSelectColumns();
        $c->addSelectColumn( SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID );
        $c->addSelectColumn( SchemaPropertyElementPeer::PROFILE_PROPERTY_ID );
        $c->addSelectColumn( SchemaPropertyElementPeer::LANGUAGE );
        $c->addAscendingOrderByColumn( SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID );
        $c->addJoin( SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID );

        $foo     = array();
        $results = SchemaPropertyElementPeer::doSelectRS( $c );
        unset( $c );

        foreach ( $results as $result )
        {
            if ( ! isset( $foo[$result[0]][$result[1]][$result[2]] ) )
            {
                $foo[$result[0]][$result[1]][$result[2]] = 1;
            }
            else
            {
                $foo[$result[0]][$result[1]][$result[2]] ++;
            }
        }

        $bar = self::buildColumnArray( $foo );

        return $bar;
    }

    /**
     * @return mixed|null|string
     */
    public function getPrefixes()
    {
        $v = parent::getPrefixes();
        try
        {
            $n = unserialize( $v );
            if (!empty($n) and is_array(($n))) { //make sure it's a valid (not empty) prefix
                foreach ($n as $key => $value) {
                    if (!$key) {
                        unset($n[$key]);
                    }
                }
                if (!count($n)) {
                    $n = null;
                }
            }
        }
        catch( Exception $e )
        {
            $n = $v;
        }

        return $n;
    }

    /**
     * @param string $v
     */
    public function setPrefixes( $v )
    {
        parent::setPrefixes( serialize( $v ) );
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        $languages = parent::getLanguages();
        if ( empty( $languages ) )
        {
            $languages = [ $this->getLanguage() ];

            if ( empty( $languages ) )
            {
                $languages = [ 'en' ];
            }
        }
        else
        {
            $languages = unserialize( $languages );
        }

        return $languages;
    }

    /**
     * @return array
     */
    public function getLanguagesNoDefault()
    {
        $languages = $this->getLanguages();
        $language  = $this->getLanguage();
        $default   = array_search($language, $languages);
        if (false !== $default) {
            unset( $languages[$default] );
        }

        return $languages;
    }

    /**
     * @param SchemaProperty     $property
     * @param Criteria           $cLang
     * @param ProfileProperty[] $propArray
     * @param Status[]          $statusArray
     * @param bool              $languageArray
     * @param                    $languageDefault
     *
     * @return array
     *
     */
  public function getResourceArray(SchemaProperty $property, Criteria $cLang, $propArray, $statusArray, $languageArray, $languageDefault)
  {
      //todo: this should be based on a constant rather than hard-coded;
      $lexicalAliasProperty = 27;
      //todo: remove hard coded registry URLs
      $resourceArray = [];
      $resourceArray["@id"] = $property->getUri();
      $resourceArray["isDefinedBy"] = array(
          //here we need the related object, but we don't always have it
          "@id"   => $this->getUri(),
          "url"   => "http://metadataregistry.org/schema/show/id/" . $this->getId() . ".html",
          "label" => $this->getName(),
      );
      $typeArray = array(
            'property' => "Property",
            'class' => "Class",
            'subproperty' => "Property",
            'subclass' => "Class",
      );
      $resourceArray["url"] = "http://metadataregistry.org/schemaprop/show/id/" . $property->getId() . ".html";

      $elements = $property->getSchemaPropertyElementsRelatedBySchemaPropertyId($cLang);
      /** @var SchemaPropertyElement[] $elements */
      foreach ($elements as $element) {
          /** @var string $ppi */
          $pproperty = $propArray[$element->getProfilePropertyId()];
          $ppi = $pproperty->getLabel();
          //id
          if ( ! $pproperty->getIsObjectProp()) {
              if ($pproperty->getHasLanguage() && $languageArray) {
                  //we're putting language related elements in a language specific array
                  self::addToGraph($resourceArray[$ppi][$element->getLanguage()], $element->getObject(),
                        $pproperty->getIsSingleton());
              } else {
                  self::addToGraph($resourceArray[$ppi], $element->getObject(), $pproperty->getIsSingleton());
              }
          } else {
              $array = array();
              if ("status" !== $ppi) {
                  if ( ! in_array($statusArray[$element->getStatusId()][2], [
                        "Deprecated",
                        "Not Approved",
                  ])
                  ) {
                      $object = $element->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
                      if ( ! $object) {
                          //there wasn't an ID so we look it up by the URI
                          $object = SchemaPropertyPeer::retrieveByUri($element->getObject());
                          if ($object) {
                              //we now have an ID
                              //todo: log that we did this
                              $element->setRelatedSchemaPropertyId($object->getId());
                              $element->save();
                          }
                      }
                      if ($object) {
                          //we got an object somehow
                          //todo: refactor this to build a language array for lexicalalias and label if uselanguagearray is true
                          //we'll need to get the array of available languages for the schema and do a for/next
                          //todo: we removed the language filter from the query, so we need to check for a language match here
                          $object->setLanguage($languageDefault);
                          if ($lexicalAliasProperty == $pproperty->getId()) {
                              $array = $object->getLexicalAlias();
                              $this->setLexicalArray($element->getObject(), $resourceArray["@id"], 308);
                          } else {
                              $array = array(
                                    "@id"          => $object->getUri(),
                                    "lexicalAlias" => $object->getLexicalAlias(),
                                    //"url"          => $object->getUrl(),
                                    "url"          => "http://metadataregistry.org/schemaprop/show/id/"
                                                      . $object->getId() . ".html",
                                    "label"        => $object->getLabel(),
                              );
                              if (empty($array['lexicalAlias'])) {
                                  unset($array['lexicalAlias']);
                              }
                          }
                      } else if ('@type' == $ppi and isset($typeArray[$element->getObject()])) {
                          $array = $typeArray[$element->getObject()];
                      } else {
                          $array = array(
                              //here we need the related object, but we don't always have it
                              "@id" => $element->getObject(),
                          );
                      }
                  }
              } else {
                  //it's a status
                  $status = $statusArray[$element->getObject()];
                  $array = array(
                        "@id"          => $status[3],
                        "lexicalAlias" => "http://metadataregistry.org/uri/RegStatus/" . $status[2] . ".en",
                        "url"          => "http://metadataregistry.org/concept/show/id/$status[4].html",
                        "label"        => $status[2],
                  );
                  //$resourceArray[ $ppi ] = self::addToGraph($array, $pproperty->getIsSingleton());
              }
              self::addToGraph($resourceArray[$ppi], $array, $pproperty->getIsSingleton());
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
        $language = PHP_EOL . '    "@language": "' . $lang . '",';
      }
      return  <<<EOT
{
  "@context": { $language
    "dc": "http://purl.org/dc/elements/1.1/",
    "rdac": "http://rdaregistry.info/Elements/c/",
    "rdaa": "http://rdaregistry.info/Elements/a/",
    "rdau": "http://rdaregistry.info/Elements/u/",
    "rdaw": "http://rdaregistry.info/Elements/w/",
    "rdae": "http://rdaregistry.info/Elements/e/",
    "rdam": "http://rdaregistry.info/Elements/m/",
    "rdai": "http://rdaregistry.info/Elements/i/",
    "rdaz": "http://rdaregistry.info/Elements/z/",
    "rof":  "http://rdaregistry.info/Elements/rof/",
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
    "hasunconstrained": {
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
    "description": "skos:definition",
    "narrowMatch": {
      "@id": "skos:narrowMatch",
      "@type": "@id"
    },
    "scopeNote": "skos:scopeNote"
  }
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

    $cLang = new Criteria();
    //skip URI
    $cLang->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, 13, Criteria::NOT_EQUAL);
    //if we want a single language we have to select for it
    if (!$languageArray and !empty($languageDefault)) {
      $cLang->add(SchemaPropertyElementPeer::LANGUAGE, $languageDefault);
    }

    return $cLang;
  }

    /**
     * @return array
     */
    public function getMaintainerIds()
    {
        $ca = new Criteria();
        $ca->add(SchemaHasUserPeer::SCHEMA_ID, $this->getId());
        $ca->add(SchemaHasUserPeer::IS_MAINTAINER_FOR, true);
        $maintainers = SchemaHasUserPeer::doSelect($ca);
        $maintainerArray = [];
        /** @var SchemaHasUser $maintainer */
        foreach ($maintainers as $maintainer) {
            $maintainerArray[] = $maintainer->getUserId();
        }

        return $maintainerArray;
    }

    public function getRdfNamespaces($criteria = null, $con = null)
    {
        $con = Propel::getConnection(SchemaPeer::DATABASE_NAME);
        $id = $this->getId();
        $rs = $con->executeQuery(
        /** @lang MySQL */
            <<<SQL
SELECT DISTINCT reg_prefix.prefix, reg_prefix.uri
FROM reg_schema_property,
	reg_schema_property_element,
	profile_property,
	reg_prefix
WHERE reg_schema_property_element.schema_property_id = reg_schema_property.id
				AND reg_schema_property.schema_id = $id
				AND reg_schema_property_element.deleted_at IS NULL
				AND profile_property_id = profile_property.id
				AND reg_prefix.uri = profile_property.namespce
ORDER BY reg_prefix.prefix
SQL
        );
        //we have some defaults
        $results['dc'] = PrefixPeer::findByPrefix('dc')->getUri();
        $results['foaf'] = PrefixPeer::findByPrefix('foaf')->getUri();
        $results['rdf'] = PrefixPeer::findByPrefix('rdf')->getUri();
        $results['skos'] = PrefixPeer::findByPrefix('skos')->getUri();

        while ($rs->next()) {
            $results[$rs->getString('prefix')] = $rs->getString('uri');
        }
      if ($this->getPrefix()) {
        $results[$this->getPrefix()] = $this->getUri();
      }

        ksort($results);

        return $results;
    }


  /**
   * @return ProfileProperty[]
   */
  public function getProfilePropertiesInUse()
  {
    $results=[];
    $con = Propel::getConnection(SchemaPeer::DATABASE_NAME);
    $id  = $this->getId();
    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
select profile_property.* from reg_schema_property_element, reg_schema_property, profile_property
where reg_schema_property.schema_id = $id
and reg_schema_property_element.schema_property_id = reg_schema_property.id
and reg_schema_property_element.profile_property_id = profile_property.id
group by profile_property.id
order by profile_property.export_order
SQL
    ,
        ResultSet::FETCHMODE_NUM);

    // set the class once to avoid overhead in the loop
    $cls = ProfilePropertyPeer::getOMClass();
    $cls = Propel::import($cls);
    // populate the object(s)
    while ($rs->next()) {

      $obj = new $cls();
      $obj->hydrate($rs);
      $results[] = $obj;

    }

    return $results;

  }


  /**
   * @param bool $excludeDeprecated
   * @param bool $includeGenerated
   * @param bool $includeDeleted
   * @param bool $includeNotAccepted
   * @param array $languages


   *
*@return array
   */
  public function getColumnCounts(
      $excludeDeprecated = false, $includeGenerated = false, $includeDeleted = false, $includeNotAccepted = false,
      $languages = []
  ) {
    $results       = [];
    $maxes         = [];
    $con           = Propel::getConnection(SchemaPeer::DATABASE_NAME);
    $id            = $this->getId();
    $deleteSQL     = $includeDeleted ? '' : 'and reg_schema_property_element.deleted_at is null';
    $generatedSQL  = $includeGenerated ? '' : 'and is_generated = 0';
    $deprecatedSQL = $excludeDeprecated ? 'and reg_schema_property.status_id <> 8' : '';
    $allStatusSQL  = $includeNotAccepted ? '' : 'and reg_schema_property.status_id = 1';
    $languageSQL   = '';
    if (count($languages)) {
      $languageSQL = "and (reg_schema_property_element.language = ''";
      foreach ($languages as $language) {
        $languageSQL .= " or reg_schema_property_element.language = '$language'";
      }
      $languageSQL .= ")";
    }    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
select profile_property_id, lang, max(cnt) as maxcnt from (
select profile_property_id, reg_schema_property_element.language as lang, reg_schema_property.id, count(reg_schema_property_element.language) as cnt
from reg_schema_property_element join reg_schema_property on reg_schema_property_element.schema_property_id = reg_schema_property.id
$deleteSQL
$generatedSQL
$languageSQL
and reg_schema_property.schema_id = $id
$deprecatedSQL
$allStatusSQL
group by reg_schema_property.id, reg_schema_property_element.language, profile_property_id
order by profile_property_id) as results
group by profile_property_id, lang
SQL
        , ResultSet::FETCHMODE_ASSOC);
    while ($rs->next()) {
      $id                                   = $rs->getInt('profile_property_id');
      $max                                  = $rs->getInt('maxcnt');
      $results[$id][$rs->getString('lang')] = $max;
      if (isset( $maxes[$id] )) {
        $maxes[$id] = $max > $maxes[$id] ? $max : $maxes[$id];
      } else {
        $maxes[$id] = $max;
      }
    }

    foreach ($results as $index => &$languages) {
      foreach ($languages as &$language) {
        $language = $maxes[$index];
      }
    }

    return $results;
  }


  /**
   * @param bool $excludeDeprecated
   * @param bool $includeGenerated
   * @param bool $includeDeleted
   * @param bool $includeNotAccepted
   * @param array $languages

   *
*@return array
   */
  public function getDataForExport(
      $includeDeprecated = false, $includeGenerated = false, $includeDeleted = false, $includeNotAccepted = false,
      $languages = []
  ) {
    $results       = [];
    $con           = Propel::getConnection(SchemaPeer::DATABASE_NAME);
    $id            = $this->getId();
    $deleteSQL     = $includeDeleted ? '' : 'and reg_schema_property_element.deleted_at is null';
    $generatedSQL  = $includeGenerated ? '' : 'and reg_schema_property_element.is_generated = 0';
    $deprecatedSQL = $includeDeprecated ? '' :'and reg_schema_property.status_id <> 8 and reg_schema_property_element.status_id <> 8';

    $allStatusSQL = '';
    if ($includeNotAccepted && $includeDeprecated) {
      $allStatusSQL = '';
    }
    if ( ! $includeNotAccepted && $includeDeprecated) {
      $allStatusSQL = 'and reg_schema_property.status_id in (1,8)';
    }
    if ( ! $includeNotAccepted && ! $includeDeprecated) {
      $allStatusSQL = 'and reg_schema_property.status_id = 1';
    }

    $languageSQL   = '';
    if (count($languages)) {
      $languageSQL = "and (reg_schema_property_element.language = ''";
      foreach ($languages as $language) {
        $languageSQL .= " or reg_schema_property_element.language = '$language'";
      }
      $languageSQL .= ")";
    }
    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
SELECT reg_schema_property_element.id,
  reg_schema_property_element.schema_property_id,
  reg_schema_property_element.profile_property_id,
  reg_schema_property_element.object,
  reg_schema_property_element.language
FROM reg_schema_property_element
JOIN reg_schema_property ON reg_schema_property_element.schema_property_id = reg_schema_property.id
WHERE reg_schema_property.schema_id = $id
$deprecatedSQL
$deleteSQL
$languageSQL
$generatedSQL
$allStatusSQL
SQL
        , ResultSet::FETCHMODE_ASSOC);

    while ($rs->next()) {
      $id     = $rs->getInt('schema_property_id');
      $result = [];
      $result['object'] = $rs->getString('object');
      $result['id']     = $rs->getInt('id');

      $results[$id][$rs->getInt('profile_property_id')][$rs->getString('language')][] = $result;
    }

    return $results;
  }

}
