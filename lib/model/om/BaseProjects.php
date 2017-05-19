<?php

/**
 * Base class that represents a row from the 'projects' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjects extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProjectsPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label;


	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;


	/**
	 * The value for the is_private field.
	 * @var        boolean
	 */
	protected $is_private = false;


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
	 * The value for the repo field.
	 * @var        string
	 */
	protected $repo;


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;


	/**
	 * The value for the license field.
	 * @var        string
	 */
	protected $license;


	/**
	 * The value for the uri_strategy field.
	 * @var        string
	 */
	protected $uri_strategy;


	/**
	 * The value for the uri_type field.
	 * @var        string
	 */
	protected $uri_type;


	/**
	 * The value for the uri_prepend field.
	 * @var        string
	 */
	protected $uri_prepend;


	/**
	 * The value for the uri_append field.
	 * @var        string
	 */
	protected $uri_append;


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
	 * The value for the starting_number field.
	 * @var        int
	 */
	protected $starting_number;


	/**
	 * The value for the license_uri field.
	 * @var        string
	 */
	protected $license_uri;


	/**
	 * The value for the default_language field.
	 * @var        string
	 */
	protected $default_language;


	/**
	 * The value for the google_sheet_url field.
	 * @var        string
	 */
	protected $google_sheet_url;

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
	 * Collection to store aggregation of collProjectUsers.
	 * @var        array
	 */
	protected $collProjectUsers;

	/**
	 * The criteria used to select the current contents of collProjectUsers.
	 * @var        Criteria
	 */
	protected $lastProjectUserCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByProjectId.
	 * @var        array
	 */
	protected $collSchemasRelatedByProjectId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByProjectId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByProjectIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByAgentId.
	 * @var        array
	 */
	protected $collSchemasRelatedByAgentId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByAgentId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByAgentIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByProjectId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByProjectId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByProjectId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByProjectIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByAgentId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByAgentId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByAgentId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByAgentIdCriteria = null;

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
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{

		return $this->description;
	}

	/**
	 * Get the [is_private] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPrivate()
	{

		return $this->is_private;
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
	 * Get the [repo] column value.
	 * 
	 * @return     string
	 */
	public function getRepo()
	{

		return $this->repo;
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
	 * Get the [license] column value.
	 * 
	 * @return     string
	 */
	public function getLicense()
	{

		return $this->license;
	}

	/**
	 * Get the [uri_strategy] column value.
	 * 
	 * @return     string
	 */
	public function getUriStrategy()
	{

		return $this->uri_strategy;
	}

	/**
	 * Get the [uri_type] column value.
	 * 
	 * @return     string
	 */
	public function getUriType()
	{

		return $this->uri_type;
	}

	/**
	 * Get the [uri_prepend] column value.
	 * 
	 * @return     string
	 */
	public function getUriPrepend()
	{

		return $this->uri_prepend;
	}

	/**
	 * Get the [uri_append] column value.
	 * 
	 * @return     string
	 */
	public function getUriAppend()
	{

		return $this->uri_append;
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
	 * Get the [starting_number] column value.
	 * 
	 * @return     int
	 */
	public function getStartingNumber()
	{

		return $this->starting_number;
	}

	/**
	 * Get the [license_uri] column value.
	 * 
	 * @return     string
	 */
	public function getLicenseUri()
	{

		return $this->license_uri;
	}

	/**
	 * Get the [default_language] column value.
	 * 
	 * @return     string
	 */
	public function getDefaultLanguage()
	{

		return $this->default_language;
	}

	/**
	 * Get the [google_sheet_url] column value.
	 * 
	 * @return     string
	 */
	public function getGoogleSheetUrl()
	{

		return $this->google_sheet_url;
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
			$this->modifiedColumns[] = ProjectsPeer::ID;
		}

	} // setId()

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

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ProjectsPeer::NAME;
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

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = ProjectsPeer::LABEL;
		}

	} // setLabel()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDescription($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProjectsPeer::DESCRIPTION;
		}

	} // setDescription()

	/**
	 * Set the value of [is_private] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsPrivate($v)
	{

		if ($this->is_private !== $v || $v === false) {
			$this->is_private = $v;
			$this->modifiedColumns[] = ProjectsPeer::IS_PRIVATE;
		}

	} // setIsPrivate()

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
			$this->modifiedColumns[] = ProjectsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProjectsPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = ProjectsPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [repo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setRepo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->repo !== $v) {
			$this->repo = $v;
			$this->modifiedColumns[] = ProjectsPeer::REPO;
		}

	} // setRepo()

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
			$this->modifiedColumns[] = ProjectsPeer::URL;
		}

	} // setUrl()

	/**
	 * Set the value of [license] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLicense($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->license !== $v) {
			$this->license = $v;
			$this->modifiedColumns[] = ProjectsPeer::LICENSE;
		}

	} // setLicense()

	/**
	 * Set the value of [uri_strategy] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUriStrategy($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri_strategy !== $v) {
			$this->uri_strategy = $v;
			$this->modifiedColumns[] = ProjectsPeer::URI_STRATEGY;
		}

	} // setUriStrategy()

	/**
	 * Set the value of [uri_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUriType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri_type !== $v) {
			$this->uri_type = $v;
			$this->modifiedColumns[] = ProjectsPeer::URI_TYPE;
		}

	} // setUriType()

	/**
	 * Set the value of [uri_prepend] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUriPrepend($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri_prepend !== $v) {
			$this->uri_prepend = $v;
			$this->modifiedColumns[] = ProjectsPeer::URI_PREPEND;
		}

	} // setUriPrepend()

	/**
	 * Set the value of [uri_append] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUriAppend($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->uri_append !== $v) {
			$this->uri_append = $v;
			$this->modifiedColumns[] = ProjectsPeer::URI_APPEND;
		}

	} // setUriAppend()

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
			$this->modifiedColumns[] = ProjectsPeer::CREATED_BY;
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
			$this->modifiedColumns[] = ProjectsPeer::UPDATED_BY;
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
			$this->modifiedColumns[] = ProjectsPeer::DELETED_BY;
		}

		if ($this->aUsersRelatedByDeletedBy !== null && $this->aUsersRelatedByDeletedBy->getId() !== $v) {
			$this->aUsersRelatedByDeletedBy = null;
		}

	} // setDeletedBy()

	/**
	 * Set the value of [starting_number] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStartingNumber($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->starting_number !== $v) {
			$this->starting_number = $v;
			$this->modifiedColumns[] = ProjectsPeer::STARTING_NUMBER;
		}

	} // setStartingNumber()

	/**
	 * Set the value of [license_uri] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLicenseUri($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->license_uri !== $v) {
			$this->license_uri = $v;
			$this->modifiedColumns[] = ProjectsPeer::LICENSE_URI;
		}

	} // setLicenseUri()

	/**
	 * Set the value of [default_language] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDefaultLanguage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->default_language !== $v) {
			$this->default_language = $v;
			$this->modifiedColumns[] = ProjectsPeer::DEFAULT_LANGUAGE;
		}

	} // setDefaultLanguage()

	/**
	 * Set the value of [google_sheet_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGoogleSheetUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->google_sheet_url !== $v) {
			$this->google_sheet_url = $v;
			$this->modifiedColumns[] = ProjectsPeer::GOOGLE_SHEET_URL;
		}

	} // setGoogleSheetUrl()

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

			$this->name = $rs->getString($startcol + 1);

			$this->label = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->is_private = $rs->getBoolean($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 7, null);

			$this->repo = $rs->getString($startcol + 8);

			$this->url = $rs->getString($startcol + 9);

			$this->license = $rs->getString($startcol + 10);

			$this->uri_strategy = $rs->getString($startcol + 11);

			$this->uri_type = $rs->getString($startcol + 12);

			$this->uri_prepend = $rs->getString($startcol + 13);

			$this->uri_append = $rs->getString($startcol + 14);

			$this->created_by = $rs->getInt($startcol + 15);

			$this->updated_by = $rs->getInt($startcol + 16);

			$this->deleted_by = $rs->getInt($startcol + 17);

			$this->starting_number = $rs->getInt($startcol + 18);

			$this->license_uri = $rs->getString($startcol + 19);

			$this->default_language = $rs->getString($startcol + 20);

			$this->google_sheet_url = $rs->getString($startcol + 21);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 22; // 22 = ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Projects object", $e);
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

    foreach (sfMixer::getCallables('BaseProjects:delete:pre') as $callable)
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
			$con = Propel::getConnection(ProjectsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProjectsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProjects:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseProjects:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ProjectsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProjectsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProjectsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProjects:save:post') as $callable)
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProjectsPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProjectsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProfileProjects !== null) {
				foreach($this->collProfileProjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProjectUsers !== null) {
				foreach($this->collProjectUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByProjectId !== null) {
				foreach($this->collSchemasRelatedByProjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByAgentId !== null) {
				foreach($this->collSchemasRelatedByAgentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByProjectId !== null) {
				foreach($this->collVocabularysRelatedByProjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByAgentId !== null) {
				foreach($this->collVocabularysRelatedByAgentId as $referrerFK) {
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


			if (($retval = ProjectsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProfileProjects !== null) {
					foreach($this->collProfileProjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProjectUsers !== null) {
					foreach($this->collProjectUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByProjectId !== null) {
					foreach($this->collSchemasRelatedByProjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByAgentId !== null) {
					foreach($this->collSchemasRelatedByAgentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByProjectId !== null) {
					foreach($this->collVocabularysRelatedByProjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByAgentId !== null) {
					foreach($this->collVocabularysRelatedByAgentId as $referrerFK) {
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
		$pos = ProjectsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getLabel();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getIsPrivate();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getDeletedAt();
				break;
			case 8:
				return $this->getRepo();
				break;
			case 9:
				return $this->getUrl();
				break;
			case 10:
				return $this->getLicense();
				break;
			case 11:
				return $this->getUriStrategy();
				break;
			case 12:
				return $this->getUriType();
				break;
			case 13:
				return $this->getUriPrepend();
				break;
			case 14:
				return $this->getUriAppend();
				break;
			case 15:
				return $this->getCreatedBy();
				break;
			case 16:
				return $this->getUpdatedBy();
				break;
			case 17:
				return $this->getDeletedBy();
				break;
			case 18:
				return $this->getStartingNumber();
				break;
			case 19:
				return $this->getLicenseUri();
				break;
			case 20:
				return $this->getDefaultLanguage();
				break;
			case 21:
				return $this->getGoogleSheetUrl();
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
		$keys = ProjectsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getLabel(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getIsPrivate(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getDeletedAt(),
			$keys[8] => $this->getRepo(),
			$keys[9] => $this->getUrl(),
			$keys[10] => $this->getLicense(),
			$keys[11] => $this->getUriStrategy(),
			$keys[12] => $this->getUriType(),
			$keys[13] => $this->getUriPrepend(),
			$keys[14] => $this->getUriAppend(),
			$keys[15] => $this->getCreatedBy(),
			$keys[16] => $this->getUpdatedBy(),
			$keys[17] => $this->getDeletedBy(),
			$keys[18] => $this->getStartingNumber(),
			$keys[19] => $this->getLicenseUri(),
			$keys[20] => $this->getDefaultLanguage(),
			$keys[21] => $this->getGoogleSheetUrl(),
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
		$pos = ProjectsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setLabel($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setIsPrivate($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setDeletedAt($value);
				break;
			case 8:
				$this->setRepo($value);
				break;
			case 9:
				$this->setUrl($value);
				break;
			case 10:
				$this->setLicense($value);
				break;
			case 11:
				$this->setUriStrategy($value);
				break;
			case 12:
				$this->setUriType($value);
				break;
			case 13:
				$this->setUriPrepend($value);
				break;
			case 14:
				$this->setUriAppend($value);
				break;
			case 15:
				$this->setCreatedBy($value);
				break;
			case 16:
				$this->setUpdatedBy($value);
				break;
			case 17:
				$this->setDeletedBy($value);
				break;
			case 18:
				$this->setStartingNumber($value);
				break;
			case 19:
				$this->setLicenseUri($value);
				break;
			case 20:
				$this->setDefaultLanguage($value);
				break;
			case 21:
				$this->setGoogleSheetUrl($value);
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
		$keys = ProjectsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLabel($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsPrivate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeletedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRepo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUrl($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLicense($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUriStrategy($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUriType($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUriPrepend($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUriAppend($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedBy($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedBy($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDeletedBy($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setStartingNumber($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLicenseUri($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setDefaultLanguage($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setGoogleSheetUrl($arr[$keys[21]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProjectsPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProjectsPeer::ID)) $criteria->add(ProjectsPeer::ID, $this->id);
		if ($this->isColumnModified(ProjectsPeer::NAME)) $criteria->add(ProjectsPeer::NAME, $this->name);
		if ($this->isColumnModified(ProjectsPeer::LABEL)) $criteria->add(ProjectsPeer::LABEL, $this->label);
		if ($this->isColumnModified(ProjectsPeer::DESCRIPTION)) $criteria->add(ProjectsPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProjectsPeer::IS_PRIVATE)) $criteria->add(ProjectsPeer::IS_PRIVATE, $this->is_private);
		if ($this->isColumnModified(ProjectsPeer::CREATED_AT)) $criteria->add(ProjectsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProjectsPeer::UPDATED_AT)) $criteria->add(ProjectsPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ProjectsPeer::DELETED_AT)) $criteria->add(ProjectsPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(ProjectsPeer::REPO)) $criteria->add(ProjectsPeer::REPO, $this->repo);
		if ($this->isColumnModified(ProjectsPeer::URL)) $criteria->add(ProjectsPeer::URL, $this->url);
		if ($this->isColumnModified(ProjectsPeer::LICENSE)) $criteria->add(ProjectsPeer::LICENSE, $this->license);
		if ($this->isColumnModified(ProjectsPeer::URI_STRATEGY)) $criteria->add(ProjectsPeer::URI_STRATEGY, $this->uri_strategy);
		if ($this->isColumnModified(ProjectsPeer::URI_TYPE)) $criteria->add(ProjectsPeer::URI_TYPE, $this->uri_type);
		if ($this->isColumnModified(ProjectsPeer::URI_PREPEND)) $criteria->add(ProjectsPeer::URI_PREPEND, $this->uri_prepend);
		if ($this->isColumnModified(ProjectsPeer::URI_APPEND)) $criteria->add(ProjectsPeer::URI_APPEND, $this->uri_append);
		if ($this->isColumnModified(ProjectsPeer::CREATED_BY)) $criteria->add(ProjectsPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(ProjectsPeer::UPDATED_BY)) $criteria->add(ProjectsPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(ProjectsPeer::DELETED_BY)) $criteria->add(ProjectsPeer::DELETED_BY, $this->deleted_by);
		if ($this->isColumnModified(ProjectsPeer::STARTING_NUMBER)) $criteria->add(ProjectsPeer::STARTING_NUMBER, $this->starting_number);
		if ($this->isColumnModified(ProjectsPeer::LICENSE_URI)) $criteria->add(ProjectsPeer::LICENSE_URI, $this->license_uri);
		if ($this->isColumnModified(ProjectsPeer::DEFAULT_LANGUAGE)) $criteria->add(ProjectsPeer::DEFAULT_LANGUAGE, $this->default_language);
		if ($this->isColumnModified(ProjectsPeer::GOOGLE_SHEET_URL)) $criteria->add(ProjectsPeer::GOOGLE_SHEET_URL, $this->google_sheet_url);

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
		$criteria = new Criteria(ProjectsPeer::DATABASE_NAME);

		$criteria->add(ProjectsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Projects (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setLabel($this->label);

		$copyObj->setDescription($this->description);

		$copyObj->setIsPrivate($this->is_private);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setRepo($this->repo);

		$copyObj->setUrl($this->url);

		$copyObj->setLicense($this->license);

		$copyObj->setUriStrategy($this->uri_strategy);

		$copyObj->setUriType($this->uri_type);

		$copyObj->setUriPrepend($this->uri_prepend);

		$copyObj->setUriAppend($this->uri_append);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setDeletedBy($this->deleted_by);

		$copyObj->setStartingNumber($this->starting_number);

		$copyObj->setLicenseUri($this->license_uri);

		$copyObj->setDefaultLanguage($this->default_language);

		$copyObj->setGoogleSheetUrl($this->google_sheet_url);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getProfileProjects() as $relObj) {
				$copyObj->addProfileProject($relObj->copy($deepCopy));
			}

			foreach($this->getProjectUsers() as $relObj) {
				$copyObj->addProjectUser($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByProjectId() as $relObj) {
				$copyObj->addSchemaRelatedByProjectId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByAgentId() as $relObj) {
				$copyObj->addSchemaRelatedByAgentId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByProjectId() as $relObj) {
				$copyObj->addVocabularyRelatedByProjectId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByAgentId() as $relObj) {
				$copyObj->addVocabularyRelatedByAgentId($relObj->copy($deepCopy));
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
	 * @return     Projects Clone of current object.
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
	 * @return     ProjectsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProjectsPeer();
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
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related ProfileProjects from storage.
	 * If this Projects is new, it will return
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

				$criteria->add(ProfileProjectPeer::PROJECT_ID, $this->getId());

				ProfileProjectPeer::addSelectColumns($criteria);
				$this->collProfileProjects = ProfileProjectPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfileProjectPeer::PROJECT_ID, $this->getId());

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

		$criteria->add(ProfileProjectPeer::PROJECT_ID, $this->getId());

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
		$l->setProjects($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related ProfileProjects from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getProfileProjectsJoinProfile($criteria = null, $con = null)
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

				$criteria->add(ProfileProjectPeer::PROJECT_ID, $this->getId());

				$this->collProfileProjects = ProfileProjectPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfileProjectPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastProfileProjectCriteria) || !$this->lastProfileProjectCriteria->equals($criteria)) {
				$this->collProfileProjects = ProfileProjectPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfileProjectCriteria = $criteria;

		return $this->collProfileProjects;
	}

	/**
	 * Temporary storage of collProjectUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProjectUsers()
	{
		if ($this->collProjectUsers === null) {
			$this->collProjectUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related ProjectUsers from storage.
	 * If this Projects is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProjectUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectUsers === null) {
			if ($this->isNew()) {
			   $this->collProjectUsers = array();
			} else {

				$criteria->add(ProjectUserPeer::PROJECT_ID, $this->getId());

				ProjectUserPeer::addSelectColumns($criteria);
				$this->collProjectUsers = ProjectUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProjectUserPeer::PROJECT_ID, $this->getId());

				ProjectUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastProjectUserCriteria) || !$this->lastProjectUserCriteria->equals($criteria)) {
					$this->collProjectUsers = ProjectUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProjectUserCriteria = $criteria;
		return $this->collProjectUsers;
	}

	/**
	 * Returns the number of related ProjectUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProjectUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProjectUserPeer::PROJECT_ID, $this->getId());

		return ProjectUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ProjectUser object to this object
	 * through the ProjectUser foreign key attribute
	 *
	 * @param      ProjectUser $l ProjectUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProjectUser(ProjectUser $l)
	{
		$this->collProjectUsers[] = $l;
		$l->setProjects($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related ProjectUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getProjectUsersJoinUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProjectUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProjectUsers === null) {
			if ($this->isNew()) {
				$this->collProjectUsers = array();
			} else {

				$criteria->add(ProjectUserPeer::PROJECT_ID, $this->getId());

				$this->collProjectUsers = ProjectUserPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProjectUserPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastProjectUserCriteria) || !$this->lastProjectUserCriteria->equals($criteria)) {
				$this->collProjectUsers = ProjectUserPeer::doSelectJoinUsers($criteria, $con);
			}
		}
		$this->lastProjectUserCriteria = $criteria;

		return $this->collProjectUsers;
	}

	/**
	 * Temporary storage of collSchemasRelatedByProjectId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByProjectId()
	{
		if ($this->collSchemasRelatedByProjectId === null) {
			$this->collSchemasRelatedByProjectId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 * If this Projects is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByProjectId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByProjectId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;
		return $this->collSchemasRelatedByProjectId;
	}

	/**
	 * Returns the number of related SchemasRelatedByProjectId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByProjectId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

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
	public function addSchemaRelatedByProjectId(Schema $l)
	{
		$this->collSchemasRelatedByProjectId[] = $l;
		$l->setProjectsRelatedByProjectId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByProjectIdJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByProjectId = array();
			} else {

				$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByProjectIdCriteria) || !$this->lastSchemaRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByProjectId = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByProjectIdCriteria = $criteria;

		return $this->collSchemasRelatedByProjectId;
	}

	/**
	 * Temporary storage of collSchemasRelatedByAgentId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByAgentId()
	{
		if ($this->collSchemasRelatedByAgentId === null) {
			$this->collSchemasRelatedByAgentId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 * If this Projects is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByAgentId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByAgentId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;
		return $this->collSchemasRelatedByAgentId;
	}

	/**
	 * Returns the number of related SchemasRelatedByAgentId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByAgentId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

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
	public function addSchemaRelatedByAgentId(Schema $l)
	{
		$this->collSchemasRelatedByAgentId[] = $l;
		$l->setProjectsRelatedByAgentId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related SchemasRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getSchemasRelatedByAgentIdJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByAgentId = array();
			} else {

				$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByAgentIdCriteria) || !$this->lastSchemaRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByAgentId = SchemaPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByAgentIdCriteria = $criteria;

		return $this->collSchemasRelatedByAgentId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByProjectId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByProjectId()
	{
		if ($this->collVocabularysRelatedByProjectId === null) {
			$this->collVocabularysRelatedByProjectId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 * If this Projects is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByProjectId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;
		return $this->collVocabularysRelatedByProjectId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByProjectId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByProjectId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

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
	public function addVocabularyRelatedByProjectId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByProjectId[] = $l;
		$l->setProjectsRelatedByProjectId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByChildUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByProjectId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByProjectIdJoinUsersRelatedByChildUpdatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByProjectId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByProjectId = array();
			} else {

				$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::PROJECT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByProjectIdCriteria) || !$this->lastVocabularyRelatedByProjectIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByProjectId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByProjectIdCriteria = $criteria;

		return $this->collVocabularysRelatedByProjectId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByAgentId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByAgentId()
	{
		if ($this->collVocabularysRelatedByAgentId === null) {
			$this->collVocabularysRelatedByAgentId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 * If this Projects is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByAgentId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;
		return $this->collVocabularysRelatedByAgentId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByAgentId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByAgentId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

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
	public function addVocabularyRelatedByAgentId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByAgentId[] = $l;
		$l->setProjectsRelatedByAgentId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByChildUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Projects is new, it will return
	 * an empty collection; or if this Projects has previously
	 * been saved, it will retrieve related VocabularysRelatedByAgentId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Projects.
	 */
	public function getVocabularysRelatedByAgentIdJoinUsersRelatedByChildUpdatedBy($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByAgentId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByAgentId = array();
			} else {

				$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::AGENT_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByAgentIdCriteria) || !$this->lastVocabularyRelatedByAgentIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByAgentId = VocabularyPeer::doSelectJoinUsersRelatedByChildUpdatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByAgentIdCriteria = $criteria;

		return $this->collVocabularysRelatedByAgentId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProjects:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProjects::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseProjects
