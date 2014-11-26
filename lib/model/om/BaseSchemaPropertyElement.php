<?php

/**
 * Base class that represents a row from the 'reg_schema_property_element' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyElement extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SchemaPropertyElementPeer
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
	 * The value for the deleted_at field.
	 * @var        int
	 */
	protected $deleted_at;


	/**
	 * The value for the created_user_id field.
	 * @var        int
	 */
	protected $created_user_id;


	/**
	 * The value for the updated_user_id field.
	 * @var        int
	 */
	protected $updated_user_id;


	/**
	 * The value for the schema_property_id field.
	 * @var        int
	 */
	protected $schema_property_id;


	/**
	 * The value for the profile_property_id field.
	 * @var        int
	 */
	protected $profile_property_id;


	/**
	 * The value for the is_schema_property field.
	 * @var        boolean
	 */
	protected $is_schema_property;


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
	 * @var        User
	 */
	protected $aUserRelatedByCreatedUserId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByUpdatedUserId;

	/**
	 * @var        SchemaProperty
	 */
	protected $aSchemaPropertyRelatedBySchemaPropertyId;

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
	 * Collection to store aggregation of collDiscusss.
	 * @var        array
	 */
	protected $collDiscusss;

	/**
	 * The criteria used to select the current contents of collDiscusss.
	 * @var        Criteria
	 */
	protected $lastDiscussCriteria = null;

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
	 * Get the [optionally formatted] [deleted_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
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
	 * Get the [updated_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUpdatedUserId()
	{

		return $this->updated_user_id;
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
	 * Get the [profile_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfilePropertyId()
	{

		return $this->profile_property_id;
	}

	/**
	 * Get the [is_schema_property] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSchemaProperty()
	{

		return $this->is_schema_property;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::ID;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Set the value of [deleted_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = SchemaPropertyElementPeer::DELETED_AT;
		}

	} // setDeletedAt()

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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::CREATED_USER_ID;
		}

		if ($this->aUserRelatedByCreatedUserId !== null && $this->aUserRelatedByCreatedUserId->getId() !== $v) {
			$this->aUserRelatedByCreatedUserId = null;
		}

	} // setCreatedUserId()

	/**
	 * Set the value of [updated_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_user_id !== $v) {
			$this->updated_user_id = $v;
			$this->modifiedColumns[] = SchemaPropertyElementPeer::UPDATED_USER_ID;
		}

		if ($this->aUserRelatedByUpdatedUserId !== null && $this->aUserRelatedByUpdatedUserId->getId() !== $v) {
			$this->aUserRelatedByUpdatedUserId = null;
		}

	} // setUpdatedUserId()

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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID;
		}

		if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null && $this->aSchemaPropertyRelatedBySchemaPropertyId->getId() !== $v) {
			$this->aSchemaPropertyRelatedBySchemaPropertyId = null;
		}

	} // setSchemaPropertyId()

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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::PROFILE_PROPERTY_ID;
		}

		if ($this->aProfileProperty !== null && $this->aProfileProperty->getId() !== $v) {
			$this->aProfileProperty = null;
		}

	} // setProfilePropertyId()

	/**
	 * Set the value of [is_schema_property] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsSchemaProperty($v)
	{

		if ($this->is_schema_property !== $v) {
			$this->is_schema_property = $v;
			$this->modifiedColumns[] = SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY;
		}

	} // setIsSchemaProperty()

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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::OBJECT;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::LANGUAGE;
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
			$this->modifiedColumns[] = SchemaPropertyElementPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} // setStatusId()

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

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->created_user_id = $rs->getInt($startcol + 4);

			$this->updated_user_id = $rs->getInt($startcol + 5);

			$this->schema_property_id = $rs->getInt($startcol + 6);

			$this->profile_property_id = $rs->getInt($startcol + 7);

			$this->is_schema_property = $rs->getBoolean($startcol + 8);

			$this->object = $rs->getString($startcol + 9);

			$this->related_schema_property_id = $rs->getInt($startcol + 10);

			$this->language = $rs->getString($startcol + 11);

			$this->status_id = $rs->getInt($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SchemaPropertyElement object", $e);
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElement:delete:pre') as $callable)
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
			$con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchemaPropertyElementPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyElement:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElement:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SchemaPropertyElementPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchemaPropertyElementPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSchemaPropertyElement:save:post') as $callable)
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

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if ($this->aUserRelatedByCreatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByCreatedUserId->save($con);
				}
				$this->setUserRelatedByCreatedUserId($this->aUserRelatedByCreatedUserId);
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if ($this->aUserRelatedByUpdatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByUpdatedUserId->save($con);
				}
				$this->setUserRelatedByUpdatedUserId($this->aUserRelatedByUpdatedUserId);
			}

			if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null) {
				if ($this->aSchemaPropertyRelatedBySchemaPropertyId->isModified()) {
					$affectedRows += $this->aSchemaPropertyRelatedBySchemaPropertyId->save($con);
				}
				$this->setSchemaPropertyRelatedBySchemaPropertyId($this->aSchemaPropertyRelatedBySchemaPropertyId);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchemaPropertyElementPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SchemaPropertyElementPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDiscusss !== null) {
				foreach($this->collDiscusss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if (!$this->aUserRelatedByCreatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedUserId->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if (!$this->aUserRelatedByUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedUserId->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyRelatedBySchemaPropertyId !== null) {
				if (!$this->aSchemaPropertyRelatedBySchemaPropertyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyRelatedBySchemaPropertyId->getValidationFailures());
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


			if (($retval = SchemaPropertyElementPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDiscusss !== null) {
					foreach($this->collDiscusss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = SchemaPropertyElementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getCreatedUserId();
				break;
			case 5:
				return $this->getUpdatedUserId();
				break;
			case 6:
				return $this->getSchemaPropertyId();
				break;
			case 7:
				return $this->getProfilePropertyId();
				break;
			case 8:
				return $this->getIsSchemaProperty();
				break;
			case 9:
				return $this->getObject();
				break;
			case 10:
				return $this->getRelatedSchemaPropertyId();
				break;
			case 11:
				return $this->getLanguage();
				break;
			case 12:
				return $this->getStatusId();
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
		$keys = SchemaPropertyElementPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getCreatedUserId(),
			$keys[5] => $this->getUpdatedUserId(),
			$keys[6] => $this->getSchemaPropertyId(),
			$keys[7] => $this->getProfilePropertyId(),
			$keys[8] => $this->getIsSchemaProperty(),
			$keys[9] => $this->getObject(),
			$keys[10] => $this->getRelatedSchemaPropertyId(),
			$keys[11] => $this->getLanguage(),
			$keys[12] => $this->getStatusId(),
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
		$pos = SchemaPropertyElementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setCreatedUserId($value);
				break;
			case 5:
				$this->setUpdatedUserId($value);
				break;
			case 6:
				$this->setSchemaPropertyId($value);
				break;
			case 7:
				$this->setProfilePropertyId($value);
				break;
			case 8:
				$this->setIsSchemaProperty($value);
				break;
			case 9:
				$this->setObject($value);
				break;
			case 10:
				$this->setRelatedSchemaPropertyId($value);
				break;
			case 11:
				$this->setLanguage($value);
				break;
			case 12:
				$this->setStatusId($value);
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
		$keys = SchemaPropertyElementPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedUserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchemaPropertyId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setProfilePropertyId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSchemaProperty($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setObject($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRelatedSchemaPropertyId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLanguage($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStatusId($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SchemaPropertyElementPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchemaPropertyElementPeer::ID)) $criteria->add(SchemaPropertyElementPeer::ID, $this->id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::CREATED_AT)) $criteria->add(SchemaPropertyElementPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchemaPropertyElementPeer::UPDATED_AT)) $criteria->add(SchemaPropertyElementPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchemaPropertyElementPeer::DELETED_AT)) $criteria->add(SchemaPropertyElementPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(SchemaPropertyElementPeer::CREATED_USER_ID)) $criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::UPDATED_USER_ID)) $criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->updated_user_id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID)) $criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->schema_property_id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID)) $criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->profile_property_id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY)) $criteria->add(SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY, $this->is_schema_property);
		if ($this->isColumnModified(SchemaPropertyElementPeer::OBJECT)) $criteria->add(SchemaPropertyElementPeer::OBJECT, $this->object);
		if ($this->isColumnModified(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID)) $criteria->add(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, $this->related_schema_property_id);
		if ($this->isColumnModified(SchemaPropertyElementPeer::LANGUAGE)) $criteria->add(SchemaPropertyElementPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(SchemaPropertyElementPeer::STATUS_ID)) $criteria->add(SchemaPropertyElementPeer::STATUS_ID, $this->status_id);

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
		$criteria = new Criteria(SchemaPropertyElementPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyElementPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SchemaPropertyElement (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setUpdatedUserId($this->updated_user_id);

		$copyObj->setSchemaPropertyId($this->schema_property_id);

		$copyObj->setProfilePropertyId($this->profile_property_id);

		$copyObj->setIsSchemaProperty($this->is_schema_property);

		$copyObj->setObject($this->object);

		$copyObj->setRelatedSchemaPropertyId($this->related_schema_property_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getDiscusss() as $relObj) {
				$copyObj->addDiscuss($relObj->copy($deepCopy));
			}

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
	 * @return     SchemaPropertyElement Clone of current object.
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
	 * @return     SchemaPropertyElementPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SchemaPropertyElementPeer();
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
	public function setUserRelatedByCreatedUserId($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUserRelatedByCreatedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByCreatedUserId($con = null)
	{
		if ($this->aUserRelatedByCreatedUserId === null && ($this->created_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByCreatedUserId = UserPeer::retrieveByPK($this->created_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->created_user_id, $con);
			   $obj->addUsersRelatedByCreatedUserId($this);
			 */
		}
		return $this->aUserRelatedByCreatedUserId;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setUpdatedUserId(NULL);
		} else {
			$this->setUpdatedUserId($v->getId());
		}


		$this->aUserRelatedByUpdatedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByUpdatedUserId($con = null)
	{
		if ($this->aUserRelatedByUpdatedUserId === null && ($this->updated_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByUpdatedUserId = UserPeer::retrieveByPK($this->updated_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->updated_user_id, $con);
			   $obj->addUsersRelatedByUpdatedUserId($this);
			 */
		}
		return $this->aUserRelatedByUpdatedUserId;
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
	 * Temporary storage of collDiscusss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusss()
	{
		if ($this->collDiscusss === null) {
			$this->collDiscusss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 * If this SchemaPropertyElement is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusss($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
			   $this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusss = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
					$this->collDiscusss = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussCriteria = $criteria;
		return $this->collDiscusss;
	}

	/**
	 * Returns the number of related Discusss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscuss(Discuss $l)
	{
		$this->collDiscusss[] = $l;
		$l->setSchemaPropertyElement($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinUserRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinDiscussRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
	 */
	public function getDiscusssJoinDiscussRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
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
	 * Otherwise if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 * If this SchemaPropertyElement is new, it will return
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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

		$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
		$l->setSchemaPropertyElement($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

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
	 * Otherwise if this SchemaPropertyElement is new, it will return
	 * an empty collection; or if this SchemaPropertyElement has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaPropertyElement.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSchemaPropertyElement:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSchemaPropertyElement::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseSchemaPropertyElement
