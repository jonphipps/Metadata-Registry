<?php

/**
 * Subclass for representing a row from the 'reg_vocabulary' table.
 *
 *
 *
 * @package lib.model
 */
class Vocabulary extends BaseVocabulary
{
  public function __toString() {

    return $this->getName();
  }

  public function getLanguageForSelect() {
    return array($this->getLanguage() => format_language($this->getLanguage()));
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
  public function getMyAgentId() {
    //
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $criteria = new Criteria();
	  $criteria->add(VocabularyHasUserPeer::USER_ID, $userId);
    $userAgents = AgentHasUserPeer::doSelectJoinAgent($criteria);
    foreach ($userAgents as $agent) {
      $agents[] = $agent->getAgent();
    }

    return $agents;
  }

  public function save($con = null)
  {
    $con = Propel::getConnection();
    try
    {
      $con->begin();

      $ret = parent::save($con);

      // update vocabulary_has_user table
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $vocabularyId = $this->getId();
      $mode = sfContext::getInstance()->getRequest()->getParameter('action');
      if ($userId && $vocabularyId)
      {
        //see if there's already an entry in the table and if not, add it
        $criteria = new Criteria();
		    $criteria->add(VocabularyHasUserPeer::USER_ID, $userId);
        $VocabularyHasUsersColl = $this->getVocabularyHasUsers($criteria, $con);

        if (!count($VocabularyHasUsersColl))
        {
          $vocabularyUser = new VocabularyHasUser();
          $vocabularyUser->setVocabularyId($vocabularyId);
          $vocabularyUser->setUserId($userId);
          $vocabularyUser->setIsRegistrarFor(true);
          $vocabularyUser->setIsAdminFor(true);
          $vocabularyUser->setIsMaintainerFor(true);
          $vocabularyUser->save($con);
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
  public function getPrefixes()
  {
    $v = parent::getPrefixes();
    try
    {
      $n = unserialize( $v );
    }
    catch( Exception $e )
    {
      $n = $v;
    }

    return $n;
  }

  public function setPrefixes( $v )
  {
    parent::setPrefixes( serialize( $v ) );
  }

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

  public function getLanguagesNoDefault()
  {
    $languages = $this->getLanguages();
    $language = $this->getLanguage();
    $default = array_search( $language, $languages );
    if ( false !== $default ) {
      unset( $languages[ $default ] );
    }

    return $languages;
  }

  public function getNamespaces()
  {
    $criteria = new Criteria();
    $criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());
    $criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);
    $criteria->addJoin(ProfilePropertyPeer::SKOS_ID, ConceptPropertyPeer::SKOS_PROPERTY_ID);
    $criteria->clearSelectColumns();
    $criteria->addSelectColumn(ProfilePropertyPeer::URI);
    $criteria->setDistinct();
    $rs = ConceptPeer::doSelectRS($criteria);
    $coreNamespaces = [
        'dc'     => 'http://purl.org/dc/elements/1.1/',
        'dcterm' => 'http://purl.org/dc/terms/',
        'owl'    => 'http://www.w3.org/2002/07/owl#',
        'skos'   => 'http://www.w3.org/2004/02/skos/core#',
        'rdf'    => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'rdfs'   => 'http://www.w3.org/2000/01/rdf-schema#',
        'reg'    => 'http://metadataregistry.org/uri/profile/regap/',
        'rdakit' => 'http://metadataregistry.org/uri/profile/rdakit/',
    ];
    $namespaces = [];
    foreach ($rs as $r) {
      $array = explode(":", $r[0]);
      if (isset($coreNamespaces[$array[0]])) {
        $namespaces[$array[0]] = $coreNamespaces[$array[0]];
      }
    }
    //add the required namespaces
    foreach (['dc', 'reg', 'rdf', 'skos'] as $ns) {
      $namespaces[$ns] = $coreNamespaces[$ns];
    }

    if ($this->getPrefix()) {
      $results[$this->getPrefix()] = $this->getUri();
    }

    ksort($namespaces);

    return $namespaces;
  }


  public function getProfilePropertiesInUse()
  {
    $results = [];
    $con     = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
    $id      = $this->getId();
    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
select profile_property.* from reg_concept_property, reg_concept, profile_property
where reg_concept.vocabulary_id = 58
and reg_concept_property.concept_id = reg_concept.id
and reg_concept_property.profile_property_id = profile_property.id
group by profile_property.id
order by profile_property.export_order
SQL
, ResultSet::FETCHMODE_NUM);
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
    $con           = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
    $id            = $this->getId();
    $deleteSQL     = $includeDeleted ? '' : 'and reg_concept_property.deleted_at is null';
    $generatedSQL  = $includeGenerated ? '' : 'and is_generated = 0';
    $deprecatedSQL = $excludeDeprecated ? 'and reg_concept.status_id <> 8' : '';
    $allStatusSQL  = $includeNotAccepted ? '' : 'and reg_concept.status_id = 1';
    $languageSQL   = '';
    if (count($languages)) {
      $languageSQL = "and (reg_concept_property.language = ''";
      foreach ($languages as $language) {
        $languageSQL .= " or reg_concept_property.language = '$language'";
      }
      $languageSQL .= ")";
    }
    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
select profile_property_id, lang, max(cnt) as maxcnt from (
select profile_property_id, reg_concept_property.language as lang, reg_concept.id, count(reg_concept_property.language) as cnt
from reg_concept_property join reg_concept on reg_concept_property.concept_id = reg_concept.id
$deleteSQL
$generatedSQL
$languageSQL
and reg_concept.vocabulary_id = $id
$deprecatedSQL
$allStatusSQL
group by reg_concept.id, reg_concept_property.language, profile_property_id) as results
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

    //fixme: !someday! Remove this hack that papers over the fact that uri and status aren't separate properties for vocabs
    // this requires reconfiguring rdf generation, file import, and the form processing for vocabs
    $results[59]['status'][''] = 1;
    $results[62]['uri'][''] = 1;

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
      $excludeDeprecated = false, $includeGenerated = false, $includeDeleted = false, $includeNotAccepted = false,
      $languages = []
  ) {
    $results       = [];
    $con           = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
    $id            = $this->getId();
    $deleteSQL     = $includeDeleted ? '' : 'and reg_concept_property.deleted_at is null';
    $generatedSQL  = $includeGenerated ? 'and reg_concept_property.is_generated = 0' : '';
    $deprecatedSQL = $excludeDeprecated ? 'and reg_concept.status_id <> 8' : '';
    $allStatusSQL  = $includeNotAccepted ? '' : 'and reg_concept.status_id = 1';
    $languageSQL   = '';
    if (count($languages)) {
      $languageSQL = "and (reg_concept_property.language = ''";
      foreach ($languages as $language) {
        $languageSQL .= " or reg_concept_property.language = '$language'";
      }
      $languageSQL .= ")";
    }
    /** @var ResultSet $rs */
    $rs = $con->executeQuery(/** @lang MySQL */
        <<<SQL
SELECT reg_concept_property.id,
  reg_concept_property.concept_id,
  reg_concept_property.profile_property_id,
  reg_concept_property.object,
  reg_concept_property.language,
  reg_status.display_name as status,
  reg_concept.uri
FROM reg_concept_property
JOIN reg_concept ON reg_concept_property.concept_id = reg_concept.id
JOIN reg_status on reg_concept.status_id = reg_status.id
WHERE reg_concept.vocabulary_id = $id
$deprecatedSQL
$deleteSQL
$languageSQL
$generatedSQL
$allStatusSQL
order by reg_concept.uri
SQL
        , ResultSet::FETCHMODE_ASSOC);
    while ($rs->next()) {
      $concept_id       = $rs->getInt('concept_id');
      $result           = [];

      $result['object'] = $rs->getString('object');
      $result['id']     = $rs->getInt('id');
      $results[$concept_id][$rs->getInt('profile_property_id')][$rs->getString('language')][] = $result;

      //fixme: adding in the concept status and uri data manually because it's not in the vocab properties
      $result['object']             = $rs->getString('status');
      $result['id']                 = 0;
      $results[$concept_id][59][''][] = $result;

      $result['object']             = $rs->getString('uri');
      $result['id']                 = 0;
      $results[$concept_id][62][''][] = $result;
    }

    return $results;
  }

}
