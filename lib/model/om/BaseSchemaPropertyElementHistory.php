<?php

/**
 * Base class that represents a row from the 'reg_schema_property_element_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyElementHistory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SchemaPropertyElementHistoryPeer
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
	 * The value for the created_user_id field.
	 * @var        int
	 */
	protected $created_user_id;


	/**
	 * The value for the action field.
	 * @var        string
	 */
	protected $action;


	/**
	 * The value for the schema_property_element_id field.
	 * @var        int
	 */
	protected $schema_property_element_id;


	/**
	 * The value for the schema_property_id field.
	 * @var        int
	 */
	protected $schema_property_id;


	/**
	 * The value for the schema_id field.
	 * @var        int
	 */
	protected $schema_id;


	/**
	 * The value for the profile_property_id field.
	 * @var        int
	 */
	protected $profile_property_id;


	/**
	 * The value for the object field.
	 * @var        string
	 */
	protected $object;


	/**
	 * The value for the related_schema_property_id field.
	 * @var        int
	 */
	protected $related_schema_property_id;


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
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        SchemaPropertyElement
	 */
	protected $aSchemaPropertyElement;

	/**
	 * @var        SchemaProperty
	 */
	protected $aSchemaPropertyRelatedBySchemaPropertyId;

	/**
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        ProfileProperty
	 */
	protected $aProfileProperty;

	/**
	 * @var        SchemaProperty
	 */
	protected $aSchemaPropertyRelatedByRelatedSchemaPropertyId;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        FileImportHistory
	 */
	protected $aFileImportHistory;

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
	 * Get the [created_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedUserId()
	{

		return $this->created_user_id;
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
	 * Get the [schema_property_element_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaPropertyElementId()
	{

		return $this->schema_property_element_id;
	}

	/**
	 * Get the [schema_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaPropertyId()
	{

		return $this->schema_property_id;
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
	 * Get the [profile_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfilePropertyId()
	{

		return $this->profile_property_id;
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
	 * Get the [related_schema_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getRelatedSchemaPropertyId()
	{

		return $this->related_schema_property_id;
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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::ID;
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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::CREATED_AT;
		}

	} // setCreatedAt()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::CREATED_USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

	} // setCreatedUserId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::ACTION;
		}

	} // setAction()

	/**
	 * Set the value of [schema_property_element_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaPropertyElementId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_property_element_id !== $v) {
			$this->schema_property_element_id = $v;
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID;
		}

		if ($this->aSchemaPropertyElement !== null && $this->aSchemaPropertyElement->getId() !== $v) {
			$this->aSchemaPropertyElement = null;
		}

	} // setSchemaPropertyElementId()

	/**
	 * Set the value of [schema_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_property_id !== $v) {
			$this->schema_property_id = $v;
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID;
		}

		if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null && $this->aSchemaPropertyRelatedBySchemaPropertyId->getId() !== $v) {
			$this->aSchemaPropertyRelatedBySchemaPropertyId = null;
		}

	} // setSchemaPropertyId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

	} // setSchemaId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID;
		}

		if ($this->aProfileProperty !== null && $this->aProfileProperty->getId() !== $v) {
			$this->aProfileProperty = null;
		}

	} // setProfilePropertyId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::OBJECT;
		}

	} // setObject()

	/**
	 * Set the value of [related_schema_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRelatedSchemaPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->related_schema_property_id !== $v) {
			$this->related_schema_property_id = $v;
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID;
		}

		if ($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId !== null && $this->aSchemaPropertyRelatedByRelatedSchemaPropertyId->getId() !== $v) {
			$this->aSchemaPropertyRelatedByRelatedSchemaPropertyId = null;
		}

	} // setRelatedSchemaPropertyId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::LANGUAGE;
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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} // setStatusId()

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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::CHANGE_NOTE;
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
			$this->modifiedColumns[] = SchemaPropertyElementHistoryPeer::IMPORT_ID;
		}

		if ($this->aFileImportHistory !== null && $this->aFileImportHistory->getId() !== $v) {
			$this->aFileImportHistory = null;
		}

	} // setImportId()

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

			$this->created_user_id = $rs->getInt($startcol + 2);

			$this->action = $rs->getString($startcol + 3);

			$this->schema_property_element_id = $rs->getInt($startcol + 4);

			$this->schema_property_id = $rs->getInt($startcol + 5);

			$this->schema_id = $rs->getInt($startcol + 6);

			$this->profile_property_id = $rs->getInt($startcol + 7);

			$this->object = $rs->getString($startcol + 8);

			$this->related_schema_property_id = $rs->getInt($startcol + 9);

			$this->language = $rs->getString($startcol + 10);

			$this->status_id = $rs->getInt($startcol + 11);

			$this->change_note = $rs->getString($startcol + 12);

			$this->import_id = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SchemaPropertyElementHistory object", $e);
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistory:delete:pre') as $callable)
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
			$con = Propel::getConnection(SchemaPropertyElementHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchemaPropertyElementHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistory:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SchemaPropertyElementHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchemaPropertyElementHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistory:save:post') as $callable)
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

			if ($this->aSchemaPropertyElement !== null) {
				if ($this->aSchemaPropertyElement->isModified()) {
					$affectedRows += $this->aSchemaPropertyElement->save($con);
				}
				$this->setSchemaPropertyElement($this->aSchemaPropertyElement);
			}

			if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null) {
				if ($this->aSchemaPropertyRelatedBySchemaPropertyId->isModified()) {
					$affectedRows += $this->aSchemaPropertyRelatedBySchemaPropertyId->save($con);
				}
				$this->setSchemaPropertyRelatedBySchemaPropertyId($this->aSchemaPropertyRelatedBySchemaPropertyId);
			}

			if ($this->aSchema !== null) {
				if ($this->aSchema->isModified()) {
					$affectedRows += $this->aSchema->save($con);
				}
				$this->setSchema($this->aSchema);
			}

			if ($this->aProfileProperty !== null) {
				if ($this->aProfileProperty->isModified()) {
					$affectedRows += $this->aProfileProperty->save($con);
				}
				$this->setProfileProperty($this->aProfileProperty);
			}

			if ($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId !== null) {
				if ($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId->isModified()) {
					$affectedRows += $this->aSchemaPropertyRelatedByRelatedSchemaPropertyId->save($con);
				}
				$this->setSchemaPropertyRelatedByRelatedSchemaPropertyId($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->aFileImportHistory !== null) {
				if ($this->aFileImportHistory->isModified()) {
					$affectedRows += $this->aFileImportHistory->save($con);
				}
				$this->setFileImportHistory($this->aFileImportHistory);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchemaPropertyElementHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SchemaPropertyElementHistoryPeer::doUpdate($this, $con);
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyElement !== null) {
				if (!$this->aSchemaPropertyElement->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyElement->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null) {
				if (!$this->aSchemaPropertyRelatedBySchemaPropertyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyRelatedBySchemaPropertyId->getValidationFailures());
				}
			}

			if ($this->aSchema !== null) {
				if (!$this->aSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchema->getValidationFailures());
				}
			}

			if ($this->aProfileProperty !== null) {
				if (!$this->aProfileProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfileProperty->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId !== null) {
				if (!$this->aSchemaPropertyRelatedByRelatedSchemaPropertyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyRelatedByRelatedSchemaPropertyId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->aFileImportHistory !== null) {
				if (!$this->aFileImportHistory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFileImportHistory->getValidationFailures());
				}
			}


			if (($retval = SchemaPropertyElementHistoryPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SchemaPropertyElementHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedUserId();
				break;
			case 3:
				return $this->getAction();
				break;
			case 4:
				return $this->getSchemaPropertyElementId();
				break;
			case 5:
				return $this->getSchemaPropertyId();
				break;
			case 6:
				return $this->getSchemaId();
				break;
			case 7:
				return $this->getProfilePropertyId();
				break;
			case 8:
				return $this->getObject();
				break;
			case 9:
				return $this->getRelatedSchemaPropertyId();
				break;
			case 10:
				return $this->getLanguage();
				break;
			case 11:
				return $this->getStatusId();
				break;
			case 12:
				return $this->getChangeNote();
				break;
			case 13:
				return $this->getImportId();
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
		$keys = SchemaPropertyElementHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getCreatedUserId(),
			$keys[3] => $this->getAction(),
			$keys[4] => $this->getSchemaPropertyElementId(),
			$keys[5] => $this->getSchemaPropertyId(),
			$keys[6] => $this->getSchemaId(),
			$keys[7] => $this->getProfilePropertyId(),
			$keys[8] => $this->getObject(),
			$keys[9] => $this->getRelatedSchemaPropertyId(),
			$keys[10] => $this->getLanguage(),
			$keys[11] => $this->getStatusId(),
			$keys[12] => $this->getChangeNote(),
			$keys[13] => $this->getImportId(),
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
		$pos = SchemaPropertyElementHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedUserId($value);
				break;
			case 3:
				$this->setAction($value);
				break;
			case 4:
				$this->setSchemaPropertyElementId($value);
				break;
			case 5:
				$this->setSchemaPropertyId($value);
				break;
			case 6:
				$this->setSchemaId($value);
				break;
			case 7:
				$this->setProfilePropertyId($value);
				break;
			case 8:
				$this->setObject($value);
				break;
			case 9:
				$this->setRelatedSchemaPropertyId($value);
				break;
			case 10:
				$this->setLanguage($value);
				break;
			case 11:
				$this->setStatusId($value);
				break;
			case 12:
				$this->setChangeNote($value);
				break;
			case 13:
				$this->setImportId($value);
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
		$keys = SchemaPropertyElementHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAction($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSchemaPropertyElementId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSchemaPropertyId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchemaId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setProfilePropertyId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setObject($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setRelatedSchemaPropertyId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLanguage($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStatusId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setChangeNote($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setImportId($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SchemaPropertyElementHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::ID)) $criteria->add(SchemaPropertyElementHistoryPeer::ID, $this->id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::CREATED_AT)) $criteria->add(SchemaPropertyElementHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::CREATED_USER_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::ACTION)) $criteria->add(SchemaPropertyElementHistoryPeer::ACTION, $this->action);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->schema_property_element_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->schema_property_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::SCHEMA_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->profile_property_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::OBJECT)) $criteria->add(SchemaPropertyElementHistoryPeer::OBJECT, $this->object);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->related_schema_property_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::LANGUAGE)) $criteria->add(SchemaPropertyElementHistoryPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::STATUS_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::CHANGE_NOTE)) $criteria->add(SchemaPropertyElementHistoryPeer::CHANGE_NOTE, $this->change_note);
		if ($this->isColumnModified(SchemaPropertyElementHistoryPeer::IMPORT_ID)) $criteria->add(SchemaPropertyElementHistoryPeer::IMPORT_ID, $this->import_id);

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
		$criteria = new Criteria(SchemaPropertyElementHistoryPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyElementHistoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SchemaPropertyElementHistory (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setAction($this->action);

		$copyObj->setSchemaPropertyElementId($this->schema_property_element_id);

		$copyObj->setSchemaPropertyId($this->schema_property_id);

		$copyObj->setSchemaId($this->schema_id);

		$copyObj->setProfilePropertyId($this->profile_property_id);

		$copyObj->setObject($this->object);

		$copyObj->setRelatedSchemaPropertyId($this->related_schema_property_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setChangeNote($this->change_note);

		$copyObj->setImportId($this->import_id);


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
	 * @return     SchemaPropertyElementHistory Clone of current object.
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
	 * @return     SchemaPropertyElementHistoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SchemaPropertyElementHistoryPeer();
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
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
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
		if ($this->aUser === null && ($this->created_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->created_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->created_user_id, $con);
			   $obj->addUsers($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a SchemaPropertyElement object.
	 *
	 * @param      SchemaPropertyElement $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchemaPropertyElement($v)
	{


		if ($v === null) {
			$this->setSchemaPropertyElementId(NULL);
		} else {
			$this->setSchemaPropertyElementId($v->getId());
		}


		$this->aSchemaPropertyElement = $v;
	}


	/**
	 * Get the associated SchemaPropertyElement object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaPropertyElement The associated SchemaPropertyElement object.
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElement($con = null)
	{
		if ($this->aSchemaPropertyElement === null && ($this->schema_property_element_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';

			$this->aSchemaPropertyElement = SchemaPropertyElementPeer::retrieveByPK($this->schema_property_element_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyElementPeer::retrieveByPK($this->schema_property_element_id, $con);
			   $obj->addSchemaPropertyElements($this);
			 */
		}
		return $this->aSchemaPropertyElement;
	}

	/**
	 * Declares an association between this object and a SchemaProperty object.
	 *
	 * @param      SchemaProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchemaPropertyRelatedBySchemaPropertyId($v)
	{


		if ($v === null) {
			$this->setSchemaPropertyId(NULL);
		} else {
			$this->setSchemaPropertyId($v->getId());
		}


		$this->aSchemaPropertyRelatedBySchemaPropertyId = $v;
	}


	/**
	 * Get the associated SchemaProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaProperty The associated SchemaProperty object.
	 * @throws     PropelException
	 */
	public function getSchemaPropertyRelatedBySchemaPropertyId($con = null)
	{
		if ($this->aSchemaPropertyRelatedBySchemaPropertyId === null && ($this->schema_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyPeer.php';

			$this->aSchemaPropertyRelatedBySchemaPropertyId = SchemaPropertyPeer::retrieveByPK($this->schema_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyPeer::retrieveByPK($this->schema_property_id, $con);
			   $obj->addSchemaPropertysRelatedBySchemaPropertyId($this);
			 */
		}
		return $this->aSchemaPropertyRelatedBySchemaPropertyId;
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
	 * Declares an association between this object and a SchemaProperty object.
	 *
	 * @param      SchemaProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchemaPropertyRelatedByRelatedSchemaPropertyId($v)
	{


		if ($v === null) {
			$this->setRelatedSchemaPropertyId(NULL);
		} else {
			$this->setRelatedSchemaPropertyId($v->getId());
		}


		$this->aSchemaPropertyRelatedByRelatedSchemaPropertyId = $v;
	}


	/**
	 * Get the associated SchemaProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaProperty The associated SchemaProperty object.
	 * @throws     PropelException
	 */
	public function getSchemaPropertyRelatedByRelatedSchemaPropertyId($con = null)
	{
		if ($this->aSchemaPropertyRelatedByRelatedSchemaPropertyId === null && ($this->related_schema_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyPeer.php';

			$this->aSchemaPropertyRelatedByRelatedSchemaPropertyId = SchemaPropertyPeer::retrieveByPK($this->related_schema_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyPeer::retrieveByPK($this->related_schema_property_id, $con);
			   $obj->addSchemaPropertysRelatedByRelatedSchemaPropertyId($this);
			 */
		}
		return $this->aSchemaPropertyRelatedByRelatedSchemaPropertyId;
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSchemaPropertyElementHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSchemaPropertyElementHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseSchemaPropertyElementHistory
