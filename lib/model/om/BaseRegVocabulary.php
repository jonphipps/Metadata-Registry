<?php

/**
 * Base class that represents a row from the 'reg_vocabulary' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseRegVocabulary extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RegVocabularyPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the agent_id field.
	 * @var        int
	 */
	protected $agent_id = 0;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the deleted_at field.
	 * @var        int
	 */
	protected $deleted_at;


	/**
	 * The value for the last_updated field.
	 * @var        int
	 */
	protected $last_updated;


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
	 * The value for the child_updated_at field.
	 * @var        int
	 */
	protected $child_updated_at;


	/**
	 * The value for the child_updated_user_id field.
	 * @var        int
	 */
	protected $child_updated_user_id;


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
	protected $last_uri_id = 1000;


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
	 * @var        Agent
	 */
	protected $aAgent;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByCreatedUserId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByUpdatedUserId;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByChildUpdatedUserId;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * Collection to store aggregation of collConcepts.
	 * @var        array
	 */
	protected $collConcepts;

	/**
	 * The criteria used to select the current contents of collConcepts.
	 * @var        Criteria
	 */
	protected $lastConceptCriteria = null;

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
	 * Collection to store aggregation of collConceptPropertyHistorysRelatedByVocabularyId.
	 * @var        array
	 */
	protected $collConceptPropertyHistorysRelatedByVocabularyId;

	/**
	 * The criteria used to select the current contents of collConceptPropertyHistorysRelatedByVocabularyId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertyHistorysRelatedBySchemeId.
	 * @var        array
	 */
	protected $collConceptPropertyHistorysRelatedBySchemeId;

	/**
	 * The criteria used to select the current contents of collConceptPropertyHistorysRelatedBySchemeId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyHistoryRelatedBySchemeIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyPropertys.
	 * @var        array
	 */
	protected $collSchemaPropertyPropertys;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyPropertys.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyPropertyCriteria = null;

	/**
	 * Collection to store aggregation of collRegVocabularyHasUsers.
	 * @var        array
	 */
	protected $collRegVocabularyHasUsers;

	/**
	 * The criteria used to select the current contents of collRegVocabularyHasUsers.
	 * @var        Criteria
	 */
	protected $lastRegVocabularyHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collRegVocabularyHasVersions.
	 * @var        array
	 */
	protected $collRegVocabularyHasVersions;

	/**
	 * The criteria used to select the current contents of collRegVocabularyHasVersions.
	 * @var        Criteria
	 */
	protected $lastRegVocabularyHasVersionCriteria = null;

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
	 * Get the [agent_id] column value.
	 * 
	 * @return     int
	 */
	public function getAgentId()
	{

		return $this->agent_id;
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
	 * Get the [optionally formatted] [last_updated] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
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
	 * Get the [child_updated_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getChildUpdatedUserId()
	{

		return $this->child_updated_user_id;
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
			$this->modifiedColumns[] = RegVocabularyPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [agent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setAgentId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->agent_id !== $v || $v === 0) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = RegVocabularyPeer::AGENT_ID;
		}

		if ($this->aAgent !== null && $this->aAgent->getId() !== $v) {
			$this->aAgent = null;
		}

	} // setAgentId()

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
			$this->modifiedColumns[] = RegVocabularyPeer::CREATED_AT;
		}

	} // setCreatedAt()

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
			$this->modifiedColumns[] = RegVocabularyPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [last_updated] column.
	 * 
	 * @param      int $v new value
	 * @return     void
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
			$this->modifiedColumns[] = RegVocabularyPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

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
			$this->modifiedColumns[] = RegVocabularyPeer::CREATED_USER_ID;
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
			$this->modifiedColumns[] = RegVocabularyPeer::UPDATED_USER_ID;
		}

		if ($this->aUserRelatedByUpdatedUserId !== null && $this->aUserRelatedByUpdatedUserId->getId() !== $v) {
			$this->aUserRelatedByUpdatedUserId = null;
		}

	} // setUpdatedUserId()

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
			$this->modifiedColumns[] = RegVocabularyPeer::CHILD_UPDATED_AT;
		}

	} // setChildUpdatedAt()

	/**
	 * Set the value of [child_updated_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setChildUpdatedUserId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->child_updated_user_id !== $v) {
			$this->child_updated_user_id = $v;
			$this->modifiedColumns[] = RegVocabularyPeer::CHILD_UPDATED_USER_ID;
		}

		if ($this->aUserRelatedByChildUpdatedUserId !== null && $this->aUserRelatedByChildUpdatedUserId->getId() !== $v) {
			$this->aUserRelatedByChildUpdatedUserId = null;
		}

	} // setChildUpdatedUserId()

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
			$this->modifiedColumns[] = RegVocabularyPeer::NAME;
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
			$this->modifiedColumns[] = RegVocabularyPeer::NOTE;
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
			$this->modifiedColumns[] = RegVocabularyPeer::URI;
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
			$this->modifiedColumns[] = RegVocabularyPeer::URL;
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
			$this->modifiedColumns[] = RegVocabularyPeer::BASE_DOMAIN;
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
			$this->modifiedColumns[] = RegVocabularyPeer::TOKEN;
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
			$this->modifiedColumns[] = RegVocabularyPeer::COMMUNITY;
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

		if ($this->last_uri_id !== $v || $v === 1000) {
			$this->last_uri_id = $v;
			$this->modifiedColumns[] = RegVocabularyPeer::LAST_URI_ID;
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
			$this->modifiedColumns[] = RegVocabularyPeer::STATUS_ID;
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
			$this->modifiedColumns[] = RegVocabularyPeer::LANGUAGE;
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

			$this->agent_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->last_updated = $rs->getTimestamp($startcol + 4, null);

			$this->created_user_id = $rs->getInt($startcol + 5);

			$this->updated_user_id = $rs->getInt($startcol + 6);

			$this->child_updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->child_updated_user_id = $rs->getInt($startcol + 8);

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
			return $startcol + 19; // 19 = RegVocabularyPeer::NUM_COLUMNS - RegVocabularyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RegVocabulary object", $e);
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

    foreach (sfMixer::getCallables('BaseRegVocabulary:delete:pre') as $callable)
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
			$con = Propel::getConnection(RegVocabularyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RegVocabularyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRegVocabulary:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseRegVocabulary:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(RegVocabularyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RegVocabularyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRegVocabulary:save:post') as $callable)
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

			if ($this->aAgent !== null) {
				if ($this->aAgent->isModified()) {
					$affectedRows += $this->aAgent->save($con);
				}
				$this->setAgent($this->aAgent);
			}

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

			if ($this->aUserRelatedByChildUpdatedUserId !== null) {
				if ($this->aUserRelatedByChildUpdatedUserId->isModified()) {
					$affectedRows += $this->aUserRelatedByChildUpdatedUserId->save($con);
				}
				$this->setUserRelatedByChildUpdatedUserId($this->aUserRelatedByChildUpdatedUserId);
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
					$pk = RegVocabularyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RegVocabularyPeer::doUpdate($this, $con);
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

			if ($this->collConceptPropertyHistorysRelatedByVocabularyId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedByVocabularyId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertyHistorysRelatedBySchemeId !== null) {
				foreach($this->collConceptPropertyHistorysRelatedBySchemeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyPropertys !== null) {
				foreach($this->collSchemaPropertyPropertys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRegVocabularyHasUsers !== null) {
				foreach($this->collRegVocabularyHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRegVocabularyHasVersions !== null) {
				foreach($this->collRegVocabularyHasVersions as $referrerFK) {
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

			if ($this->aAgent !== null) {
				if (!$this->aAgent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgent->getValidationFailures());
				}
			}

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

			if ($this->aUserRelatedByChildUpdatedUserId !== null) {
				if (!$this->aUserRelatedByChildUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByChildUpdatedUserId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = RegVocabularyPeer::doValidate($this, $columns)) !== true) {
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

				if ($this->collConceptPropertyHistorysRelatedByVocabularyId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedByVocabularyId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertyHistorysRelatedBySchemeId !== null) {
					foreach($this->collConceptPropertyHistorysRelatedBySchemeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyPropertys !== null) {
					foreach($this->collSchemaPropertyPropertys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRegVocabularyHasUsers !== null) {
					foreach($this->collRegVocabularyHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRegVocabularyHasVersions !== null) {
					foreach($this->collRegVocabularyHasVersions as $referrerFK) {
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
		$pos = RegVocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAgentId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getLastUpdated();
				break;
			case 5:
				return $this->getCreatedUserId();
				break;
			case 6:
				return $this->getUpdatedUserId();
				break;
			case 7:
				return $this->getChildUpdatedAt();
				break;
			case 8:
				return $this->getChildUpdatedUserId();
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
		$keys = RegVocabularyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAgentId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getLastUpdated(),
			$keys[5] => $this->getCreatedUserId(),
			$keys[6] => $this->getUpdatedUserId(),
			$keys[7] => $this->getChildUpdatedAt(),
			$keys[8] => $this->getChildUpdatedUserId(),
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
		$pos = RegVocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAgentId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setLastUpdated($value);
				break;
			case 5:
				$this->setCreatedUserId($value);
				break;
			case 6:
				$this->setUpdatedUserId($value);
				break;
			case 7:
				$this->setChildUpdatedAt($value);
				break;
			case 8:
				$this->setChildUpdatedUserId($value);
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
		$keys = RegVocabularyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAgentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLastUpdated($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedUserId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedUserId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setChildUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setChildUpdatedUserId($arr[$keys[8]]);
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
		$criteria = new Criteria(RegVocabularyPeer::DATABASE_NAME);

		if ($this->isColumnModified(RegVocabularyPeer::ID)) $criteria->add(RegVocabularyPeer::ID, $this->id);
		if ($this->isColumnModified(RegVocabularyPeer::AGENT_ID)) $criteria->add(RegVocabularyPeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(RegVocabularyPeer::CREATED_AT)) $criteria->add(RegVocabularyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RegVocabularyPeer::DELETED_AT)) $criteria->add(RegVocabularyPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(RegVocabularyPeer::LAST_UPDATED)) $criteria->add(RegVocabularyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(RegVocabularyPeer::CREATED_USER_ID)) $criteria->add(RegVocabularyPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(RegVocabularyPeer::UPDATED_USER_ID)) $criteria->add(RegVocabularyPeer::UPDATED_USER_ID, $this->updated_user_id);
		if ($this->isColumnModified(RegVocabularyPeer::CHILD_UPDATED_AT)) $criteria->add(RegVocabularyPeer::CHILD_UPDATED_AT, $this->child_updated_at);
		if ($this->isColumnModified(RegVocabularyPeer::CHILD_UPDATED_USER_ID)) $criteria->add(RegVocabularyPeer::CHILD_UPDATED_USER_ID, $this->child_updated_user_id);
		if ($this->isColumnModified(RegVocabularyPeer::NAME)) $criteria->add(RegVocabularyPeer::NAME, $this->name);
		if ($this->isColumnModified(RegVocabularyPeer::NOTE)) $criteria->add(RegVocabularyPeer::NOTE, $this->note);
		if ($this->isColumnModified(RegVocabularyPeer::URI)) $criteria->add(RegVocabularyPeer::URI, $this->uri);
		if ($this->isColumnModified(RegVocabularyPeer::URL)) $criteria->add(RegVocabularyPeer::URL, $this->url);
		if ($this->isColumnModified(RegVocabularyPeer::BASE_DOMAIN)) $criteria->add(RegVocabularyPeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(RegVocabularyPeer::TOKEN)) $criteria->add(RegVocabularyPeer::TOKEN, $this->token);
		if ($this->isColumnModified(RegVocabularyPeer::COMMUNITY)) $criteria->add(RegVocabularyPeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(RegVocabularyPeer::LAST_URI_ID)) $criteria->add(RegVocabularyPeer::LAST_URI_ID, $this->last_uri_id);
		if ($this->isColumnModified(RegVocabularyPeer::STATUS_ID)) $criteria->add(RegVocabularyPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(RegVocabularyPeer::LANGUAGE)) $criteria->add(RegVocabularyPeer::LANGUAGE, $this->language);

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
		$criteria = new Criteria(RegVocabularyPeer::DATABASE_NAME);

		$criteria->add(RegVocabularyPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of RegVocabulary (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setAgentId($this->agent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setUpdatedUserId($this->updated_user_id);

		$copyObj->setChildUpdatedAt($this->child_updated_at);

		$copyObj->setChildUpdatedUserId($this->child_updated_user_id);

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

			foreach($this->getConcepts() as $relObj) {
				$copyObj->addConcept($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertys() as $relObj) {
				$copyObj->addConceptProperty($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedByVocabularyId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedByVocabularyId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorysRelatedBySchemeId() as $relObj) {
				$copyObj->addConceptPropertyHistoryRelatedBySchemeId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyPropertys() as $relObj) {
				$copyObj->addSchemaPropertyProperty($relObj->copy($deepCopy));
			}

			foreach($this->getRegVocabularyHasUsers() as $relObj) {
				$copyObj->addRegVocabularyHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getRegVocabularyHasVersions() as $relObj) {
				$copyObj->addRegVocabularyHasVersion($relObj->copy($deepCopy));
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
	 * @return     RegVocabulary Clone of current object.
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
	 * @return     RegVocabularyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RegVocabularyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Agent object.
	 *
	 * @param      Agent $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setAgent($v)
	{


		if ($v === null) {
			$this->setAgentId('');
		} else {
			$this->setAgentId($v->getId());
		}


		$this->aAgent = $v;
	}


	/**
	 * Get the associated Agent object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Agent The associated Agent object.
	 * @throws     PropelException
	 */
	public function getAgent($con = null)
	{
		if ($this->aAgent === null && ($this->agent_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseAgentPeer.php';

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
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByChildUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setChildUpdatedUserId(NULL);
		} else {
			$this->setChildUpdatedUserId($v->getId());
		}


		$this->aUserRelatedByChildUpdatedUserId = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByChildUpdatedUserId($con = null)
	{
		if ($this->aUserRelatedByChildUpdatedUserId === null && ($this->child_updated_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByChildUpdatedUserId = UserPeer::retrieveByPK($this->child_updated_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->child_updated_user_id, $con);
			   $obj->addUsersRelatedByChildUpdatedUserId($this);
			 */
		}
		return $this->aUserRelatedByChildUpdatedUserId;
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
	 * Temporary storage of collConcepts to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
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
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConcepts($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConcepts($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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
	 * @param      Concept $l Concept
	 * @return     void
	 * @throws     PropelException
	 */
	public function addConcept(Concept $l)
	{
		$this->collConcepts[] = $l;
		$l->setRegVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptsJoinUserRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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

				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptsJoinUserRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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

				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptsJoinConceptProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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

				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptsJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseConceptPeer.php';
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

				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
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
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 * If this RegVocabulary is new, it will return
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

		$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
		$l->setRegVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
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

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
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

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

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
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
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
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertysJoinSkosProperty($criteria = null, $con = null)
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
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
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
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertysJoinLookup($criteria = null, $con = null)
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
	 * Temporary storage of collConceptPropertyHistorysRelatedByVocabularyId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertyHistorysRelatedByVocabularyId()
	{
		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}

	/**
	 * Returns the number of related ConceptPropertyHistorysRelatedByVocabularyId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertyHistorysRelatedByVocabularyId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

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
	public function addConceptPropertyHistoryRelatedByVocabularyId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedByVocabularyId[] = $l;
		$l->setRegVocabularyRelatedByVocabularyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinSkosProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinUser($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedByVocabularyId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}

	/**
	 * Temporary storage of collConceptPropertyHistorysRelatedBySchemeId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertyHistorysRelatedBySchemeId()
	{
		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			$this->collConceptPropertyHistorysRelatedBySchemeId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertyHistorysRelatedBySchemeId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
					$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;
		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}

	/**
	 * Returns the number of related ConceptPropertyHistorysRelatedBySchemeId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertyHistorysRelatedBySchemeId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

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
	public function addConceptPropertyHistoryRelatedBySchemeId(ConceptPropertyHistory $l)
	{
		$this->collConceptPropertyHistorysRelatedBySchemeId[] = $l;
		$l->setRegVocabularyRelatedBySchemeId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinSkosProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinUser($criteria = null, $con = null)
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

		if ($this->collConceptPropertyHistorysRelatedBySchemeId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = array();
			} else {

				$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}

	/**
	 * Temporary storage of collSchemaPropertyPropertys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyPropertys()
	{
		if ($this->collSchemaPropertyPropertys === null) {
			$this->collSchemaPropertyPropertys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related SchemaPropertyPropertys from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyPropertys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyPropertys === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyPropertys = array();
			} else {

				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyPropertyCriteria) || !$this->lastSchemaPropertyPropertyCriteria->equals($criteria)) {
					$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyPropertyCriteria = $criteria;
		return $this->collSchemaPropertyPropertys;
	}

	/**
	 * Returns the number of related SchemaPropertyPropertys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyPropertys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

		return SchemaPropertyPropertyPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaPropertyProperty object to this object
	 * through the SchemaPropertyProperty foreign key attribute
	 *
	 * @param      SchemaPropertyProperty $l SchemaPropertyProperty
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaPropertyProperty(SchemaPropertyProperty $l)
	{
		$this->collSchemaPropertyPropertys[] = $l;
		$l->setRegVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related SchemaPropertyPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getSchemaPropertyPropertysJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyPropertys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyPropertys = array();
			} else {

				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyPropertyCriteria) || !$this->lastSchemaPropertyPropertyCriteria->equals($criteria)) {
				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSchemaPropertyPropertyCriteria = $criteria;

		return $this->collSchemaPropertyPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related SchemaPropertyPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getSchemaPropertyPropertysJoinSchemaProperty($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyPropertys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyPropertys = array();
			} else {

				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyPropertyCriteria) || !$this->lastSchemaPropertyPropertyCriteria->equals($criteria)) {
				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyPropertyCriteria = $criteria;

		return $this->collSchemaPropertyPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related SchemaPropertyPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getSchemaPropertyPropertysJoinSchemaPropertyPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyPropertys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyPropertys = array();
			} else {

				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinSchemaPropertyPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyPropertyCriteria) || !$this->lastSchemaPropertyPropertyCriteria->equals($criteria)) {
				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinSchemaPropertyPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyPropertyCriteria = $criteria;

		return $this->collSchemaPropertyPropertys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related SchemaPropertyPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getSchemaPropertyPropertysJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaPropertyPropertyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaPropertyPropertys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyPropertys = array();
			} else {

				$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyPropertyCriteria) || !$this->lastSchemaPropertyPropertyCriteria->equals($criteria)) {
				$this->collSchemaPropertyPropertys = SchemaPropertyPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyPropertyCriteria = $criteria;

		return $this->collSchemaPropertyPropertys;
	}

	/**
	 * Temporary storage of collRegVocabularyHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRegVocabularyHasUsers()
	{
		if ($this->collRegVocabularyHasUsers === null) {
			$this->collRegVocabularyHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related RegVocabularyHasUsers from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRegVocabularyHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRegVocabularyHasUsers === null) {
			if ($this->isNew()) {
			   $this->collRegVocabularyHasUsers = array();
			} else {

				$criteria->add(RegVocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				RegVocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collRegVocabularyHasUsers = RegVocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RegVocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				RegVocabularyHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastRegVocabularyHasUserCriteria) || !$this->lastRegVocabularyHasUserCriteria->equals($criteria)) {
					$this->collRegVocabularyHasUsers = RegVocabularyHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRegVocabularyHasUserCriteria = $criteria;
		return $this->collRegVocabularyHasUsers;
	}

	/**
	 * Returns the number of related RegVocabularyHasUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRegVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RegVocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

		return RegVocabularyHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RegVocabularyHasUser object to this object
	 * through the RegVocabularyHasUser foreign key attribute
	 *
	 * @param      RegVocabularyHasUser $l RegVocabularyHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRegVocabularyHasUser(RegVocabularyHasUser $l)
	{
		$this->collRegVocabularyHasUsers[] = $l;
		$l->setRegVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related RegVocabularyHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getRegVocabularyHasUsersJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRegVocabularyHasUsers === null) {
			if ($this->isNew()) {
				$this->collRegVocabularyHasUsers = array();
			} else {

				$criteria->add(RegVocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

				$this->collRegVocabularyHasUsers = RegVocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RegVocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastRegVocabularyHasUserCriteria) || !$this->lastRegVocabularyHasUserCriteria->equals($criteria)) {
				$this->collRegVocabularyHasUsers = RegVocabularyHasUserPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastRegVocabularyHasUserCriteria = $criteria;

		return $this->collRegVocabularyHasUsers;
	}

	/**
	 * Temporary storage of collRegVocabularyHasVersions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRegVocabularyHasVersions()
	{
		if ($this->collRegVocabularyHasVersions === null) {
			$this->collRegVocabularyHasVersions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary has previously
	 * been saved, it will retrieve related RegVocabularyHasVersions from storage.
	 * If this RegVocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRegVocabularyHasVersions($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRegVocabularyHasVersions === null) {
			if ($this->isNew()) {
			   $this->collRegVocabularyHasVersions = array();
			} else {

				$criteria->add(RegVocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				RegVocabularyHasVersionPeer::addSelectColumns($criteria);
				$this->collRegVocabularyHasVersions = RegVocabularyHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RegVocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				RegVocabularyHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRegVocabularyHasVersionCriteria) || !$this->lastRegVocabularyHasVersionCriteria->equals($criteria)) {
					$this->collRegVocabularyHasVersions = RegVocabularyHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRegVocabularyHasVersionCriteria = $criteria;
		return $this->collRegVocabularyHasVersions;
	}

	/**
	 * Returns the number of related RegVocabularyHasVersions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRegVocabularyHasVersions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RegVocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

		return RegVocabularyHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RegVocabularyHasVersion object to this object
	 * through the RegVocabularyHasVersion foreign key attribute
	 *
	 * @param      RegVocabularyHasVersion $l RegVocabularyHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRegVocabularyHasVersion(RegVocabularyHasVersion $l)
	{
		$this->collRegVocabularyHasVersions[] = $l;
		$l->setRegVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this RegVocabulary is new, it will return
	 * an empty collection; or if this RegVocabulary has previously
	 * been saved, it will retrieve related RegVocabularyHasVersions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in RegVocabulary.
	 */
	public function getRegVocabularyHasVersionsJoinUser($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRegVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRegVocabularyHasVersions === null) {
			if ($this->isNew()) {
				$this->collRegVocabularyHasVersions = array();
			} else {

				$criteria->add(RegVocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				$this->collRegVocabularyHasVersions = RegVocabularyHasVersionPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RegVocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastRegVocabularyHasVersionCriteria) || !$this->lastRegVocabularyHasVersionCriteria->equals($criteria)) {
				$this->collRegVocabularyHasVersions = RegVocabularyHasVersionPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastRegVocabularyHasVersionCriteria = $criteria;

		return $this->collRegVocabularyHasVersions;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRegVocabulary:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRegVocabulary::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseRegVocabulary
