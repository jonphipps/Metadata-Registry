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
    ksort($namespaces);

    return $namespaces;
  }
}
