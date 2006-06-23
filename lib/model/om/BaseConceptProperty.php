<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/ConceptPropertyPeer.php';

/**
 * Base class that represents a row from the 'reg_concept_property' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseConceptProperty extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var ConceptPropertyPeer
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
	 * The value for the concept_id field.
	 * @var int
	 */
	protected $concept_id = 0;


	/**
	 * The value for the skos_property_id field.
	 * @var int
	 */
	protected $skos_property_id = 0;


	/**
	 * The value for the object field.
	 * @var string
	 */
	protected $object;


	/**
	 * The value for the scheme_id field.
	 * @var int
	 */
	protected $scheme_id;


	/**
	 * The value for the related_concept_id field.
	 * @var int
	 */
	protected $related_concept_id;


	/**
	 * The value for the language field.
	 * @var string
	 */
	protected $language;


	/**
	 * The value for the status_id field.
	 * @var int
	 */
	protected $status_id;

	/**
	 * @var SkosProperty
	 */
	protected $aSkosProperty;

	/**
	 * @var Concept
	 */
	protected $aConceptRelatedByConceptId;

	/**
	 * @var Vocabulary
	 */
	protected $aVocabulary;

	/**
	 * @var Lookup
	 */
	protected $aLookup;

	/**
	 * @var Concept
	 */
	protected $aConceptRelatedByRelatedConceptId;

	/**
	 * Collection to store aggregation of collConceptHistorys.
	 * @var array
	 */
	protected $collConceptHistorys;

	/**
	 * The criteria used to select the current contents of collConceptHistorys.
	 * @var Criteria
	 */
	protected $lastConceptHistoryCriteria = null;

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
	 * Get the [concept_id] column value.
	 * 
	 * @return int
	 */
	public function getConceptId()
	{

		return $this->concept_id;
	}

	/**
	 * Get the [skos_property_id] column value.
	 * 
	 * @return int
	 */
	public function getSkosPropertyId()
	{

		return $this->skos_property_id;
	}

	/**
	 * Get the [object] column value.
	 * 
	 * @return string
	 */
	public function getObject()
	{

		return $this->object;
	}

	/**
	 * Get the [scheme_id] column value.
	 * 
	 * @return int
	 */
	public function getSchemeId()
	{

		return $this->scheme_id;
	}

	/**
	 * Get the [related_concept_id] column value.
	 * 
	 * @return int
	 */
	public function getRelatedConceptId()
	{

		return $this->related_concept_id;
	}

	/**
	 * Get the [language] column value.
	 * 
	 * @return string
	 */
	public function getLanguage()
	{

		return $this->language;
	}

	/**
	 * Get the [status_id] column value.
	 * 
	 * @return int
	 */
	public function getStatusId()
	{

		return $this->status_id;
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
			$this->modifiedColumns[] = ConceptPropertyPeer::ID;
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
			$this->modifiedColumns[] = ConceptPropertyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ConceptPropertyPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

	/**
	 * Set the value of [concept_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setConceptId($v)
	{

		if ($this->concept_id !== $v || $v === 0) {
			$this->concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::CONCEPT_ID;
		}

		if ($this->aConceptRelatedByConceptId !== null && $this->aConceptRelatedByConceptId->getId() !== $v) {
			$this->aConceptRelatedByConceptId = null;
		}

	} // setConceptId()

	/**
	 * Set the value of [skos_property_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setSkosPropertyId($v)
	{

		if ($this->skos_property_id !== $v || $v === 0) {
			$this->skos_property_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SKOS_PROPERTY_ID;
		}

		if ($this->aSkosProperty !== null && $this->aSkosProperty->getId() !== $v) {
			$this->aSkosProperty = null;
		}

	} // setSkosPropertyId()

	/**
	 * Set the value of [object] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setObject($v)
	{

		if ($this->object !== $v) {
			$this->object = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::OBJECT;
		}

	} // setObject()

	/**
	 * Set the value of [scheme_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setSchemeId($v)
	{

		if ($this->scheme_id !== $v) {
			$this->scheme_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::SCHEME_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} // setSchemeId()

	/**
	 * Set the value of [related_concept_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setRelatedConceptId($v)
	{

		if ($this->related_concept_id !== $v) {
			$this->related_concept_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::RELATED_CONCEPT_ID;
		}

		if ($this->aConceptRelatedByRelatedConceptId !== null && $this->aConceptRelatedByRelatedConceptId->getId() !== $v) {
			$this->aConceptRelatedByRelatedConceptId = null;
		}

	} // setRelatedConceptId()

	/**
	 * Set the value of [language] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setLanguage($v)
	{

		if ($this->language !== $v) {
			$this->language = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::LANGUAGE;
		}

	} // setLanguage()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setStatusId($v)
	{

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ConceptPropertyPeer::STATUS_ID;
		}

		if ($this->aLookup !== null && $this->aLookup->getId() !== $v) {
			$this->aLookup = null;
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

			$this->concept_id = $rs->getInt($startcol + 3);

			$this->skos_property_id = $rs->getInt($startcol + 4);

			$this->object = $rs->getString($startcol + 5);

			$this->scheme_id = $rs->getInt($startcol + 6);

			$this->related_concept_id = $rs->getInt($startcol + 7);

			$this->language = $rs->getString($startcol + 8);

			$this->status_id = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptProperty object", $e);
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
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptPropertyPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
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

			if ($this->aSkosProperty !== null) {
				if ($this->aSkosProperty->isModified()) {
					$affectedRows += $this->aSkosProperty->save($con);
				}
				$this->setSkosProperty($this->aSkosProperty);
			}

			if ($this->aConceptRelatedByConceptId !== null) {
				if ($this->aConceptRelatedByConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByConceptId->save($con);
				}
				$this->setConceptRelatedByConceptId($this->aConceptRelatedByConceptId);
			}

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}

			if ($this->aLookup !== null) {
				if ($this->aLookup->isModified()) {
					$affectedRows += $this->aLookup->save($con);
				}
				$this->setLookup($this->aLookup);
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if ($this->aConceptRelatedByRelatedConceptId->isModified()) {
					$affectedRows += $this->aConceptRelatedByRelatedConceptId->save($con);
				}
				$this->setConceptRelatedByRelatedConceptId($this->aConceptRelatedByRelatedConceptId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptPropertyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ConceptPropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collConceptHistorys !== null) {
				foreach($this->collConceptHistorys as $referrerFK) {
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

			if ($this->aSkosProperty !== null) {
				if (!$this->aSkosProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSkosProperty->getValidationFailures());
				}
			}

			if ($this->aConceptRelatedByConceptId !== null) {
				if (!$this->aConceptRelatedByConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByConceptId->getValidationFailures());
				}
			}

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}

			if ($this->aLookup !== null) {
				if (!$this->aLookup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLookup->getValidationFailures());
				}
			}

			if ($this->aConceptRelatedByRelatedConceptId !== null) {
				if (!$this->aConceptRelatedByRelatedConceptId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptRelatedByRelatedConceptId->getValidationFailures());
				}
			}


			if (($retval = ConceptPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collConceptHistorys !== null) {
					foreach($this->collConceptHistorys as $referrerFK) {
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
		$pos = ConceptPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getConceptId();
				break;
			case 4:
				return $this->getSkosPropertyId();
				break;
			case 5:
				return $this->getObject();
				break;
			case 6:
				return $this->getSchemeId();
				break;
			case 7:
				return $this->getRelatedConceptId();
				break;
			case 8:
				return $this->getLanguage();
				break;
			case 9:
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
	 * @param string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getConceptId(),
			$keys[4] => $this->getSkosPropertyId(),
			$keys[5] => $this->getObject(),
			$keys[6] => $this->getSchemeId(),
			$keys[7] => $this->getRelatedConceptId(),
			$keys[8] => $this->getLanguage(),
			$keys[9] => $this->getStatusId(),
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
		$pos = ConceptPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setConceptId($value);
				break;
			case 4:
				$this->setSkosPropertyId($value);
				break;
			case 5:
				$this->setObject($value);
				break;
			case 6:
				$this->setSchemeId($value);
				break;
			case 7:
				$this->setRelatedConceptId($value);
				break;
			case 8:
				$this->setLanguage($value);
				break;
			case 9:
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
	 * @param array  $arr     An array to populate the object from.
	 * @param string $keyType The type of keys the array uses.
	 * @return void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptPropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConceptId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSkosPropertyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObject($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchemeId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRelatedConceptId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLanguage($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatusId($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptPropertyPeer::ID)) $criteria->add(ConceptPropertyPeer::ID, $this->id);
		if ($this->isColumnModified(ConceptPropertyPeer::CREATED_AT)) $criteria->add(ConceptPropertyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ConceptPropertyPeer::LAST_UPDATED)) $criteria->add(ConceptPropertyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(ConceptPropertyPeer::CONCEPT_ID)) $criteria->add(ConceptPropertyPeer::CONCEPT_ID, $this->concept_id);
		if ($this->isColumnModified(ConceptPropertyPeer::SKOS_PROPERTY_ID)) $criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->skos_property_id);
		if ($this->isColumnModified(ConceptPropertyPeer::OBJECT)) $criteria->add(ConceptPropertyPeer::OBJECT, $this->object);
		if ($this->isColumnModified(ConceptPropertyPeer::SCHEME_ID)) $criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->scheme_id);
		if ($this->isColumnModified(ConceptPropertyPeer::RELATED_CONCEPT_ID)) $criteria->add(ConceptPropertyPeer::RELATED_CONCEPT_ID, $this->related_concept_id);
		if ($this->isColumnModified(ConceptPropertyPeer::LANGUAGE)) $criteria->add(ConceptPropertyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(ConceptPropertyPeer::STATUS_ID)) $criteria->add(ConceptPropertyPeer::STATUS_ID, $this->status_id);

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
		$criteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyPeer::ID, $this->id);

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
	 * @param object $copyObj An object of ConceptProperty (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setConceptId($this->concept_id);

		$copyObj->setSkosPropertyId($this->skos_property_id);

		$copyObj->setObject($this->object);

		$copyObj->setSchemeId($this->scheme_id);

		$copyObj->setRelatedConceptId($this->related_concept_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setStatusId($this->status_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getConceptHistorys() as $relObj) {
				$copyObj->addConceptHistory($relObj->copy($deepCopy));
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
	 * @return ConceptProperty Clone of current object.
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
	 * @return ConceptPropertyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptPropertyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SkosProperty object.
	 *
	 * @param SkosProperty $v
	 * @return void
	 * @throws PropelException
	 */
	public function setSkosProperty($v)
	{


		if ($v === null) {
			$this->setSkosPropertyId('');
		} else {
			$this->setSkosPropertyId($v->getId());
		}


		$this->aSkosProperty = $v;
	}


	/**
	 * Get the associated SkosProperty object
	 *
	 * @param Connection Optional Connection object.
	 * @return SkosProperty The associated SkosProperty object.
	 * @throws PropelException
	 */
	public function getSkosProperty($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseSkosPropertyPeer.php';

		if ($this->aSkosProperty === null && ($this->skos_property_id !== null)) {

			$this->aSkosProperty = SkosPropertyPeer::retrieveByPK($this->skos_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SkosPropertyPeer::retrieveByPK($this->skos_property_id, $con);
			   $obj->addSkosPropertys($this);
			 */
		}
		return $this->aSkosProperty;
	}

	/**
	 * Declares an association between this object and a Concept object.
	 *
	 * @param Concept $v
	 * @return void
	 * @throws PropelException
	 */
	public function setConceptRelatedByConceptId($v)
	{


		if ($v === null) {
			$this->setConceptId('');
		} else {
			$this->setConceptId($v->getId());
		}


		$this->aConceptRelatedByConceptId = $v;
	}


	/**
	 * Get the associated Concept object
	 *
	 * @param Connection Optional Connection object.
	 * @return Concept The associated Concept object.
	 * @throws PropelException
	 */
	public function getConceptRelatedByConceptId($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseConceptPeer.php';

		if ($this->aConceptRelatedByConceptId === null && ($this->concept_id !== null)) {

			$this->aConceptRelatedByConceptId = ConceptPeer::retrieveByPK($this->concept_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPeer::retrieveByPK($this->concept_id, $con);
			   $obj->addConceptsRelatedByConceptId($this);
			 */
		}
		return $this->aConceptRelatedByConceptId;
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
			$this->setSchemeId(NULL);
		} else {
			$this->setSchemeId($v->getId());
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

		if ($this->aVocabulary === null && ($this->scheme_id !== null)) {

			$this->aVocabulary = VocabularyPeer::retrieveByPK($this->scheme_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = VocabularyPeer::retrieveByPK($this->scheme_id, $con);
			   $obj->addVocabularys($this);
			 */
		}
		return $this->aVocabulary;
	}

	/**
	 * Declares an association between this object and a Lookup object.
	 *
	 * @param Lookup $v
	 * @return void
	 * @throws PropelException
	 */
	public function setLookup($v)
	{


		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aLookup = $v;
	}


	/**
	 * Get the associated Lookup object
	 *
	 * @param Connection Optional Connection object.
	 * @return Lookup The associated Lookup object.
	 * @throws PropelException
	 */
	public function getLookup($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseLookupPeer.php';

		if ($this->aLookup === null && ($this->status_id !== null)) {

			$this->aLookup = LookupPeer::retrieveByPK($this->status_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = LookupPeer::retrieveByPK($this->status_id, $con);
			   $obj->addLookups($this);
			 */
		}
		return $this->aLookup;
	}

	/**
	 * Declares an association between this object and a Concept object.
	 *
	 * @param Concept $v
	 * @return void
	 * @throws PropelException
	 */
	public function setConceptRelatedByRelatedConceptId($v)
	{


		if ($v === null) {
			$this->setRelatedConceptId(NULL);
		} else {
			$this->setRelatedConceptId($v->getId());
		}


		$this->aConceptRelatedByRelatedConceptId = $v;
	}


	/**
	 * Get the associated Concept object
	 *
	 * @param Connection Optional Connection object.
	 * @return Concept The associated Concept object.
	 * @throws PropelException
	 */
	public function getConceptRelatedByRelatedConceptId($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseConceptPeer.php';

		if ($this->aConceptRelatedByRelatedConceptId === null && ($this->related_concept_id !== null)) {

			$this->aConceptRelatedByRelatedConceptId = ConceptPeer::retrieveByPK($this->related_concept_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPeer::retrieveByPK($this->related_concept_id, $con);
			   $obj->addConceptsRelatedByRelatedConceptId($this);
			 */
		}
		return $this->aConceptRelatedByRelatedConceptId;
	}

	/**
	 * Temporary storage of collConceptHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initConceptHistorys()
	{
		if ($this->collConceptHistorys === null) {
			$this->collConceptHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ConceptProperty has previously
	 * been saved, it will retrieve related ConceptHistorys from storage.
	 * If this ConceptProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getConceptHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptHistorys === null) {
			if ($this->isNew()) {
			   $this->collConceptHistorys = array();
			} else {

				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptHistoryPeer::addSelectColumns($criteria);
				$this->collConceptHistorys = ConceptHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				ConceptHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptHistoryCriteria) || !$this->lastConceptHistoryCriteria->equals($criteria)) {
					$this->collConceptHistorys = ConceptHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptHistoryCriteria = $criteria;
		return $this->collConceptHistorys;
	}

	/**
	 * Returns the number of related ConceptHistorys.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countConceptHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

		return ConceptHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ConceptHistory object to this object
	 * through the ConceptHistory foreign key attribute
	 *
	 * @param ConceptHistory $l ConceptHistory
	 * @return void
	 * @throws PropelException
	 */
	public function addConceptHistory(ConceptHistory $l)
	{
		$this->collConceptHistorys[] = $l;
		$l->setConceptProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ConceptProperty is new, it will return
	 * an empty collection; or if this ConceptProperty has previously
	 * been saved, it will retrieve related ConceptHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ConceptProperty.
	 */
	public function getConceptHistorysJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptHistorys === null) {
			if ($this->isNew()) {
				$this->collConceptHistorys = array();
			} else {

				$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

				$this->collConceptHistorys = ConceptHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptHistoryCriteria) || !$this->lastConceptHistoryCriteria->equals($criteria)) {
				$this->collConceptHistorys = ConceptHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptHistoryCriteria = $criteria;

		return $this->collConceptHistorys;
	}

} // BaseConceptProperty
