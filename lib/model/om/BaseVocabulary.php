<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/VocabularyPeer.php';

/**
 * Base class that represents a row from the 'reg_vocabulary' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseVocabulary extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var VocabularyPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var int
	 */
	protected $id;


	/**
	 * The value for the agent_id field.
	 * @var int
	 */
	protected $agent_id;


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
	 * The value for the name field.
	 * @var string
	 */
	protected $name;


	/**
	 * The value for the note field.
	 * @var string
	 */
	protected $note;


	/**
	 * The value for the uri field.
	 * @var string
	 */
	protected $uri;


	/**
	 * The value for the url field.
	 * @var string
	 */
	protected $url;


	/**
	 * The value for the base_domain field.
	 * @var string
	 */
	protected $base_domain;


	/**
	 * The value for the token field.
	 * @var string
	 */
	protected $token;


	/**
	 * The value for the community field.
	 * @var string
	 */
	protected $community;


	/**
	 * The value for the last_uri_id field.
	 * @var int
	 */
	protected $last_uri_id = 1000;

	/**
	 * @var Agent
	 */
	protected $aAgent;

	/**
	 * Collection to store aggregation of collConcepts.
	 * @var array
	 */
	protected $collConcepts;

	/**
	 * The criteria used to select the current contents of collConcepts.
	 * @var Criteria
	 */
	protected $lastConceptCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertys.
	 * @var array
	 */
	protected $collConceptPropertys;

	/**
	 * The criteria used to select the current contents of collConceptPropertys.
	 * @var Criteria
	 */
	protected $lastConceptPropertyCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasUsers.
	 * @var array
	 */
	protected $collVocabularyHasUsers;

	/**
	 * The criteria used to select the current contents of collVocabularyHasUsers.
	 * @var Criteria
	 */
	protected $lastVocabularyHasUserCriteria = null;

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
	 * Get the [agent_id] column value.
	 * 
	 * @return int
	 */
	public function getAgentId()
	{

		return $this->agent_id;
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
	 * Get the [name] column value.
	 * 
	 * @return string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [note] column value.
	 * 
	 * @return string
	 */
	public function getNote()
	{

		return $this->note;
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
	 * Get the [url] column value.
	 * 
	 * @return string
	 */
	public function getUrl()
	{

		return $this->url;
	}

	/**
	 * Get the [base_domain] column value.
	 * 
	 * @return string
	 */
	public function getBaseDomain()
	{

		return $this->base_domain;
	}

	/**
	 * Get the [token] column value.
	 * 
	 * @return string
	 */
	public function getToken()
	{

		return $this->token;
	}

	/**
	 * Get the [community] column value.
	 * 
	 * @return string
	 */
	public function getCommunity()
	{

		return $this->community;
	}

	/**
	 * Get the [last_uri_id] column value.
	 * 
	 * @return int
	 */
	public function getLastUriId()
	{

		return $this->last_uri_id;
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
			$this->modifiedColumns[] = VocabularyPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [agent_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setAgentId($v)
	{

		if ($this->agent_id !== $v) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::AGENT_ID;
		}

		if ($this->aAgent !== null && $this->aAgent->getId() !== $v) {
			$this->aAgent = null;
		}

	} // setAgentId()

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
			$this->modifiedColumns[] = VocabularyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = VocabularyPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setName($v)
	{

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = VocabularyPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [note] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setNote($v)
	{

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = VocabularyPeer::NOTE;
		}

	} // setNote()

	/**
	 * Set the value of [uri] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setUri($v)
	{

		if ($this->uri !== $v) {
			$this->uri = $v;
			$this->modifiedColumns[] = VocabularyPeer::URI;
		}

	} // setUri()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setUrl($v)
	{

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = VocabularyPeer::URL;
		}

	} // setUrl()

	/**
	 * Set the value of [base_domain] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setBaseDomain($v)
	{

		if ($this->base_domain !== $v) {
			$this->base_domain = $v;
			$this->modifiedColumns[] = VocabularyPeer::BASE_DOMAIN;
		}

	} // setBaseDomain()

	/**
	 * Set the value of [token] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setToken($v)
	{

		if ($this->token !== $v) {
			$this->token = $v;
			$this->modifiedColumns[] = VocabularyPeer::TOKEN;
		}

	} // setToken()

	/**
	 * Set the value of [community] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setCommunity($v)
	{

		if ($this->community !== $v) {
			$this->community = $v;
			$this->modifiedColumns[] = VocabularyPeer::COMMUNITY;
		}

	} // setCommunity()

	/**
	 * Set the value of [last_uri_id] column.
	 * 
	 * @param int $v new value
	 * @return void
	 */
	public function setLastUriId($v)
	{

		if ($this->last_uri_id !== $v || $v === 1000) {
			$this->last_uri_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::LAST_URI_ID;
		}

	} // setLastUriId()

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

			$this->agent_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->last_updated = $rs->getTimestamp($startcol + 3, null);

			$this->name = $rs->getString($startcol + 4);

			$this->note = $rs->getString($startcol + 5);

			$this->uri = $rs->getString($startcol + 6);

			$this->url = $rs->getString($startcol + 7);

			$this->base_domain = $rs->getString($startcol + 8);

			$this->token = $rs->getString($startcol + 9);

			$this->community = $rs->getString($startcol + 10);

			$this->last_uri_id = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 12; // 12 = VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Vocabulary object", $e);
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
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VocabularyPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
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

			if ($this->aAgent !== null) {
				if ($this->aAgent->isModified()) {
					$affectedRows += $this->aAgent->save($con);
				}
				$this->setAgent($this->aAgent);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VocabularyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += VocabularyPeer::doUpdate($this, $con);
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

			if ($this->collVocabularyHasUsers !== null) {
				foreach($this->collVocabularyHasUsers as $referrerFK) {
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

			if ($this->aAgent !== null) {
				if (!$this->aAgent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgent->getValidationFailures());
				}
			}


			if (($retval = VocabularyPeer::doValidate($this, $columns)) !== true) {
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

				if ($this->collVocabularyHasUsers !== null) {
					foreach($this->collVocabularyHasUsers as $referrerFK) {
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
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAgentId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getLastUpdated();
				break;
			case 4:
				return $this->getName();
				break;
			case 5:
				return $this->getNote();
				break;
			case 6:
				return $this->getUri();
				break;
			case 7:
				return $this->getUrl();
				break;
			case 8:
				return $this->getBaseDomain();
				break;
			case 9:
				return $this->getToken();
				break;
			case 10:
				return $this->getCommunity();
				break;
			case 11:
				return $this->getLastUriId();
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
		$keys = VocabularyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAgentId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getLastUpdated(),
			$keys[4] => $this->getName(),
			$keys[5] => $this->getNote(),
			$keys[6] => $this->getUri(),
			$keys[7] => $this->getUrl(),
			$keys[8] => $this->getBaseDomain(),
			$keys[9] => $this->getToken(),
			$keys[10] => $this->getCommunity(),
			$keys[11] => $this->getLastUriId(),
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
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAgentId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setLastUpdated($value);
				break;
			case 4:
				$this->setName($value);
				break;
			case 5:
				$this->setNote($value);
				break;
			case 6:
				$this->setUri($value);
				break;
			case 7:
				$this->setUrl($value);
				break;
			case 8:
				$this->setBaseDomain($value);
				break;
			case 9:
				$this->setToken($value);
				break;
			case 10:
				$this->setCommunity($value);
				break;
			case 11:
				$this->setLastUriId($value);
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
		$keys = VocabularyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAgentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastUpdated($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNote($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUri($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUrl($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBaseDomain($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setToken($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCommunity($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastUriId($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		if ($this->isColumnModified(VocabularyPeer::ID)) $criteria->add(VocabularyPeer::ID, $this->id);
		if ($this->isColumnModified(VocabularyPeer::AGENT_ID)) $criteria->add(VocabularyPeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(VocabularyPeer::CREATED_AT)) $criteria->add(VocabularyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(VocabularyPeer::LAST_UPDATED)) $criteria->add(VocabularyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(VocabularyPeer::NAME)) $criteria->add(VocabularyPeer::NAME, $this->name);
		if ($this->isColumnModified(VocabularyPeer::NOTE)) $criteria->add(VocabularyPeer::NOTE, $this->note);
		if ($this->isColumnModified(VocabularyPeer::URI)) $criteria->add(VocabularyPeer::URI, $this->uri);
		if ($this->isColumnModified(VocabularyPeer::URL)) $criteria->add(VocabularyPeer::URL, $this->url);
		if ($this->isColumnModified(VocabularyPeer::BASE_DOMAIN)) $criteria->add(VocabularyPeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(VocabularyPeer::TOKEN)) $criteria->add(VocabularyPeer::TOKEN, $this->token);
		if ($this->isColumnModified(VocabularyPeer::COMMUNITY)) $criteria->add(VocabularyPeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(VocabularyPeer::LAST_URI_ID)) $criteria->add(VocabularyPeer::LAST_URI_ID, $this->last_uri_id);

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
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		$criteria->add(VocabularyPeer::ID, $this->id);

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
	 * @param object $copyObj An object of Vocabulary (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setAgentId($this->agent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setName($this->name);

		$copyObj->setNote($this->note);

		$copyObj->setUri($this->uri);

		$copyObj->setUrl($this->url);

		$copyObj->setBaseDomain($this->base_domain);

		$copyObj->setToken($this->token);

		$copyObj->setCommunity($this->community);

		$copyObj->setLastUriId($this->last_uri_id);


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

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
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
	 * @return Vocabulary Clone of current object.
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
	 * @return VocabularyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VocabularyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Agent object.
	 *
	 * @param Agent $v
	 * @return void
	 * @throws PropelException
	 */
	public function setAgent($v)
	{


		if ($v === null) {
			$this->setAgentId(NULL);
		} else {
			$this->setAgentId($v->getId());
		}


		$this->aAgent = $v;
	}


	/**
	 * Get the associated Agent object
	 *
	 * @param Connection Optional Connection object.
	 * @return Agent The associated Agent object.
	 * @throws PropelException
	 */
	public function getAgent($con = null)
	{
		// include the related Peer class
		include_once 'model/om/BaseAgentPeer.php';

		if ($this->aAgent === null && ($this->agent_id !== null)) {

			$this->aAgent = AgentPeer::retrieveByPK($this->agent_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = AgentPeer::retrieveByPK($this->agent_id, $con);
			   $obj->addAgents($this);
			 */
		}
		return $this->aAgent;
	}

	/**
	 * Temporary storage of collConcepts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getConcepts($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPeer.php';
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

				$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConcepts = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

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
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countConcepts($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseConceptPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

		return ConceptPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Concept object to this object
	 * through the Concept foreign key attribute
	 *
	 * @param Concept $l Concept
	 * @return void
	 * @throws PropelException
	 */
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setVocabulary($this);
	}

	/**
	 * Temporary storage of collConceptPropertys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getConceptPropertys($criteria = null, $con = null)
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

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countConceptPropertys($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	public function addConceptProperty(ConceptProperty $l)
	{
		$this->collConceptPropertys[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertysJoinSkosProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertysJoinConceptRelatedByConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertysJoinLookup($criteria = null, $con = null)
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

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinLookup($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertysJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertys === null) {
			if ($this->isNew()) {
				$this->collConceptPropertys = array();
			} else {

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}

	/**
	 * Temporary storage of collVocabularyHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initVocabularyHasUsers()
	{
		if ($this->collVocabularyHasUsers === null) {
			$this->collVocabularyHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getVocabularyHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
					$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;
		return $this->collVocabularyHasUsers;
	}

	/**
	 * Returns the number of related VocabularyHasUsers.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

		return VocabularyHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VocabularyHasUser object to this object
	 * through the VocabularyHasUser foreign key attribute
	 *
	 * @param VocabularyHasUser $l VocabularyHasUser
	 * @return void
	 * @throws PropelException
	 */
	public function addVocabularyHasUser(VocabularyHasUser $l)
	{
		$this->collVocabularyHasUsers[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getVocabularyHasUsersJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasUsers === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasUsers = array();
			} else {

				$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;

		return $this->collVocabularyHasUsers;
	}

} // BaseVocabulary
