<?php

/**
 * Base class that represents a row from the 'arc_o2val' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseArcO2val extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArcO2valPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the cid field.
	 * @var        int
	 */
	protected $cid = 0;


	/**
	 * The value for the misc field.
	 * @var        boolean
	 */
	protected $misc = false;


	/**
	 * The value for the val field.
	 * @var        string
	 */
	protected $val;

	/**
	 * Collection to store aggregation of collArcTriples.
	 * @var        array
	 */
	protected $collArcTriples;

	/**
	 * The criteria used to select the current contents of collArcTriples.
	 * @var        Criteria
	 */
	protected $lastArcTripleCriteria = null;

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
	 * Get the [cid] column value.
	 * 
	 * @return     int
	 */
	public function getCid()
	{

		return $this->cid;
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
	 * Get the [val] column value.
	 * 
	 * @return     string
	 */
	public function getVal()
	{

		return $this->val;
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
			$this->modifiedColumns[] = ArcO2valPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [cid] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCid($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cid !== $v || $v === 0) {
			$this->cid = $v;
			$this->modifiedColumns[] = ArcO2valPeer::CID;
		}

	} // setCid()

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
			$this->modifiedColumns[] = ArcO2valPeer::MISC;
		}

	} // setMisc()

	/**
	 * Set the value of [val] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVal($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->val !== $v) {
			$this->val = $v;
			$this->modifiedColumns[] = ArcO2valPeer::VAL;
		}

	} // setVal()

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

			$this->cid = $rs->getInt($startcol + 1);

			$this->misc = $rs->getBoolean($startcol + 2);

			$this->val = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = ArcO2valPeer::NUM_COLUMNS - ArcO2valPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ArcO2val object", $e);
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

    foreach (sfMixer::getCallables('BaseArcO2val:delete:pre') as $callable)
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
			$con = Propel::getConnection(ArcO2valPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ArcO2valPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseArcO2val:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseArcO2val:save:pre') as $callable)
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
			$con = Propel::getConnection(ArcO2valPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseArcO2val:save:post') as $callable)
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
					$pk = ArcO2valPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ArcO2valPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collArcTriples !== null) {
				foreach($this->collArcTriples as $referrerFK) {
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


			if (($retval = ArcO2valPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collArcTriples !== null) {
					foreach($this->collArcTriples as $referrerFK) {
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
		$pos = ArcO2valPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCid();
				break;
			case 2:
				return $this->getMisc();
				break;
			case 3:
				return $this->getVal();
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
		$keys = ArcO2valPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCid(),
			$keys[2] => $this->getMisc(),
			$keys[3] => $this->getVal(),
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
		$pos = ArcO2valPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCid($value);
				break;
			case 2:
				$this->setMisc($value);
				break;
			case 3:
				$this->setVal($value);
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
		$keys = ArcO2valPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMisc($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVal($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArcO2valPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArcO2valPeer::ID)) $criteria->add(ArcO2valPeer::ID, $this->id);
		if ($this->isColumnModified(ArcO2valPeer::CID)) $criteria->add(ArcO2valPeer::CID, $this->cid);
		if ($this->isColumnModified(ArcO2valPeer::MISC)) $criteria->add(ArcO2valPeer::MISC, $this->misc);
		if ($this->isColumnModified(ArcO2valPeer::VAL)) $criteria->add(ArcO2valPeer::VAL, $this->val);

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
		$criteria = new Criteria(ArcO2valPeer::DATABASE_NAME);

		$criteria->add(ArcO2valPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ArcO2val (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCid($this->cid);

		$copyObj->setMisc($this->misc);

		$copyObj->setVal($this->val);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getArcTriples() as $relObj) {
				$copyObj->addArcTriple($relObj->copy($deepCopy));
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
	 * @return     ArcO2val Clone of current object.
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
	 * @return     ArcO2valPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArcO2valPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collArcTriples to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initArcTriples()
	{
		if ($this->collArcTriples === null) {
			$this->collArcTriples = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcO2val has previously
	 * been saved, it will retrieve related ArcTriples from storage.
	 * If this ArcO2val is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getArcTriples($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcTriplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcTriples === null) {
			if ($this->isNew()) {
			   $this->collArcTriples = array();
			} else {

				$criteria->add(ArcTriplePeer::O, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				$this->collArcTriples = ArcTriplePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArcTriplePeer::O, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				if (!isset($this->lastArcTripleCriteria) || !$this->lastArcTripleCriteria->equals($criteria)) {
					$this->collArcTriples = ArcTriplePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArcTripleCriteria = $criteria;
		return $this->collArcTriples;
	}

	/**
	 * Returns the number of related ArcTriples.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countArcTriples($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcTriplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ArcTriplePeer::O, $this->getId());

		return ArcTriplePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ArcTriple object to this object
	 * through the ArcTriple foreign key attribute
	 *
	 * @param      ArcTriple $l ArcTriple
	 * @return     void
	 * @throws     PropelException
	 */
	public function addArcTriple(ArcTriple $l)
	{
		$this->collArcTriples[] = $l;
		$l->setArcO2val($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcO2val is new, it will return
	 * an empty collection; or if this ArcO2val has previously
	 * been saved, it will retrieve related ArcTriples from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcO2val.
	 */
	public function getArcTriplesJoinArcS2val($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcTriplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcTriples === null) {
			if ($this->isNew()) {
				$this->collArcTriples = array();
			} else {

				$criteria->add(ArcTriplePeer::O, $this->getId());

				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::O, $this->getId());

			if (!isset($this->lastArcTripleCriteria) || !$this->lastArcTripleCriteria->equals($criteria)) {
				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		}
		$this->lastArcTripleCriteria = $criteria;

		return $this->collArcTriples;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcO2val is new, it will return
	 * an empty collection; or if this ArcO2val has previously
	 * been saved, it will retrieve related ArcTriples from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcO2val.
	 */
	public function getArcTriplesJoinArcId2valRelatedByP($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcTriplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcTriples === null) {
			if ($this->isNew()) {
				$this->collArcTriples = array();
			} else {

				$criteria->add(ArcTriplePeer::O, $this->getId());

				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcId2valRelatedByP($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::O, $this->getId());

			if (!isset($this->lastArcTripleCriteria) || !$this->lastArcTripleCriteria->equals($criteria)) {
				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcId2valRelatedByP($criteria, $con);
			}
		}
		$this->lastArcTripleCriteria = $criteria;

		return $this->collArcTriples;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcO2val is new, it will return
	 * an empty collection; or if this ArcO2val has previously
	 * been saved, it will retrieve related ArcTriples from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcO2val.
	 */
	public function getArcTriplesJoinArcId2valRelatedByOLangDt($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcTriplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcTriples === null) {
			if ($this->isNew()) {
				$this->collArcTriples = array();
			} else {

				$criteria->add(ArcTriplePeer::O, $this->getId());

				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcId2valRelatedByOLangDt($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::O, $this->getId());

			if (!isset($this->lastArcTripleCriteria) || !$this->lastArcTripleCriteria->equals($criteria)) {
				$this->collArcTriples = ArcTriplePeer::doSelectJoinArcId2valRelatedByOLangDt($criteria, $con);
			}
		}
		$this->lastArcTripleCriteria = $criteria;

		return $this->collArcTriples;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseArcO2val:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseArcO2val::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseArcO2val
