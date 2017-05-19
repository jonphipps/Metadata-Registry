<?php

/**
 * Base class that represents a row from the 'profile' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProfile extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProfilePeer
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
	 * The value for the created_by field.
	 * @var        int
	 */
	protected $created_by;


	/**
	 * The value for the updated_by field.
	 * @var        int
	 */
	protected $updated_by;


	/**
	 * The value for the deleted_by field.
	 * @var        int
	 */
	protected $deleted_by;


	/**
	 * The value for the child_updated_at field.
	 * @var        int
	 */
	protected $child_updated_at;


	/**
	 * The value for the child_updated_by field.
	 * @var        int
	 */
	protected $child_updated_by;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name = '';


	/**
	 * The value for the note field.
	 * @var        string
	 */
	protected $note;


	/**
	 * The value for the uri field.
	 * @var        string
	 */
	protected $uri = '';


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;


	/**
	 * The value for the base_domain field.
	 * @var        string
	 */
	protected $base_domain = '';


	/**
	 * The value for the token field.
	 * @var        string
	 */
	protected $token = '';


	/**
	 * The value for the community field.
	 * @var        string
	 */
	protected $community;


	/**
	 * The value for the last_uri_id field.
	 * @var        int
	 */
	protected $last_uri_id = 100000;


	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id = 1;


	/**
	 * The value for the language field.
	 * @var        string
	 */
	protected $language = 'en';

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByCreatedBy;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByUpdatedBy;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByDeletedBy;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByChildUpdatedBy;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * Collection to store aggregation of collExportss.
	 * @var        array
	 */
	protected $collExportss;

	/**
	 * The criteria used to select the current contents of collExportss.
	 * @var        Criteria
	 */
	protected $lastExportsCriteria = null;

	/**
	 * Collection to store aggregation of collProfileProjects.
	 * @var        array
	 */
	protected $collProfileProjects;

	/**
	 * The criteria used to select the current contents of collProfileProjects.
	 * @var        Criteria
	 */
	protected $lastProfileProjectCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertys.
	 * @var        array
	 */
	protected $collProfilePropertys;

	/**
	 * The criteria used to select the current contents of collProfilePropertys.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyCriteria = null;

	/**
	 * Collection to store aggregation of collExportHistorys.
	 * @var        array
	 */
	protected $collExportHistorys;

	/**
	 * The criteria used to select the current contents of collExportHistorys.
	 * @var        Criteria
	 */
	protected $lastExportHistoryCriteria = null;

	/**
	 * Collection to store aggregation of collSchemas.
	 * @var        array
	 */
	protected $collSchemas;

	/**
	 * The criteria used to select the current contents of collSchemas.
	 * @var        Criteria
	 */
	protected $lastSchemaCriteria = null;

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
	 * Get the [created_by] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	/**
	 * Get the [updated_by] column value.
	 * 
	 * @return     int
	 */
	public function getUpdatedBy()
	{

		return $this->updated_by;
	}

	/**
	 * Get the [deleted_by] column value.
	 * 
	 * @return     int
	 */
	public function getDeletedBy()
	{

		return $this->deleted_by;
	}

	/**
	 * Get the [optionally formatted] [child_updated_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getChildUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->child_updated_at === null || $this->child_updated_at === '') {
			return null;
		} elseif (!is_int($this->child_updated_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->child_updated_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [child_updated_at] as date/time value: " . var_export($this->child_updated_at, true));
			}
		} else {
			$ts = $this->child_updated_at;
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
	 * Get the [child_updated_by] column value.
	 * 
	 * @return     int
	 */
	public function getChildUpdatedBy()
	{

		return $this->child_updated_by;
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
	 * Get the [note] column value.
	 * 
	 * @return     string
	 */
	public function getNote()
	{

		return $this->note;
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
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{

		return $this->url;
	}

	/**
	 * Get the [base_domain] column value.
	 * 
	 * @return     string
	 */
	public function getBaseDomain()
	{

		return $this->base_domain;
	}

	/**
	 * Get the [token] column value.
	 * 
	 * @return     string
	 */
	public function getToken()
	{

		return $this->token;
	}

	/**
	 * Get the [community] column value.
	 * 
	 * @return     string
	 */
	public function getCommunity()
	{

		return $this->community;
	}

	/**
	 * Get the [last_uri_id] column value.
	 * 
	 * @return     int
	 */
	public function getLastUriId()
	{

		return $this->last_uri_id;
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
			$this->modifiedColumns[] = ProfilePeer::ID;
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
			$this->modifiedColumns[] = ProfilePeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProfilePeer::UPDATED_AT;
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
			$this->modifiedColumns[] = ProfilePeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [created_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = ProfilePeer::CREATED_BY;
		}

		if ($this->aUsersRelatedByCreatedBy !== null && $this->aUsersRelatedByCreatedBy->getId() !== $v) {
			$this->aUsersRelatedByCreatedBy = null;
		}

	} // setCreatedBy()

	/**
	 * Set the value of [updated_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUpdatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = ProfilePeer::UPDATED_BY;
		}

		if ($this->aUsersRelatedByUpdatedBy !== null && $this->aUsersRelatedByUpdatedBy->getId() !== $v) {
			$this->aUsersRelatedByUpdatedBy = null;
		}

	} // setUpdatedBy()

	/**
	 * Set the value of [deleted_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deleted_by !== $v) {
			$this->deleted_by = $v;
			$this->modifiedColumns[] = ProfilePeer::DELETED_BY;
		}

		if ($this->aUsersRelatedByDeletedBy !== null && $this->aUsersRelatedByDeletedBy->getId() !== $v) {
			$this->aUsersRelatedByDeletedBy = null;
		}

	} // setDeletedBy()

	/**
	 * Set the value of [child_updated_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setChildUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [child_updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->child_updated_at !== $ts) {
			$this->child_updated_at = $ts;
			$this->modifiedColumns[] = ProfilePeer::CHILD_UPDATED_AT;
		}

	} // setChildUpdatedAt()

	/**
	 * Set the value of [child_updated_by] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setChildUpdatedBy($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->child_updated_by !== $v) {
			$this->child_updated_by = $v;
			$this->modifiedColumns[] = ProfilePeer::CHILD_UPDATED_BY;
		}

		if ($this->aUsersRelatedByChildUpdatedBy !== null && $this->aUsersRelatedByChildUpdatedBy->getId() !== $v) {
			$this->aUsersRelatedByChildUpdatedBy = null;
		}

	} // setChildUpdatedBy()

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
			$this->modifiedColumns[] = ProfilePeer::NAME;
		}

	} // setName()

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
			$this->modifiedColumns[] = ProfilePeer::NOTE;
		}

	} // setNote()

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
			$this->modifiedColumns[] = ProfilePeer::URI;
		}

	} // setUri()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = ProfilePeer::URL;
		}

	} // setUrl()

	/**
	 * Set the value of [base_domain] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setBaseDomain($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->base_domain !== $v || $v === '') {
			$this->base_domain = $v;
			$this->modifiedColumns[] = ProfilePeer::BASE_DOMAIN;
		}

	} // setBaseDomain()

	/**
	 * Set the value of [token] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setToken($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->token !== $v || $v === '') {
			$this->token = $v;
			$this->modifiedColumns[] = ProfilePeer::TOKEN;
		}

	} // setToken()

	/**
	 * Set the value of [community] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCommunity($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->community !== $v) {
			$this->community = $v;
			$this->modifiedColumns[] = ProfilePeer::COMMUNITY;
		}

	} // setCommunity()

	/**
	 * Set the value of [last_uri_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setLastUriId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_uri_id !== $v || $v === 100000) {
			$this->last_uri_id = $v;
			$this->modifiedColumns[] = ProfilePeer::LAST_URI_ID;
		}

	} // setLastUriId()

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

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ProfilePeer::STATUS_ID;
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

		if ($this->language !== $v || $v === 'en') {
			$this->language = $v;
			$this->modifiedColumns[] = ProfilePeer::LANGUAGE;
		}

	} // setLanguage()

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

			$this->created_by = $rs->getInt($startcol + 4);

			$this->updated_by = $rs->getInt($startcol + 5);

			$this->deleted_by = $rs->getInt($startcol + 6);

			$this->child_updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->child_updated_by = $rs->getInt($startcol + 8);

			$this->name = $rs->getString($startcol + 9);

			$this->note = $rs->getString($startcol + 10);

			$this->uri = $rs->getString($startcol + 11);

			$this->url = $rs->getString($startcol + 12);

			$this->base_domain = $rs->getString($startcol + 13);

			$this->token = $rs->getString($startcol + 14);

			$this->community = $rs->getString($startcol + 15);

			$this->last_uri_id = $rs->getInt($startcol + 16);

			$this->status_id = $rs->getInt($startcol + 17);

			$this->language = $rs->getString($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Profile object", $e);
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

    foreach (sfMixer::getCallables('BaseProfile:delete:pre') as $callable)
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
			$con = Propel::getConnection(ProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProfilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProfile:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseProfile:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ProfilePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProfilePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProfilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProfile:save:post') as $callable)
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

			if ($this->aUsersRelatedByCreatedBy !== null) {
				if ($this->aUsersRelatedByCreatedBy->isModified()) {
					$affectedRows += $this->aUsersRelatedByCreatedBy->save($con);
				}
				$this->setUsersRelatedByCreatedBy($this->aUsersRelatedByCreatedBy);
			}

			if ($this->aUsersRelatedByUpdatedBy !== null) {
				if ($this->aUsersRelatedByUpdatedBy->isModified()) {
					$affectedRows += $this->aUsersRelatedByUpdatedBy->save($con);
				}
				$this->setUsersRelatedByUpdatedBy($this->aUsersRelatedByUpdatedBy);
			}

			if ($this->aUsersRelatedByDeletedBy !== null) {
				if ($this->aUsersRelatedByDeletedBy->isModified()) {
					$affectedRows += $this->aUsersRelatedByDeletedBy->save($con);
				}
				$this->setUsersRelatedByDeletedBy($this->aUsersRelatedByDeletedBy);
			}

			if ($this->aUsersRelatedByChildUpdatedBy !== null) {
				if ($this->aUsersRelatedByChildUpdatedBy->isModified()) {
					$affectedRows += $this->aUsersRelatedByChildUpdatedBy->save($con);
				}
				$this->setUsersRelatedByChildUpdatedBy($this->aUsersRelatedByChildUpdatedBy);
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
					$pk = ProfilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProfilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collExportss !== null) {
				foreach($this->collExportss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfileProjects !== null) {
				foreach($this->collProfileProjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertys !== null) {
				foreach($this->collProfilePropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExportHistorys !== null) {
				foreach($this->collExportHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemas !== null) {
				foreach($this->collSchemas as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUsersRelatedByCreatedBy !== null) {
				if (!$this->aUsersRelatedByCreatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByCreatedBy->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByUpdatedBy !== null) {
				if (!$this->aUsersRelatedByUpdatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByUpdatedBy->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByDeletedBy !== null) {
				if (!$this->aUsersRelatedByDeletedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByDeletedBy->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByChildUpdatedBy !== null) {
				if (!$this->aUsersRelatedByChildUpdatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByChildUpdatedBy->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = ProfilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collExportss !== null) {
					foreach($this->collExportss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfileProjects !== null) {
					foreach($this->collProfileProjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertys !== null) {
					foreach($this->collProfilePropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExportHistorys !== null) {
					foreach($this->collExportHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemas !== null) {
					foreach($this->collSchemas as $referrerFK) {
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
		$pos = ProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCreatedBy();
				break;
			case 5:
				return $this->getUpdatedBy();
				break;
			case 6:
				return $this->getDeletedBy();
				break;
			case 7:
				return $this->getChildUpdatedAt();
				break;
			case 8:
				return $this->getChildUpdatedBy();
				break;
			case 9:
				return $this->getName();
				break;
			case 10:
				return $this->getNote();
				break;
			case 11:
				return $this->getUri();
				break;
			case 12:
				return $this->getUrl();
				break;
			case 13:
				return $this->getBaseDomain();
				break;
			case 14:
				return $this->getToken();
				break;
			case 15:
				return $this->getCommunity();
				break;
			case 16:
				return $this->getLastUriId();
				break;
			case 17:
				return $this->getStatusId();
				break;
			case 18:
				return $this->getLanguage();
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
		$keys = ProfilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getCreatedBy(),
			$keys[5] => $this->getUpdatedBy(),
			$keys[6] => $this->getDeletedBy(),
			$keys[7] => $this->getChildUpdatedAt(),
			$keys[8] => $this->getChildUpdatedBy(),
			$keys[9] => $this->getName(),
			$keys[10] => $this->getNote(),
			$keys[11] => $this->getUri(),
			$keys[12] => $this->getUrl(),
			$keys[13] => $this->getBaseDomain(),
			$keys[14] => $this->getToken(),
			$keys[15] => $this->getCommunity(),
			$keys[16] => $this->getLastUriId(),
			$keys[17] => $this->getStatusId(),
			$keys[18] => $this->getLanguage(),
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
		$pos = ProfilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCreatedBy($value);
				break;
			case 5:
				$this->setUpdatedBy($value);
				break;
			case 6:
				$this->setDeletedBy($value);
				break;
			case 7:
				$this->setChildUpdatedAt($value);
				break;
			case 8:
				$this->setChildUpdatedBy($value);
				break;
			case 9:
				$this->setName($value);
				break;
			case 10:
				$this->setNote($value);
				break;
			case 11:
				$this->setUri($value);
				break;
			case 12:
				$this->setUrl($value);
				break;
			case 13:
				$this->setBaseDomain($value);
				break;
			case 14:
				$this->setToken($value);
				break;
			case 15:
				$this->setCommunity($value);
				break;
			case 16:
				$this->setLastUriId($value);
				break;
			case 17:
				$this->setStatusId($value);
				break;
			case 18:
				$this->setLanguage($value);
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
		$keys = ProfilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeletedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setChildUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setChildUpdatedBy($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNote($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUri($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUrl($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setBaseDomain($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setToken($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCommunity($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLastUriId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setStatusId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLanguage($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProfilePeer::DATABASE_NAME);

		if ($this->isColumnModified(ProfilePeer::ID)) $criteria->add(ProfilePeer::ID, $this->id);
		if ($this->isColumnModified(ProfilePeer::CREATED_AT)) $criteria->add(ProfilePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProfilePeer::UPDATED_AT)) $criteria->add(ProfilePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ProfilePeer::DELETED_AT)) $criteria->add(ProfilePeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(ProfilePeer::CREATED_BY)) $criteria->add(ProfilePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(ProfilePeer::UPDATED_BY)) $criteria->add(ProfilePeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(ProfilePeer::DELETED_BY)) $criteria->add(ProfilePeer::DELETED_BY, $this->deleted_by);
		if ($this->isColumnModified(ProfilePeer::CHILD_UPDATED_AT)) $criteria->add(ProfilePeer::CHILD_UPDATED_AT, $this->child_updated_at);
		if ($this->isColumnModified(ProfilePeer::CHILD_UPDATED_BY)) $criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->child_updated_by);
		if ($this->isColumnModified(ProfilePeer::NAME)) $criteria->add(ProfilePeer::NAME, $this->name);
		if ($this->isColumnModified(ProfilePeer::NOTE)) $criteria->add(ProfilePeer::NOTE, $this->note);
		if ($this->isColumnModified(ProfilePeer::URI)) $criteria->add(ProfilePeer::URI, $this->uri);
		if ($this->isColumnModified(ProfilePeer::URL)) $criteria->add(ProfilePeer::URL, $this->url);
		if ($this->isColumnModified(ProfilePeer::BASE_DOMAIN)) $criteria->add(ProfilePeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(ProfilePeer::TOKEN)) $criteria->add(ProfilePeer::TOKEN, $this->token);
		if ($this->isColumnModified(ProfilePeer::COMMUNITY)) $criteria->add(ProfilePeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(ProfilePeer::LAST_URI_ID)) $criteria->add(ProfilePeer::LAST_URI_ID, $this->last_uri_id);
		if ($this->isColumnModified(ProfilePeer::STATUS_ID)) $criteria->add(ProfilePeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ProfilePeer::LANGUAGE)) $criteria->add(ProfilePeer::LANGUAGE, $this->language);

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
		$criteria = new Criteria(ProfilePeer::DATABASE_NAME);

		$criteria->add(ProfilePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Profile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setDeletedBy($this->deleted_by);

		$copyObj->setChildUpdatedAt($this->child_updated_at);

		$copyObj->setChildUpdatedBy($this->child_updated_by);

		$copyObj->setName($this->name);

		$copyObj->setNote($this->note);

		$copyObj->setUri($this->uri);

		$copyObj->setUrl($this->url);

		$copyObj->setBaseDomain($this->base_domain);

		$copyObj->setToken($this->token);

		$copyObj->setCommunity($this->community);

		$copyObj->setLastUriId($this->last_uri_id);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLanguage($this->language);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getExportss() as $relObj) {
				$copyObj->addExports($relObj->copy($deepCopy));
			}

			foreach($this->getProfileProjects() as $relObj) {
				$copyObj->addProfileProject($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertys() as $relObj) {
				$copyObj->addProfileProperty($relObj->copy($deepCopy));
			}

			foreach($this->getExportHistorys() as $relObj) {
				$copyObj->addExportHistory($relObj->copy($deepCopy));
			}

			foreach($this->getSchemas() as $relObj) {
				$copyObj->addSchema($relObj->copy($deepCopy));
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
	 * @return     Profile Clone of current object.
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
	 * @return     ProfilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProfilePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByCreatedBy($v)
	{


		if ($v === null) {
			$this->setCreatedBy(NULL);
		} else {
			$this->setCreatedBy($v->getId());
		}


		$this->aUsersRelatedByCreatedBy = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByCreatedBy($con = null)
	{
		if ($this->aUsersRelatedByCreatedBy === null && ($this->created_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByCreatedBy = UsersPeer::retrieveByPK($this->created_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->created_by, $con);
			   $obj->addUserssRelatedByCreatedBy($this);
			 */
		}
		return $this->aUsersRelatedByCreatedBy;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByUpdatedBy($v)
	{


		if ($v === null) {
			$this->setUpdatedBy(NULL);
		} else {
			$this->setUpdatedBy($v->getId());
		}


		$this->aUsersRelatedByUpdatedBy = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByUpdatedBy($con = null)
	{
		if ($this->aUsersRelatedByUpdatedBy === null && ($this->updated_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByUpdatedBy = UsersPeer::retrieveByPK($this->updated_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->updated_by, $con);
			   $obj->addUserssRelatedByUpdatedBy($this);
			 */
		}
		return $this->aUsersRelatedByUpdatedBy;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByDeletedBy($v)
	{


		if ($v === null) {
			$this->setDeletedBy(NULL);
		} else {
			$this->setDeletedBy($v->getId());
		}


		$this->aUsersRelatedByDeletedBy = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByDeletedBy($con = null)
	{
		if ($this->aUsersRelatedByDeletedBy === null && ($this->deleted_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByDeletedBy = UsersPeer::retrieveByPK($this->deleted_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->deleted_by, $con);
			   $obj->addUserssRelatedByDeletedBy($this);
			 */
		}
		return $this->aUsersRelatedByDeletedBy;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByChildUpdatedBy($v)
	{


		if ($v === null) {
			$this->setChildUpdatedBy(NULL);
		} else {
			$this->setChildUpdatedBy($v->getId());
		}


		$this->aUsersRelatedByChildUpdatedBy = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByChildUpdatedBy($con = null)
	{
		if ($this->aUsersRelatedByChildUpdatedBy === null && ($this->child_updated_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByChildUpdatedBy = UsersPeer::retrieveByPK($this->child_updated_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->child_updated_by, $con);
			   $obj->addUserssRelatedByChildUpdatedBy($this);
			 */
		}
		return $this->aUsersRelatedByChildUpdatedBy;
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
			$this->setStatusId('1');
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
	 * Temporary storage of collExportss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initExportss()
	{
		if ($this->collExportss === null) {
			$this->collExportss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related Exportss from storage.
	 * If this Profile is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getExportss($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
			   $this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

				ExportsPeer::addSelectColumns($criteria);
				$this->collExportss = ExportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

				ExportsPeer::addSelectColumns($criteria);
				if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
					$this->collExportss = ExportsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExportsCriteria = $criteria;
		return $this->collExportss;
	}

	/**
	 * Returns the number of related Exportss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countExportss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

		return ExportsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Exports object to this object
	 * through the Exports foreign key attribute
	 *
	 * @param      Exports $l Exports
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExports(Exports $l)
	{
		$this->collExportss[] = $l;
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportssJoinUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinUsers($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportssJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportssJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportss === null) {
			if ($this->isNew()) {
				$this->collExportss = array();
			} else {

				$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}

	/**
	 * Temporary storage of collProfileProjects to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfileProjects()
	{
		if ($this->collProfileProjects === null) {
			$this->collProfileProjects = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related ProfileProjects from storage.
	 * If this Profile is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfileProjects($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfileProjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfileProjects === null) {
			if ($this->isNew()) {
			   $this->collProfileProjects = array();
			} else {

				$criteria->add(ProfileProjectPeer::PROFILE_ID, $this->getId());

				ProfileProjectPeer::addSelectColumns($criteria);
				$this->collProfileProjects = ProfileProjectPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfileProjectPeer::PROFILE_ID, $this->getId());

				ProfileProjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileProjectCriteria) || !$this->lastProfileProjectCriteria->equals($criteria)) {
					$this->collProfileProjects = ProfileProjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileProjectCriteria = $criteria;
		return $this->collProfileProjects;
	}

	/**
	 * Returns the number of related ProfileProjects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfileProjects($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfileProjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfileProjectPeer::PROFILE_ID, $this->getId());

		return ProfileProjectPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProfileProject object to this object
	 * through the ProfileProject foreign key attribute
	 *
	 * @param      ProfileProject $l ProfileProject
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileProject(ProfileProject $l)
	{
		$this->collProfileProjects[] = $l;
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfileProjects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfileProjectsJoinProjects($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfileProjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfileProjects === null) {
			if ($this->isNew()) {
				$this->collProfileProjects = array();
			} else {

				$criteria->add(ProfileProjectPeer::PROFILE_ID, $this->getId());

				$this->collProfileProjects = ProfileProjectPeer::doSelectJoinProjects($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfileProjectPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfileProjectCriteria) || !$this->lastProfileProjectCriteria->equals($criteria)) {
				$this->collProfileProjects = ProfileProjectPeer::doSelectJoinProjects($criteria, $con);
			}
		}
		$this->lastProfileProjectCriteria = $criteria;

		return $this->collProfileProjects;
	}

	/**
	 * Temporary storage of collProfilePropertys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertys()
	{
		if ($this->collProfilePropertys === null) {
			$this->collProfilePropertys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 * If this Profile is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertys = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
					$this->collProfilePropertys = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;
		return $this->collProfilePropertys;
	}

	/**
	 * Returns the number of related ProfilePropertys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

		return ProfilePropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProfileProperty object to this object
	 * through the ProfileProperty foreign key attribute
	 *
	 * @param      ProfileProperty $l ProfileProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileProperty(ProfileProperty $l)
	{
		$this->collProfilePropertys[] = $l;
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfilePropertysJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
				$this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;

		return $this->collProfilePropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfilePropertysJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
				$this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;

		return $this->collProfilePropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfilePropertysJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
				$this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;

		return $this->collProfilePropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfilePropertysJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
				$this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;

		return $this->collProfilePropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ProfilePropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getProfilePropertysJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilePropertys === null) {
			if ($this->isNew()) {
				$this->collProfilePropertys = array();
			} else {

				$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastProfilePropertyCriteria) || !$this->lastProfilePropertyCriteria->equals($criteria)) {
				$this->collProfilePropertys = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyCriteria = $criteria;

		return $this->collProfilePropertys;
	}

	/**
	 * Temporary storage of collExportHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initExportHistorys()
	{
		if ($this->collExportHistorys === null) {
			$this->collExportHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 * If this Profile is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getExportHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorys === null) {
			if ($this->isNew()) {
			   $this->collExportHistorys = array();
			} else {

				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				$this->collExportHistorys = ExportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
					$this->collExportHistorys = ExportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExportHistoryCriteria = $criteria;
		return $this->collExportHistorys;
	}

	/**
	 * Returns the number of related ExportHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countExportHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

		return ExportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ExportHistory object to this object
	 * through the ExportHistory foreign key attribute
	 *
	 * @param      ExportHistory $l ExportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addExportHistory(ExportHistory $l)
	{
		$this->collExportHistorys[] = $l;
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportHistorysJoinUsersRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorys === null) {
			if ($this->isNew()) {
				$this->collExportHistorys = array();
			} else {

				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportHistorysJoinVocabulary($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorys === null) {
			if ($this->isNew()) {
				$this->collExportHistorys = array();
			} else {

				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportHistorysJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorys === null) {
			if ($this->isNew()) {
				$this->collExportHistorys = array();
			} else {

				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getExportHistorysJoinUsersRelatedByExportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseExportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExportHistorys === null) {
			if ($this->isNew()) {
				$this->collExportHistorys = array();
			} else {

				$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByExportedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByExportedBy($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}

	/**
	 * Temporary storage of collSchemas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemas()
	{
		if ($this->collSchemas === null) {
			$this->collSchemas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 * If this Profile is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemas($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
			   $this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemas = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
					$this->collSchemas = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaCriteria = $criteria;
		return $this->collSchemas;
	}

	/**
	 * Returns the number of related Schemas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

		return SchemaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Schema object to this object
	 * through the Schema foreign key attribute
	 *
	 * @param      Schema $l Schema
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchema(Schema $l)
	{
		$this->collSchemas[] = $l;
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinProjectsRelatedByProjectId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinProjectsRelatedByAgentId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Schemas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getSchemasJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemas === null) {
			if ($this->isNew()) {
				$this->collSchemas = array();
			} else {

				$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastSchemaCriteria) || !$this->lastSchemaCriteria->equals($criteria)) {
				$this->collSchemas = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastSchemaCriteria = $criteria;

		return $this->collSchemas;
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
	 * Otherwise if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 * If this Profile is new, it will return
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularys = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

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

		$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

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
		$l->setProfile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinProjectsRelatedByProjectId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinProjectsRelatedByProjectId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinProjectsRelatedByAgentId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinProjectsRelatedByAgentId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByChildUpdatedUserId($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinStatus($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Profile is new, it will return
	 * an empty collection; or if this Profile has previously
	 * been saved, it will retrieve related Vocabularys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Profile.
	 */
	public function getVocabularysJoinUsersRelatedByChildUpdatedBy($criteria = null, $con = null)
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

				$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROFILE_ID, $this->getId());

			if (!isset($this->lastVocabularyCriteria) || !$this->lastVocabularyCriteria->equals($criteria)) {
				$this->collVocabularys = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyCriteria = $criteria;

		return $this->collVocabularys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProfile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProfile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseProfile
