<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'model/AgentPeer.php';

/**
 * Base class that represents a row from the 'reg_agent' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseAgent extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var AgentPeer
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
	 * The value for the org_email field.
	 * @var string
	 */
	protected $org_email;


	/**
	 * The value for the org_name field.
	 * @var string
	 */
	protected $org_name;


	/**
	 * The value for the ind_affiliation field.
	 * @var string
	 */
	protected $ind_affiliation;


	/**
	 * The value for the ind_role field.
	 * @var string
	 */
	protected $ind_role;


	/**
	 * The value for the address1 field.
	 * @var string
	 */
	protected $address1;


	/**
	 * The value for the address2 field.
	 * @var string
	 */
	protected $address2;


	/**
	 * The value for the city field.
	 * @var string
	 */
	protected $city;


	/**
	 * The value for the state field.
	 * @var string
	 */
	protected $state;


	/**
	 * The value for the postal_code field.
	 * @var string
	 */
	protected $postal_code;


	/**
	 * The value for the country field.
	 * @var string
	 */
	protected $country;


	/**
	 * The value for the phone field.
	 * @var string
	 */
	protected $phone;


	/**
	 * The value for the web_address field.
	 * @var string
	 */
	protected $web_address;


	/**
	 * The value for the type field.
	 * @var string
	 */
	protected $type;

	/**
	 * Collection to store aggregation of collAgentHasUsers.
	 * @var array
	 */
	protected $collAgentHasUsers;
	
	/**
	 * The criteria used to select the current contents of collAgentHasUsers.
	 * @var Criteria
	 */
	private $lastAgentHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularys.
	 * @var array
	 */
	protected $collVocabularys;
	
	/**
	 * The criteria used to select the current contents of collVocabularys.
	 * @var Criteria
	 */
	private $lastVocabularyCriteria = null;

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
	 * Get the [org_email] column value.
	 * 
	 * @return string
	 */
	public function getOrgEmail()
	{

		return $this->org_email;
	}

	/**
	 * Get the [org_name] column value.
	 * 
	 * @return string
	 */
	public function getOrgName()
	{

		return $this->org_name;
	}

	/**
	 * Get the [ind_affiliation] column value.
	 * 
	 * @return string
	 */
	public function getIndAffiliation()
	{

		return $this->ind_affiliation;
	}

	/**
	 * Get the [ind_role] column value.
	 * 
	 * @return string
	 */
	public function getIndRole()
	{

		return $this->ind_role;
	}

	/**
	 * Get the [address1] column value.
	 * 
	 * @return string
	 */
	public function getAddress1()
	{

		return $this->address1;
	}

	/**
	 * Get the [address2] column value.
	 * 
	 * @return string
	 */
	public function getAddress2()
	{

		return $this->address2;
	}

	/**
	 * Get the [city] column value.
	 * 
	 * @return string
	 */
	public function getCity()
	{

		return $this->city;
	}

	/**
	 * Get the [state] column value.
	 * 
	 * @return string
	 */
	public function getState()
	{

		return $this->state;
	}

	/**
	 * Get the [postal_code] column value.
	 * 
	 * @return string
	 */
	public function getPostalCode()
	{

		return $this->postal_code;
	}

	/**
	 * Get the [country] column value.
	 * 
	 * @return string
	 */
	public function getCountry()
	{

		return $this->country;
	}

	/**
	 * Get the [phone] column value.
	 * 
	 * @return string
	 */
	public function getPhone()
	{

		return $this->phone;
	}

	/**
	 * Get the [web_address] column value.
	 * 
	 * @return string
	 */
	public function getWebAddress()
	{

		return $this->web_address;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return string
	 */
	public function getType()
	{

		return $this->type;
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
			$this->modifiedColumns[] = AgentPeer::ID;
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
			$this->modifiedColumns[] = AgentPeer::CREATED_AT;
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
			$this->modifiedColumns[] = AgentPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

	/**
	 * Set the value of [org_email] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setOrgEmail($v)
	{

		if ($this->org_email !== $v) {
			$this->org_email = $v;
			$this->modifiedColumns[] = AgentPeer::ORG_EMAIL;
		}

	} // setOrgEmail()

	/**
	 * Set the value of [org_name] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setOrgName($v)
	{

		if ($this->org_name !== $v) {
			$this->org_name = $v;
			$this->modifiedColumns[] = AgentPeer::ORG_NAME;
		}

	} // setOrgName()

	/**
	 * Set the value of [ind_affiliation] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setIndAffiliation($v)
	{

		if ($this->ind_affiliation !== $v) {
			$this->ind_affiliation = $v;
			$this->modifiedColumns[] = AgentPeer::IND_AFFILIATION;
		}

	} // setIndAffiliation()

	/**
	 * Set the value of [ind_role] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setIndRole($v)
	{

		if ($this->ind_role !== $v) {
			$this->ind_role = $v;
			$this->modifiedColumns[] = AgentPeer::IND_ROLE;
		}

	} // setIndRole()

	/**
	 * Set the value of [address1] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setAddress1($v)
	{

		if ($this->address1 !== $v) {
			$this->address1 = $v;
			$this->modifiedColumns[] = AgentPeer::ADDRESS1;
		}

	} // setAddress1()

	/**
	 * Set the value of [address2] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setAddress2($v)
	{

		if ($this->address2 !== $v) {
			$this->address2 = $v;
			$this->modifiedColumns[] = AgentPeer::ADDRESS2;
		}

	} // setAddress2()

	/**
	 * Set the value of [city] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setCity($v)
	{

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = AgentPeer::CITY;
		}

	} // setCity()

	/**
	 * Set the value of [state] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setState($v)
	{

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = AgentPeer::STATE;
		}

	} // setState()

	/**
	 * Set the value of [postal_code] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setPostalCode($v)
	{

		if ($this->postal_code !== $v) {
			$this->postal_code = $v;
			$this->modifiedColumns[] = AgentPeer::POSTAL_CODE;
		}

	} // setPostalCode()

	/**
	 * Set the value of [country] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setCountry($v)
	{

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = AgentPeer::COUNTRY;
		}

	} // setCountry()

	/**
	 * Set the value of [phone] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setPhone($v)
	{

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = AgentPeer::PHONE;
		}

	} // setPhone()

	/**
	 * Set the value of [web_address] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setWebAddress($v)
	{

		if ($this->web_address !== $v) {
			$this->web_address = $v;
			$this->modifiedColumns[] = AgentPeer::WEB_ADDRESS;
		}

	} // setWebAddress()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param string $v new value
	 * @return void
	 */
	public function setType($v)
	{

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = AgentPeer::TYPE;
		}

	} // setType()

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

			$this->org_email = $rs->getString($startcol + 3);

			$this->org_name = $rs->getString($startcol + 4);

			$this->ind_affiliation = $rs->getString($startcol + 5);

			$this->ind_role = $rs->getString($startcol + 6);

			$this->address1 = $rs->getString($startcol + 7);

			$this->address2 = $rs->getString($startcol + 8);

			$this->city = $rs->getString($startcol + 9);

			$this->state = $rs->getString($startcol + 10);

			$this->postal_code = $rs->getString($startcol + 11);

			$this->country = $rs->getString($startcol + 12);

			$this->phone = $rs->getString($startcol + 13);

			$this->web_address = $rs->getString($startcol + 14);

			$this->type = $rs->getString($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Agent object", $e);
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AgentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
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
	

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AgentPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which 
										 // should always be true here (even though technically 
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AgentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAgentHasUsers !== null) {
				foreach($this->collAgentHasUsers as $referrerFK) {
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


			if (($retval = AgentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAgentHasUsers !== null) {
					foreach($this->collAgentHasUsers as $referrerFK) {
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
	 * @param string $name name
	 * @param string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOrgEmail();
				break;
			case 4:
				return $this->getOrgName();
				break;
			case 5:
				return $this->getIndAffiliation();
				break;
			case 6:
				return $this->getIndRole();
				break;
			case 7:
				return $this->getAddress1();
				break;
			case 8:
				return $this->getAddress2();
				break;
			case 9:
				return $this->getCity();
				break;
			case 10:
				return $this->getState();
				break;
			case 11:
				return $this->getPostalCode();
				break;
			case 12:
				return $this->getCountry();
				break;
			case 13:
				return $this->getPhone();
				break;
			case 14:
				return $this->getWebAddress();
				break;
			case 15:
				return $this->getType();
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
		$keys = AgentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getOrgEmail(),
			$keys[4] => $this->getOrgName(),
			$keys[5] => $this->getIndAffiliation(),
			$keys[6] => $this->getIndRole(),
			$keys[7] => $this->getAddress1(),
			$keys[8] => $this->getAddress2(),
			$keys[9] => $this->getCity(),
			$keys[10] => $this->getState(),
			$keys[11] => $this->getPostalCode(),
			$keys[12] => $this->getCountry(),
			$keys[13] => $this->getPhone(),
			$keys[14] => $this->getWebAddress(),
			$keys[15] => $this->getType(),
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
		$pos = AgentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOrgEmail($value);
				break;
			case 4:
				$this->setOrgName($value);
				break;
			case 5:
				$this->setIndAffiliation($value);
				break;
			case 6:
				$this->setIndRole($value);
				break;
			case 7:
				$this->setAddress1($value);
				break;
			case 8:
				$this->setAddress2($value);
				break;
			case 9:
				$this->setCity($value);
				break;
			case 10:
				$this->setState($value);
				break;
			case 11:
				$this->setPostalCode($value);
				break;
			case 12:
				$this->setCountry($value);
				break;
			case 13:
				$this->setPhone($value);
				break;
			case 14:
				$this->setWebAddress($value);
				break;
			case 15:
				$this->setType($value);
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
		$keys = AgentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOrgEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOrgName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIndAffiliation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIndRole($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAddress1($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAddress2($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCity($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setState($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPostalCode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCountry($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPhone($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setWebAddress($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setType($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentPeer::ID)) $criteria->add(AgentPeer::ID, $this->id);
		if ($this->isColumnModified(AgentPeer::CREATED_AT)) $criteria->add(AgentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AgentPeer::LAST_UPDATED)) $criteria->add(AgentPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(AgentPeer::ORG_EMAIL)) $criteria->add(AgentPeer::ORG_EMAIL, $this->org_email);
		if ($this->isColumnModified(AgentPeer::ORG_NAME)) $criteria->add(AgentPeer::ORG_NAME, $this->org_name);
		if ($this->isColumnModified(AgentPeer::IND_AFFILIATION)) $criteria->add(AgentPeer::IND_AFFILIATION, $this->ind_affiliation);
		if ($this->isColumnModified(AgentPeer::IND_ROLE)) $criteria->add(AgentPeer::IND_ROLE, $this->ind_role);
		if ($this->isColumnModified(AgentPeer::ADDRESS1)) $criteria->add(AgentPeer::ADDRESS1, $this->address1);
		if ($this->isColumnModified(AgentPeer::ADDRESS2)) $criteria->add(AgentPeer::ADDRESS2, $this->address2);
		if ($this->isColumnModified(AgentPeer::CITY)) $criteria->add(AgentPeer::CITY, $this->city);
		if ($this->isColumnModified(AgentPeer::STATE)) $criteria->add(AgentPeer::STATE, $this->state);
		if ($this->isColumnModified(AgentPeer::POSTAL_CODE)) $criteria->add(AgentPeer::POSTAL_CODE, $this->postal_code);
		if ($this->isColumnModified(AgentPeer::COUNTRY)) $criteria->add(AgentPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(AgentPeer::PHONE)) $criteria->add(AgentPeer::PHONE, $this->phone);
		if ($this->isColumnModified(AgentPeer::WEB_ADDRESS)) $criteria->add(AgentPeer::WEB_ADDRESS, $this->web_address);
		if ($this->isColumnModified(AgentPeer::TYPE)) $criteria->add(AgentPeer::TYPE, $this->type);

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
		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		$criteria->add(AgentPeer::ID, $this->id);

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
	 * @param object $copyObj An object of Agent (or compatible) type.
	 * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setOrgEmail($this->org_email);

		$copyObj->setOrgName($this->org_name);

		$copyObj->setIndAffiliation($this->ind_affiliation);

		$copyObj->setIndRole($this->ind_role);

		$copyObj->setAddress1($this->address1);

		$copyObj->setAddress2($this->address2);

		$copyObj->setCity($this->city);

		$copyObj->setState($this->state);

		$copyObj->setPostalCode($this->postal_code);

		$copyObj->setCountry($this->country);

		$copyObj->setPhone($this->phone);

		$copyObj->setWebAddress($this->web_address);

		$copyObj->setType($this->type);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getAgentHasUsers() as $relObj) {
				if($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAgentHasUser($relObj->copy($deepCopy));
				}
			}

			foreach($this->getVocabularys() as $relObj) {
				if($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addVocabulary($relObj->copy($deepCopy));
				}
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
	 * @return Agent Clone of current object.
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
	 * @return AgentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AgentPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collAgentHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initAgentHasUsers()
	{
		if ($this->collAgentHasUsers === null) {
			$this->collAgentHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Agent has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 * If this Agent is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getAgentHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
			   $this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
					$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;
		return $this->collAgentHasUsers;
	}

	/**
	 * Returns the number of related AgentHasUsers.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countAgentHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

		return AgentHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AgentHasUser object to this object
	 * through the AgentHasUser foreign key attribute
	 *
	 * @param AgentHasUser $l AgentHasUser
	 * @return void
	 * @throws PropelException
	 */
	public function addAgentHasUser(AgentHasUser $l)
	{
		$this->collAgentHasUsers[] = $l;
		$l->setAgent($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Agent is new, it will return
	 * an empty collection; or if this Agent has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agent.
	 */
	public function getAgentHasUsersJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentHasUsers === null) {
			if ($this->isNew()) {
				$this->collAgentHasUsers = array();
			} else {

				$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AgentHasUserPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;

		return $this->collAgentHasUsers;
	}

	/**
	 * Temporary storage of collVocabularys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
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
	 * Otherwise if this Agent has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 * If this Agent is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param Connection $con
	 * @param Criteria $criteria
	 * @throws PropelException
	 */
	public function getVocabularys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseVocabularyPeer.php';
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

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

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
	 * @param Criteria $criteria
	 * @param boolean $distinct
	 * @param Connection $con
	 * @throws PropelException
	 */
	public function countVocabularys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'model/om/BaseVocabularyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

		return VocabularyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Vocabulary object to this object
	 * through the Vocabulary foreign key attribute
	 *
	 * @param Vocabulary $l Vocabulary
	 * @return void
	 * @throws PropelException
	 */
	public function addVocabulary(Vocabulary $l)
	{
		$this->collVocabularys[] = $l;
		$l->setAgent($this);
	}

} // BaseAgent
