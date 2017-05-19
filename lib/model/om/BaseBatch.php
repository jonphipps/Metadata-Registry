<?php

/**
 * Base class that represents a row from the 'reg_batch' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseBatch extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BatchPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the run_time field.
	 * @var        int
	 */
	protected $run_time;


	/**
	 * The value for the run_description field.
	 * @var        string
	 */
	protected $run_description;


	/**
	 * The value for the object_type field.
	 * @var        string
	 */
	protected $object_type;


	/**
	 * The value for the object_id field.
	 * @var        int
	 */
	protected $object_id;


	/**
	 * The value for the event_time field.
	 * @var        int
	 */
	protected $event_time;


	/**
	 * The value for the event_type field.
	 * @var        string
	 */
	protected $event_type;


	/**
	 * The value for the event_description field.
	 * @var        string
	 */
	protected $event_description;


	/**
	 * The value for the registry_uri field.
	 * @var        string
	 */
	protected $registry_uri;

	/**
	 * Collection to store aggregation of collFileImportHistorys.
	 * @var        array
	 */
	protected $collFileImportHistorys;

	/**
	 * The criteria used to select the current contents of collFileImportHistorys.
	 * @var        Criteria
	 */
	protected $lastFileImportHistoryCriteria = null;

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
	 * Get the [optionally formatted] [run_time] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getRunTime($format = 'Y-m-d H:i:s')
	{

		if ($this->run_time === null || $this->run_time === '') {
			return null;
		} elseif (!is_int($this->run_time)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->run_time);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [run_time] as date/time value: " . var_export($this->run_time, true));
			}
		} else {
			$ts = $this->run_time;
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
	 * Get the [run_description] column value.
	 * 
	 * @return     string
	 */
	public function getRunDescription()
	{

		return $this->run_description;
	}

	/**
	 * Get the [object_type] column value.
	 * 
	 * @return     string
	 */
	public function getObjectType()
	{

		return $this->object_type;
	}

	/**
	 * Get the [object_id] column value.
	 * 
	 * @return     int
	 */
	public function getObjectId()
	{

		return $this->object_id;
	}

	/**
	 * Get the [optionally formatted] [event_time] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getEventTime($format = 'Y-m-d H:i:s')
	{

		if ($this->event_time === null || $this->event_time === '') {
			return null;
		} elseif (!is_int($this->event_time)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->event_time);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [event_time] as date/time value: " . var_export($this->event_time, true));
			}
		} else {
			$ts = $this->event_time;
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
	 * Get the [event_type] column value.
	 * 
	 * @return     string
	 */
	public function getEventType()
	{

		return $this->event_type;
	}

	/**
	 * Get the [event_description] column value.
	 * 
	 * @return     string
	 */
	public function getEventDescription()
	{

		return $this->event_description;
	}

	/**
	 * Get the [registry_uri] column value.
	 * 
	 * @return     string
	 */
	public function getRegistryUri()
	{

		return $this->registry_uri;
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
			$this->modifiedColumns[] = BatchPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [run_time] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRunTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [run_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->run_time !== $ts) {
			$this->run_time = $ts;
			$this->modifiedColumns[] = BatchPeer::RUN_TIME;
		}

	} // setRunTime()

	/**
	 * Set the value of [run_description] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setRunDescription($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->run_description !== $v) {
			$this->run_description = $v;
			$this->modifiedColumns[] = BatchPeer::RUN_DESCRIPTION;
		}

	} // setRunDescription()

	/**
	 * Set the value of [object_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setObjectType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_type !== $v) {
			$this->object_type = $v;
			$this->modifiedColumns[] = BatchPeer::OBJECT_TYPE;
		}

	} // setObjectType()

	/**
	 * Set the value of [object_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setObjectId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = BatchPeer::OBJECT_ID;
		}

	} // setObjectId()

	/**
	 * Set the value of [event_time] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setEventTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [event_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_time !== $ts) {
			$this->event_time = $ts;
			$this->modifiedColumns[] = BatchPeer::EVENT_TIME;
		}

	} // setEventTime()

	/**
	 * Set the value of [event_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEventType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_type !== $v) {
			$this->event_type = $v;
			$this->modifiedColumns[] = BatchPeer::EVENT_TYPE;
		}

	} // setEventType()

	/**
	 * Set the value of [event_description] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEventDescription($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->event_description !== $v) {
			$this->event_description = $v;
			$this->modifiedColumns[] = BatchPeer::EVENT_DESCRIPTION;
		}

	} // setEventDescription()

	/**
	 * Set the value of [registry_uri] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setRegistryUri($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->registry_uri !== $v) {
			$this->registry_uri = $v;
			$this->modifiedColumns[] = BatchPeer::REGISTRY_URI;
		}

	} // setRegistryUri()

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

			$this->run_time = $rs->getTimestamp($startcol + 1, null);

			$this->run_description = $rs->getString($startcol + 2);

			$this->object_type = $rs->getString($startcol + 3);

			$this->object_id = $rs->getInt($startcol + 4);

			$this->event_time = $rs->getTimestamp($startcol + 5, null);

			$this->event_type = $rs->getString($startcol + 6);

			$this->event_description = $rs->getString($startcol + 7);

			$this->registry_uri = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = BatchPeer::NUM_COLUMNS - BatchPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Batch object", $e);
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

    foreach (sfMixer::getCallables('BaseBatch:delete:pre') as $callable)
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
			$con = Propel::getConnection(BatchPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BatchPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseBatch:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseBatch:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BatchPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseBatch:save:post') as $callable)
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BatchPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += BatchPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFileImportHistorys !== null) {
				foreach($this->collFileImportHistorys as $referrerFK) {
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


			if (($retval = BatchPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileImportHistorys !== null) {
					foreach($this->collFileImportHistorys as $referrerFK) {
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
		$pos = BatchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRunTime();
				break;
			case 2:
				return $this->getRunDescription();
				break;
			case 3:
				return $this->getObjectType();
				break;
			case 4:
				return $this->getObjectId();
				break;
			case 5:
				return $this->getEventTime();
				break;
			case 6:
				return $this->getEventType();
				break;
			case 7:
				return $this->getEventDescription();
				break;
			case 8:
				return $this->getRegistryUri();
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
		$keys = BatchPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRunTime(),
			$keys[2] => $this->getRunDescription(),
			$keys[3] => $this->getObjectType(),
			$keys[4] => $this->getObjectId(),
			$keys[5] => $this->getEventTime(),
			$keys[6] => $this->getEventType(),
			$keys[7] => $this->getEventDescription(),
			$keys[8] => $this->getRegistryUri(),
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
		$pos = BatchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRunTime($value);
				break;
			case 2:
				$this->setRunDescription($value);
				break;
			case 3:
				$this->setObjectType($value);
				break;
			case 4:
				$this->setObjectId($value);
				break;
			case 5:
				$this->setEventTime($value);
				break;
			case 6:
				$this->setEventType($value);
				break;
			case 7:
				$this->setEventDescription($value);
				break;
			case 8:
				$this->setRegistryUri($value);
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
		$keys = BatchPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRunTime($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRunDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjectId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEventTime($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEventType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEventDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRegistryUri($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BatchPeer::DATABASE_NAME);

		if ($this->isColumnModified(BatchPeer::ID)) $criteria->add(BatchPeer::ID, $this->id);
		if ($this->isColumnModified(BatchPeer::RUN_TIME)) $criteria->add(BatchPeer::RUN_TIME, $this->run_time);
		if ($this->isColumnModified(BatchPeer::RUN_DESCRIPTION)) $criteria->add(BatchPeer::RUN_DESCRIPTION, $this->run_description);
		if ($this->isColumnModified(BatchPeer::OBJECT_TYPE)) $criteria->add(BatchPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(BatchPeer::OBJECT_ID)) $criteria->add(BatchPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(BatchPeer::EVENT_TIME)) $criteria->add(BatchPeer::EVENT_TIME, $this->event_time);
		if ($this->isColumnModified(BatchPeer::EVENT_TYPE)) $criteria->add(BatchPeer::EVENT_TYPE, $this->event_type);
		if ($this->isColumnModified(BatchPeer::EVENT_DESCRIPTION)) $criteria->add(BatchPeer::EVENT_DESCRIPTION, $this->event_description);
		if ($this->isColumnModified(BatchPeer::REGISTRY_URI)) $criteria->add(BatchPeer::REGISTRY_URI, $this->registry_uri);

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
		$criteria = new Criteria(BatchPeer::DATABASE_NAME);

		$criteria->add(BatchPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Batch (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRunTime($this->run_time);

		$copyObj->setRunDescription($this->run_description);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setEventTime($this->event_time);

		$copyObj->setEventType($this->event_type);

		$copyObj->setEventDescription($this->event_description);

		$copyObj->setRegistryUri($this->registry_uri);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getFileImportHistorys() as $relObj) {
				$copyObj->addFileImportHistory($relObj->copy($deepCopy));
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
	 * @return     Batch Clone of current object.
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
	 * @return     BatchPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BatchPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collFileImportHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileImportHistorys()
	{
		if ($this->collFileImportHistorys === null) {
			$this->collFileImportHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Batch has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 * If this Batch is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileImportHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
			   $this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
					$this->collFileImportHistorys = FileImportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;
		return $this->collFileImportHistorys;
	}

	/**
	 * Returns the number of related FileImportHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileImportHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

		return FileImportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileImportHistory object to this object
	 * through the FileImportHistory foreign key attribute
	 *
	 * @param      FileImportHistory $l FileImportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImportHistory(FileImportHistory $l)
	{
		$this->collFileImportHistorys[] = $l;
		$l->setBatch($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Batch is new, it will return
	 * an empty collection; or if this Batch has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Batch.
	 */
	public function getFileImportHistorysJoinUsersRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Batch is new, it will return
	 * an empty collection; or if this Batch has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Batch.
	 */
	public function getFileImportHistorysJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Batch is new, it will return
	 * an empty collection; or if this Batch has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Batch.
	 */
	public function getFileImportHistorysJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Batch is new, it will return
	 * an empty collection; or if this Batch has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Batch.
	 */
	public function getFileImportHistorysJoinUsersRelatedByImportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::BATCH_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseBatch:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseBatch::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseBatch
