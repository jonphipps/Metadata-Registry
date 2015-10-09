<?php

/**
 * Subclass for representing a row from the 'reg_concept_property' table.
 *
 *
 *
 * @package lib.model
 */
class ConceptProperty extends BaseConceptProperty
{
    public $importId;
    public $matchKey;
    public $importStatus;
    public $doReciprocal = true;

    /**
	 * The value for the vocabulary_id field.
	 * @var int
	 */
	protected $vocabulary_id;

	/**
	 * The value for the vocabulary_name field.
	 * @var string
	 */
	protected $vocabulary_name;

	/**
	 * The value for the skos_property_name field.
	 * @var string
	 */
	protected $skos_property_name;

	/**
	 * The value for the concept_pref_label field.
	 * @var string
	 */
	protected $concept_pref_label = '';


  public function __toString()
  {
    return $this->getProfileProperty()->getName();
  }

  /**
  * returns the parent vocabulary
  *
  * @return vocabulary
  */
  public function getConceptVocabulary()
  {
    return $this->getConceptRelatedByConceptId()->getVocabulary();
  }

	/**
	 * Get the [vocabulary_id] column value.
	 *
	 * @return int
	 */
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	/**
	 * Get the [vocabulary_name] column value.
	 *
	 * @return string
	 */
	public function getVocabularyName()
	{
		return $this->vocabulary_name;
	}

	/**
	 * Get the [concept_pref_label] column value.
	 *
	 * @return string
	 */
	public function getCONCEPTPrefLabel()
	{

		return $this->concept_pref_label;
	}

	/**
	 * Set the value of [vocabulary_id] column.
	 *
	 * @param int $v new value
	 * @return void
	 */
	public function setVocabularyId($v)
	{

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::VOCABULARY_ID;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [vocabulary_name] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setVocabularyName($v)
	{

		if ($this->vocabulary_name !== $v) {
			$this->vocabulary_name = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::VOCABULARY_NAME;
		}

	} // setVocabularyName()

	/**
	 * Get the [skos_property_name] column value.
	 *
	 * @return string
	 */
	public function getSkosPropertyName()
	{
      if (!$this->skos_property_name && $this->getSkosPropertyId())
      {
         $this->skos_property_name = SkosPropertyPeer::retrieveByPK($this->getSkosPropertyId())->getName();
      }
		return $this->skos_property_name;
	}

	/**
	 * Set the value of [skos_property_name] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setSkosPropertyName($v)
	{

		if ($this->skos_property_name !== $v) {
			$this->skos_property_name = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SKOS_PROPERTY_NAME;
		}

	} // setVocabularyName()

	/**
	 * Set the value of [concept_pref_label] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setConceptPrefLabel($v)
	{

		if ($this->concept_pref_label !== $v || $v === '') {
			$this->concept_pref_label = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::CONCEPT_PREF_LABEL;
		}

	} // setPrefLabel()

   public function setSchemeId($v)
   {
      if ($this->scheme_id !== $v || $v === 0) {
         if ($v == 0 || $v == '')
         {
            $v = null;
         }
         $this->scheme_id = $v;
         $this->modifiedColumns[] = ConceptPropertyPeer::SCHEME_ID;
      }

      if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
         $this->aVocabulary = null;
      }

   }

   public function setRelatedConceptId($v)
   {
      if ($this->related_concept_id !== $v || $v === 0) {
         if ($v == 0 || $v == '')
         {
            $v = null;
         }
         $this->related_concept_id = $v;
         $this->modifiedColumns[] = ConceptPropertyPeer::RELATED_CONCEPT_ID;
      }

      if ($this->aConceptRelatedByRelatedConceptId !== null && $this->aConceptRelatedByRelatedConceptId->getId() !== $v) {
         $this->aConceptRelatedByRelatedConceptId = null;
      }
   }

  /**
  * Gets the related vocabulary object
  *
  * @return Vocabulary
  */
  public function getRelatedScheme()
  {
     return VocabularyPeer::retrieveByPK($this->scheme_id);
  }

  /**
  * Gets the related vocabulary object
  *
  * @return Vocabulary
  */
  public function getRelatedConcept()
  {
     return ConceptPeer::retrieveByPK($this->related_concept_id);
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
      return $user->getNickname();
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
      return $user->getNickname();
    }

  } // getUpdatedUser

  /**
   * wraps the save function to update concept first
   * adds history function
   *
   * Stores the object in the database.  If the object is new,
   * it inserts it; otherwise an update is performed.  This method
   * wraps the doSave() worker method in a transaction.
   *
   * @param Connection $con
   * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
   * @throws PropelException
   * @see doSave()
   */
  public function save($con = null)
  {
    $concept = $this->getConceptRelatedByConceptId();
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();

    if ($userId)
    {
      $this->setUpdatedUserId($userId);
    }


    if ($concept)
    {
      if ($userId)
      {
        $concept->setUpdatedUserId($userId);
      }

      //check to see if the primary pref label flag is set
      if ($this->primary_pref_label)
      {
        //if set, then update the associated concept fields
        $concept->setPrefLabel($this->getObject());
        $concept->setStatusId($this->getStatusId());
        $concept->setLanguage($this->getLanguage());
      }

      $vocabularyId = $concept->getVocabularyId();
    }

    if ($this->isModified())
    {
      if ($this->isNew())
      {
        $action = 'added';
      }
      //this is untested since we don't allow this kind of delete
      elseif ($this->isDeleted())
      {
        $action = 'force_deleted';
      }
      else
      {
        $action = 'updated';
      }
    }
    Else
    {
      $action = 'added';
    }

    //continue with save
    parent::save();

    //do the history
    $history = new ConceptPropertyHistory();

    if ($action == 'updated' && $this->getDeletedAt())
    {
      $action = 'deleted';
    }

    $history->setAction($action);
    $history->setVocabularyId($vocabularyId);
    $history->setConceptId($this->getConceptId());
    $history->setConceptPropertyId($this->getId());
    $history->setSkosPropertyId($this->getSkosPropertyId());
    $history->setObject($this->getObject());
    $history->setSchemeId($this->getSchemeId());
    $history->setRelatedConceptId($this->getRelatedConceptId());
    $history->setLanguage($this->getLanguage());
    $history->setStatusId($this->getStatusId());
    $history->setCreatedUserId($this->getUpdatedUserId());
    $history->setCreatedAt($this->getUpdatedAt());
      if ( ! empty($this->importId)) {
          $history->setImportId($this->importId);
      }
    $history->save();
  }

  /**
  * returns the last property history older than the supplied timestamp
  *
  * @return ConceptPropertyHistory
  * @param  date $ts (optional) If null returns the latest
  */
  public function getLastHistoryByTimestamp($ts = null)
  {
    $c = new Criteria();
    $c->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

    if ($ts)
    {
      $c->add(ConceptPropertyHistoryPeer::CREATED_AT, $ts, Criteria::LESS_EQUAL);
    }

    $c->addDescendingOrderByColumn(ConceptPropertyHistoryPeer::CREATED_AT);
    $c->setLimit(1);

    $result = ConceptPropertyHistoryPeer::doSelect($c);
    $result = (count($result) == 1) ? $result[0] : false;

    return $result;

  } //getLastHistoryByTimestamp

    /**
     * Get the associated ProfileProperty object
     *
     * @param      Connection Optional Connection object.
     * @return     ProfileProperty The associated ProfileProperty object.
     * @throws     PropelException
     */
    public function getProfileProperty($con = null)
    {
        if ($this->aProfileProperty === null && ($this->skos_property_id !== null)) {
            // include the related Peer class
            include_once 'lib/model/om/BaseProfilePropertyPeer.php';

            if ($con === null) {
                $con = \Propel::getConnection(\ProfilePropertyPeer::DATABASE_NAME);
            }

            $criteria = new \Criteria(ProfilePropertyPeer::DATABASE_NAME);
            $criteria->add(\ProfilePropertyPeer::SKOS_ID, $this->skos_property_id);

            $v = ProfilePropertyPeer::doSelect($criteria, $con);

            $this->aProfileProperty = !empty($v) > 0 ? $v[0] : null;

        }

        return $this->aProfileProperty;
    }

    /**
     * Get the associated ProfileProperty object
     *
     * @param      Connection Optional Connection object.
     * @return     ProfileProperty The associated ProfileProperty object.
     * @throws     PropelException
     */
    public function getSkosProperty($con = null)
    {
        if ($this->aProfileProperty === null && ($this->skos_property_id !== null)) {
            // include the related Peer class
            include_once 'lib/model/om/BaseProfilePropertyPeer.php';
            $c = new \Criteria();
            $c->add(\ProfilePropertyPeer::SKOS_ID, $this->skos_property_id);

            $this->aProfileProperty = ProfilePropertyPeer::doSelect($c, $con);

        }
        return $this->aProfileProperty;
    }


} // ConceptProperty

