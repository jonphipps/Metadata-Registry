<?php

/**
 * Base class that represents a row from the 'arc_triple' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseArcTriple extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArcTriplePeer
	 */
	protected static $peer;


	/**
	 * The value for the t field.
	 * @var        int
	 */
	protected $t = 0;


	/**
	 * The value for the s field.
	 * @var        int
	 */
	protected $s = 0;


	/**
	 * The value for the p field.
	 * @var        int
	 */
	protected $p = 0;


	/**
	 * The value for the o field.
	 * @var        int
	 */
	protected $o = 0;


	/**
	 * The value for the o_lang_dt field.
	 * @var        int
	 */
	protected $o_lang_dt = 0;


	/**
	 * The value for the o_comp field.
	 * @var        string
	 */
	protected $o_comp = '';


	/**
	 * The value for the s_type field.
	 * @var        boolean
	 */
	protected $s_type = false;


	/**
	 * The value for the o_type field.
	 * @var        boolean
	 */
	protected $o_type = false;


	/**
	 * The value for the misc field.
	 * @var        boolean
	 */
	protected $misc = false;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

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
	 * Get the [t] column value.
	 * 
	 * @return     int
	 */
	public function getT()
	{

		return $this->t;
	}

	/**
	 * Get the [s] column value.
	 * 
	 * @return     int
	 */
	public function getS()
	{

		return $this->s;
	}

	/**
	 * Get the [p] column value.
	 * 
	 * @return     int
	 */
	public function getP()
	{

		return $this->p;
	}

	/**
	 * Get the [o] column value.
	 * 
	 * @return     int
	 */
	public function getO()
	{

		return $this->o;
	}

	/**
	 * Get the [o_lang_dt] column value.
	 * 
	 * @return     int
	 */
	public function getOLangDt()
	{

		return $this->o_lang_dt;
	}

	/**
	 * Get the [o_comp] column value.
	 * 
	 * @return     string
	 */
	public function getOComp()
	{

		return $this->o_comp;
	}

	/**
	 * Get the [s_type] column value.
	 * 
	 * @return     boolean
	 */
	public function getSType()
	{

		return $this->s_type;
	}

	/**
	 * Get the [o_type] column value.
	 * 
	 * @return     boolean
	 */
	public function getOType()
	{

		return $this->o_type;
	}

	/**
	 * Get the [misc] column value.
	 * 
	 * @return     boolean
	 */
	public function getMisc()
	{

		return $this->misc;
	}

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
	 * Set the value of [t] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setT($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->t !== $v || $v === 0) {
			$this->t = $v;
			$this->modifiedColumns[] = ArcTriplePeer::T;
		}

	} // setT()

	/**
	 * Set the value of [s] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setS($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->s !== $v || $v === 0) {
			$this->s = $v;
			$this->modifiedColumns[] = ArcTriplePeer::S;
		}

	} // setS()

	/**
	 * Set the value of [p] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setP($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->p !== $v || $v === 0) {
			$this->p = $v;
			$this->modifiedColumns[] = ArcTriplePeer::P;
		}

	} // setP()

	/**
	 * Set the value of [o] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setO($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->o !== $v || $v === 0) {
			$this->o = $v;
			$this->modifiedColumns[] = ArcTriplePeer::O;
		}

	} // setO()

	/**
	 * Set the value of [o_lang_dt] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setOLangDt($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->o_lang_dt !== $v || $v === 0) {
			$this->o_lang_dt = $v;
			$this->modifiedColumns[] = ArcTriplePeer::O_LANG_DT;
		}

	} // setOLangDt()

	/**
	 * Set the value of [o_comp] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setOComp($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->o_comp !== $v || $v === '') {
			$this->o_comp = $v;
			$this->modifiedColumns[] = ArcTriplePeer::O_COMP;
		}

	} // setOComp()

	/**
	 * Set the value of [s_type] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setSType($v)
	{

		if ($this->s_type !== $v || $v === false) {
			$this->s_type = $v;
			$this->modifiedColumns[] = ArcTriplePeer::S_TYPE;
		}

	} // setSType()

	/**
	 * Set the value of [o_type] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setOType($v)
	{

		if ($this->o_type !== $v || $v === false) {
			$this->o_type = $v;
			$this->modifiedColumns[] = ArcTriplePeer::O_TYPE;
		}

	} // setOType()

	/**
	 * Set the value of [misc] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setMisc($v)
	{

		if ($this->misc !== $v || $v === false) {
			$this->misc = $v;
			$this->modifiedColumns[] = ArcTriplePeer::MISC;
		}

	} // setMisc()

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
			$this->modifiedColumns[] = ArcTriplePeer::ID;
		}

	} // setId()

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

			$this->t = $rs->getInt($startcol + 0);

			$this->s = $rs->getInt($startcol + 1);

			$this->p = $rs->getInt($startcol + 2);

			$this->o = $rs->getInt($startcol + 3);

			$this->o_lang_dt = $rs->getInt($startcol + 4);

			$this->o_comp = $rs->getString($startcol + 5);

			$this->s_type = $rs->getBoolean($startcol + 6);

			$this->o_type = $rs->getBoolean($startcol + 7);

			$this->misc = $rs->getBoolean($startcol + 8);

			$this->id = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ArcTriple object", $e);
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

    foreach (sfMixer::getCallables('BaseArcTriple:delete:pre') as $callable)
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
			$con = Propel::getConnection(ArcTriplePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ArcTriplePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseArcTriple:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseArcTriple:save:pre') as $callable)
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
			$con = Propel::getConnection(ArcTriplePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseArcTriple:save:post') as $callable)
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
					$pk = ArcTriplePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ArcTriplePeer::doUpdate($this, $con);
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


			if (($retval = ArcTriplePeer::doValidate($this, $columns)) !== true) {
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
		$pos = ArcTriplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getT();
				break;
			case 1:
				return $this->getS();
				break;
			case 2:
				return $this->getP();
				break;
			case 3:
				return $this->getO();
				break;
			case 4:
				return $this->getOLangDt();
				break;
			case 5:
				return $this->getOComp();
				break;
			case 6:
				return $this->getSType();
				break;
			case 7:
				return $this->getOType();
				break;
			case 8:
				return $this->getMisc();
				break;
			case 9:
				return $this->getId();
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
		$keys = ArcTriplePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getT(),
			$keys[1] => $this->getS(),
			$keys[2] => $this->getP(),
			$keys[3] => $this->getO(),
			$keys[4] => $this->getOLangDt(),
			$keys[5] => $this->getOComp(),
			$keys[6] => $this->getSType(),
			$keys[7] => $this->getOType(),
			$keys[8] => $this->getMisc(),
			$keys[9] => $this->getId(),
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
		$pos = ArcTriplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setT($value);
				break;
			case 1:
				$this->setS($value);
				break;
			case 2:
				$this->setP($value);
				break;
			case 3:
				$this->setO($value);
				break;
			case 4:
				$this->setOLangDt($value);
				break;
			case 5:
				$this->setOComp($value);
				break;
			case 6:
				$this->setSType($value);
				break;
			case 7:
				$this->setOType($value);
				break;
			case 8:
				$this->setMisc($value);
				break;
			case 9:
				$this->setId($value);
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
		$keys = ArcTriplePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setT($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setS($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setP($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setO($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOLangDt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOComp($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMisc($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArcTriplePeer::DATABASE_NAME);

		if ($this->isColumnModified(ArcTriplePeer::T)) $criteria->add(ArcTriplePeer::T, $this->t);
		if ($this->isColumnModified(ArcTriplePeer::S)) $criteria->add(ArcTriplePeer::S, $this->s);
		if ($this->isColumnModified(ArcTriplePeer::P)) $criteria->add(ArcTriplePeer::P, $this->p);
		if ($this->isColumnModified(ArcTriplePeer::O)) $criteria->add(ArcTriplePeer::O, $this->o);
		if ($this->isColumnModified(ArcTriplePeer::O_LANG_DT)) $criteria->add(ArcTriplePeer::O_LANG_DT, $this->o_lang_dt);
		if ($this->isColumnModified(ArcTriplePeer::O_COMP)) $criteria->add(ArcTriplePeer::O_COMP, $this->o_comp);
		if ($this->isColumnModified(ArcTriplePeer::S_TYPE)) $criteria->add(ArcTriplePeer::S_TYPE, $this->s_type);
		if ($this->isColumnModified(ArcTriplePeer::O_TYPE)) $criteria->add(ArcTriplePeer::O_TYPE, $this->o_type);
		if ($this->isColumnModified(ArcTriplePeer::MISC)) $criteria->add(ArcTriplePeer::MISC, $this->misc);
		if ($this->isColumnModified(ArcTriplePeer::ID)) $criteria->add(ArcTriplePeer::ID, $this->id);

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
		$criteria = new Criteria(ArcTriplePeer::DATABASE_NAME);

		$criteria->add(ArcTriplePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ArcTriple (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setT($this->t);

		$copyObj->setS($this->s);

		$copyObj->setP($this->p);

		$copyObj->setO($this->o);

		$copyObj->setOLangDt($this->o_lang_dt);

		$copyObj->setOComp($this->o_comp);

		$copyObj->setSType($this->s_type);

		$copyObj->setOType($this->o_type);

		$copyObj->setMisc($this->misc);


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
	 * @return     ArcTriple Clone of current object.
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
	 * @return     ArcTriplePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArcTriplePeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseArcTriple:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseArcTriple::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseArcTriple
