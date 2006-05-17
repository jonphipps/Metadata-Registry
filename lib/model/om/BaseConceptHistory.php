<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/ConceptHistoryPeer.php';

/**
 * Base class that represents a row from the 'reg_concept_history' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseConceptHistory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var ConceptHistoryPeer
	 */
	protected static $peer;


	/**
	 * The value for the sid field.
	 * @var string
	 */
	protected $sid = '';


	/**
	 * The value for the concept_property_id field.
	 * @var int
	 */
	protected $concept_property_id = 0;


	/**
	 * The value for the user_id field.
	 * @var int
	 */
	protected $user_id = 0;


	/**
	 * The value for the changed_at field.
	 * @var int
	 */
	protected $changed_at;


	/**
	 * The value for the old_values field.
	 * @var string
	 */
	protected $old_values;


	/**
	 * The value for the new_values field.
	 * @var string
	 */
	protected $new_values;

	/**
	 * @var User
	 */
	protected $aUser;

	/**
	 * @var ConceptProperty
	 */
	protected $aConceptProperty;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [sid] column value.
	 * 
	 * @return string
	 */
	public function getSid()
	{

		return $this->sid;
	}

	/**
	 * Get the [concept_property_id] column value.
	 * 
	 * @return int
	 */
	public function getConceptPropertyId()
	{

		return $this->concept_property_id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return int
	 */
	public function getUserId()
	{

		return $this->user_id;
	}

	/**
	 * Get the [optionally formatted] [changed_at] column value.
	 * 
	 * @param string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getChangedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->changed_at === null || $this->changed_at === '') {
			return null;
		} elseif (!is_int($this->changed_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->changed_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [changed_at] as date/time value: " . var_export($this->changed_at, true));
			}
		} else {
			$ts = $this->changed_at;
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
	 * Get the [old_values] column value.
	 * 
	 * @return string
	 */
	public function getOldValues()
	{

		return $this->old_values;
	}

	/**
	 * Get the [new_values] column value.
	 * 
	 * @return string
	 */
	public function getNewValues()
	{

		return $this->new_values;
	}

	/**
	 * Set the value of [sid] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setSid($v)
	{

		if ($this->sid !== $v || $v === '') {
			$this->sid = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::SID;
		}

	} // setSid()

	/**
	 * Set the value of [concept_property_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setConceptPropertyId($v)
	{

		if ($this->concept_property_id !== $v || $v === 0) {
			$this->concept_property_id = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::CONCEPT_PROPERTY_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}		

	} // setConceptPropertyId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setUserId($v)
	{

		if ($this->user_id !== $v || $v === 0) {
			$this->user_id = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}		

	} // setUserId()

	/**
	 * Set the value of [changed_at] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setChangedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [changed_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->changed_at !== $ts) {
			$this->changed_at = $ts;
			$this->modifiedColumns[] = ConceptHistoryPeer::CHANGED_AT;
		}

	} // setChangedAt()

	/**
	 * Set the value of [old_values] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setOldValues($v)
	{

		if ($this->old_values !== $v) {
			$this->old_values = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::OLD_VALUES;
		}

	} // setOldValues()

	/**
	 * Set the value of [new_values] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setNewValues($v)
	{

		if ($this->new_values !== $v) {
			$this->new_values = $v;
			$this->modifiedColumns[] = ConceptHistoryPeer::NEW_VALUES;
		}

	} // setNewValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return int next starting column
	 * @throws PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sid = $rs->getString($startcol + 0);

			$this->concept_property_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->changed_at = $rs->getTimestamp($startcol + 3, null);

			$this->old_values = $rs->getString($startcol + 4);

			$this->new_values = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptHistory object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param Connection $con
	 * @return void
	 * @throws PropelException
	 * @see BaseObject::setDeleted()
	 * @see BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
		}
		
		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
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
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see save()
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

			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}
	

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which 
										 // should always be true here (even though technically 
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += ConceptHistoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return array ValidationFailed[]
	 * @see validate()
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
	 * @param mixed $columns Column name or an array of column names.
	 * @return boolean Whether all columns pass validation.
	 * @see doValidate()
	 * @see getValidationFailures()
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
	 * @param array $columns Array of column names to validate.
	 * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
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

			if ($this->aConceptProperty !== null) {
				if (!$this->aConceptProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptProperty->getValidationFailures());
				}
			}


			if (($retval = ConceptHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param string $name name
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param int $pos position in xml schema
	 * @return mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSid();
				break;
			case 1:
				return $this->getConceptPropertyId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getChangedAt();
				break;
			case 4:
				return $this->getOldValues();
				break;
			case 5:
				return $this->getNewValues();
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
	 * @param string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSid(),
			$keys[1] => $this->getConceptPropertyId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getChangedAt(),
			$keys[4] => $this->getOldValues(),
			$keys[5] => $this->getNewValues(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param string $name peer name
	 * @param mixed $value field value
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param int $pos position in xml schema
	 * @param mixed $value field value
	 * @return void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSid($value);
				break;
			case 1:
				$this->setConceptPropertyId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setChangedAt($value);
				break;
			case 4:
				$this->setOldValues($value);
				break;
			case 5:
				$this->setNewValues($value);
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
	 * @param array  $arr     An array to populate the object from.
	 * @param string $keyType The type of keys the array uses.
	 * @return void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setConceptPropertyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setChangedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOldValues($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNewValues($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptHistoryPeer::SID)) $criteria->add(ConceptHistoryPeer::SID, $this->sid);
		if ($this->isColumnModified(ConceptHistoryPeer::CONCEPT_PROPERTY_ID)) $criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);
		if ($this->isColumnModified(ConceptHistoryPeer::USER_ID)) $criteria->add(ConceptHistoryPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(ConceptHistoryPeer::CHANGED_AT)) $criteria->add(ConceptHistoryPeer::CHANGED_AT, $this->changed_at);
		if ($this->isColumnModified(ConceptHistoryPeer::OLD_VALUES)) $criteria->add(ConceptHistoryPeer::OLD_VALUES, $this->old_values);
		if ($this->isColumnModified(ConceptHistoryPeer::NEW_VALUES)) $criteria->add(ConceptHistoryPeer::NEW_VALUES, $this->new_values);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptHistoryPeer::DATABASE_NAME);

		$criteria->add(ConceptHistoryPeer::SID, $this->sid);
		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getSid();

		$pks[1] = $this->getConceptPropertyId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param array $keys The elements of the composite key (order must match the order in XML file).
	 * @return void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setSid($keys[0]);

		$this->setConceptPropertyId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 * 
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param object $copyObj An object of ConceptHistory (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setChangedAt($this->changed_at);

		$copyObj->setOldValues($this->old_values);

		$copyObj->setNewValues($this->new_values);


		$copyObj->setNew(true);

		$copyObj->setSid(''); // this is a pkey column, so set to default value

		$copyObj->setConceptPropertyId(''); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 * 
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return ConceptHistory Clone of current object.
	 * @throws PropelException
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
	 * @return ConceptHistoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptHistoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param User $v
	 * @return void
	 * @throws PropelException
	 */
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId('');
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param Connection Optional Connection object.
	 * @return User The associated User object.
	 * @throws PropelException
	 */
	public function getUser($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->user_id !== null)) {

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
	 * Declares an association between this object and a ConceptProperty object.
	 *
	 * @param ConceptProperty $v
	 * @return void
	 * @throws PropelException
	 */
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setConceptPropertyId('');
		} else {
			$this->setConceptPropertyId($v->getId());
		}


		$this->aConceptProperty = $v;
	}


	/**
	 * Get the associated ConceptProperty object
	 *
	 * @param Connection Optional Connection object.
	 * @return ConceptProperty The associated ConceptProperty object.
	 * @throws PropelException
	 */
	public function getConceptProperty($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';

		if ($this->aConceptProperty === null && ($this->concept_property_id !== null)) {

			$this->aConceptProperty = ConceptPropertyPeer::retrieveByPK($this->concept_property_id, $con);
					
			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPropertyPeer::retrieveByPK($this->concept_property_id, $con);
			   $obj->addConceptPropertys($this);
			 */
		}
		return $this->aConceptProperty;
	}

} // BaseConceptHistory
