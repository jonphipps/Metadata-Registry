<?php

/**
 * Base class that represents a row from the 'roles' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseRoles extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RolesPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the display_name field.
	 * @var        string
	 */
	protected $display_name;


	/**
	 * The value for the all field.
	 * @var        boolean
	 */
	protected $all = false;


	/**
	 * The value for the sort field.
	 * @var        int
	 */
	protected $sort = 0;


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
	 * Collection to store aggregation of collAssignedRoless.
	 * @var        array
	 */
	protected $collAssignedRoless;

	/**
	 * The criteria used to select the current contents of collAssignedRoless.
	 * @var        Criteria
	 */
	protected $lastAssignedRolesCriteria = null;

	/**
	 * Collection to store aggregation of collPermissionRoles.
	 * @var        array
	 */
	protected $collPermissionRoles;

	/**
	 * The criteria used to select the current contents of collPermissionRoles.
	 * @var        Criteria
	 */
	protected $lastPermissionRoleCriteria = null;

	/**
	 * Collection to store aggregation of collRoleUsers.
	 * @var        array
	 */
	protected $collRoleUsers;

	/**
	 * The criteria used to select the current contents of collRoleUsers.
	 * @var        Criteria
	 */
	protected $lastRoleUserCriteria = null;

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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [display_name] column value.
	 * 
	 * @return     string
	 */
	public function getDisplayName()
	{

		return $this->display_name;
	}

	/**
	 * Get the [all] column value.
	 * 
	 * @return     boolean
	 */
	public function getAll()
	{

		return $this->all;
	}

	/**
	 * Get the [sort] column value.
	 * 
	 * @return     int
	 */
	public function getSort()
	{

		return $this->sort;
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
			$this->modifiedColumns[] = RolesPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = RolesPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [display_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDisplayName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->display_name !== $v) {
			$this->display_name = $v;
			$this->modifiedColumns[] = RolesPeer::DISPLAY_NAME;
		}

	} // setDisplayName()

	/**
	 * Set the value of [all] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setAll($v)
	{

		if ($this->all !== $v || $v === false) {
			$this->all = $v;
			$this->modifiedColumns[] = RolesPeer::ALL;
		}

	} // setAll()

	/**
	 * Set the value of [sort] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSort($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sort !== $v || $v === 0) {
			$this->sort = $v;
			$this->modifiedColumns[] = RolesPeer::SORT;
		}

	} // setSort()

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
			$this->modifiedColumns[] = RolesPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RolesPeer::UPDATED_AT;
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

			$this->name = $rs->getString($startcol + 1);

			$this->display_name = $rs->getString($startcol + 2);

			$this->all = $rs->getBoolean($startcol + 3);

			$this->sort = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = RolesPeer::NUM_COLUMNS - RolesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Roles object", $e);
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

    foreach (sfMixer::getCallables('BaseRoles:delete:pre') as $callable)
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
			$con = Propel::getConnection(RolesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RolesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRoles:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseRoles:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(RolesPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RolesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRoles:save:post') as $callable)
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
					$pk = RolesPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RolesPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAssignedRoless !== null) {
				foreach($this->collAssignedRoless as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPermissionRoles !== null) {
				foreach($this->collPermissionRoles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRoleUsers !== null) {
				foreach($this->collRoleUsers as $referrerFK) {
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


			if (($retval = RolesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAssignedRoless !== null) {
					foreach($this->collAssignedRoless as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPermissionRoles !== null) {
					foreach($this->collPermissionRoles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRoleUsers !== null) {
					foreach($this->collRoleUsers as $referrerFK) {
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
		$pos = RolesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getDisplayName();
				break;
			case 3:
				return $this->getAll();
				break;
			case 4:
				return $this->getSort();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
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
		$keys = RolesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDisplayName(),
			$keys[3] => $this->getAll(),
			$keys[4] => $this->getSort(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
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
		$pos = RolesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setDisplayName($value);
				break;
			case 3:
				$this->setAll($value);
				break;
			case 4:
				$this->setSort($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
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
		$keys = RolesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDisplayName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAll($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSort($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RolesPeer::DATABASE_NAME);

		if ($this->isColumnModified(RolesPeer::ID)) $criteria->add(RolesPeer::ID, $this->id);
		if ($this->isColumnModified(RolesPeer::NAME)) $criteria->add(RolesPeer::NAME, $this->name);
		if ($this->isColumnModified(RolesPeer::DISPLAY_NAME)) $criteria->add(RolesPeer::DISPLAY_NAME, $this->display_name);
		if ($this->isColumnModified(RolesPeer::ALL)) $criteria->add(RolesPeer::ALL, $this->all);
		if ($this->isColumnModified(RolesPeer::SORT)) $criteria->add(RolesPeer::SORT, $this->sort);
		if ($this->isColumnModified(RolesPeer::CREATED_AT)) $criteria->add(RolesPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RolesPeer::UPDATED_AT)) $criteria->add(RolesPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(RolesPeer::DATABASE_NAME);

		$criteria->add(RolesPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Roles (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setDisplayName($this->display_name);

		$copyObj->setAll($this->all);

		$copyObj->setSort($this->sort);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getAssignedRoless() as $relObj) {
				$copyObj->addAssignedRoles($relObj->copy($deepCopy));
			}

			foreach($this->getPermissionRoles() as $relObj) {
				$copyObj->addPermissionRole($relObj->copy($deepCopy));
			}

			foreach($this->getRoleUsers() as $relObj) {
				$copyObj->addRoleUser($relObj->copy($deepCopy));
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
	 * @return     Roles Clone of current object.
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
	 * @return     RolesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RolesPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collAssignedRoless to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAssignedRoless()
	{
		if ($this->collAssignedRoless === null) {
			$this->collAssignedRoless = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles has previously
	 * been saved, it will retrieve related AssignedRoless from storage.
	 * If this Roles is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAssignedRoless($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAssignedRoless === null) {
			if ($this->isNew()) {
			   $this->collAssignedRoless = array();
			} else {

				$criteria->add(AssignedRolesPeer::ROLE_ID, $this->getId());

				AssignedRolesPeer::addSelectColumns($criteria);
				$this->collAssignedRoless = AssignedRolesPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AssignedRolesPeer::ROLE_ID, $this->getId());

				AssignedRolesPeer::addSelectColumns($criteria);
				if (!isset($this->lastAssignedRolesCriteria) || !$this->lastAssignedRolesCriteria->equals($criteria)) {
					$this->collAssignedRoless = AssignedRolesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAssignedRolesCriteria = $criteria;
		return $this->collAssignedRoless;
	}

	/**
	 * Returns the number of related AssignedRoless.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAssignedRoless($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AssignedRolesPeer::ROLE_ID, $this->getId());

		return AssignedRolesPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AssignedRoles object to this object
	 * through the AssignedRoles foreign key attribute
	 *
	 * @param      AssignedRoles $l AssignedRoles
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAssignedRoles(AssignedRoles $l)
	{
		$this->collAssignedRoless[] = $l;
		$l->setRoles($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles is new, it will return
	 * an empty collection; or if this Roles has previously
	 * been saved, it will retrieve related AssignedRoless from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Roles.
	 */
	public function getAssignedRolessJoinUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAssignedRolesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAssignedRoless === null) {
			if ($this->isNew()) {
				$this->collAssignedRoless = array();
			} else {

				$criteria->add(AssignedRolesPeer::ROLE_ID, $this->getId());

				$this->collAssignedRoless = AssignedRolesPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AssignedRolesPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastAssignedRolesCriteria) || !$this->lastAssignedRolesCriteria->equals($criteria)) {
				$this->collAssignedRoless = AssignedRolesPeer::doSelectJoinUsers($criteria, $con);
			}
		}
		$this->lastAssignedRolesCriteria = $criteria;

		return $this->collAssignedRoless;
	}

	/**
	 * Temporary storage of collPermissionRoles to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPermissionRoles()
	{
		if ($this->collPermissionRoles === null) {
			$this->collPermissionRoles = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles has previously
	 * been saved, it will retrieve related PermissionRoles from storage.
	 * If this Roles is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPermissionRoles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePermissionRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermissionRoles === null) {
			if ($this->isNew()) {
			   $this->collPermissionRoles = array();
			} else {

				$criteria->add(PermissionRolePeer::ROLE_ID, $this->getId());

				PermissionRolePeer::addSelectColumns($criteria);
				$this->collPermissionRoles = PermissionRolePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PermissionRolePeer::ROLE_ID, $this->getId());

				PermissionRolePeer::addSelectColumns($criteria);
				if (!isset($this->lastPermissionRoleCriteria) || !$this->lastPermissionRoleCriteria->equals($criteria)) {
					$this->collPermissionRoles = PermissionRolePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPermissionRoleCriteria = $criteria;
		return $this->collPermissionRoles;
	}

	/**
	 * Returns the number of related PermissionRoles.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPermissionRoles($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePermissionRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PermissionRolePeer::ROLE_ID, $this->getId());

		return PermissionRolePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PermissionRole object to this object
	 * through the PermissionRole foreign key attribute
	 *
	 * @param      PermissionRole $l PermissionRole
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPermissionRole(PermissionRole $l)
	{
		$this->collPermissionRoles[] = $l;
		$l->setRoles($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles is new, it will return
	 * an empty collection; or if this Roles has previously
	 * been saved, it will retrieve related PermissionRoles from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Roles.
	 */
	public function getPermissionRolesJoinPermissions($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePermissionRolePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermissionRoles === null) {
			if ($this->isNew()) {
				$this->collPermissionRoles = array();
			} else {

				$criteria->add(PermissionRolePeer::ROLE_ID, $this->getId());

				$this->collPermissionRoles = PermissionRolePeer::doSelectJoinPermissions($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PermissionRolePeer::ROLE_ID, $this->getId());

			if (!isset($this->lastPermissionRoleCriteria) || !$this->lastPermissionRoleCriteria->equals($criteria)) {
				$this->collPermissionRoles = PermissionRolePeer::doSelectJoinPermissions($criteria, $con);
			}
		}
		$this->lastPermissionRoleCriteria = $criteria;

		return $this->collPermissionRoles;
	}

	/**
	 * Temporary storage of collRoleUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRoleUsers()
	{
		if ($this->collRoleUsers === null) {
			$this->collRoleUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 * If this Roles is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRoleUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
			   $this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				RoleUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
					$this->collRoleUsers = RoleUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleUserCriteria = $criteria;
		return $this->collRoleUsers;
	}

	/**
	 * Returns the number of related RoleUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRoleUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

		return RoleUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RoleUser object to this object
	 * through the RoleUser foreign key attribute
	 *
	 * @param      RoleUser $l RoleUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoleUser(RoleUser $l)
	{
		$this->collRoleUsers[] = $l;
		$l->setRoles($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Roles is new, it will return
	 * an empty collection; or if this Roles has previously
	 * been saved, it will retrieve related RoleUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Roles.
	 */
	public function getRoleUsersJoinUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleUsers === null) {
			if ($this->isNew()) {
				$this->collRoleUsers = array();
			} else {

				$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

				$this->collRoleUsers = RoleUserPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RoleUserPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastRoleUserCriteria) || !$this->lastRoleUserCriteria->equals($criteria)) {
				$this->collRoleUsers = RoleUserPeer::doSelectJoinUsers($criteria, $con);
			}
		}
		$this->lastRoleUserCriteria = $criteria;

		return $this->collRoleUsers;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRoles:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRoles::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseRoles
