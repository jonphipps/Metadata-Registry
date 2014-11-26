<?php

/**
 * Base class that represents a row from the 'reg_skos_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSkosProperty extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SkosPropertyPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;


	/**
	 * The value for the inverse_id field.
	 * @var        int
	 */
	protected $inverse_id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name = '';


	/**
	 * The value for the uri field.
	 * @var        string
	 */
	protected $uri = '';


	/**
	 * The value for the object_type field.
	 * @var        string
	 */
	protected $object_type = 'resource';


	/**
	 * The value for the display_order field.
	 * @var        int
	 */
	protected $display_order;


	/**
	 * The value for the picklist_order field.
	 * @var        int
	 */
	protected $picklist_order;


	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label;


	/**
	 * The value for the definition field.
	 * @var        string
	 */
	protected $definition;


	/**
	 * The value for the comment field.
	 * @var        string
	 */
	protected $comment;


	/**
	 * The value for the examples field.
	 * @var        string
	 */
	protected $examples;


	/**
	 * The value for the is_required field.
	 * @var        boolean
	 */
	protected $is_required = false;


	/**
	 * The value for the is_reciprocal field.
	 * @var        boolean
	 */
	protected $is_reciprocal = false;


	/**
	 * The value for the is_singleton field.
	 * @var        boolean
	 */
	protected $is_singleton = false;


	/**
	 * The value for the is_scheme field.
	 * @var        boolean
	 */
	protected $is_scheme = false;


	/**
	 * The value for the is_in_picklist field.
	 * @var        boolean
	 */
	protected $is_in_picklist = true;

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
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{

		return $this->parent_id;
	}

	/**
	 * Get the [inverse_id] column value.
	 * 
	 * @return     int
	 */
	public function getInverseId()
	{

		return $this->inverse_id;
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
	 * Get the [uri] column value.
	 * 
	 * @return     string
	 */
	public function getUri()
	{

		return $this->uri;
	}

	/**
	 * Get the [object_type] column value.
	 * 
	 * @return     string
	 */
	public function getObjectType()
	{

		return $this->object_type;
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
	 * Get the [picklist_order] column value.
	 * 
	 * @return     int
	 */
	public function getPicklistOrder()
	{

		return $this->picklist_order;
	}

	/**
	 * Get the [label] column value.
	 * 
	 * @return     string
	 */
	public function getLabel()
	{

		return $this->label;
	}

	/**
	 * Get the [definition] column value.
	 * 
	 * @return     string
	 */
	public function getDefinition()
	{

		return $this->definition;
	}

	/**
	 * Get the [comment] column value.
	 * 
	 * @return     string
	 */
	public function getComment()
	{

		return $this->comment;
	}

	/**
	 * Get the [examples] column value.
	 * 
	 * @return     string
	 */
	public function getExamples()
	{

		return $this->examples;
	}

	/**
	 * Get the [is_required] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsRequired()
	{

		return $this->is_required;
	}

	/**
	 * Get the [is_reciprocal] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsReciprocal()
	{

		return $this->is_reciprocal;
	}

	/**
	 * Get the [is_singleton] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSingleton()
	{

		return $this->is_singleton;
	}

	/**
	 * Get the [is_scheme] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsScheme()
	{

		return $this->is_scheme;
	}

	/**
	 * Get the [is_in_picklist] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInPicklist()
	{

		return $this->is_in_picklist;
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
			$this->modifiedColumns[] = SkosPropertyPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setParentId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::PARENT_ID;
		}

	} // setParentId()

	/**
	 * Set the value of [inverse_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setInverseId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inverse_id !== $v) {
			$this->inverse_id = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::INVERSE_ID;
		}

	} // setInverseId()

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

		if ($this->name !== $v || $v === '') {
			$this->name = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [uri] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUri($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri !== $v || $v === '') {
			$this->uri = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::URI;
		}

	} // setUri()

	/**
	 * Set the value of [object_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setObjectType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_type !== $v || $v === 'resource') {
			$this->object_type = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::OBJECT_TYPE;
		}

	} // setObjectType()

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
			$this->modifiedColumns[] = SkosPropertyPeer::DISPLAY_ORDER;
		}

	} // setDisplayOrder()

	/**
	 * Set the value of [picklist_order] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPicklistOrder($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->picklist_order !== $v) {
			$this->picklist_order = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::PICKLIST_ORDER;
		}

	} // setPicklistOrder()

	/**
	 * Set the value of [label] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLabel($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::LABEL;
		}

	} // setLabel()

	/**
	 * Set the value of [definition] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDefinition($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->definition !== $v) {
			$this->definition = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::DEFINITION;
		}

	} // setDefinition()

	/**
	 * Set the value of [comment] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setComment($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::COMMENT;
		}

	} // setComment()

	/**
	 * Set the value of [examples] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setExamples($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->examples !== $v) {
			$this->examples = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::EXAMPLES;
		}

	} // setExamples()

	/**
	 * Set the value of [is_required] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsRequired($v)
	{

		if ($this->is_required !== $v || $v === false) {
			$this->is_required = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_REQUIRED;
		}

	} // setIsRequired()

	/**
	 * Set the value of [is_reciprocal] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsReciprocal($v)
	{

		if ($this->is_reciprocal !== $v || $v === false) {
			$this->is_reciprocal = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_RECIPROCAL;
		}

	} // setIsReciprocal()

	/**
	 * Set the value of [is_singleton] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsSingleton($v)
	{

		if ($this->is_singleton !== $v || $v === false) {
			$this->is_singleton = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_SINGLETON;
		}

	} // setIsSingleton()

	/**
	 * Set the value of [is_scheme] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsScheme($v)
	{

		if ($this->is_scheme !== $v || $v === false) {
			$this->is_scheme = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_SCHEME;
		}

	} // setIsScheme()

	/**
	 * Set the value of [is_in_picklist] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInPicklist($v)
	{

		if ($this->is_in_picklist !== $v || $v === true) {
			$this->is_in_picklist = $v;
			$this->modifiedColumns[] = SkosPropertyPeer::IS_IN_PICKLIST;
		}

	} // setIsInPicklist()

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

			$this->parent_id = $rs->getInt($startcol + 1);

			$this->inverse_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->uri = $rs->getString($startcol + 4);

			$this->object_type = $rs->getString($startcol + 5);

			$this->display_order = $rs->getInt($startcol + 6);

			$this->picklist_order = $rs->getInt($startcol + 7);

			$this->label = $rs->getString($startcol + 8);

			$this->definition = $rs->getString($startcol + 9);

			$this->comment = $rs->getString($startcol + 10);

			$this->examples = $rs->getString($startcol + 11);

			$this->is_required = $rs->getBoolean($startcol + 12);

			$this->is_reciprocal = $rs->getBoolean($startcol + 13);

			$this->is_singleton = $rs->getBoolean($startcol + 14);

			$this->is_scheme = $rs->getBoolean($startcol + 15);

			$this->is_in_picklist = $rs->getBoolean($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = SkosPropertyPeer::NUM_COLUMNS - SkosPropertyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SkosProperty object", $e);
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

    foreach (sfMixer::getCallables('BaseSkosProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SkosPropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSkosProperty:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseSkosProperty:save:pre') as $callable)
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
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSkosProperty:save:post') as $callable)
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
					$pk = SkosPropertyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SkosPropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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


			if (($retval = SkosPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = SkosPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getParentId();
				break;
			case 2:
				return $this->getInverseId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getUri();
				break;
			case 5:
				return $this->getObjectType();
				break;
			case 6:
				return $this->getDisplayOrder();
				break;
			case 7:
				return $this->getPicklistOrder();
				break;
			case 8:
				return $this->getLabel();
				break;
			case 9:
				return $this->getDefinition();
				break;
			case 10:
				return $this->getComment();
				break;
			case 11:
				return $this->getExamples();
				break;
			case 12:
				return $this->getIsRequired();
				break;
			case 13:
				return $this->getIsReciprocal();
				break;
			case 14:
				return $this->getIsSingleton();
				break;
			case 15:
				return $this->getIsScheme();
				break;
			case 16:
				return $this->getIsInPicklist();
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
		$keys = SkosPropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getInverseId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getUri(),
			$keys[5] => $this->getObjectType(),
			$keys[6] => $this->getDisplayOrder(),
			$keys[7] => $this->getPicklistOrder(),
			$keys[8] => $this->getLabel(),
			$keys[9] => $this->getDefinition(),
			$keys[10] => $this->getComment(),
			$keys[11] => $this->getExamples(),
			$keys[12] => $this->getIsRequired(),
			$keys[13] => $this->getIsReciprocal(),
			$keys[14] => $this->getIsSingleton(),
			$keys[15] => $this->getIsScheme(),
			$keys[16] => $this->getIsInPicklist(),
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
		$pos = SkosPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setParentId($value);
				break;
			case 2:
				$this->setInverseId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setUri($value);
				break;
			case 5:
				$this->setObjectType($value);
				break;
			case 6:
				$this->setDisplayOrder($value);
				break;
			case 7:
				$this->setPicklistOrder($value);
				break;
			case 8:
				$this->setLabel($value);
				break;
			case 9:
				$this->setDefinition($value);
				break;
			case 10:
				$this->setComment($value);
				break;
			case 11:
				$this->setExamples($value);
				break;
			case 12:
				$this->setIsRequired($value);
				break;
			case 13:
				$this->setIsReciprocal($value);
				break;
			case 14:
				$this->setIsSingleton($value);
				break;
			case 15:
				$this->setIsScheme($value);
				break;
			case 16:
				$this->setIsInPicklist($value);
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
		$keys = SkosPropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInverseId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUri($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObjectType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDisplayOrder($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPicklistOrder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLabel($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDefinition($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setExamples($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsRequired($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsReciprocal($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsSingleton($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIsScheme($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setIsInPicklist($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(SkosPropertyPeer::ID)) $criteria->add(SkosPropertyPeer::ID, $this->id);
		if ($this->isColumnModified(SkosPropertyPeer::PARENT_ID)) $criteria->add(SkosPropertyPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(SkosPropertyPeer::INVERSE_ID)) $criteria->add(SkosPropertyPeer::INVERSE_ID, $this->inverse_id);
		if ($this->isColumnModified(SkosPropertyPeer::NAME)) $criteria->add(SkosPropertyPeer::NAME, $this->name);
		if ($this->isColumnModified(SkosPropertyPeer::URI)) $criteria->add(SkosPropertyPeer::URI, $this->uri);
		if ($this->isColumnModified(SkosPropertyPeer::OBJECT_TYPE)) $criteria->add(SkosPropertyPeer::OBJECT_TYPE, $this->object_type);
		if ($this->isColumnModified(SkosPropertyPeer::DISPLAY_ORDER)) $criteria->add(SkosPropertyPeer::DISPLAY_ORDER, $this->display_order);
		if ($this->isColumnModified(SkosPropertyPeer::PICKLIST_ORDER)) $criteria->add(SkosPropertyPeer::PICKLIST_ORDER, $this->picklist_order);
		if ($this->isColumnModified(SkosPropertyPeer::LABEL)) $criteria->add(SkosPropertyPeer::LABEL, $this->label);
		if ($this->isColumnModified(SkosPropertyPeer::DEFINITION)) $criteria->add(SkosPropertyPeer::DEFINITION, $this->definition);
		if ($this->isColumnModified(SkosPropertyPeer::COMMENT)) $criteria->add(SkosPropertyPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(SkosPropertyPeer::EXAMPLES)) $criteria->add(SkosPropertyPeer::EXAMPLES, $this->examples);
		if ($this->isColumnModified(SkosPropertyPeer::IS_REQUIRED)) $criteria->add(SkosPropertyPeer::IS_REQUIRED, $this->is_required);
		if ($this->isColumnModified(SkosPropertyPeer::IS_RECIPROCAL)) $criteria->add(SkosPropertyPeer::IS_RECIPROCAL, $this->is_reciprocal);
		if ($this->isColumnModified(SkosPropertyPeer::IS_SINGLETON)) $criteria->add(SkosPropertyPeer::IS_SINGLETON, $this->is_singleton);
		if ($this->isColumnModified(SkosPropertyPeer::IS_SCHEME)) $criteria->add(SkosPropertyPeer::IS_SCHEME, $this->is_scheme);
		if ($this->isColumnModified(SkosPropertyPeer::IS_IN_PICKLIST)) $criteria->add(SkosPropertyPeer::IS_IN_PICKLIST, $this->is_in_picklist);

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
		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);

		$criteria->add(SkosPropertyPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SkosProperty (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParentId($this->parent_id);

		$copyObj->setInverseId($this->inverse_id);

		$copyObj->setName($this->name);

		$copyObj->setUri($this->uri);

		$copyObj->setObjectType($this->object_type);

		$copyObj->setDisplayOrder($this->display_order);

		$copyObj->setPicklistOrder($this->picklist_order);

		$copyObj->setLabel($this->label);

		$copyObj->setDefinition($this->definition);

		$copyObj->setComment($this->comment);

		$copyObj->setExamples($this->examples);

		$copyObj->setIsRequired($this->is_required);

		$copyObj->setIsReciprocal($this->is_reciprocal);

		$copyObj->setIsSingleton($this->is_singleton);

		$copyObj->setIsScheme($this->is_scheme);

		$copyObj->setIsInPicklist($this->is_in_picklist);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
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
	 * @return     SkosProperty Clone of current object.
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
	 * @return     SkosPropertyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SkosPropertyPeer();
		}
		return self::$peer;
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
	 * Otherwise if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 * If this SkosProperty is new, it will return
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertys = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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

		$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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
		$l->setSkosProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyCriteria = $criteria;

		return $this->collConceptPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
	 */
	public function getConceptPropertysJoinStatus($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
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
	 * Otherwise if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 * If this SkosProperty is new, it will return
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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

		$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
		$l->setSkosProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
	 */
	public function getConceptPropertyHistorysJoinStatus($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SkosProperty is new, it will return
	 * an empty collection; or if this SkosProperty has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SkosProperty.
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

				$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSkosProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSkosProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseSkosProperty
