<?php

/**
 * Base class that represents a row from the 'history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseHistory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HistoryPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the type_id field.
	 * @var        int
	 */
	protected $type_id;


	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id = 0;


	/**
	 * The value for the entity_id field.
	 * @var        int
	 */
	protected $entity_id;


	/**
	 * The value for the icon field.
	 * @var        string
	 */
	protected $icon;


	/**
	 * The value for the class field.
	 * @var        string
	 */
	protected $class;


	/**
	 * The value for the text field.
	 * @var        string
	 */
	protected $text;


	/**
	 * The value for the assets field.
	 * @var        string
	 */
	protected $assets;


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
	 * @var        HistoryTypes
	 */
	protected $aHistoryTypes;

	/**
	 * @var        Users
	 */
	protected $aUsers;

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
	 * Get the [type_id] column value.
	 * 
	 * @return     int
	 */
	public function getTypeId()
	{

		return $this->type_id;
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
	 * Get the [entity_id] column value.
	 * 
	 * @return     int
	 */
	public function getEntityId()
	{

		return $this->entity_id;
	}

	/**
	 * Get the [icon] column value.
	 * 
	 * @return     string
	 */
	public function getIcon()
	{

		return $this->icon;
	}

	/**
	 * Get the [class] column value.
	 * 
	 * @return     string
	 */
	public function getClass()
	{

		return $this->class;
	}

	/**
	 * Get the [text] column value.
	 * 
	 * @return     string
	 */
	public function getText()
	{

		return $this->text;
	}

	/**
	 * Get the [assets] column value.
	 * 
	 * @return     string
	 */
	public function getAssets()
	{

		return $this->assets;
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
			$this->modifiedColumns[] = HistoryPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_id !== $v) {
			$this->type_id = $v;
			$this->modifiedColumns[] = HistoryPeer::TYPE_ID;
		}

		if ($this->aHistoryTypes !== null && $this->aHistoryTypes->getId() !== $v) {
			$this->aHistoryTypes = null;
		}

	} // setTypeId()

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

		if ($this->user_id !== $v || $v === 0) {
			$this->user_id = $v;
			$this->modifiedColumns[] = HistoryPeer::USER_ID;
		}

		if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
			$this->aUsers = null;
		}

	} // setUserId()

	/**
	 * Set the value of [entity_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setEntityId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->entity_id !== $v) {
			$this->entity_id = $v;
			$this->modifiedColumns[] = HistoryPeer::ENTITY_ID;
		}

	} // setEntityId()

	/**
	 * Set the value of [icon] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setIcon($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = HistoryPeer::ICON;
		}

	} // setIcon()

	/**
	 * Set the value of [class] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setClass($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->class !== $v) {
			$this->class = $v;
			$this->modifiedColumns[] = HistoryPeer::CLASS;
		}

	} // setClass()

	/**
	 * Set the value of [text] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setText($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = HistoryPeer::TEXT;
		}

	} // setText()

	/**
	 * Set the value of [assets] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setAssets($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->assets !== $v) {
			$this->assets = $v;
			$this->modifiedColumns[] = HistoryPeer::ASSETS;
		}

	} // setAssets()

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
			$this->modifiedColumns[] = HistoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = HistoryPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

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

			$this->type_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->entity_id = $rs->getInt($startcol + 3);

			$this->icon = $rs->getString($startcol + 4);

			$this->class = $rs->getString($startcol + 5);

			$this->text = $rs->getString($startcol + 6);

			$this->assets = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = HistoryPeer::NUM_COLUMNS - HistoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating History object", $e);
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

    foreach (sfMixer::getCallables('BaseHistory:delete:pre') as $callable)
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
			$con = Propel::getConnection(HistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHistory:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseHistory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(HistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(HistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHistory:save:post') as $callable)
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

			if ($this->aHistoryTypes !== null) {
				if ($this->aHistoryTypes->isModified()) {
					$affectedRows += $this->aHistoryTypes->save($con);
				}
				$this->setHistoryTypes($this->aHistoryTypes);
			}

			if ($this->aUsers !== null) {
				if ($this->aUsers->isModified()) {
					$affectedRows += $this->aUsers->save($con);
				}
				$this->setUsers($this->aUsers);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HistoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += HistoryPeer::doUpdate($this, $con);
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

			if ($this->aHistoryTypes !== null) {
				if (!$this->aHistoryTypes->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHistoryTypes->getValidationFailures());
				}
			}

			if ($this->aUsers !== null) {
				if (!$this->aUsers->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsers->getValidationFailures());
				}
			}


			if (($retval = HistoryPeer::doValidate($this, $columns)) !== true) {
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
		$pos = HistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTypeId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getEntityId();
				break;
			case 4:
				return $this->getIcon();
				break;
			case 5:
				return $this->getClass();
				break;
			case 6:
				return $this->getText();
				break;
			case 7:
				return $this->getAssets();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
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
		$keys = HistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getEntityId(),
			$keys[4] => $this->getIcon(),
			$keys[5] => $this->getClass(),
			$keys[6] => $this->getText(),
			$keys[7] => $this->getAssets(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
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
		$pos = HistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTypeId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setEntityId($value);
				break;
			case 4:
				$this->setIcon($value);
				break;
			case 5:
				$this->setClass($value);
				break;
			case 6:
				$this->setText($value);
				break;
			case 7:
				$this->setAssets($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
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
		$keys = HistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEntityId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIcon($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setClass($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setText($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAssets($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(HistoryPeer::ID)) $criteria->add(HistoryPeer::ID, $this->id);
		if ($this->isColumnModified(HistoryPeer::TYPE_ID)) $criteria->add(HistoryPeer::TYPE_ID, $this->type_id);
		if ($this->isColumnModified(HistoryPeer::USER_ID)) $criteria->add(HistoryPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(HistoryPeer::ENTITY_ID)) $criteria->add(HistoryPeer::ENTITY_ID, $this->entity_id);
		if ($this->isColumnModified(HistoryPeer::ICON)) $criteria->add(HistoryPeer::ICON, $this->icon);
		if ($this->isColumnModified(HistoryPeer::CLASS)) $criteria->add(HistoryPeer::CLASS, $this->class);
		if ($this->isColumnModified(HistoryPeer::TEXT)) $criteria->add(HistoryPeer::TEXT, $this->text);
		if ($this->isColumnModified(HistoryPeer::ASSETS)) $criteria->add(HistoryPeer::ASSETS, $this->assets);
		if ($this->isColumnModified(HistoryPeer::CREATED_AT)) $criteria->add(HistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HistoryPeer::UPDATED_AT)) $criteria->add(HistoryPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(HistoryPeer::DATABASE_NAME);

		$criteria->add(HistoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of History (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTypeId($this->type_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setEntityId($this->entity_id);

		$copyObj->setIcon($this->icon);

		$copyObj->setClass($this->class);

		$copyObj->setText($this->text);

		$copyObj->setAssets($this->assets);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
	 * @return     History Clone of current object.
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
	 * @return     HistoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HistoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a HistoryTypes object.
	 *
	 * @param      HistoryTypes $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setHistoryTypes($v)
	{


		if ($v === null) {
			$this->setTypeId(NULL);
		} else {
			$this->setTypeId($v->getId());
		}


		$this->aHistoryTypes = $v;
	}


	/**
	 * Get the associated HistoryTypes object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     HistoryTypes The associated HistoryTypes object.
	 * @throws     PropelException
	 */
	public function getHistoryTypes($con = null)
	{
		if ($this->aHistoryTypes === null && ($this->type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseHistoryTypesPeer.php';

			$this->aHistoryTypes = HistoryTypesPeer::retrieveByPK($this->type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = HistoryTypesPeer::retrieveByPK($this->type_id, $con);
			   $obj->addHistoryTypess($this);
			 */
		}
		return $this->aHistoryTypes;
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
			$this->setUserId('0');
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


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHistory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHistory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseHistory
