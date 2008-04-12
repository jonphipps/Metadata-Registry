<?php

/**
 * Base class that represents a row from the 'reg_schema_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaProperty extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SchemaPropertyPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the updated_at field.
	 * @var        int
	 */
	protected $updated_at;


	/**
	 * The value for the deleted_at field.
	 * @var        int
	 */
	protected $deleted_at;


	/**
	 * The value for the created_user_id field.
	 * @var        int
	 */
	protected $created_user_id;


	/**
	 * The value for the updated_user_id field.
	 * @var        int
	 */
	protected $updated_user_id;


	/**
	 * The value for the schema_id field.
	 * @var        int
	 */
	protected $schema_id = 0;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name = '';


	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label = '';


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
	 * The value for the type field.
	 * @var        string
	 */
	protected $type = '';


	/**
	 * The value for the related_property_id field.
	 * @var        int
	 */
	protected $related_property_id;


	/**
	 * The value for the related_property field.
	 * @var        string
	 */
	protected $related_property;


	/**
	 * The value for the uri field.
	 * @var        string
	 */
	protected $uri;


	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id = 0;


	/**
	 * The value for the language field.
	 * @var        string
	 */
	protected $language = '';


	/**
	 * The value for the note field.
	 * @var        string
	 */
	protected $note;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByCreatedUserId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByUpdatedUserId;

	/**
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        SchemaProperty
	 */
	protected $aSchemaPropertyRelatedByRelatedPropertyId;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByRelatedPropertyId.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByRelatedPropertyId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByRelatedPropertyId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElements.
	 * @var        array
	 */
	protected $collSchemaPropertyElements;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElements.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorysRelatedBySchemaPropertyId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorysRelatedBySchemaPropertyId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = null;

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
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
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
	 * Get the [optionally formatted] [updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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
	 * Get the [optionally formatted] [deleted_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
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
	 * Get the [created_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedUserId()
	{

		return $this->created_user_id;
	}

	/**
	 * Get the [updated_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUpdatedUserId()
	{

		return $this->updated_user_id;
	}

	/**
	 * Get the [schema_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaId()
	{

		return $this->schema_id;
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
	 * Get the [type] column value.
	 * 
	 * @return     string
	 */
	public function getType()
	{

		return $this->type;
	}

	/**
	 * Get the [related_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getRelatedPropertyId()
	{

		return $this->related_property_id;
	}

	/**
	 * Get the [related_property] column value.
	 * 
	 * @return     string
	 */
	public function getRelatedProperty()
	{

		return $this->related_property;
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
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{

		return $this->status_id;
	}

	/**
	 * Get the [language] column value.
	 * 
	 * @return     string
	 */
	public function getLanguage()
	{

		return $this->language;
	}

	/**
	 * Get the [note] column value.
	 * 
	 * @return     string
	 */
	public function getNote()
	{

		return $this->note;
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
			$this->modifiedColumns[] = SchemaPropertyPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
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
			$this->modifiedColumns[] = SchemaPropertyPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SchemaPropertyPeer::UPDATED_AT;
		}

	} // setUpdatedAt()

	/**
	 * Set the value of [deleted_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = SchemaPropertyPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [created_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_user_id !== $v) {
			$this->created_user_id = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::CREATED_USER_ID;
		}

		if ($this->aUserRelatedByCreatedUserId !== null && $this->aUserRelatedByCreatedUserId->getId() !== $v) {
			$this->aUserRelatedByCreatedUserId = null;
		}

	} // setCreatedUserId()

	/**
	 * Set the value of [updated_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_user_id !== $v) {
			$this->updated_user_id = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::UPDATED_USER_ID;
		}

		if ($this->aUserRelatedByUpdatedUserId !== null && $this->aUserRelatedByUpdatedUserId->getId() !== $v) {
			$this->aUserRelatedByUpdatedUserId = null;
		}

	} // setUpdatedUserId()

	/**
	 * Set the value of [schema_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_id !== $v || $v === 0) {
			$this->schema_id = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

	} // setSchemaId()

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
			$this->modifiedColumns[] = SchemaPropertyPeer::NAME;
		}

	} // setName()

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

		if ($this->label !== $v || $v === '') {
			$this->label = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::LABEL;
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
			$this->modifiedColumns[] = SchemaPropertyPeer::DEFINITION;
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
			$this->modifiedColumns[] = SchemaPropertyPeer::COMMENT;
		}

	} // setComment()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v || $v === '') {
			$this->type = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::TYPE;
		}

	} // setType()

	/**
	 * Set the value of [related_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRelatedPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->related_property_id !== $v) {
			$this->related_property_id = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::RELATED_PROPERTY_ID;
		}

		if ($this->aSchemaPropertyRelatedByRelatedPropertyId !== null && $this->aSchemaPropertyRelatedByRelatedPropertyId->getId() !== $v) {
			$this->aSchemaPropertyRelatedByRelatedPropertyId = null;
		}

	} // setRelatedPropertyId()

	/**
	 * Set the value of [related_property] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setRelatedProperty($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->related_property !== $v) {
			$this->related_property = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::RELATED_PROPERTY;
		}

	} // setRelatedProperty()

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

		if ($this->uri !== $v) {
			$this->uri = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::URI;
		}

	} // setUri()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStatusId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 0) {
			$this->status_id = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

	} // setStatusId()

	/**
	 * Set the value of [language] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLanguage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->language !== $v || $v === '') {
			$this->language = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::LANGUAGE;
		}

	} // setLanguage()

	/**
	 * Set the value of [note] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setNote($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = SchemaPropertyPeer::NOTE;
		}

	} // setNote()

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

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->created_user_id = $rs->getInt($startcol + 4);

			$this->updated_user_id = $rs->getInt($startcol + 5);

			$this->schema_id = $rs->getInt($startcol + 6);

			$this->name = $rs->getString($startcol + 7);

			$this->label = $rs->getString($startcol + 8);

			$this->definition = $rs->getString($startcol + 9);

			$this->comment = $rs->getString($startcol + 10);

			$this->type = $rs->getString($startcol + 11);

			$this->related_property_id = $rs->getInt($startcol + 12);

			$this->related_property = $rs->getString($startcol + 13);

			$this->uri = $rs->getString($startcol + 14);

			$this->status_id = $rs->getInt($startcol + 15);

			$this->language = $rs->getString($startcol + 16);

			$this->note = $rs->getString($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 18; // 18 = SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SchemaProperty object", $e);
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

    foreach (sfMixer::getCallables('BaseSchemaProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SchemaPropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSchemaProperty:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseSchemaProperty:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SchemaPropertyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SchemaPropertyPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSchemaProperty:save:post') as $callable)
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


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if ($this->aUserRelatedByCreatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByCreatedUserId->save($con);
				}
				$this->setUserRelatedByCreatedUserId($this->aUserRelatedByCreatedUserId);
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if ($this->aUserRelatedByUpdatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByUpdatedUserId->save($con);
				}
				$this->setUserRelatedByUpdatedUserId($this->aUserRelatedByUpdatedUserId);
			}

			if ($this->aSchema !== null) {
				if ($this->aSchema->isModified()) {
					$affectedRows += $this->aSchema->save($con);
				}
				$this->setSchema($this->aSchema);
			}

			if ($this->aSchemaPropertyRelatedByRelatedPropertyId !== null) {
				if ($this->aSchemaPropertyRelatedByRelatedPropertyId->isModified()) {
					$affectedRows += $this->aSchemaPropertyRelatedByRelatedPropertyId->save($con);
				}
				$this->setSchemaPropertyRelatedByRelatedPropertyId($this->aSchemaPropertyRelatedByRelatedPropertyId);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SchemaPropertyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SchemaPropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSchemaPropertysRelatedByRelatedPropertyId !== null) {
				foreach($this->collSchemaPropertysRelatedByRelatedPropertyId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElements !== null) {
				foreach($this->collSchemaPropertyElements as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId !== null) {
				foreach($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId !== null) {
				foreach($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUserRelatedByCreatedUserId !== null) {
				if (!$this->aUserRelatedByCreatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedUserId->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByUpdatedUserId !== null) {
				if (!$this->aUserRelatedByUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedUserId->getValidationFailures());
				}
			}

			if ($this->aSchema !== null) {
				if (!$this->aSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchema->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyRelatedByRelatedPropertyId !== null) {
				if (!$this->aSchemaPropertyRelatedByRelatedPropertyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyRelatedByRelatedPropertyId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = SchemaPropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSchemaPropertyElements !== null) {
					foreach($this->collSchemaPropertyElements as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId !== null) {
					foreach($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId !== null) {
					foreach($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId as $referrerFK) {
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
		$pos = SchemaPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getCreatedUserId();
				break;
			case 5:
				return $this->getUpdatedUserId();
				break;
			case 6:
				return $this->getSchemaId();
				break;
			case 7:
				return $this->getName();
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
				return $this->getType();
				break;
			case 12:
				return $this->getRelatedPropertyId();
				break;
			case 13:
				return $this->getRelatedProperty();
				break;
			case 14:
				return $this->getUri();
				break;
			case 15:
				return $this->getStatusId();
				break;
			case 16:
				return $this->getLanguage();
				break;
			case 17:
				return $this->getNote();
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
		$keys = SchemaPropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getCreatedUserId(),
			$keys[5] => $this->getUpdatedUserId(),
			$keys[6] => $this->getSchemaId(),
			$keys[7] => $this->getName(),
			$keys[8] => $this->getLabel(),
			$keys[9] => $this->getDefinition(),
			$keys[10] => $this->getComment(),
			$keys[11] => $this->getType(),
			$keys[12] => $this->getRelatedPropertyId(),
			$keys[13] => $this->getRelatedProperty(),
			$keys[14] => $this->getUri(),
			$keys[15] => $this->getStatusId(),
			$keys[16] => $this->getLanguage(),
			$keys[17] => $this->getNote(),
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
		$pos = SchemaPropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setCreatedUserId($value);
				break;
			case 5:
				$this->setUpdatedUserId($value);
				break;
			case 6:
				$this->setSchemaId($value);
				break;
			case 7:
				$this->setName($value);
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
				$this->setType($value);
				break;
			case 12:
				$this->setRelatedPropertyId($value);
				break;
			case 13:
				$this->setRelatedProperty($value);
				break;
			case 14:
				$this->setUri($value);
				break;
			case 15:
				$this->setStatusId($value);
				break;
			case 16:
				$this->setLanguage($value);
				break;
			case 17:
				$this->setNote($value);
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
		$keys = SchemaPropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedUserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSchemaId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLabel($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDefinition($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setType($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setRelatedPropertyId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRelatedProperty($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUri($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setStatusId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLanguage($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setNote($arr[$keys[17]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SchemaPropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(SchemaPropertyPeer::ID)) $criteria->add(SchemaPropertyPeer::ID, $this->id);
		if ($this->isColumnModified(SchemaPropertyPeer::CREATED_AT)) $criteria->add(SchemaPropertyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SchemaPropertyPeer::UPDATED_AT)) $criteria->add(SchemaPropertyPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SchemaPropertyPeer::DELETED_AT)) $criteria->add(SchemaPropertyPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(SchemaPropertyPeer::CREATED_USER_ID)) $criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(SchemaPropertyPeer::UPDATED_USER_ID)) $criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->updated_user_id);
		if ($this->isColumnModified(SchemaPropertyPeer::SCHEMA_ID)) $criteria->add(SchemaPropertyPeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(SchemaPropertyPeer::NAME)) $criteria->add(SchemaPropertyPeer::NAME, $this->name);
		if ($this->isColumnModified(SchemaPropertyPeer::LABEL)) $criteria->add(SchemaPropertyPeer::LABEL, $this->label);
		if ($this->isColumnModified(SchemaPropertyPeer::DEFINITION)) $criteria->add(SchemaPropertyPeer::DEFINITION, $this->definition);
		if ($this->isColumnModified(SchemaPropertyPeer::COMMENT)) $criteria->add(SchemaPropertyPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(SchemaPropertyPeer::TYPE)) $criteria->add(SchemaPropertyPeer::TYPE, $this->type);
		if ($this->isColumnModified(SchemaPropertyPeer::RELATED_PROPERTY_ID)) $criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->related_property_id);
		if ($this->isColumnModified(SchemaPropertyPeer::RELATED_PROPERTY)) $criteria->add(SchemaPropertyPeer::RELATED_PROPERTY, $this->related_property);
		if ($this->isColumnModified(SchemaPropertyPeer::URI)) $criteria->add(SchemaPropertyPeer::URI, $this->uri);
		if ($this->isColumnModified(SchemaPropertyPeer::STATUS_ID)) $criteria->add(SchemaPropertyPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(SchemaPropertyPeer::LANGUAGE)) $criteria->add(SchemaPropertyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(SchemaPropertyPeer::NOTE)) $criteria->add(SchemaPropertyPeer::NOTE, $this->note);

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
		$criteria = new Criteria(SchemaPropertyPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SchemaProperty (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setUpdatedUserId($this->updated_user_id);

		$copyObj->setSchemaId($this->schema_id);

		$copyObj->setName($this->name);

		$copyObj->setLabel($this->label);

		$copyObj->setDefinition($this->definition);

		$copyObj->setComment($this->comment);

		$copyObj->setType($this->type);

		$copyObj->setRelatedPropertyId($this->related_property_id);

		$copyObj->setRelatedProperty($this->related_property);

		$copyObj->setUri($this->uri);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setNote($this->note);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getSchemaPropertysRelatedByRelatedPropertyId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addSchemaPropertyRelatedByRelatedPropertyId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElements() as $relObj) {
				$copyObj->addSchemaPropertyElement($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorysRelatedBySchemaPropertyId() as $relObj) {
				$copyObj->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId() as $relObj) {
				$copyObj->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($relObj->copy($deepCopy));
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
	 * @return     SchemaProperty Clone of current object.
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
	 * @return     SchemaPropertyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SchemaPropertyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByCreatedUserId($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUserRelatedByCreatedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByCreatedUserId($con = null)
	{
		if ($this->aUserRelatedByCreatedUserId === null && ($this->created_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByCreatedUserId = UserPeer::retrieveByPK($this->created_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->created_user_id, $con);
			   $obj->addUsersRelatedByCreatedUserId($this);
			 */
		}
		return $this->aUserRelatedByCreatedUserId;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setUpdatedUserId(NULL);
		} else {
			$this->setUpdatedUserId($v->getId());
		}


		$this->aUserRelatedByUpdatedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByUpdatedUserId($con = null)
	{
		if ($this->aUserRelatedByUpdatedUserId === null && ($this->updated_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByUpdatedUserId = UserPeer::retrieveByPK($this->updated_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->updated_user_id, $con);
			   $obj->addUsersRelatedByUpdatedUserId($this);
			 */
		}
		return $this->aUserRelatedByUpdatedUserId;
	}

	/**
	 * Declares an association between this object and a Schema object.
	 *
	 * @param      Schema $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchema($v)
	{


		if ($v === null) {
			$this->setSchemaId('');
		} else {
			$this->setSchemaId($v->getId());
		}


		$this->aSchema = $v;
	}


	/**
	 * Get the associated Schema object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Schema The associated Schema object.
	 * @throws     PropelException
	 */
	public function getSchema($con = null)
	{
		if ($this->aSchema === null && ($this->schema_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPeer.php';

			$this->aSchema = SchemaPeer::retrieveByPK($this->schema_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPeer::retrieveByPK($this->schema_id, $con);
			   $obj->addSchemas($this);
			 */
		}
		return $this->aSchema;
	}

	/**
	 * Declares an association between this object and a SchemaProperty object.
	 *
	 * @param      SchemaProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchemaPropertyRelatedByRelatedPropertyId($v)
	{


		if ($v === null) {
			$this->setRelatedPropertyId(NULL);
		} else {
			$this->setRelatedPropertyId($v->getId());
		}


		$this->aSchemaPropertyRelatedByRelatedPropertyId = $v;
	}


	/**
	 * Get the associated SchemaProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaProperty The associated SchemaProperty object.
	 * @throws     PropelException
	 */
	public function getSchemaPropertyRelatedByRelatedPropertyId($con = null)
	{
		if ($this->aSchemaPropertyRelatedByRelatedPropertyId === null && ($this->related_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyPeer.php';

			$this->aSchemaPropertyRelatedByRelatedPropertyId = SchemaPropertyPeer::retrieveByPK($this->related_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyPeer::retrieveByPK($this->related_property_id, $con);
			   $obj->addSchemaPropertysRelatedByRelatedPropertyId($this);
			 */
		}
		return $this->aSchemaPropertyRelatedByRelatedPropertyId;
	}

	/**
	 * Declares an association between this object and a Status object.
	 *
	 * @param      Status $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setStatus($v)
	{


		if ($v === null) {
			$this->setStatusId('0');
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aStatus = $v;
	}


	/**
	 * Get the associated Status object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Status The associated Status object.
	 * @throws     PropelException
	 */
	public function getStatus($con = null)
	{
		if ($this->aStatus === null && ($this->status_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseStatusPeer.php';

			$this->aStatus = StatusPeer::retrieveByPK($this->status_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = StatusPeer::retrieveByPK($this->status_id, $con);
			   $obj->addStatuss($this);
			 */
		}
		return $this->aStatus;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByRelatedPropertyId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByRelatedPropertyId()
	{
		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			$this->collSchemaPropertysRelatedByRelatedPropertyId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByRelatedPropertyId from storage.
	 * If this SchemaProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByRelatedPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByRelatedPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria) || !$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByRelatedPropertyId;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByRelatedPropertyId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByRelatedPropertyId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

		return SchemaPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaProperty object to this object
	 * through the SchemaProperty foreign key attribute
	 *
	 * @param      SchemaProperty $l SchemaProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyRelatedByRelatedPropertyId(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByRelatedPropertyId[] = $l;
		$l->setSchemaPropertyRelatedByRelatedPropertyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByRelatedPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertysRelatedByRelatedPropertyIdJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria) || !$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByRelatedPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByRelatedPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertysRelatedByRelatedPropertyIdJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria) || !$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByRelatedPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByRelatedPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertysRelatedByRelatedPropertyIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria) || !$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByRelatedPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByRelatedPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertysRelatedByRelatedPropertyIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertysRelatedByRelatedPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::RELATED_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria) || !$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByRelatedPropertyId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByRelatedPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByRelatedPropertyId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElements to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElements()
	{
		if ($this->collSchemaPropertyElements === null) {
			$this->collSchemaPropertyElements = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 * If this SchemaProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElements($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElements === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElements = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
					$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;
		return $this->collSchemaPropertyElements;
	}

	/**
	 * Returns the number of related SchemaPropertyElements.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElements($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

		return SchemaPropertyElementPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElement object to this object
	 * through the SchemaPropertyElement foreign key attribute
	 *
	 * @param      SchemaPropertyElement $l SchemaPropertyElement
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElement(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElements[] = $l;
		$l->setSchemaProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementsJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElements === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElements = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementsJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElements === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElements = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementsJoinSchemaPropertyElementRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElements === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElements = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyElementRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyElementRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementsJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElements === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElements = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorysRelatedBySchemaPropertyId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorysRelatedBySchemaPropertyId()
	{
		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedBySchemaPropertyId from storage.
	 * If this SchemaProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorysRelatedBySchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorysRelatedBySchemaPropertyId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorysRelatedBySchemaPropertyId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

		return SchemaPropertyElementHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElementHistory object to this object
	 * through the SchemaPropertyElementHistory foreign key attribute
	 *
	 * @param      SchemaPropertyElementHistory $l SchemaPropertyElementHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementHistoryRelatedBySchemaPropertyId(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId[] = $l;
		$l->setSchemaPropertyRelatedBySchemaPropertyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedBySchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedBySchemaPropertyIdJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedBySchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedBySchemaPropertyIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedBySchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedBySchemaPropertyIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedBySchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedBySchemaPropertyIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedBySchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedBySchemaPropertyId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId()
	{
		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId from storage.
	 * If this SchemaProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

		return SchemaPropertyElementHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyElementHistory object to this object
	 * through the SchemaPropertyElementHistory foreign key attribute
	 *
	 * @param      SchemaPropertyElementHistory $l SchemaPropertyElementHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId[] = $l;
		$l->setSchemaPropertyRelatedByRelatedSchemaPropertyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyIdJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SchemaProperty is new, it will return
	 * an empty collection; or if this SchemaProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SchemaProperty.
	 */
	public function getSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyIdJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyElementHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria) || !$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyIdCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSchemaProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSchemaProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseSchemaProperty
