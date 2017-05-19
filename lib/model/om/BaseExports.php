<?php

/**
 * Base class that represents a row from the 'exports' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseExports extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ExportsPeer
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
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;


	/**
	 * The value for the vocabulary_id field.
	 * @var        int
	 */
	protected $vocabulary_id;


	/**
	 * The value for the schema_id field.
	 * @var        int
	 */
	protected $schema_id;


	/**
	 * The value for the exclude_deprecated field.
	 * @var        boolean
	 */
	protected $exclude_deprecated = true;


	/**
	 * The value for the include_generated field.
	 * @var        boolean
	 */
	protected $include_generated = true;


	/**
	 * The value for the include_deleted field.
	 * @var        boolean
	 */
	protected $include_deleted = true;


	/**
	 * The value for the include_not_accepted field.
	 * @var        boolean
	 */
	protected $include_not_accepted = false;


	/**
	 * The value for the selected_columns field.
	 * @var        string
	 */
	protected $selected_columns;


	/**
	 * The value for the selected_language field.
	 * @var        string
	 */
	protected $selected_language;


	/**
	 * The value for the published_english_version field.
	 * @var        string
	 */
	protected $published_english_version;


	/**
	 * The value for the published_language_version field.
	 * @var        string
	 */
	protected $published_language_version;


	/**
	 * The value for the last_vocab_update field.
	 * @var        int
	 */
	protected $last_vocab_update;


	/**
	 * The value for the profile_id field.
	 * @var        int
	 */
	protected $profile_id;


	/**
	 * The value for the exported_by field.
	 * @var        int
	 */
	protected $exported_by;


	/**
	 * The value for the file field.
	 * @var        string
	 */
	protected $file;


	/**
	 * The value for the map field.
	 * @var        string
	 */
	protected $map;

	/**
	 * @var        Users
	 */
	protected $aUsers;

	/**
	 * @var        Vocabulary
	 */
	protected $aVocabulary;

	/**
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        Profile
	 */
	protected $aProfile;

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
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{

		return $this->user_id;
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
	 * Get the [schema_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaId()
	{

		return $this->schema_id;
	}

	/**
	 * Get the [exclude_deprecated] column value.
	 * 
	 * @return     boolean
	 */
	public function getExcludeDeprecated()
	{

		return $this->exclude_deprecated;
	}

	/**
	 * Get the [include_generated] column value.
	 * 
	 * @return     boolean
	 */
	public function getIncludeGenerated()
	{

		return $this->include_generated;
	}

	/**
	 * Get the [include_deleted] column value.
	 * 
	 * @return     boolean
	 */
	public function getIncludeDeleted()
	{

		return $this->include_deleted;
	}

	/**
	 * Get the [include_not_accepted] column value.
	 * 
	 * @return     boolean
	 */
	public function getIncludeNotAccepted()
	{

		return $this->include_not_accepted;
	}

	/**
	 * Get the [selected_columns] column value.
	 * 
	 * @return     string
	 */
	public function getSelectedColumns()
	{

		return $this->selected_columns;
	}

	/**
	 * Get the [selected_language] column value.
	 * 
	 * @return     string
	 */
	public function getSelectedLanguage()
	{

		return $this->selected_language;
	}

	/**
	 * Get the [published_english_version] column value.
	 * 
	 * @return     string
	 */
	public function getPublishedEnglishVersion()
	{

		return $this->published_english_version;
	}

	/**
	 * Get the [published_language_version] column value.
	 * 
	 * @return     string
	 */
	public function getPublishedLanguageVersion()
	{

		return $this->published_language_version;
	}

	/**
	 * Get the [optionally formatted] [last_vocab_update] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getLastVocabUpdate($format = 'Y-m-d H:i:s')
	{

		if ($this->last_vocab_update === null || $this->last_vocab_update === '') {
			return null;
		} elseif (!is_int($this->last_vocab_update)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->last_vocab_update);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [last_vocab_update] as date/time value: " . var_export($this->last_vocab_update, true));
			}
		} else {
			$ts = $this->last_vocab_update;
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
	 * Get the [profile_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfileId()
	{

		return $this->profile_id;
	}

	/**
	 * Get the [exported_by] column value.
	 * 
	 * @return     int
	 */
	public function getExportedBy()
	{

		return $this->exported_by;
	}

	/**
	 * Get the [file] column value.
	 * 
	 * @return     string
	 */
	public function getFile()
	{

		return $this->file;
	}

	/**
	 * Get the [map] column value.
	 * 
	 * @return     string
	 */
	public function getMap()
	{

		return $this->map;
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
			$this->modifiedColumns[] = ExportsPeer::ID;
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
			$this->modifiedColumns[] = ExportsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ExportsPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = ExportsPeer::USER_ID;
		}

		if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
			$this->aUsers = null;
		}

	} // setUserId()

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
			$this->modifiedColumns[] = ExportsPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [schema_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_id !== $v) {
			$this->schema_id = $v;
			$this->modifiedColumns[] = ExportsPeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

	} // setSchemaId()

	/**
	 * Set the value of [exclude_deprecated] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setExcludeDeprecated($v)
	{

		if ($this->exclude_deprecated !== $v || $v === true) {
			$this->exclude_deprecated = $v;
			$this->modifiedColumns[] = ExportsPeer::EXCLUDE_DEPRECATED;
		}

	} // setExcludeDeprecated()

	/**
	 * Set the value of [include_generated] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIncludeGenerated($v)
	{

		if ($this->include_generated !== $v || $v === true) {
			$this->include_generated = $v;
			$this->modifiedColumns[] = ExportsPeer::INCLUDE_GENERATED;
		}

	} // setIncludeGenerated()

	/**
	 * Set the value of [include_deleted] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIncludeDeleted($v)
	{

		if ($this->include_deleted !== $v || $v === true) {
			$this->include_deleted = $v;
			$this->modifiedColumns[] = ExportsPeer::INCLUDE_DELETED;
		}

	} // setIncludeDeleted()

	/**
	 * Set the value of [include_not_accepted] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIncludeNotAccepted($v)
	{

		if ($this->include_not_accepted !== $v || $v === false) {
			$this->include_not_accepted = $v;
			$this->modifiedColumns[] = ExportsPeer::INCLUDE_NOT_ACCEPTED;
		}

	} // setIncludeNotAccepted()

	/**
	 * Set the value of [selected_columns] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSelectedColumns($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->selected_columns !== $v) {
			$this->selected_columns = $v;
			$this->modifiedColumns[] = ExportsPeer::SELECTED_COLUMNS;
		}

	} // setSelectedColumns()

	/**
	 * Set the value of [selected_language] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSelectedLanguage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->selected_language !== $v) {
			$this->selected_language = $v;
			$this->modifiedColumns[] = ExportsPeer::SELECTED_LANGUAGE;
		}

	} // setSelectedLanguage()

	/**
	 * Set the value of [published_english_version] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPublishedEnglishVersion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->published_english_version !== $v) {
			$this->published_english_version = $v;
			$this->modifiedColumns[] = ExportsPeer::PUBLISHED_ENGLISH_VERSION;
		}

	} // setPublishedEnglishVersion()

	/**
	 * Set the value of [published_language_version] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPublishedLanguageVersion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->published_language_version !== $v) {
			$this->published_language_version = $v;
			$this->modifiedColumns[] = ExportsPeer::PUBLISHED_LANGUAGE_VERSION;
		}

	} // setPublishedLanguageVersion()

	/**
	 * Set the value of [last_vocab_update] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setLastVocabUpdate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [last_vocab_update] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_vocab_update !== $ts) {
			$this->last_vocab_update = $ts;
			$this->modifiedColumns[] = ExportsPeer::LAST_VOCAB_UPDATE;
		}

	} // setLastVocabUpdate()

	/**
	 * Set the value of [profile_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setProfileId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_id !== $v) {
			$this->profile_id = $v;
			$this->modifiedColumns[] = ExportsPeer::PROFILE_ID;
		}

		if ($this->aProfile !== null && $this->aProfile->getId() !== $v) {
			$this->aProfile = null;
		}

	} // setProfileId()

	/**
	 * Set the value of [exported_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setExportedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->exported_by !== $v) {
			$this->exported_by = $v;
			$this->modifiedColumns[] = ExportsPeer::EXPORTED_BY;
		}

	} // setExportedBy()

	/**
	 * Set the value of [file] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFile($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file !== $v) {
			$this->file = $v;
			$this->modifiedColumns[] = ExportsPeer::FILE;
		}

	} // setFile()

	/**
	 * Set the value of [map] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMap($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->map !== $v) {
			$this->map = $v;
			$this->modifiedColumns[] = ExportsPeer::MAP;
		}

	} // setMap()

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

			$this->user_id = $rs->getInt($startcol + 3);

			$this->vocabulary_id = $rs->getInt($startcol + 4);

			$this->schema_id = $rs->getInt($startcol + 5);

			$this->exclude_deprecated = $rs->getBoolean($startcol + 6);

			$this->include_generated = $rs->getBoolean($startcol + 7);

			$this->include_deleted = $rs->getBoolean($startcol + 8);

			$this->include_not_accepted = $rs->getBoolean($startcol + 9);

			$this->selected_columns = $rs->getString($startcol + 10);

			$this->selected_language = $rs->getString($startcol + 11);

			$this->published_english_version = $rs->getString($startcol + 12);

			$this->published_language_version = $rs->getString($startcol + 13);

			$this->last_vocab_update = $rs->getTimestamp($startcol + 14, null);

			$this->profile_id = $rs->getInt($startcol + 15);

			$this->exported_by = $rs->getInt($startcol + 16);

			$this->file = $rs->getString($startcol + 17);

			$this->map = $rs->getString($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = ExportsPeer::NUM_COLUMNS - ExportsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Exports object", $e);
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

    foreach (sfMixer::getCallables('BaseExports:delete:pre') as $callable)
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
			$con = Propel::getConnection(ExportsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ExportsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseExports:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseExports:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ExportsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ExportsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ExportsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseExports:save:post') as $callable)
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

			if ($this->aUsers !== null) {
				if ($this->aUsers->isModified()) {
					$affectedRows += $this->aUsers->save($con);
				}
				$this->setUsers($this->aUsers);
			}

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}

			if ($this->aSchema !== null) {
				if ($this->aSchema->isModified()) {
					$affectedRows += $this->aSchema->save($con);
				}
				$this->setSchema($this->aSchema);
			}

			if ($this->aProfile !== null) {
				if ($this->aProfile->isModified()) {
					$affectedRows += $this->aProfile->save($con);
				}
				$this->setProfile($this->aProfile);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ExportsPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ExportsPeer::doUpdate($this, $con);
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

			if ($this->aUsers !== null) {
				if (!$this->aUsers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsers->getValidationFailures());
				}
			}

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}

			if ($this->aSchema !== null) {
				if (!$this->aSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchema->getValidationFailures());
				}
			}

			if ($this->aProfile !== null) {
				if (!$this->aProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfile->getValidationFailures());
				}
			}


			if (($retval = ExportsPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ExportsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 4:
				return $this->getVocabularyId();
				break;
			case 5:
				return $this->getSchemaId();
				break;
			case 6:
				return $this->getExcludeDeprecated();
				break;
			case 7:
				return $this->getIncludeGenerated();
				break;
			case 8:
				return $this->getIncludeDeleted();
				break;
			case 9:
				return $this->getIncludeNotAccepted();
				break;
			case 10:
				return $this->getSelectedColumns();
				break;
			case 11:
				return $this->getSelectedLanguage();
				break;
			case 12:
				return $this->getPublishedEnglishVersion();
				break;
			case 13:
				return $this->getPublishedLanguageVersion();
				break;
			case 14:
				return $this->getLastVocabUpdate();
				break;
			case 15:
				return $this->getProfileId();
				break;
			case 16:
				return $this->getExportedBy();
				break;
			case 17:
				return $this->getFile();
				break;
			case 18:
				return $this->getMap();
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
		$keys = ExportsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getVocabularyId(),
			$keys[5] => $this->getSchemaId(),
			$keys[6] => $this->getExcludeDeprecated(),
			$keys[7] => $this->getIncludeGenerated(),
			$keys[8] => $this->getIncludeDeleted(),
			$keys[9] => $this->getIncludeNotAccepted(),
			$keys[10] => $this->getSelectedColumns(),
			$keys[11] => $this->getSelectedLanguage(),
			$keys[12] => $this->getPublishedEnglishVersion(),
			$keys[13] => $this->getPublishedLanguageVersion(),
			$keys[14] => $this->getLastVocabUpdate(),
			$keys[15] => $this->getProfileId(),
			$keys[16] => $this->getExportedBy(),
			$keys[17] => $this->getFile(),
			$keys[18] => $this->getMap(),
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
		$pos = ExportsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 4:
				$this->setVocabularyId($value);
				break;
			case 5:
				$this->setSchemaId($value);
				break;
			case 6:
				$this->setExcludeDeprecated($value);
				break;
			case 7:
				$this->setIncludeGenerated($value);
				break;
			case 8:
				$this->setIncludeDeleted($value);
				break;
			case 9:
				$this->setIncludeNotAccepted($value);
				break;
			case 10:
				$this->setSelectedColumns($value);
				break;
			case 11:
				$this->setSelectedLanguage($value);
				break;
			case 12:
				$this->setPublishedEnglishVersion($value);
				break;
			case 13:
				$this->setPublishedLanguageVersion($value);
				break;
			case 14:
				$this->setLastVocabUpdate($value);
				break;
			case 15:
				$this->setProfileId($value);
				break;
			case 16:
				$this->setExportedBy($value);
				break;
			case 17:
				$this->setFile($value);
				break;
			case 18:
				$this->setMap($value);
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
		$keys = ExportsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVocabularyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSchemaId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setExcludeDeprecated($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIncludeGenerated($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIncludeDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIncludeNotAccepted($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSelectedColumns($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSelectedLanguage($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPublishedEnglishVersion($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPublishedLanguageVersion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLastVocabUpdate($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setProfileId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setExportedBy($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFile($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setMap($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ExportsPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExportsPeer::ID)) $criteria->add(ExportsPeer::ID, $this->id);
		if ($this->isColumnModified(ExportsPeer::CREATED_AT)) $criteria->add(ExportsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ExportsPeer::UPDATED_AT)) $criteria->add(ExportsPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ExportsPeer::USER_ID)) $criteria->add(ExportsPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(ExportsPeer::VOCABULARY_ID)) $criteria->add(ExportsPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(ExportsPeer::SCHEMA_ID)) $criteria->add(ExportsPeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(ExportsPeer::EXCLUDE_DEPRECATED)) $criteria->add(ExportsPeer::EXCLUDE_DEPRECATED, $this->exclude_deprecated);
		if ($this->isColumnModified(ExportsPeer::INCLUDE_GENERATED)) $criteria->add(ExportsPeer::INCLUDE_GENERATED, $this->include_generated);
		if ($this->isColumnModified(ExportsPeer::INCLUDE_DELETED)) $criteria->add(ExportsPeer::INCLUDE_DELETED, $this->include_deleted);
		if ($this->isColumnModified(ExportsPeer::INCLUDE_NOT_ACCEPTED)) $criteria->add(ExportsPeer::INCLUDE_NOT_ACCEPTED, $this->include_not_accepted);
		if ($this->isColumnModified(ExportsPeer::SELECTED_COLUMNS)) $criteria->add(ExportsPeer::SELECTED_COLUMNS, $this->selected_columns);
		if ($this->isColumnModified(ExportsPeer::SELECTED_LANGUAGE)) $criteria->add(ExportsPeer::SELECTED_LANGUAGE, $this->selected_language);
		if ($this->isColumnModified(ExportsPeer::PUBLISHED_ENGLISH_VERSION)) $criteria->add(ExportsPeer::PUBLISHED_ENGLISH_VERSION, $this->published_english_version);
		if ($this->isColumnModified(ExportsPeer::PUBLISHED_LANGUAGE_VERSION)) $criteria->add(ExportsPeer::PUBLISHED_LANGUAGE_VERSION, $this->published_language_version);
		if ($this->isColumnModified(ExportsPeer::LAST_VOCAB_UPDATE)) $criteria->add(ExportsPeer::LAST_VOCAB_UPDATE, $this->last_vocab_update);
		if ($this->isColumnModified(ExportsPeer::PROFILE_ID)) $criteria->add(ExportsPeer::PROFILE_ID, $this->profile_id);
		if ($this->isColumnModified(ExportsPeer::EXPORTED_BY)) $criteria->add(ExportsPeer::EXPORTED_BY, $this->exported_by);
		if ($this->isColumnModified(ExportsPeer::FILE)) $criteria->add(ExportsPeer::FILE, $this->file);
		if ($this->isColumnModified(ExportsPeer::MAP)) $criteria->add(ExportsPeer::MAP, $this->map);

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
		$criteria = new Criteria(ExportsPeer::DATABASE_NAME);

		$criteria->add(ExportsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Exports (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUserId($this->user_id);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setSchemaId($this->schema_id);

		$copyObj->setExcludeDeprecated($this->exclude_deprecated);

		$copyObj->setIncludeGenerated($this->include_generated);

		$copyObj->setIncludeDeleted($this->include_deleted);

		$copyObj->setIncludeNotAccepted($this->include_not_accepted);

		$copyObj->setSelectedColumns($this->selected_columns);

		$copyObj->setSelectedLanguage($this->selected_language);

		$copyObj->setPublishedEnglishVersion($this->published_english_version);

		$copyObj->setPublishedLanguageVersion($this->published_language_version);

		$copyObj->setLastVocabUpdate($this->last_vocab_update);

		$copyObj->setProfileId($this->profile_id);

		$copyObj->setExportedBy($this->exported_by);

		$copyObj->setFile($this->file);

		$copyObj->setMap($this->map);


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
	 * @return     Exports Clone of current object.
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
	 * @return     ExportsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ExportsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsers($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUsers = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsers($con = null)
	{
		if ($this->aUsers === null && ($this->user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsers = UsersPeer::retrieveByPK($this->user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->user_id, $con);
			   $obj->addUserss($this);
			 */
		}
		return $this->aUsers;
	}

	/**
	 * Declares an association between this object and a Vocabulary object.
	 *
	 * @param      Vocabulary $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setVocabularyId(NULL);
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	/**
	 * Get the associated Vocabulary object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Vocabulary The associated Vocabulary object.
	 * @throws     PropelException
	 */
	public function getVocabulary($con = null)
	{
		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseVocabularyPeer.php';

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);
			   $obj->addVocabularys($this);
			 */
		}
		return $this->aVocabulary;
	}

	/**
	 * Declares an association between this object and a Schema object.
	 *
	 * @param      Schema $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchema($v)
	{


		if ($v === null) {
			$this->setSchemaId(NULL);
		} else {
			$this->setSchemaId($v->getId());
		}


		$this->aSchema = $v;
	}


	/**
	 * Get the associated Schema object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Schema The associated Schema object.
	 * @throws     PropelException
	 */
	public function getSchema($con = null)
	{
		if ($this->aSchema === null && ($this->schema_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPeer.php';

			$this->aSchema = SchemaPeer::retrieveByPK($this->schema_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPeer::retrieveByPK($this->schema_id, $con);
			   $obj->addSchemas($this);
			 */
		}
		return $this->aSchema;
	}

	/**
	 * Declares an association between this object and a Profile object.
	 *
	 * @param      Profile $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProfile($v)
	{


		if ($v === null) {
			$this->setProfileId(NULL);
		} else {
			$this->setProfileId($v->getId());
		}


		$this->aProfile = $v;
	}


	/**
	 * Get the associated Profile object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Profile The associated Profile object.
	 * @throws     PropelException
	 */
	public function getProfile($con = null)
	{
		if ($this->aProfile === null && ($this->profile_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProfilePeer.php';

			$this->aProfile = ProfilePeer::retrieveByPK($this->profile_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProfilePeer::retrieveByPK($this->profile_id, $con);
			   $obj->addProfiles($this);
			 */
		}
		return $this->aProfile;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseExports:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseExports::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseExports
