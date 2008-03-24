<?php

/**
 * Base class that represents a row from the 'reg_status' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStatus extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StatusPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the display_order field.
	 * @var        int
	 */
	protected $display_order;


	/**
	 * The value for the display_name field.
	 * @var        string
	 */
	protected $display_name;

	/**
	 * Collection to store aggregation of collConcepts.
	 * @var        array
	 */
	protected $collConcepts;

	/**
	 * The criteria used to select the current contents of collConcepts.
	 * @var        Criteria
	 */
	protected $lastConceptCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertys.
	 * @var        array
	 */
	protected $collConceptPropertys;

	/**
	 * The criteria used to select the current contents of collConceptPropertys.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertyHistorys.
	 * @var        array
	 */
	protected $collConceptPropertyHistorys;

	/**
	 * The criteria used to select the current contents of collConceptPropertyHistorys.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyHistoryCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularys.
	 * @var        array
	 */
	protected $collVocabularys;

	/**
	 * The criteria used to select the current contents of collVocabularys.
	 * @var        Criteria
	 */
	protected $lastVocabularyCriteria = null;

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
	 * Get the [display_order] column value.
	 * 
	 * @return     int
	 */
	public function getDisplayOrder()
	{

		return $this->display_order;
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
			$this->modifiedColumns[] = StatusPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [display_order] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDisplayOrder($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->display_order !== $v) {
			$this->display_order = $v;
			$this->modifiedColumns[] = StatusPeer::DISPLAY_ORDER;
		}

	} // setDisplayOrder()

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
			$this->modifiedColumns[] = StatusPeer::DISPLAY_NAME;
		}

	} // setDisplayName()

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

			$this->display_order = $rs->getInt($startcol + 1);

			$this->display_name = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = StatusPeer::NUM_COLUMNS - StatusPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Status object", $e);
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

    foreach (sfMixer::getCallables('BaseStatus:delete:pre') as $callable)
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
			$con = Propel::getConnection(StatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			StatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseStatus:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseStatus:save:pre') as $callable)
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
			$con = Propel::getConnection(StatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseStatus:save:post') as $callable)
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
					$pk = StatusPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StatusPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collConcepts !== null) {
				foreach($this->collConcepts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertys !== null) {
				foreach($this->collConceptPropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorys !== null) {
				foreach($this->collConceptPropertyHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularys !== null) {
				foreach($this->collVocabularys as $referrerFK) {
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


			if (($retval = StatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConcepts !== null) {
					foreach($this->collConcepts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertys !== null) {
					foreach($this->collConceptPropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorys !== null) {
					foreach($this->collConceptPropertyHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularys !== null) {
					foreach($this->collVocabularys as $referrerFK) {
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
		$pos = StatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDisplayOrder();
				break;
			case 2:
				return $this->getDisplayName();
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
		$keys = StatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDisplayOrder(),
			$keys[2] => $this->getDisplayName(),
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
		$pos = StatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDisplayOrder($value);
				break;
			case 2:
				$this->setDisplayName($value);
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
		$keys = StatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDisplayOrder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDisplayName($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(StatusPeer::ID)) $criteria->add(StatusPeer::ID, $this->id);
		if ($this->isColumnModified(StatusPeer::DISPLAY_ORDER)) $criteria->add(StatusPeer::DISPLAY_ORDER, $this->display_order);
		if ($this->isColumnModified(StatusPeer::DISPLAY_NAME)) $criteria->add(StatusPeer::DISPLAY_NAME, $this->display_name);

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
		$criteria = new Criteria(StatusPeer::DATABASE_NAME);

		$criteria->add(StatusPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Status (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDisplayOrder($this->display_order);

		$copyObj->setDisplayName($this->display_name);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getConcepts() as $relObj) {
				$copyObj->addConcept($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularys() as $relObj) {
				$copyObj->addVocabulary($relObj->copy($deepCopy));
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
	 * @return     Status Clone of current object.
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
	 * @return     StatusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StatusPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collConcepts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConcepts()
	{
		if ($this->collConcepts === null) {
			$this->collConcepts = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status has previously
	 * been saved, it will retrieve related Concepts from storage.
	 * If this Status is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConcepts($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
			   $this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
					$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptCriteria = $criteria;
		return $this->collConcepts;
	}

	/**
	 * Returns the number of related Concepts.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConcepts($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setStatus($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptsJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptsJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptsJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptsJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConcepts === null) {
			if ($this->isNew()) {
				$this->collConcepts = array();
			} else {

				$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}

	/**
	 * Temporary storage of collConceptPropertys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertys()
	{
		if ($this->collConceptPropertys === null) {
			$this->collConceptPropertys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 * If this Status is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
					$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;
		return $this->collConceptPropertys;
	}

	/**
	 * Returns the number of related ConceptPropertys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param      ConceptProperty $l ConceptProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setStatus($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}

	/**
	 * Temporary storage of collConceptPropertyHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertyHistorys()
	{
		if ($this->collConceptPropertyHistorys === null) {
			$this->collConceptPropertyHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 * If this Status is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertyHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;
		return $this->collConceptPropertyHistorys;
	}

	/**
	 * Returns the number of related ConceptPropertyHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertyHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

		return ConceptPropertyHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptPropertyHistory object to this object
	 * through the ConceptPropertyHistory foreign key attribute
	 *
	 * @param      ConceptPropertyHistory $l ConceptPropertyHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConceptPropertyHistory(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorys[] = $l;
		$l->setStatus($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinConceptRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinVocabularyRelatedByVocabularyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinVocabularyRelatedBySchemeId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getConceptPropertyHistorysJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPropertyHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertyHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorys = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}

	/**
	 * Temporary storage of collVocabularys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularys()
	{
		if ($this->collVocabularys === null) {
			$this->collVocabularys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 * If this Status is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
			   $this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
					$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyCriteria = $criteria;
		return $this->collVocabularys;
	}

	/**
	 * Returns the number of related Vocabularys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param      Vocabulary $l Vocabulary
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabulary(Vocabulary $l)
	{
		$this->collVocabularys[] = $l;
		$l->setStatus($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getVocabularysJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
				$this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getVocabularysJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
				$this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getVocabularysJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
				$this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Status is new, it will return
	 * an empty collection; or if this Status has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Status.
	 */
	public function getVocabularysJoinUserRelatedByChildUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularys === null) {
			if ($this->isNew()) {
				$this->collVocabularys = array();
			} else {

				$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByChildUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUserRelatedByChildUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseStatus:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseStatus::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseStatus
