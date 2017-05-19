<?php

/**
 * Base class that represents a row from the 'reg_concept_property_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseConceptPropertyHistory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ConceptPropertyHistoryPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the updated_at field.
	 * @var        int
	 */
	protected $updated_at;


	/**
	 * The value for the action field.
	 * @var        string
	 */
	protected $action;


	/**
	 * The value for the concept_property_id field.
	 * @var        int
	 */
	protected $concept_property_id;


	/**
	 * The value for the concept_id field.
	 * @var        int
	 */
	protected $concept_id;


	/**
	 * The value for the vocabulary_id field.
	 * @var        int
	 */
	protected $vocabulary_id;


	/**
	 * The value for the skos_property_id field.
	 * @var        int
	 */
	protected $skos_property_id;


	/**
	 * The value for the object field.
	 * @var        string
	 */
	protected $object;


	/**
	 * The value for the scheme_id field.
	 * @var        int
	 */
	protected $scheme_id;


	/**
	 * The value for the related_concept_id field.
	 * @var        int
	 */
	protected $related_concept_id;


	/**
	 * The value for the language field.
	 * @var        string
	 */
	protected $language = 'en';


	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id = 1;


	/**
	 * The value for the created_user_id field.
	 * @var        int
	 */
	protected $created_user_id;


	/**
	 * The value for the change_note field.
	 * @var        string
	 */
	protected $change_note;


	/**
	 * The value for the import_id field.
	 * @var        int
	 */
	protected $import_id;


	/**
	 * The value for the profile_property_id field.
	 * @var        int
	 */
	protected $profile_property_id;


	/**
	 * The value for the created_by field.
	 * @var        int
	 */
	protected $created_by;

	/**
	 * @var        ConceptProperty
	 */
	protected $aConceptProperty;

	/**
	 * @var        Concept
	 */
	protected $aConceptRelatedByConceptId;

	/**
	 * @var        Vocabulary
	 */
	protected $aVocabularyRelatedByVocabularyId;

	/**
	 * @var        SkosProperty
	 */
	protected $aSkosProperty;

	/**
	 * @var        Vocabulary
	 */
	protected $aVocabularyRelatedBySchemeId;

	/**
	 * @var        Concept
	 */
	protected $aConceptRelatedByRelatedConceptId;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByCreatedUserId;

	/**
	 * @var        FileImportHistory
	 */
	protected $aFileImportHistory;

	/**
	 * @var        ProfileProperty
	 */
	protected $aProfileProperty;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByCreatedBy;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [action] column value.
	 * 
	 * @return     string
	 */
	public function getAction()
	{

		return $this->action;
	}

	/**
	 * Get the [concept_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getConceptPropertyId()
	{

		return $this->concept_property_id;
	}

	/**
	 * Get the [concept_id] column value.
	 * 
	 * @return     int
	 */
	public function getConceptId()
	{

		return $this->concept_id;
	}

	/**
	 * Get the [vocabulary_id] column value.
	 * 
	 * @return     int
	 */
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	/**
	 * Get the [skos_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getSkosPropertyId()
	{

		return $this->skos_property_id;
	}

	/**
	 * Get the [object] column value.
	 * 
	 * @return     string
	 */
	public function getObject()
	{

		return $this->object;
	}

	/**
	 * Get the [scheme_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemeId()
	{

		return $this->scheme_id;
	}

	/**
	 * Get the [related_concept_id] column value.
	 * 
	 * @return     int
	 */
	public function getRelatedConceptId()
	{

		return $this->related_concept_id;
	}

	/**
	 * Get the [language] column value.
	 * 
	 * @return     string
	 */
	public function getLanguage()
	{

		return $this->language;
	}

	/**
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{

		return $this->status_id;
	}

	/**
	 * Get the [created_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedUserId()
	{

		return $this->created_user_id;
	}

	/**
	 * Get the [change_note] column value.
	 * 
	 * @return     string
	 */
	public function getChangeNote()
	{

		return $this->change_note;
	}

	/**
	 * Get the [import_id] column value.
	 * 
	 * @return     int
	 */
	public function getImportId()
	{

		return $this->import_id;
	}

	/**
	 * Get the [profile_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfilePropertyId()
	{

		return $this->profile_property_id;
	}

	/**
	 * Get the [created_by] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Set the value of [action] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setAction($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action !== $v) {
			$this->action = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::ACTION;
		}

	} // setAction()

	/**
	 * Set the value of [concept_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setConceptPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_property_id !== $v) {
			$this->concept_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}

	} // setConceptPropertyId()

	/**
	 * Set the value of [concept_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setConceptId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_id !== $v) {
			$this->concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CONCEPT_ID;
		}

		if ($this->aConceptRelatedByConceptId !== null && $this->aConceptRelatedByConceptId->getId() !== $v) {
			$this->aConceptRelatedByConceptId = null;
		}

	} // setConceptId()

	/**
	 * Set the value of [vocabulary_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setVocabularyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::VOCABULARY_ID;
		}

		if ($this->aVocabularyRelatedByVocabularyId !== null && $this->aVocabularyRelatedByVocabularyId->getId() !== $v) {
			$this->aVocabularyRelatedByVocabularyId = null;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [skos_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSkosPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->skos_property_id !== $v) {
			$this->skos_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID;
		}

		if ($this->aSkosProperty !== null && $this->aSkosProperty->getId() !== $v) {
			$this->aSkosProperty = null;
		}

	} // setSkosPropertyId()

	/**
	 * Set the value of [object] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setObject($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object !== $v) {
			$this->object = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::OBJECT;
		}

	} // setObject()

	/**
	 * Set the value of [scheme_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheme_id !== $v) {
			$this->scheme_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::SCHEME_ID;
		}

		if ($this->aVocabularyRelatedBySchemeId !== null && $this->aVocabularyRelatedBySchemeId->getId() !== $v) {
			$this->aVocabularyRelatedBySchemeId = null;
		}

	} // setSchemeId()

	/**
	 * Set the value of [related_concept_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRelatedConceptId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->related_concept_id !== $v) {
			$this->related_concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID;
		}

		if ($this->aConceptRelatedByRelatedConceptId !== null && $this->aConceptRelatedByRelatedConceptId->getId() !== $v) {
			$this->aConceptRelatedByRelatedConceptId = null;
		}

	} // setRelatedConceptId()

	/**
	 * Set the value of [language] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLanguage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v || $v === 'en') {
			$this->language = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::LANGUAGE;
		}

	} // setLanguage()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStatusId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} // setStatusId()

	/**
	 * Set the value of [created_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_user_id !== $v) {
			$this->created_user_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CREATED_USER_ID;
		}

		if ($this->aUsersRelatedByCreatedUserId !== null && $this->aUsersRelatedByCreatedUserId->getId() !== $v) {
			$this->aUsersRelatedByCreatedUserId = null;
		}

	} // setCreatedUserId()

	/**
	 * Set the value of [change_note] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setChangeNote($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->change_note !== $v) {
			$this->change_note = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CHANGE_NOTE;
		}

	} // setChangeNote()

	/**
	 * Set the value of [import_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setImportId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->import_id !== $v) {
			$this->import_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::IMPORT_ID;
		}

		if ($this->aFileImportHistory !== null && $this->aFileImportHistory->getId() !== $v) {
			$this->aFileImportHistory = null;
		}

	} // setImportId()

	/**
	 * Set the value of [profile_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setProfilePropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_property_id !== $v) {
			$this->profile_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::PROFILE_PROPERTY_ID;
		}

		if ($this->aProfileProperty !== null && $this->aProfileProperty->getId() !== $v) {
			$this->aProfileProperty = null;
		}

	} // setProfilePropertyId()

	/**
	 * Set the value of [created_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = ConceptPropertyHistoryPeer::CREATED_BY;
		}

		if ($this->aUsersRelatedByCreatedBy !== null && $this->aUsersRelatedByCreatedBy->getId() !== $v) {
			$this->aUsersRelatedByCreatedBy = null;
		}

	} // setCreatedBy()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->action = $rs->getString($startcol + 3);

			$this->concept_property_id = $rs->getInt($startcol + 4);

			$this->concept_id = $rs->getInt($startcol + 5);

			$this->vocabulary_id = $rs->getInt($startcol + 6);

			$this->skos_property_id = $rs->getInt($startcol + 7);

			$this->object = $rs->getString($startcol + 8);

			$this->scheme_id = $rs->getInt($startcol + 9);

			$this->related_concept_id = $rs->getInt($startcol + 10);

			$this->language = $rs->getString($startcol + 11);

			$this->status_id = $rs->getInt($startcol + 12);

			$this->created_user_id = $rs->getInt($startcol + 13);

			$this->change_note = $rs->getString($startcol + 14);

			$this->import_id = $rs->getInt($startcol + 15);

			$this->profile_property_id = $rs->getInt($startcol + 16);

			$this->created_by = $rs->getInt($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 18; // 18 = ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptPropertyHistory object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPropertyHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ConceptPropertyHistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConceptPropertyHistory:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}

			if ($this->aConceptRelatedByConceptId !== null) {
				if ($this->aConceptRelatedByConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByConceptId->save($con);
				}
				$this->setConceptRelatedByConceptId($this->aConceptRelatedByConceptId);
			}

			if ($this->aVocabularyRelatedByVocabularyId !== null) {
				if ($this->aVocabularyRelatedByVocabularyId->isModified()) {
					$affectedRows += $this->aVocabularyRelatedByVocabularyId->save($con);
				}
				$this->setVocabularyRelatedByVocabularyId($this->aVocabularyRelatedByVocabularyId);
			}

			if ($this->aSkosProperty !== null) {
				if ($this->aSkosProperty->isModified()) {
					$affectedRows += $this->aSkosProperty->save($con);
				}
				$this->setSkosProperty($this->aSkosProperty);
			}

			if ($this->aVocabularyRelatedBySchemeId !== null) {
				if ($this->aVocabularyRelatedBySchemeId->isModified()) {
					$affectedRows += $this->aVocabularyRelatedBySchemeId->save($con);
				}
				$this->setVocabularyRelatedBySchemeId($this->aVocabularyRelatedBySchemeId);
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if ($this->aConceptRelatedByRelatedConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByRelatedConceptId->save($con);
				}
				$this->setConceptRelatedByRelatedConceptId($this->aConceptRelatedByRelatedConceptId);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->aUsersRelatedByCreatedUserId !== null) {
				if ($this->aUsersRelatedByCreatedUserId->isModified()) {
					$affectedRows += $this->aUsersRelatedByCreatedUserId->save($con);
				}
				$this->setUsersRelatedByCreatedUserId($this->aUsersRelatedByCreatedUserId);
			}

			if ($this->aFileImportHistory !== null) {
				if ($this->aFileImportHistory->isModified()) {
					$affectedRows += $this->aFileImportHistory->save($con);
				}
				$this->setFileImportHistory($this->aFileImportHistory);
			}

			if ($this->aProfileProperty !== null) {
				if ($this->aProfileProperty->isModified()) {
					$affectedRows += $this->aProfileProperty->save($con);
				}
				$this->setProfileProperty($this->aProfileProperty);
			}

			if ($this->aUsersRelatedByCreatedBy !== null) {
				if ($this->aUsersRelatedByCreatedBy->isModified()) {
					$affectedRows += $this->aUsersRelatedByCreatedBy->save($con);
				}
				$this->setUsersRelatedByCreatedBy($this->aUsersRelatedByCreatedBy);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPropertyHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ConceptPropertyHistoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aConceptProperty !== null) {
				if (!$this->aConceptProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptProperty->getValidationFailures());
				}
			}

			if ($this->aConceptRelatedByConceptId !== null) {
				if (!$this->aConceptRelatedByConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByConceptId->getValidationFailures());
				}
			}

			if ($this->aVocabularyRelatedByVocabularyId !== null) {
				if (!$this->aVocabularyRelatedByVocabularyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabularyRelatedByVocabularyId->getValidationFailures());
				}
			}

			if ($this->aSkosProperty !== null) {
				if (!$this->aSkosProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSkosProperty->getValidationFailures());
				}
			}

			if ($this->aVocabularyRelatedBySchemeId !== null) {
				if (!$this->aVocabularyRelatedBySchemeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabularyRelatedBySchemeId->getValidationFailures());
				}
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if (!$this->aConceptRelatedByRelatedConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByRelatedConceptId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByCreatedUserId !== null) {
				if (!$this->aUsersRelatedByCreatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByCreatedUserId->getValidationFailures());
				}
			}

			if ($this->aFileImportHistory !== null) {
				if (!$this->aFileImportHistory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFileImportHistory->getValidationFailures());
				}
			}

			if ($this->aProfileProperty !== null) {
				if (!$this->aProfileProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfileProperty->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByCreatedBy !== null) {
				if (!$this->aUsersRelatedByCreatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByCreatedBy->getValidationFailures());
				}
			}


			if (($retval = ConceptPropertyHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPropertyHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getAction();
				break;
			case 4:
				return $this->getConceptPropertyId();
				break;
			case 5:
				return $this->getConceptId();
				break;
			case 6:
				return $this->getVocabularyId();
				break;
			case 7:
				return $this->getSkosPropertyId();
				break;
			case 8:
				return $this->getObject();
				break;
			case 9:
				return $this->getSchemeId();
				break;
			case 10:
				return $this->getRelatedConceptId();
				break;
			case 11:
				return $this->getLanguage();
				break;
			case 12:
				return $this->getStatusId();
				break;
			case 13:
				return $this->getCreatedUserId();
				break;
			case 14:
				return $this->getChangeNote();
				break;
			case 15:
				return $this->getImportId();
				break;
			case 16:
				return $this->getProfilePropertyId();
				break;
			case 17:
				return $this->getCreatedBy();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getAction(),
			$keys[4] => $this->getConceptPropertyId(),
			$keys[5] => $this->getConceptId(),
			$keys[6] => $this->getVocabularyId(),
			$keys[7] => $this->getSkosPropertyId(),
			$keys[8] => $this->getObject(),
			$keys[9] => $this->getSchemeId(),
			$keys[10] => $this->getRelatedConceptId(),
			$keys[11] => $this->getLanguage(),
			$keys[12] => $this->getStatusId(),
			$keys[13] => $this->getCreatedUserId(),
			$keys[14] => $this->getChangeNote(),
			$keys[15] => $this->getImportId(),
			$keys[16] => $this->getProfilePropertyId(),
			$keys[17] => $this->getCreatedBy(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPropertyHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setAction($value);
				break;
			case 4:
				$this->setConceptPropertyId($value);
				break;
			case 5:
				$this->setConceptId($value);
				break;
			case 6:
				$this->setVocabularyId($value);
				break;
			case 7:
				$this->setSkosPropertyId($value);
				break;
			case 8:
				$this->setObject($value);
				break;
			case 9:
				$this->setSchemeId($value);
				break;
			case 10:
				$this->setRelatedConceptId($value);
				break;
			case 11:
				$this->setLanguage($value);
				break;
			case 12:
				$this->setStatusId($value);
				break;
			case 13:
				$this->setCreatedUserId($value);
				break;
			case 14:
				$this->setChangeNote($value);
				break;
			case 15:
				$this->setImportId($value);
				break;
			case 16:
				$this->setProfilePropertyId($value);
				break;
			case 17:
				$this->setCreatedBy($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAction($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setConceptPropertyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConceptId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setVocabularyId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSkosPropertyId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setObject($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSchemeId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRelatedConceptId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLanguage($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStatusId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedUserId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setChangeNote($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setImportId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setProfilePropertyId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCreatedBy($arr[$keys[17]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPropertyHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPropertyHistoryPeer::ID)) $criteria->add(ConceptPropertyHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_AT)) $criteria->add(ConceptPropertyHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::UPDATED_AT)) $criteria->add(ConceptPropertyHistoryPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::ACTION)) $criteria->add(ConceptPropertyHistoryPeer::ACTION, $this->action);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID)) $criteria->add(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CONCEPT_ID)) $criteria->add(ConceptPropertyHistoryPeer::CONCEPT_ID, $this->concept_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::VOCABULARY_ID)) $criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID)) $criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->skos_property_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::OBJECT)) $criteria->add(ConceptPropertyHistoryPeer::OBJECT, $this->object);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::SCHEME_ID)) $criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->scheme_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID)) $criteria->add(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, $this->related_concept_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::LANGUAGE)) $criteria->add(ConceptPropertyHistoryPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::STATUS_ID)) $criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_USER_ID)) $criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CHANGE_NOTE)) $criteria->add(ConceptPropertyHistoryPeer::CHANGE_NOTE, $this->change_note);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::IMPORT_ID)) $criteria->add(ConceptPropertyHistoryPeer::IMPORT_ID, $this->import_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::PROFILE_PROPERTY_ID)) $criteria->add(ConceptPropertyHistoryPeer::PROFILE_PROPERTY_ID, $this->profile_property_id);
		if ($this->isColumnModified(ConceptPropertyHistoryPeer::CREATED_BY)) $criteria->add(ConceptPropertyHistoryPeer::CREATED_BY, $this->created_by);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptPropertyHistoryPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyHistoryPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ConceptPropertyHistory (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setAction($this->action);

		$copyObj->setConceptPropertyId($this->concept_property_id);

		$copyObj->setConceptId($this->concept_id);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setSkosPropertyId($this->skos_property_id);

		$copyObj->setObject($this->object);

		$copyObj->setSchemeId($this->scheme_id);

		$copyObj->setRelatedConceptId($this->related_concept_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setChangeNote($this->change_note);

		$copyObj->setImportId($this->import_id);

		$copyObj->setProfilePropertyId($this->profile_property_id);

		$copyObj->setCreatedBy($this->created_by);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     ConceptPropertyHistory Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ConceptPropertyHistoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptPropertyHistoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ConceptProperty object.
	 *
	 * @param      ConceptProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setConceptPropertyId(NULL);
		} else {
			$this->setConceptPropertyId($v->getId());
		}


		$this->aConceptProperty = $v;
	}


	/**
	 * Get the associated ConceptProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     ConceptProperty The associated ConceptProperty object.
	 * @throws     PropelException
	 */
	public function getConceptProperty($con = null)
	{
		if ($this->aConceptProperty === null && ($this->concept_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseConceptPropertyPeer.php';

			$this->aConceptProperty = ConceptPropertyPeer::retrieveByPK($this->concept_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPropertyPeer::retrieveByPK($this->concept_property_id, $con);
			   $obj->addConceptPropertys($this);
			 */
		}
		return $this->aConceptProperty;
	}

	/**
	 * Declares an association between this object and a Concept object.
	 *
	 * @param      Concept $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConceptRelatedByConceptId($v)
	{


		if ($v === null) {
			$this->setConceptId(NULL);
		} else {
			$this->setConceptId($v->getId());
		}


		$this->aConceptRelatedByConceptId = $v;
	}


	/**
	 * Get the associated Concept object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concept The associated Concept object.
	 * @throws     PropelException
	 */
	public function getConceptRelatedByConceptId($con = null)
	{
		if ($this->aConceptRelatedByConceptId === null && ($this->concept_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseConceptPeer.php';

			$this->aConceptRelatedByConceptId = ConceptPeer::retrieveByPK($this->concept_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPeer::retrieveByPK($this->concept_id, $con);
			   $obj->addConceptsRelatedByConceptId($this);
			 */
		}
		return $this->aConceptRelatedByConceptId;
	}

	/**
	 * Declares an association between this object and a Vocabulary object.
	 *
	 * @param      Vocabulary $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setVocabularyRelatedByVocabularyId($v)
	{


		if ($v === null) {
			$this->setVocabularyId(NULL);
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabularyRelatedByVocabularyId = $v;
	}


	/**
	 * Get the associated Vocabulary object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Vocabulary The associated Vocabulary object.
	 * @throws     PropelException
	 */
	public function getVocabularyRelatedByVocabularyId($con = null)
	{
		if ($this->aVocabularyRelatedByVocabularyId === null && ($this->vocabulary_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseVocabularyPeer.php';

			$this->aVocabularyRelatedByVocabularyId = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);
			   $obj->addVocabularysRelatedByVocabularyId($this);
			 */
		}
		return $this->aVocabularyRelatedByVocabularyId;
	}

	/**
	 * Declares an association between this object and a SkosProperty object.
	 *
	 * @param      SkosProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSkosProperty($v)
	{


		if ($v === null) {
			$this->setSkosPropertyId(NULL);
		} else {
			$this->setSkosPropertyId($v->getId());
		}


		$this->aSkosProperty = $v;
	}


	/**
	 * Get the associated SkosProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SkosProperty The associated SkosProperty object.
	 * @throws     PropelException
	 */
	public function getSkosProperty($con = null)
	{
		if ($this->aSkosProperty === null && ($this->skos_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSkosPropertyPeer.php';

			$this->aSkosProperty = SkosPropertyPeer::retrieveByPK($this->skos_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SkosPropertyPeer::retrieveByPK($this->skos_property_id, $con);
			   $obj->addSkosPropertys($this);
			 */
		}
		return $this->aSkosProperty;
	}

	/**
	 * Declares an association between this object and a Vocabulary object.
	 *
	 * @param      Vocabulary $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setVocabularyRelatedBySchemeId($v)
	{


		if ($v === null) {
			$this->setSchemeId(NULL);
		} else {
			$this->setSchemeId($v->getId());
		}


		$this->aVocabularyRelatedBySchemeId = $v;
	}


	/**
	 * Get the associated Vocabulary object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Vocabulary The associated Vocabulary object.
	 * @throws     PropelException
	 */
	public function getVocabularyRelatedBySchemeId($con = null)
	{
		if ($this->aVocabularyRelatedBySchemeId === null && ($this->scheme_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseVocabularyPeer.php';

			$this->aVocabularyRelatedBySchemeId = VocabularyPeer::retrieveByPK($this->scheme_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = VocabularyPeer::retrieveByPK($this->scheme_id, $con);
			   $obj->addVocabularysRelatedBySchemeId($this);
			 */
		}
		return $this->aVocabularyRelatedBySchemeId;
	}

	/**
	 * Declares an association between this object and a Concept object.
	 *
	 * @param      Concept $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConceptRelatedByRelatedConceptId($v)
	{


		if ($v === null) {
			$this->setRelatedConceptId(NULL);
		} else {
			$this->setRelatedConceptId($v->getId());
		}


		$this->aConceptRelatedByRelatedConceptId = $v;
	}


	/**
	 * Get the associated Concept object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concept The associated Concept object.
	 * @throws     PropelException
	 */
	public function getConceptRelatedByRelatedConceptId($con = null)
	{
		if ($this->aConceptRelatedByRelatedConceptId === null && ($this->related_concept_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseConceptPeer.php';

			$this->aConceptRelatedByRelatedConceptId = ConceptPeer::retrieveByPK($this->related_concept_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPeer::retrieveByPK($this->related_concept_id, $con);
			   $obj->addConceptsRelatedByRelatedConceptId($this);
			 */
		}
		return $this->aConceptRelatedByRelatedConceptId;
	}

	/**
	 * Declares an association between this object and a Status object.
	 *
	 * @param      Status $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setStatus($v)
	{


		if ($v === null) {
			$this->setStatusId('1');
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aStatus = $v;
	}


	/**
	 * Get the associated Status object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Status The associated Status object.
	 * @throws     PropelException
	 */
	public function getStatus($con = null)
	{
		if ($this->aStatus === null && ($this->status_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseStatusPeer.php';

			$this->aStatus = StatusPeer::retrieveByPK($this->status_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = StatusPeer::retrieveByPK($this->status_id, $con);
			   $obj->addStatuss($this);
			 */
		}
		return $this->aStatus;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByCreatedUserId($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUsersRelatedByCreatedUserId = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByCreatedUserId($con = null)
	{
		if ($this->aUsersRelatedByCreatedUserId === null && ($this->created_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByCreatedUserId = UsersPeer::retrieveByPK($this->created_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->created_user_id, $con);
			   $obj->addUserssRelatedByCreatedUserId($this);
			 */
		}
		return $this->aUsersRelatedByCreatedUserId;
	}

	/**
	 * Declares an association between this object and a FileImportHistory object.
	 *
	 * @param      FileImportHistory $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setFileImportHistory($v)
	{


		if ($v === null) {
			$this->setImportId(NULL);
		} else {
			$this->setImportId($v->getId());
		}


		$this->aFileImportHistory = $v;
	}


	/**
	 * Get the associated FileImportHistory object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     FileImportHistory The associated FileImportHistory object.
	 * @throws     PropelException
	 */
	public function getFileImportHistory($con = null)
	{
		if ($this->aFileImportHistory === null && ($this->import_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseFileImportHistoryPeer.php';

			$this->aFileImportHistory = FileImportHistoryPeer::retrieveByPK($this->import_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = FileImportHistoryPeer::retrieveByPK($this->import_id, $con);
			   $obj->addFileImportHistorys($this);
			 */
		}
		return $this->aFileImportHistory;
	}

	/**
	 * Declares an association between this object and a ProfileProperty object.
	 *
	 * @param      ProfileProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProfileProperty($v)
	{


		if ($v === null) {
			$this->setProfilePropertyId(NULL);
		} else {
			$this->setProfilePropertyId($v->getId());
		}


		$this->aProfileProperty = $v;
	}


	/**
	 * Get the associated ProfileProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     ProfileProperty The associated ProfileProperty object.
	 * @throws     PropelException
	 */
	public function getProfileProperty($con = null)
	{
		if ($this->aProfileProperty === null && ($this->profile_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProfilePropertyPeer.php';

			$this->aProfileProperty = ProfilePropertyPeer::retrieveByPK($this->profile_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProfilePropertyPeer::retrieveByPK($this->profile_property_id, $con);
			   $obj->addProfilePropertys($this);
			 */
		}
		return $this->aProfileProperty;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByCreatedBy($v)
	{


		if ($v === null) {
			$this->setCreatedBy(NULL);
		} else {
			$this->setCreatedBy($v->getId());
		}


		$this->aUsersRelatedByCreatedBy = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByCreatedBy($con = null)
	{
		if ($this->aUsersRelatedByCreatedBy === null && ($this->created_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByCreatedBy = UsersPeer::retrieveByPK($this->created_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->created_by, $con);
			   $obj->addUserssRelatedByCreatedBy($this);
			 */
		}
		return $this->aUsersRelatedByCreatedBy;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConceptPropertyHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConceptPropertyHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseConceptPropertyHistory
