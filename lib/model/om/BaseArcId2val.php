<?php

/**
 * Base class that represents a row from the 'arc_id2val' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseArcId2val extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArcId2valPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


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
	 * The value for the val_type field.
	 * @var        boolean
	 */
	protected $val_type = false;

	/**
	 * Collection to store aggregation of collArcG2ts.
	 * @var        array
	 */
	protected $collArcG2ts;

	/**
	 * The criteria used to select the current contents of collArcG2ts.
	 * @var        Criteria
	 */
	protected $lastArcG2tCriteria = null;

	/**
	 * Collection to store aggregation of collArcTriplesRelatedByP.
	 * @var        array
	 */
	protected $collArcTriplesRelatedByP;

	/**
	 * The criteria used to select the current contents of collArcTriplesRelatedByP.
	 * @var        Criteria
	 */
	protected $lastArcTripleRelatedByPCriteria = null;

	/**
	 * Collection to store aggregation of collArcTriplesRelatedByOLangDt.
	 * @var        array
	 */
	protected $collArcTriplesRelatedByOLangDt;

	/**
	 * The criteria used to select the current contents of collArcTriplesRelatedByOLangDt.
	 * @var        Criteria
	 */
	protected $lastArcTripleRelatedByOLangDtCriteria = null;

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
	 * Get the [val_type] column value.
	 * 
	 * @return     boolean
	 */
	public function getValType()
	{

		return $this->val_type;
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
			$this->modifiedColumns[] = ArcId2valPeer::ID;
		}

	} // setId()

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
			$this->modifiedColumns[] = ArcId2valPeer::MISC;
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
			$this->modifiedColumns[] = ArcId2valPeer::VAL;
		}

	} // setVal()

	/**
	 * Set the value of [val_type] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setValType($v)
	{

		if ($this->val_type !== $v || $v === false) {
			$this->val_type = $v;
			$this->modifiedColumns[] = ArcId2valPeer::VAL_TYPE;
		}

	} // setValType()

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

			$this->misc = $rs->getBoolean($startcol + 1);

			$this->val = $rs->getString($startcol + 2);

			$this->val_type = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = ArcId2valPeer::NUM_COLUMNS - ArcId2valPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ArcId2val object", $e);
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

    foreach (sfMixer::getCallables('BaseArcId2val:delete:pre') as $callable)
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
			$con = Propel::getConnection(ArcId2valPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ArcId2valPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseArcId2val:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseArcId2val:save:pre') as $callable)
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
			$con = Propel::getConnection(ArcId2valPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseArcId2val:save:post') as $callable)
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
					$pk = ArcId2valPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ArcId2valPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collArcG2ts !== null) {
				foreach($this->collArcG2ts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collArcTriplesRelatedByP !== null) {
				foreach($this->collArcTriplesRelatedByP as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collArcTriplesRelatedByOLangDt !== null) {
				foreach($this->collArcTriplesRelatedByOLangDt as $referrerFK) {
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


			if (($retval = ArcId2valPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collArcG2ts !== null) {
					foreach($this->collArcG2ts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArcTriplesRelatedByP !== null) {
					foreach($this->collArcTriplesRelatedByP as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collArcTriplesRelatedByOLangDt !== null) {
					foreach($this->collArcTriplesRelatedByOLangDt as $referrerFK) {
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
		$pos = ArcId2valPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMisc();
				break;
			case 2:
				return $this->getVal();
				break;
			case 3:
				return $this->getValType();
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
		$keys = ArcId2valPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMisc(),
			$keys[2] => $this->getVal(),
			$keys[3] => $this->getValType(),
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
		$pos = ArcId2valPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMisc($value);
				break;
			case 2:
				$this->setVal($value);
				break;
			case 3:
				$this->setValType($value);
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
		$keys = ArcId2valPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMisc($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVal($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setValType($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArcId2valPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArcId2valPeer::ID)) $criteria->add(ArcId2valPeer::ID, $this->id);
		if ($this->isColumnModified(ArcId2valPeer::MISC)) $criteria->add(ArcId2valPeer::MISC, $this->misc);
		if ($this->isColumnModified(ArcId2valPeer::VAL)) $criteria->add(ArcId2valPeer::VAL, $this->val);
		if ($this->isColumnModified(ArcId2valPeer::VAL_TYPE)) $criteria->add(ArcId2valPeer::VAL_TYPE, $this->val_type);

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
		$criteria = new Criteria(ArcId2valPeer::DATABASE_NAME);

		$criteria->add(ArcId2valPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ArcId2val (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMisc($this->misc);

		$copyObj->setVal($this->val);

		$copyObj->setValType($this->val_type);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getArcG2ts() as $relObj) {
				$copyObj->addArcG2t($relObj->copy($deepCopy));
			}

			foreach($this->getArcTriplesRelatedByP() as $relObj) {
				$copyObj->addArcTripleRelatedByP($relObj->copy($deepCopy));
			}

			foreach($this->getArcTriplesRelatedByOLangDt() as $relObj) {
				$copyObj->addArcTripleRelatedByOLangDt($relObj->copy($deepCopy));
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
	 * @return     ArcId2val Clone of current object.
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
	 * @return     ArcId2valPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArcId2valPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collArcG2ts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initArcG2ts()
	{
		if ($this->collArcG2ts === null) {
			$this->collArcG2ts = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val has previously
	 * been saved, it will retrieve related ArcG2ts from storage.
	 * If this ArcId2val is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getArcG2ts($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcG2tPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcG2ts === null) {
			if ($this->isNew()) {
			   $this->collArcG2ts = array();
			} else {

				$criteria->add(ArcG2tPeer::G, $this->getId());

				ArcG2tPeer::addSelectColumns($criteria);
				$this->collArcG2ts = ArcG2tPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArcG2tPeer::G, $this->getId());

				ArcG2tPeer::addSelectColumns($criteria);
				if (!isset($this->lastArcG2tCriteria) || !$this->lastArcG2tCriteria->equals($criteria)) {
					$this->collArcG2ts = ArcG2tPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArcG2tCriteria = $criteria;
		return $this->collArcG2ts;
	}

	/**
	 * Returns the number of related ArcG2ts.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countArcG2ts($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcG2tPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ArcG2tPeer::G, $this->getId());

		return ArcG2tPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ArcG2t object to this object
	 * through the ArcG2t foreign key attribute
	 *
	 * @param      ArcG2t $l ArcG2t
	 * @return     void
	 * @throws     PropelException
	 */
	public function addArcG2t(ArcG2t $l)
	{
		$this->collArcG2ts[] = $l;
		$l->setArcId2val($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val is new, it will return
	 * an empty collection; or if this ArcId2val has previously
	 * been saved, it will retrieve related ArcG2ts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcId2val.
	 */
	public function getArcG2tsJoinArcTriple($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseArcG2tPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collArcG2ts === null) {
			if ($this->isNew()) {
				$this->collArcG2ts = array();
			} else {

				$criteria->add(ArcG2tPeer::G, $this->getId());

				$this->collArcG2ts = ArcG2tPeer::doSelectJoinArcTriple($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcG2tPeer::G, $this->getId());

			if (!isset($this->lastArcG2tCriteria) || !$this->lastArcG2tCriteria->equals($criteria)) {
				$this->collArcG2ts = ArcG2tPeer::doSelectJoinArcTriple($criteria, $con);
			}
		}
		$this->lastArcG2tCriteria = $criteria;

		return $this->collArcG2ts;
	}

	/**
	 * Temporary storage of collArcTriplesRelatedByP to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initArcTriplesRelatedByP()
	{
		if ($this->collArcTriplesRelatedByP === null) {
			$this->collArcTriplesRelatedByP = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByP from storage.
	 * If this ArcId2val is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getArcTriplesRelatedByP($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByP === null) {
			if ($this->isNew()) {
			   $this->collArcTriplesRelatedByP = array();
			} else {

				$criteria->add(ArcTriplePeer::P, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArcTriplePeer::P, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				if (!isset($this->lastArcTripleRelatedByPCriteria) || !$this->lastArcTripleRelatedByPCriteria->equals($criteria)) {
					$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArcTripleRelatedByPCriteria = $criteria;
		return $this->collArcTriplesRelatedByP;
	}

	/**
	 * Returns the number of related ArcTriplesRelatedByP.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countArcTriplesRelatedByP($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ArcTriplePeer::P, $this->getId());

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
	public function addArcTripleRelatedByP(ArcTriple $l)
	{
		$this->collArcTriplesRelatedByP[] = $l;
		$l->setArcId2valRelatedByP($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val is new, it will return
	 * an empty collection; or if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByP from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcId2val.
	 */
	public function getArcTriplesRelatedByPJoinArcS2val($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByP === null) {
			if ($this->isNew()) {
				$this->collArcTriplesRelatedByP = array();
			} else {

				$criteria->add(ArcTriplePeer::P, $this->getId());

				$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::P, $this->getId());

			if (!isset($this->lastArcTripleRelatedByPCriteria) || !$this->lastArcTripleRelatedByPCriteria->equals($criteria)) {
				$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		}
		$this->lastArcTripleRelatedByPCriteria = $criteria;

		return $this->collArcTriplesRelatedByP;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val is new, it will return
	 * an empty collection; or if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByP from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcId2val.
	 */
	public function getArcTriplesRelatedByPJoinArcO2val($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByP === null) {
			if ($this->isNew()) {
				$this->collArcTriplesRelatedByP = array();
			} else {

				$criteria->add(ArcTriplePeer::P, $this->getId());

				$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelectJoinArcO2val($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::P, $this->getId());

			if (!isset($this->lastArcTripleRelatedByPCriteria) || !$this->lastArcTripleRelatedByPCriteria->equals($criteria)) {
				$this->collArcTriplesRelatedByP = ArcTriplePeer::doSelectJoinArcO2val($criteria, $con);
			}
		}
		$this->lastArcTripleRelatedByPCriteria = $criteria;

		return $this->collArcTriplesRelatedByP;
	}

	/**
	 * Temporary storage of collArcTriplesRelatedByOLangDt to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initArcTriplesRelatedByOLangDt()
	{
		if ($this->collArcTriplesRelatedByOLangDt === null) {
			$this->collArcTriplesRelatedByOLangDt = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByOLangDt from storage.
	 * If this ArcId2val is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getArcTriplesRelatedByOLangDt($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByOLangDt === null) {
			if ($this->isNew()) {
			   $this->collArcTriplesRelatedByOLangDt = array();
			} else {

				$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

				ArcTriplePeer::addSelectColumns($criteria);
				if (!isset($this->lastArcTripleRelatedByOLangDtCriteria) || !$this->lastArcTripleRelatedByOLangDtCriteria->equals($criteria)) {
					$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastArcTripleRelatedByOLangDtCriteria = $criteria;
		return $this->collArcTriplesRelatedByOLangDt;
	}

	/**
	 * Returns the number of related ArcTriplesRelatedByOLangDt.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countArcTriplesRelatedByOLangDt($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

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
	public function addArcTripleRelatedByOLangDt(ArcTriple $l)
	{
		$this->collArcTriplesRelatedByOLangDt[] = $l;
		$l->setArcId2valRelatedByOLangDt($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val is new, it will return
	 * an empty collection; or if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByOLangDt from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcId2val.
	 */
	public function getArcTriplesRelatedByOLangDtJoinArcS2val($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByOLangDt === null) {
			if ($this->isNew()) {
				$this->collArcTriplesRelatedByOLangDt = array();
			} else {

				$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

				$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

			if (!isset($this->lastArcTripleRelatedByOLangDtCriteria) || !$this->lastArcTripleRelatedByOLangDtCriteria->equals($criteria)) {
				$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelectJoinArcS2val($criteria, $con);
			}
		}
		$this->lastArcTripleRelatedByOLangDtCriteria = $criteria;

		return $this->collArcTriplesRelatedByOLangDt;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ArcId2val is new, it will return
	 * an empty collection; or if this ArcId2val has previously
	 * been saved, it will retrieve related ArcTriplesRelatedByOLangDt from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ArcId2val.
	 */
	public function getArcTriplesRelatedByOLangDtJoinArcO2val($criteria = null, $con = null)
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

		if ($this->collArcTriplesRelatedByOLangDt === null) {
			if ($this->isNew()) {
				$this->collArcTriplesRelatedByOLangDt = array();
			} else {

				$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

				$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelectJoinArcO2val($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ArcTriplePeer::O_LANG_DT, $this->getId());

			if (!isset($this->lastArcTripleRelatedByOLangDtCriteria) || !$this->lastArcTripleRelatedByOLangDtCriteria->equals($criteria)) {
				$this->collArcTriplesRelatedByOLangDt = ArcTriplePeer::doSelectJoinArcO2val($criteria, $con);
			}
		}
		$this->lastArcTripleRelatedByOLangDtCriteria = $criteria;

		return $this->collArcTriplesRelatedByOLangDt;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseArcId2val:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseArcId2val::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseArcId2val
