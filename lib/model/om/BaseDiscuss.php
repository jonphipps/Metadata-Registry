<?php

/**
 * Base class that represents a row from the 'reg_discuss' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDiscuss extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DiscussPeer
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
	 * The value for the deleted_user_id field.
	 * @var        int
	 */
	protected $deleted_user_id;


	/**
	 * The value for the uri field.
	 * @var        string
	 */
	protected $uri;


	/**
	 * The value for the schema_id field.
	 * @var        int
	 */
	protected $schema_id;


	/**
	 * The value for the schema_property_id field.
	 * @var        int
	 */
	protected $schema_property_id;


	/**
	 * The value for the schema_property_element_id field.
	 * @var        int
	 */
	protected $schema_property_element_id;


	/**
	 * The value for the vocabulary_id field.
	 * @var        int
	 */
	protected $vocabulary_id;


	/**
	 * The value for the concept_id field.
	 * @var        int
	 */
	protected $concept_id;


	/**
	 * The value for the concept_property_id field.
	 * @var        int
	 */
	protected $concept_property_id;


	/**
	 * The value for the root_id field.
	 * @var        int
	 */
	protected $root_id;


	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;


	/**
	 * The value for the subject field.
	 * @var        string
	 */
	protected $subject;


	/**
	 * The value for the content field.
	 * @var        string
	 */
	protected $content;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByCreatedUserId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByDeletedUserId;

	/**
	 * @var        Schema
	 */
	protected $aSchema;

	/**
	 * @var        SchemaProperty
	 */
	protected $aSchemaProperty;

	/**
	 * @var        SchemaPropertyElement
	 */
	protected $aSchemaPropertyElement;

	/**
	 * @var        Vocabulary
	 */
	protected $aVocabulary;

	/**
	 * @var        Concept
	 */
	protected $aConcept;

	/**
	 * @var        ConceptProperty
	 */
	protected $aConceptProperty;

	/**
	 * @var        Discuss
	 */
	protected $aDiscussRelatedByRootId;

	/**
	 * @var        Discuss
	 */
	protected $aDiscussRelatedByParentId;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByRootId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByRootId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByRootId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByRootIdCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByParentId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByParentId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByParentId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByParentIdCriteria = null;

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
	 * Get the [deleted_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getDeletedUserId()
	{

		return $this->deleted_user_id;
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
	 * Get the [schema_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaId()
	{

		return $this->schema_id;
	}

	/**
	 * Get the [schema_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaPropertyId()
	{

		return $this->schema_property_id;
	}

	/**
	 * Get the [schema_property_element_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchemaPropertyElementId()
	{

		return $this->schema_property_element_id;
	}

	/**
	 * Get the [vocabulary_id] column value.
	 * 
	 * @return     int
	 */
	public function getVocabularyId()
	{

		return $this->vocabulary_id;
	}

	/**
	 * Get the [concept_id] column value.
	 * 
	 * @return     int
	 */
	public function getConceptId()
	{

		return $this->concept_id;
	}

	/**
	 * Get the [concept_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getConceptPropertyId()
	{

		return $this->concept_property_id;
	}

	/**
	 * Get the [root_id] column value.
	 * 
	 * @return     int
	 */
	public function getRootId()
	{

		return $this->root_id;
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
	 * Get the [subject] column value.
	 * 
	 * @return     string
	 */
	public function getSubject()
	{

		return $this->subject;
	}

	/**
	 * Get the [content] column value.
	 * 
	 * @return     string
	 */
	public function getContent()
	{

		return $this->content;
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
			$this->modifiedColumns[] = DiscussPeer::ID;
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
			$this->modifiedColumns[] = DiscussPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DiscussPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = DiscussPeer::DELETED_AT;
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
			$this->modifiedColumns[] = DiscussPeer::CREATED_USER_ID;
		}

		if ($this->aUserRelatedByCreatedUserId !== null && $this->aUserRelatedByCreatedUserId->getId() !== $v) {
			$this->aUserRelatedByCreatedUserId = null;
		}

	} // setCreatedUserId()

	/**
	 * Set the value of [deleted_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deleted_user_id !== $v) {
			$this->deleted_user_id = $v;
			$this->modifiedColumns[] = DiscussPeer::DELETED_USER_ID;
		}

		if ($this->aUserRelatedByDeletedUserId !== null && $this->aUserRelatedByDeletedUserId->getId() !== $v) {
			$this->aUserRelatedByDeletedUserId = null;
		}

	} // setDeletedUserId()

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
			$this->modifiedColumns[] = DiscussPeer::URI;
		}

	} // setUri()

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

		if ($this->schema_id !== $v) {
			$this->schema_id = $v;
			$this->modifiedColumns[] = DiscussPeer::SCHEMA_ID;
		}

		if ($this->aSchema !== null && $this->aSchema->getId() !== $v) {
			$this->aSchema = null;
		}

	} // setSchemaId()

	/**
	 * Set the value of [schema_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_property_id !== $v) {
			$this->schema_property_id = $v;
			$this->modifiedColumns[] = DiscussPeer::SCHEMA_PROPERTY_ID;
		}

		if ($this->aSchemaProperty !== null && $this->aSchemaProperty->getId() !== $v) {
			$this->aSchemaProperty = null;
		}

	} // setSchemaPropertyId()

	/**
	 * Set the value of [schema_property_element_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSchemaPropertyElementId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->schema_property_element_id !== $v) {
			$this->schema_property_element_id = $v;
			$this->modifiedColumns[] = DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID;
		}

		if ($this->aSchemaPropertyElement !== null && $this->aSchemaPropertyElement->getId() !== $v) {
			$this->aSchemaPropertyElement = null;
		}

	} // setSchemaPropertyElementId()

	/**
	 * Set the value of [vocabulary_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setVocabularyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vocabulary_id !== $v) {
			$this->vocabulary_id = $v;
			$this->modifiedColumns[] = DiscussPeer::VOCABULARY_ID;
		}

		if ($this->aVocabulary !== null && $this->aVocabulary->getId() !== $v) {
			$this->aVocabulary = null;
		}

	} // setVocabularyId()

	/**
	 * Set the value of [concept_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setConceptId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_id !== $v) {
			$this->concept_id = $v;
			$this->modifiedColumns[] = DiscussPeer::CONCEPT_ID;
		}

		if ($this->aConcept !== null && $this->aConcept->getId() !== $v) {
			$this->aConcept = null;
		}

	} // setConceptId()

	/**
	 * Set the value of [concept_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setConceptPropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->concept_property_id !== $v) {
			$this->concept_property_id = $v;
			$this->modifiedColumns[] = DiscussPeer::CONCEPT_PROPERTY_ID;
		}

		if ($this->aConceptProperty !== null && $this->aConceptProperty->getId() !== $v) {
			$this->aConceptProperty = null;
		}

	} // setConceptPropertyId()

	/**
	 * Set the value of [root_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRootId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->root_id !== $v) {
			$this->root_id = $v;
			$this->modifiedColumns[] = DiscussPeer::ROOT_ID;
		}

		if ($this->aDiscussRelatedByRootId !== null && $this->aDiscussRelatedByRootId->getId() !== $v) {
			$this->aDiscussRelatedByRootId = null;
		}

	} // setRootId()

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
			$this->modifiedColumns[] = DiscussPeer::PARENT_ID;
		}

		if ($this->aDiscussRelatedByParentId !== null && $this->aDiscussRelatedByParentId->getId() !== $v) {
			$this->aDiscussRelatedByParentId = null;
		}

	} // setParentId()

	/**
	 * Set the value of [subject] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSubject($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subject !== $v) {
			$this->subject = $v;
			$this->modifiedColumns[] = DiscussPeer::SUBJECT;
		}

	} // setSubject()

	/**
	 * Set the value of [content] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setContent($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = DiscussPeer::CONTENT;
		}

	} // setContent()

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

			$this->deleted_user_id = $rs->getInt($startcol + 5);

			$this->uri = $rs->getString($startcol + 6);

			$this->schema_id = $rs->getInt($startcol + 7);

			$this->schema_property_id = $rs->getInt($startcol + 8);

			$this->schema_property_element_id = $rs->getInt($startcol + 9);

			$this->vocabulary_id = $rs->getInt($startcol + 10);

			$this->concept_id = $rs->getInt($startcol + 11);

			$this->concept_property_id = $rs->getInt($startcol + 12);

			$this->root_id = $rs->getInt($startcol + 13);

			$this->parent_id = $rs->getInt($startcol + 14);

			$this->subject = $rs->getString($startcol + 15);

			$this->content = $rs->getString($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Discuss object", $e);
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

    foreach (sfMixer::getCallables('BaseDiscuss:delete:pre') as $callable)
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
			$con = Propel::getConnection(DiscussPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DiscussPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDiscuss:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseDiscuss:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DiscussPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DiscussPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DiscussPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDiscuss:save:post') as $callable)
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

			if ($this->aUserRelatedByDeletedUserId !== null) {
				if ($this->aUserRelatedByDeletedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByDeletedUserId->save($con);
				}
				$this->setUserRelatedByDeletedUserId($this->aUserRelatedByDeletedUserId);
			}

			if ($this->aSchema !== null) {
				if ($this->aSchema->isModified()) {
					$affectedRows += $this->aSchema->save($con);
				}
				$this->setSchema($this->aSchema);
			}

			if ($this->aSchemaProperty !== null) {
				if ($this->aSchemaProperty->isModified()) {
					$affectedRows += $this->aSchemaProperty->save($con);
				}
				$this->setSchemaProperty($this->aSchemaProperty);
			}

			if ($this->aSchemaPropertyElement !== null) {
				if ($this->aSchemaPropertyElement->isModified()) {
					$affectedRows += $this->aSchemaPropertyElement->save($con);
				}
				$this->setSchemaPropertyElement($this->aSchemaPropertyElement);
			}

			if ($this->aVocabulary !== null) {
				if ($this->aVocabulary->isModified()) {
					$affectedRows += $this->aVocabulary->save($con);
				}
				$this->setVocabulary($this->aVocabulary);
			}

			if ($this->aConcept !== null) {
				if ($this->aConcept->isModified()) {
					$affectedRows += $this->aConcept->save($con);
				}
				$this->setConcept($this->aConcept);
			}

			if ($this->aConceptProperty !== null) {
				if ($this->aConceptProperty->isModified()) {
					$affectedRows += $this->aConceptProperty->save($con);
				}
				$this->setConceptProperty($this->aConceptProperty);
			}

			if ($this->aDiscussRelatedByRootId !== null) {
				if ($this->aDiscussRelatedByRootId->isModified()) {
					$affectedRows += $this->aDiscussRelatedByRootId->save($con);
				}
				$this->setDiscussRelatedByRootId($this->aDiscussRelatedByRootId);
			}

			if ($this->aDiscussRelatedByParentId !== null) {
				if ($this->aDiscussRelatedByParentId->isModified()) {
					$affectedRows += $this->aDiscussRelatedByParentId->save($con);
				}
				$this->setDiscussRelatedByParentId($this->aDiscussRelatedByParentId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DiscussPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DiscussPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDiscusssRelatedByRootId !== null) {
				foreach($this->collDiscusssRelatedByRootId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByParentId !== null) {
				foreach($this->collDiscusssRelatedByParentId as $referrerFK) {
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

			if ($this->aUserRelatedByDeletedUserId !== null) {
				if (!$this->aUserRelatedByDeletedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByDeletedUserId->getValidationFailures());
				}
			}

			if ($this->aSchema !== null) {
				if (!$this->aSchema->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchema->getValidationFailures());
				}
			}

			if ($this->aSchemaProperty !== null) {
				if (!$this->aSchemaProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaProperty->getValidationFailures());
				}
			}

			if ($this->aSchemaPropertyElement !== null) {
				if (!$this->aSchemaPropertyElement->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchemaPropertyElement->getValidationFailures());
				}
			}

			if ($this->aVocabulary !== null) {
				if (!$this->aVocabulary->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVocabulary->getValidationFailures());
				}
			}

			if ($this->aConcept !== null) {
				if (!$this->aConcept->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcept->getValidationFailures());
				}
			}

			if ($this->aConceptProperty !== null) {
				if (!$this->aConceptProperty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptProperty->getValidationFailures());
				}
			}

			if ($this->aDiscussRelatedByRootId !== null) {
				if (!$this->aDiscussRelatedByRootId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDiscussRelatedByRootId->getValidationFailures());
				}
			}

			if ($this->aDiscussRelatedByParentId !== null) {
				if (!$this->aDiscussRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDiscussRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = DiscussPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = DiscussPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDeletedUserId();
				break;
			case 6:
				return $this->getUri();
				break;
			case 7:
				return $this->getSchemaId();
				break;
			case 8:
				return $this->getSchemaPropertyId();
				break;
			case 9:
				return $this->getSchemaPropertyElementId();
				break;
			case 10:
				return $this->getVocabularyId();
				break;
			case 11:
				return $this->getConceptId();
				break;
			case 12:
				return $this->getConceptPropertyId();
				break;
			case 13:
				return $this->getRootId();
				break;
			case 14:
				return $this->getParentId();
				break;
			case 15:
				return $this->getSubject();
				break;
			case 16:
				return $this->getContent();
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
		$keys = DiscussPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getCreatedUserId(),
			$keys[5] => $this->getDeletedUserId(),
			$keys[6] => $this->getUri(),
			$keys[7] => $this->getSchemaId(),
			$keys[8] => $this->getSchemaPropertyId(),
			$keys[9] => $this->getSchemaPropertyElementId(),
			$keys[10] => $this->getVocabularyId(),
			$keys[11] => $this->getConceptId(),
			$keys[12] => $this->getConceptPropertyId(),
			$keys[13] => $this->getRootId(),
			$keys[14] => $this->getParentId(),
			$keys[15] => $this->getSubject(),
			$keys[16] => $this->getContent(),
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
		$pos = DiscussPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDeletedUserId($value);
				break;
			case 6:
				$this->setUri($value);
				break;
			case 7:
				$this->setSchemaId($value);
				break;
			case 8:
				$this->setSchemaPropertyId($value);
				break;
			case 9:
				$this->setSchemaPropertyElementId($value);
				break;
			case 10:
				$this->setVocabularyId($value);
				break;
			case 11:
				$this->setConceptId($value);
				break;
			case 12:
				$this->setConceptPropertyId($value);
				break;
			case 13:
				$this->setRootId($value);
				break;
			case 14:
				$this->setParentId($value);
				break;
			case 15:
				$this->setSubject($value);
				break;
			case 16:
				$this->setContent($value);
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
		$keys = DiscussPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeletedUserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUri($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSchemaId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSchemaPropertyId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSchemaPropertyElementId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setVocabularyId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setConceptId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setConceptPropertyId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setRootId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setParentId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setSubject($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setContent($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DiscussPeer::DATABASE_NAME);

		if ($this->isColumnModified(DiscussPeer::ID)) $criteria->add(DiscussPeer::ID, $this->id);
		if ($this->isColumnModified(DiscussPeer::CREATED_AT)) $criteria->add(DiscussPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DiscussPeer::UPDATED_AT)) $criteria->add(DiscussPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(DiscussPeer::DELETED_AT)) $criteria->add(DiscussPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(DiscussPeer::CREATED_USER_ID)) $criteria->add(DiscussPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(DiscussPeer::DELETED_USER_ID)) $criteria->add(DiscussPeer::DELETED_USER_ID, $this->deleted_user_id);
		if ($this->isColumnModified(DiscussPeer::URI)) $criteria->add(DiscussPeer::URI, $this->uri);
		if ($this->isColumnModified(DiscussPeer::SCHEMA_ID)) $criteria->add(DiscussPeer::SCHEMA_ID, $this->schema_id);
		if ($this->isColumnModified(DiscussPeer::SCHEMA_PROPERTY_ID)) $criteria->add(DiscussPeer::SCHEMA_PROPERTY_ID, $this->schema_property_id);
		if ($this->isColumnModified(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID)) $criteria->add(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, $this->schema_property_element_id);
		if ($this->isColumnModified(DiscussPeer::VOCABULARY_ID)) $criteria->add(DiscussPeer::VOCABULARY_ID, $this->vocabulary_id);
		if ($this->isColumnModified(DiscussPeer::CONCEPT_ID)) $criteria->add(DiscussPeer::CONCEPT_ID, $this->concept_id);
		if ($this->isColumnModified(DiscussPeer::CONCEPT_PROPERTY_ID)) $criteria->add(DiscussPeer::CONCEPT_PROPERTY_ID, $this->concept_property_id);
		if ($this->isColumnModified(DiscussPeer::ROOT_ID)) $criteria->add(DiscussPeer::ROOT_ID, $this->root_id);
		if ($this->isColumnModified(DiscussPeer::PARENT_ID)) $criteria->add(DiscussPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(DiscussPeer::SUBJECT)) $criteria->add(DiscussPeer::SUBJECT, $this->subject);
		if ($this->isColumnModified(DiscussPeer::CONTENT)) $criteria->add(DiscussPeer::CONTENT, $this->content);

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
		$criteria = new Criteria(DiscussPeer::DATABASE_NAME);

		$criteria->add(DiscussPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Discuss (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setDeletedUserId($this->deleted_user_id);

		$copyObj->setUri($this->uri);

		$copyObj->setSchemaId($this->schema_id);

		$copyObj->setSchemaPropertyId($this->schema_property_id);

		$copyObj->setSchemaPropertyElementId($this->schema_property_element_id);

		$copyObj->setVocabularyId($this->vocabulary_id);

		$copyObj->setConceptId($this->concept_id);

		$copyObj->setConceptPropertyId($this->concept_property_id);

		$copyObj->setRootId($this->root_id);

		$copyObj->setParentId($this->parent_id);

		$copyObj->setSubject($this->subject);

		$copyObj->setContent($this->content);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getDiscusssRelatedByRootId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addDiscussRelatedByRootId($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByParentId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addDiscussRelatedByParentId($relObj->copy($deepCopy));
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
	 * @return     Discuss Clone of current object.
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
	 * @return     DiscussPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DiscussPeer();
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
	public function setUserRelatedByDeletedUserId($v)
	{


		if ($v === null) {
			$this->setDeletedUserId(NULL);
		} else {
			$this->setDeletedUserId($v->getId());
		}


		$this->aUserRelatedByDeletedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByDeletedUserId($con = null)
	{
		if ($this->aUserRelatedByDeletedUserId === null && ($this->deleted_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByDeletedUserId = UserPeer::retrieveByPK($this->deleted_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->deleted_user_id, $con);
			   $obj->addUsersRelatedByDeletedUserId($this);
			 */
		}
		return $this->aUserRelatedByDeletedUserId;
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
			$this->setSchemaId(NULL);
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
	public function setSchemaProperty($v)
	{


		if ($v === null) {
			$this->setSchemaPropertyId(NULL);
		} else {
			$this->setSchemaPropertyId($v->getId());
		}


		$this->aSchemaProperty = $v;
	}


	/**
	 * Get the associated SchemaProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaProperty The associated SchemaProperty object.
	 * @throws     PropelException
	 */
	public function getSchemaProperty($con = null)
	{
		if ($this->aSchemaProperty === null && ($this->schema_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyPeer.php';

			$this->aSchemaProperty = SchemaPropertyPeer::retrieveByPK($this->schema_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyPeer::retrieveByPK($this->schema_property_id, $con);
			   $obj->addSchemaPropertys($this);
			 */
		}
		return $this->aSchemaProperty;
	}

	/**
	 * Declares an association between this object and a SchemaPropertyElement object.
	 *
	 * @param      SchemaPropertyElement $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSchemaPropertyElement($v)
	{


		if ($v === null) {
			$this->setSchemaPropertyElementId(NULL);
		} else {
			$this->setSchemaPropertyElementId($v->getId());
		}


		$this->aSchemaPropertyElement = $v;
	}


	/**
	 * Get the associated SchemaPropertyElement object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SchemaPropertyElement The associated SchemaPropertyElement object.
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElement($con = null)
	{
		if ($this->aSchemaPropertyElement === null && ($this->schema_property_element_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSchemaPropertyElementPeer.php';

			$this->aSchemaPropertyElement = SchemaPropertyElementPeer::retrieveByPK($this->schema_property_element_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SchemaPropertyElementPeer::retrieveByPK($this->schema_property_element_id, $con);
			   $obj->addSchemaPropertyElements($this);
			 */
		}
		return $this->aSchemaPropertyElement;
	}

	/**
	 * Declares an association between this object and a Vocabulary object.
	 *
	 * @param      Vocabulary $v
	 * @return     void
	 * @throws     PropelException
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
	 * @param      Connection Optional Connection object.
	 * @return     Vocabulary The associated Vocabulary object.
	 * @throws     PropelException
	 */
	public function getVocabulary($con = null)
	{
		if ($this->aVocabulary === null && ($this->vocabulary_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseVocabularyPeer.php';

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
	 * Declares an association between this object and a Concept object.
	 *
	 * @param      Concept $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConcept($v)
	{


		if ($v === null) {
			$this->setConceptId(NULL);
		} else {
			$this->setConceptId($v->getId());
		}


		$this->aConcept = $v;
	}


	/**
	 * Get the associated Concept object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concept The associated Concept object.
	 * @throws     PropelException
	 */
	public function getConcept($con = null)
	{
		if ($this->aConcept === null && ($this->concept_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseConceptPeer.php';

			$this->aConcept = ConceptPeer::retrieveByPK($this->concept_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptPeer::retrieveByPK($this->concept_id, $con);
			   $obj->addConcepts($this);
			 */
		}
		return $this->aConcept;
	}

	/**
	 * Declares an association between this object and a ConceptProperty object.
	 *
	 * @param      ConceptProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConceptProperty($v)
	{


		if ($v === null) {
			$this->setConceptPropertyId(NULL);
		} else {
			$this->setConceptPropertyId($v->getId());
		}


		$this->aConceptProperty = $v;
	}


	/**
	 * Get the associated ConceptProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     ConceptProperty The associated ConceptProperty object.
	 * @throws     PropelException
	 */
	public function getConceptProperty($con = null)
	{
		if ($this->aConceptProperty === null && ($this->concept_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseConceptPropertyPeer.php';

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

	/**
	 * Declares an association between this object and a Discuss object.
	 *
	 * @param      Discuss $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDiscussRelatedByRootId($v)
	{


		if ($v === null) {
			$this->setRootId(NULL);
		} else {
			$this->setRootId($v->getId());
		}


		$this->aDiscussRelatedByRootId = $v;
	}


	/**
	 * Get the associated Discuss object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Discuss The associated Discuss object.
	 * @throws     PropelException
	 */
	public function getDiscussRelatedByRootId($con = null)
	{
		if ($this->aDiscussRelatedByRootId === null && ($this->root_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseDiscussPeer.php';

			$this->aDiscussRelatedByRootId = DiscussPeer::retrieveByPK($this->root_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DiscussPeer::retrieveByPK($this->root_id, $con);
			   $obj->addDiscusssRelatedByRootId($this);
			 */
		}
		return $this->aDiscussRelatedByRootId;
	}

	/**
	 * Declares an association between this object and a Discuss object.
	 *
	 * @param      Discuss $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDiscussRelatedByParentId($v)
	{


		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}


		$this->aDiscussRelatedByParentId = $v;
	}


	/**
	 * Get the associated Discuss object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Discuss The associated Discuss object.
	 * @throws     PropelException
	 */
	public function getDiscussRelatedByParentId($con = null)
	{
		if ($this->aDiscussRelatedByParentId === null && ($this->parent_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseDiscussPeer.php';

			$this->aDiscussRelatedByParentId = DiscussPeer::retrieveByPK($this->parent_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DiscussPeer::retrieveByPK($this->parent_id, $con);
			   $obj->addDiscusssRelatedByParentId($this);
			 */
		}
		return $this->aDiscussRelatedByParentId;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByRootId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByRootId()
	{
		if ($this->collDiscusssRelatedByRootId === null) {
			$this->collDiscusssRelatedByRootId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 * If this Discuss is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByRootId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByRootId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;
		return $this->collDiscusssRelatedByRootId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByRootId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByRootId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByRootId(Discuss $l)
	{
		$this->collDiscusssRelatedByRootId[] = $l;
		$l->setDiscussRelatedByRootId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinUserRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByRootId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByRootIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByRootId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByRootId = array();
			} else {

				$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::ROOT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByRootIdCriteria) || !$this->lastDiscussRelatedByRootIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByRootId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByRootIdCriteria = $criteria;

		return $this->collDiscusssRelatedByRootId;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByParentId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByParentId()
	{
		if ($this->collDiscusssRelatedByParentId === null) {
			$this->collDiscusssRelatedByParentId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 * If this Discuss is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByParentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByParentId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;
		return $this->collDiscusssRelatedByParentId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByParentId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByParentId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

		return DiscussPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Discuss object to this object
	 * through the Discuss foreign key attribute
	 *
	 * @param      Discuss $l Discuss
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDiscussRelatedByParentId(Discuss $l)
	{
		$this->collDiscusssRelatedByParentId[] = $l;
		$l->setDiscussRelatedByParentId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinUserRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinUserRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinSchemaPropertyElement($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinConcept($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Discuss is new, it will return
	 * an empty collection; or if this Discuss has previously
	 * been saved, it will retrieve related DiscusssRelatedByParentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Discuss.
	 */
	public function getDiscusssRelatedByParentIdJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDiscussPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscusssRelatedByParentId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByParentId = array();
			} else {

				$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::PARENT_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByParentIdCriteria) || !$this->lastDiscussRelatedByParentIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByParentId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByParentIdCriteria = $criteria;

		return $this->collDiscusssRelatedByParentId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDiscuss:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDiscuss::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseDiscuss
