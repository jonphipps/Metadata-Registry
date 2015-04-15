<?php

/**
 * Base class that represents a row from the 'reg_file_import_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseFileImportHistory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FileImportHistoryPeer
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
	 * The value for the map field.
	 * @var        string
	 */
	protected $map;


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
	 * The value for the file_name field.
	 * @var        string
	 */
	protected $file_name;


	/**
	 * The value for the source_file_name field.
	 * @var        string
	 */
	protected $source_file_name;


	/**
	 * The value for the file_type field.
	 * @var        string
	 */
	protected $file_type;


	/**
	 * The value for the batch_id field.
	 * @var        int
	 */
	protected $batch_id;


	/**
	 * The value for the results field.
	 * @var        string
	 */
	protected $results;


	/**
	 * The value for the total_processed_count field.
	 * @var        int
	 */
	protected $total_processed_count;


	/**
	 * The value for the error_count field.
	 * @var        int
	 */
	protected $error_count;


	/**
	 * The value for the success_count field.
	 * @var        int
	 */
	protected $success_count;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        Vocabulary
	 */
	protected $aVocabulary;

	/**
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        Batch
	 */
	protected $aBatch;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorys.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorys;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorys.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryCriteria = null;

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
	 * Get the [map] column value.
	 * 
	 * @return     string
	 */
	public function getMap()
	{

		return $this->map;
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
	 * Get the [file_name] column value.
	 * 
	 * @return     string
	 */
	public function getFileName()
	{

		return $this->file_name;
	}

	/**
	 * Get the [source_file_name] column value.
	 * 
	 * @return     string
	 */
	public function getSourceFileName()
	{

		return $this->source_file_name;
	}

	/**
	 * Get the [file_type] column value.
	 * 
	 * @return     string
	 */
	public function getFileType()
	{

		return $this->file_type;
	}

	/**
	 * Get the [batch_id] column value.
	 * 
	 * @return     int
	 */
	public function getBatchId()
	{

		return $this->batch_id;
	}

	/**
	 * Get the [results] column value.
	 * 
	 * @return     string
	 */
	public function getResults()
	{

		return $this->results;
	}

	/**
	 * Get the [total_processed_count] column value.
	 * 
	 * @return     int
	 */
	public function getTotalProcessedCount()
	{

		return $this->total_processed_count;
	}

	/**
	 * Get the [error_count] column value.
	 * 
	 * @return     int
	 */
	public function getErrorCount()
	{

		return $this->error_count;
	}

	/**
	 * Get the [success_count] column value.
	 * 
	 * @return     int
	 */
	public function getSuccessCount()
	{

		return $this->success_count;
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
			$this->modifiedColumns[] = FileImportHistoryPeer::ID;
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
			$this->modifiedColumns[] = FileImportHistoryPeer::CREATED_AT;
		}

	} // setCreatedAt()

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
			$this->modifiedColumns[] = FileImportHistoryPeer::MAP;
		}

	} // setMap()

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
			$this->modifiedColumns[] = FileImportHistoryPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
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
			$this->modifiedColumns[] = FileImportHistoryPeer::VOCABULARY_ID;
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
			$this->modifiedColumns[] = FileImportHistoryPeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

	} // setSchemaId()

	/**
	 * Set the value of [file_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFileName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_name !== $v) {
			$this->file_name = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::FILE_NAME;
		}

	} // setFileName()

	/**
	 * Set the value of [source_file_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSourceFileName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_file_name !== $v) {
			$this->source_file_name = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::SOURCE_FILE_NAME;
		}

	} // setSourceFileName()

	/**
	 * Set the value of [file_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFileType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_type !== $v) {
			$this->file_type = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::FILE_TYPE;
		}

	} // setFileType()

	/**
	 * Set the value of [batch_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setBatchId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->batch_id !== $v) {
			$this->batch_id = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::BATCH_ID;
		}

		if ($this->aBatch !== null && $this->aBatch->getId() !== $v) {
			$this->aBatch = null;
		}

	} // setBatchId()

	/**
	 * Set the value of [results] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setResults($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->results !== $v) {
			$this->results = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::RESULTS;
		}

	} // setResults()

	/**
	 * Set the value of [total_processed_count] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTotalProcessedCount($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_processed_count !== $v) {
			$this->total_processed_count = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::TOTAL_PROCESSED_COUNT;
		}

	} // setTotalProcessedCount()

	/**
	 * Set the value of [error_count] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setErrorCount($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->error_count !== $v) {
			$this->error_count = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::ERROR_COUNT;
		}

	} // setErrorCount()

	/**
	 * Set the value of [success_count] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSuccessCount($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->success_count !== $v) {
			$this->success_count = $v;
			$this->modifiedColumns[] = FileImportHistoryPeer::SUCCESS_COUNT;
		}

	} // setSuccessCount()

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

			$this->map = $rs->getString($startcol + 2);

			$this->user_id = $rs->getInt($startcol + 3);

			$this->vocabulary_id = $rs->getInt($startcol + 4);

			$this->schema_id = $rs->getInt($startcol + 5);

			$this->file_name = $rs->getString($startcol + 6);

			$this->source_file_name = $rs->getString($startcol + 7);

			$this->file_type = $rs->getString($startcol + 8);

			$this->batch_id = $rs->getInt($startcol + 9);

			$this->results = $rs->getString($startcol + 10);

			$this->total_processed_count = $rs->getInt($startcol + 11);

			$this->error_count = $rs->getInt($startcol + 12);

			$this->success_count = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FileImportHistory object", $e);
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

    foreach (sfMixer::getCallables('BaseFileImportHistory:delete:pre') as $callable)
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
			$con = Propel::getConnection(FileImportHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FileImportHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFileImportHistory:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseFileImportHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(FileImportHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FileImportHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFileImportHistory:save:post') as $callable)
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

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
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

			if ($this->aBatch !== null) {
				if ($this->aBatch->isModified()) {
					$affectedRows += $this->aBatch->save($con);
				}
				$this->setBatch($this->aBatch);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileImportHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += FileImportHistoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSchemaPropertyElementHistorys !== null) {
				foreach($this->collSchemaPropertyElementHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
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

			if ($this->aBatch !== null) {
				if (!$this->aBatch->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBatch->getValidationFailures());
				}
			}


			if (($retval = FileImportHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSchemaPropertyElementHistorys !== null) {
					foreach($this->collSchemaPropertyElementHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = FileImportHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMap();
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
				return $this->getFileName();
				break;
			case 7:
				return $this->getSourceFileName();
				break;
			case 8:
				return $this->getFileType();
				break;
			case 9:
				return $this->getBatchId();
				break;
			case 10:
				return $this->getResults();
				break;
			case 11:
				return $this->getTotalProcessedCount();
				break;
			case 12:
				return $this->getErrorCount();
				break;
			case 13:
				return $this->getSuccessCount();
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
		$keys = FileImportHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getMap(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getVocabularyId(),
			$keys[5] => $this->getSchemaId(),
			$keys[6] => $this->getFileName(),
			$keys[7] => $this->getSourceFileName(),
			$keys[8] => $this->getFileType(),
			$keys[9] => $this->getBatchId(),
			$keys[10] => $this->getResults(),
			$keys[11] => $this->getTotalProcessedCount(),
			$keys[12] => $this->getErrorCount(),
			$keys[13] => $this->getSuccessCount(),
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
		$pos = FileImportHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMap($value);
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
				$this->setFileName($value);
				break;
			case 7:
				$this->setSourceFileName($value);
				break;
			case 8:
				$this->setFileType($value);
				break;
			case 9:
				$this->setBatchId($value);
				break;
			case 10:
				$this->setResults($value);
				break;
			case 11:
				$this->setTotalProcessedCount($value);
				break;
			case 12:
				$this->setErrorCount($value);
				break;
			case 13:
				$this->setSuccessCount($value);
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
		$keys = FileImportHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMap($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVocabularyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSchemaId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFileName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSourceFileName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFileType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBatchId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setResults($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTotalProcessedCount($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setErrorCount($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSuccessCount($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FileImportHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileImportHistoryPeer::ID)) $criteria->add(FileImportHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(FileImportHistoryPeer::CREATED_AT)) $criteria->add(FileImportHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FileImportHistoryPeer::MAP)) $criteria->add(FileImportHistoryPeer::MAP, $this->map);
		if ($this->isColumnModified(FileImportHistoryPeer::USER_ID)) $criteria->add(FileImportHistoryPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(FileImportHistoryPeer::VOCABULARY_ID)) $criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(FileImportHistoryPeer::SCHEMA_ID)) $criteria->add(FileImportHistoryPeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(FileImportHistoryPeer::FILE_NAME)) $criteria->add(FileImportHistoryPeer::FILE_NAME, $this->file_name);
		if ($this->isColumnModified(FileImportHistoryPeer::SOURCE_FILE_NAME)) $criteria->add(FileImportHistoryPeer::SOURCE_FILE_NAME, $this->source_file_name);
		if ($this->isColumnModified(FileImportHistoryPeer::FILE_TYPE)) $criteria->add(FileImportHistoryPeer::FILE_TYPE, $this->file_type);
		if ($this->isColumnModified(FileImportHistoryPeer::BATCH_ID)) $criteria->add(FileImportHistoryPeer::BATCH_ID, $this->batch_id);
		if ($this->isColumnModified(FileImportHistoryPeer::RESULTS)) $criteria->add(FileImportHistoryPeer::RESULTS, $this->results);
		if ($this->isColumnModified(FileImportHistoryPeer::TOTAL_PROCESSED_COUNT)) $criteria->add(FileImportHistoryPeer::TOTAL_PROCESSED_COUNT, $this->total_processed_count);
		if ($this->isColumnModified(FileImportHistoryPeer::ERROR_COUNT)) $criteria->add(FileImportHistoryPeer::ERROR_COUNT, $this->error_count);
		if ($this->isColumnModified(FileImportHistoryPeer::SUCCESS_COUNT)) $criteria->add(FileImportHistoryPeer::SUCCESS_COUNT, $this->success_count);

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
		$criteria = new Criteria(FileImportHistoryPeer::DATABASE_NAME);

		$criteria->add(FileImportHistoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of FileImportHistory (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setMap($this->map);

		$copyObj->setUserId($this->user_id);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setSchemaId($this->schema_id);

		$copyObj->setFileName($this->file_name);

		$copyObj->setSourceFileName($this->source_file_name);

		$copyObj->setFileType($this->file_type);

		$copyObj->setBatchId($this->batch_id);

		$copyObj->setResults($this->results);

		$copyObj->setTotalProcessedCount($this->total_processed_count);

		$copyObj->setErrorCount($this->error_count);

		$copyObj->setSuccessCount($this->success_count);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getSchemaPropertyElementHistorys() as $relObj) {
				$copyObj->addSchemaPropertyElementHistory($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


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
	 * @return     FileImportHistory Clone of current object.
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
	 * @return     FileImportHistoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FileImportHistoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUser($con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->user_id, $con);
			   $obj->addUsers($this);
			 */
		}
		return $this->aUser;
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
	 * Declares an association between this object and a Batch object.
	 *
	 * @param      Batch $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setBatch($v)
	{


		if ($v === null) {
			$this->setBatchId(NULL);
		} else {
			$this->setBatchId($v->getId());
		}


		$this->aBatch = $v;
	}


	/**
	 * Get the associated Batch object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Batch The associated Batch object.
	 * @throws     PropelException
	 */
	public function getBatch($con = null)
	{
		if ($this->aBatch === null && ($this->batch_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseBatchPeer.php';

			$this->aBatch = BatchPeer::retrieveByPK($this->batch_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = BatchPeer::retrieveByPK($this->batch_id, $con);
			   $obj->addBatchs($this);
			 */
		}
		return $this->aBatch;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorys()
	{
		if ($this->collSchemaPropertyElementHistorys === null) {
			$this->collSchemaPropertyElementHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 * If this FileImportHistory is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorys;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

		return SchemaPropertyElementHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElementHistory object to this object
	 * through the SchemaPropertyElementHistory foreign key attribute
	 *
	 * @param      SchemaPropertyElementHistory $l SchemaPropertyElementHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementHistory(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorys[] = $l;
		$l->setFileImportHistory($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinProfileProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileImportHistory is new, it will return
	 * an empty collection; or if this FileImportHistory has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in FileImportHistory.
	 */
	public function getSchemaPropertyElementHistorysJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFileImportHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFileImportHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseFileImportHistory
