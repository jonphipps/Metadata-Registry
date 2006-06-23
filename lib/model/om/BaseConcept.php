<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/ConceptPeer.php';

/**
 * Base class that represents a row from the 'reg_concept' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseConcept extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var ConceptPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var int
	 */
	protected $id;


	/**
	 * The value for the created_at field.
	 * @var int
	 */
	protected $created_at;


	/**
	 * The value for the last_updated field.
	 * @var int
	 */
	protected $last_updated;


	/**
	 * The value for the uri field.
	 * @var string
	 */
	protected $uri = '';


	/**
	 * The value for the pref_label field.
	 * @var string
	 */
	protected $pref_label = '';


	/**
	 * The value for the vocabulary_id field.
	 * @var int
	 */
	protected $vocabulary_id;


	/**
	 * The value for the is_top_concept field.
	 * @var boolean
	 */
	protected $is_top_concept;

	/**
	 * @var Vocabulary
	 */
	protected $aVocabulary;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByConceptId.
	 * @var array
	 */
	protected $collConceptPropertysRelatedByConceptId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByConceptId.
	 * @var Criteria
	 */
	protected $lastConceptPropertyRelatedByConceptIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByRelatedConceptId.
	 * @var array
	 */
	protected $collConceptPropertysRelatedByRelatedConceptId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByRelatedConceptId.
	 * @var Criteria
	 */
	protected $lastConceptPropertyRelatedByRelatedConceptIdCriteria = null;

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
	 * Get the [id] column value.
	 * 
	 * @return int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws PropelException - if unable to convert the date/time to timestamp.
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
	 * Get the [optionally formatted] [last_updated] column value.
	 * 
	 * @param string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getLastUpdated($format = 'Y-m-d H:i:s')
	{

		if ($this->last_updated === null || $this->last_updated === '') {
			return null;
		} elseif (!is_int($this->last_updated)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->last_updated);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [last_updated] as date/time value: " . var_export($this->last_updated, true));
			}
		} else {
			$ts = $this->last_updated;
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
	 * Get the [uri] column value.
	 * 
	 * @return string
	 */
	public function getUri()
	{

		return $this->uri;
	}

	/**
	 * Get the [pref_label] column value.
	 *
	 * @return string
	 */
	public function getPrefLabel()
	{

		return $this->pref_label;
	}

	/**
	 * Get the [vocabulary_id] column value.
	 *
	 * @return int
	 */
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	/**
	 * Get the [is_top_concept] column value.
	 * 
	 * @return boolean
	 */
	public function getIsTopConcept()
	{

		return $this->is_top_concept;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ConceptPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param int $v new value
	 * @return void
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
			$this->modifiedColumns[] = ConceptPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [last_updated] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setLastUpdated($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [last_updated] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_updated !== $ts) {
			$this->last_updated = $ts;
			$this->modifiedColumns[] = ConceptPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

	/**
	 * Set the value of [uri] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setUri($v)
	{

		if ($this->uri !== $v || $v === '') {
			$this->uri = $v;
			$this->modifiedColumns[] = ConceptPeer::URI;
		}

	} // setUri()

	/**
	 * Set the value of [pref_label] column.
	 *
	 * @param string $v new value
	 * @return void
	 */
	public function setPrefLabel($v)
	{

		if ($this->pref_label !== $v || $v === '') {
			$this->pref_label = $v;
			$this->modifiedColumns[] = ConceptPeer::PREF_LABEL;
		}

	} // setPrefLabel()

	/**
	 * Set the value of [vocabulary_id] column.
	 *
	 * @param int $v new value
	 * @return void
	 */
	public function setVocabularyId($v)
	{

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = ConceptPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [is_top_concept] column.
	 * 
	 * @param boolean $v new value
	 * @return void
	 */
	public function setIsTopConcept($v)
	{

		if ($this->is_top_concept !== $v) {
			$this->is_top_concept = $v;
			$this->modifiedColumns[] = ConceptPeer::IS_TOP_CONCEPT;
		}

	} // setIsTopConcept()

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

			$this->id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->uri = $rs->getString($startcol + 3);

			$this->pref_label = $rs->getString($startcol + 4);

			$this->vocabulary_id = $rs->getInt($startcol + 5);

			$this->is_top_concept = $rs->getBoolean($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Concept object", $e);
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
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified('created_at'))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
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

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ConceptPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collConceptPropertysRelatedByConceptId !== null) {
				foreach($this->collConceptPropertysRelatedByConceptId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByRelatedConceptId !== null) {
				foreach($this->collConceptPropertysRelatedByRelatedConceptId as $referrerFK) {
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

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}


			if (($retval = ConceptPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConceptPropertysRelatedByConceptId !== null) {
					foreach($this->collConceptPropertysRelatedByConceptId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByRelatedConceptId !== null) {
					foreach($this->collConceptPropertysRelatedByRelatedConceptId as $referrerFK) {
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
	 * @param string $name name
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getLastUpdated();
				break;
			case 3:
				return $this->getUri();
				break;
			case 4:
				return $this->getPrefLabel();
				break;
			case 5:
				return $this->getVocabularyId();
				break;
			case 6:
				return $this->getIsTopConcept();
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
		$keys = ConceptPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getUri(),
			$keys[4] => $this->getPrefLabel(),
			$keys[5] => $this->getVocabularyId(),
			$keys[6] => $this->getIsTopConcept(),
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
		$pos = ConceptPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setLastUpdated($value);
				break;
			case 3:
				$this->setUri($value);
				break;
			case 4:
				$this->setPrefLabel($value);
				break;
			case 5:
				$this->setVocabularyId($value);
				break;
			case 6:
				$this->setIsTopConcept($value);
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
		$keys = ConceptPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUri($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrefLabel($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVocabularyId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsTopConcept($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPeer::ID)) $criteria->add(ConceptPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPeer::CREATED_AT)) $criteria->add(ConceptPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPeer::LAST_UPDATED)) $criteria->add(ConceptPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(ConceptPeer::URI)) $criteria->add(ConceptPeer::URI, $this->uri);
		if ($this->isColumnModified(ConceptPeer::PREF_LABEL)) $criteria->add(ConceptPeer::PREF_LABEL, $this->pref_label);
		if ($this->isColumnModified(ConceptPeer::VOCABULARY_ID)) $criteria->add(ConceptPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(ConceptPeer::IS_TOP_CONCEPT)) $criteria->add(ConceptPeer::IS_TOP_CONCEPT, $this->is_top_concept);

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
		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		$criteria->add(ConceptPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param int $key Primary key.
	 * @return void
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
	 * @param object $copyObj An object of Concept (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setUri($this->uri);

		$copyObj->setPrefLabel($this->pref_label);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setIsTopConcept($this->is_top_concept);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getConceptPropertysRelatedByConceptId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByConceptId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByRelatedConceptId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByRelatedConceptId($relObj->copy($deepCopy));
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
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return Concept Clone of current object.
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
	 * @return ConceptPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Vocabulary object.
	 *
	 * @param Vocabulary $v
	 * @return void
	 * @throws PropelException
	 */
	public function setVocabulary($v)
	{


		if ($v === null) {
			$this->setVocabularyId(NULL);
		} else {
			$this->setVocabularyId($v->getId());
		}


		$this->aVocabulary = $v;
	}


	/**
	 * Get the associated Vocabulary object
	 *
	 * @param Connection Optional Connection object.
	 * @return Vocabulary The associated Vocabulary object.
	 * @throws PropelException
	 */
	public function getVocabulary($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseVocabularyPeer.php';

		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = VocabularyPeer::retrieveByPK($this->vocabulary_id, $con);
			   $obj->addVocabularys($this);
			 */
		}
		return $this->aVocabulary;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByConceptId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initConceptPropertysRelatedByConceptId()
	{
		if ($this->collConceptPropertysRelatedByConceptId === null) {
			$this->collConceptPropertysRelatedByConceptId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByConceptId from storage.
	 * If this Concept is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getConceptPropertysRelatedByConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByConceptId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByConceptId.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countConceptPropertysRelatedByConceptId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param ConceptProperty $l ConceptProperty
	 * @return void
	 * @throws PropelException
	 */
	public function addConceptPropertyRelatedByConceptId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByConceptId[] = $l;
		$l->setConceptRelatedByConceptId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByConceptIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByConceptIdJoinLookup($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByConceptIdCriteria) || !$this->lastConceptPropertyRelatedByConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByConceptId = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByConceptId;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByRelatedConceptId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initConceptPropertysRelatedByRelatedConceptId()
	{
		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			$this->collConceptPropertysRelatedByRelatedConceptId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByRelatedConceptId from storage.
	 * If this Concept is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getConceptPropertysRelatedByRelatedConceptId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByRelatedConceptId.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countConceptPropertysRelatedByRelatedConceptId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

		return ConceptPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptProperty object to this object
	 * through the ConceptProperty foreign key attribute
	 *
	 * @param ConceptProperty $l ConceptProperty
	 * @return void
	 * @throws PropelException
	 */
	public function addConceptPropertyRelatedByRelatedConceptId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByRelatedConceptId[] = $l;
		$l->setConceptRelatedByRelatedConceptId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByRelatedConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByRelatedConceptIdJoinSkosProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByRelatedConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByRelatedConceptIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concept is new, it will return
	 * an empty collection; or if this Concept has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByRelatedConceptId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concept.
	 */
	public function getConceptPropertysRelatedByRelatedConceptIdJoinLookup($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptPropertysRelatedByRelatedConceptId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByRelatedConceptId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByRelatedConceptIdCriteria) || !$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByRelatedConceptId = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByRelatedConceptIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByRelatedConceptId;
	}

} // BaseConcept