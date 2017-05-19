<?php

/**
 * Base class that represents a row from the 'reg_vocabulary' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVocabulary extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        VocabularyPeer
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
	 * The value for the project_id field.
	 * @var        int
	 */
	protected $project_id;


	/**
	 * The value for the agent_id field.
	 * @var        int
	 */
	protected $agent_id;


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
	 * The value for the deleted_user_id field.
	 * @var        int
	 */
	protected $deleted_user_id;


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
	 * The value for the languages field.
	 * @var        string
	 */
	protected $languages;


	/**
	 * The value for the profile_id field.
	 * @var        int
	 */
	protected $profile_id;


	/**
	 * The value for the ns_type field.
	 * @var        string
	 */
	protected $ns_type = 'slash';


	/**
	 * The value for the prefixes field.
	 * @var        string
	 */
	protected $prefixes;


	/**
	 * The value for the repo field.
	 * @var        string
	 */
	protected $repo;


	/**
	 * The value for the prefix field.
	 * @var        string
	 */
	protected $prefix = '';


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
	 * The value for the child_updated_by field.
	 * @var        int
	 */
	protected $child_updated_by;

	/**
	 * @var        Projects
	 */
	protected $aProjectsRelatedByProjectId;

	/**
	 * @var        Projects
	 */
	protected $aProjectsRelatedByAgentId;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByCreatedUserId;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByUpdatedUserId;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByDeletedUserId;

	/**
	 * @var        Users
	 */
	protected $aUsersRelatedByChildUpdatedUserId;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        Profile
	 */
	protected $aProfile;

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
	 * Collection to store aggregation of collImportss.
	 * @var        array
	 */
	protected $collImportss;

	/**
	 * The criteria used to select the current contents of collImportss.
	 * @var        Criteria
	 */
	protected $lastImportsCriteria = null;

	/**
	 * Collection to store aggregation of collCollections.
	 * @var        array
	 */
	protected $collCollections;

	/**
	 * The criteria used to select the current contents of collCollections.
	 * @var        Criteria
	 */
	protected $lastCollectionCriteria = null;

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
	 * Collection to store aggregation of collDiscusss.
	 * @var        array
	 */
	protected $collDiscusss;

	/**
	 * The criteria used to select the current contents of collDiscusss.
	 * @var        Criteria
	 */
	protected $lastDiscussCriteria = null;

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
	 * Collection to store aggregation of collFileImportHistorys.
	 * @var        array
	 */
	protected $collFileImportHistorys;

	/**
	 * The criteria used to select the current contents of collFileImportHistorys.
	 * @var        Criteria
	 */
	protected $lastFileImportHistoryCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasUsers.
	 * @var        array
	 */
	protected $collVocabularyHasUsers;

	/**
	 * The criteria used to select the current contents of collVocabularyHasUsers.
	 * @var        Criteria
	 */
	protected $lastVocabularyHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularyHasVersions.
	 * @var        array
	 */
	protected $collVocabularyHasVersions;

	/**
	 * The criteria used to select the current contents of collVocabularyHasVersions.
	 * @var        Criteria
	 */
	protected $lastVocabularyHasVersionCriteria = null;

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
	 * Get the [project_id] column value.
	 * 
	 * @return     int
	 */
	public function getProjectId()
	{

		return $this->project_id;
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
	 * Get the [deleted_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getDeletedUserId()
	{

		return $this->deleted_user_id;
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
	 * Get the [languages] column value.
	 * 
	 * @return     string
	 */
	public function getLanguages()
	{

		return $this->languages;
	}

	/**
	 * Get the [profile_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfileId()
	{

		return $this->profile_id;
	}

	/**
	 * Get the [ns_type] column value.
	 * 
	 * @return     string
	 */
	public function getNsType()
	{

		return $this->ns_type;
	}

	/**
	 * Get the [prefixes] column value.
	 * 
	 * @return     string
	 */
	public function getPrefixes()
	{

		return $this->prefixes;
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
	 * Get the [prefix] column value.
	 * 
	 * @return     string
	 */
	public function getPrefix()
	{

		return $this->prefix;
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
	 * Get the [child_updated_by] column value.
	 * 
	 * @return     int
	 */
	public function getChildUpdatedBy()
	{

		return $this->child_updated_by;
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
			$this->modifiedColumns[] = VocabularyPeer::ID;
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
			$this->modifiedColumns[] = VocabularyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = VocabularyPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = VocabularyPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [project_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setProjectId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->project_id !== $v) {
			$this->project_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::PROJECT_ID;
		}

		if ($this->aProjectsRelatedByProjectId !== null && $this->aProjectsRelatedByProjectId->getId() !== $v) {
			$this->aProjectsRelatedByProjectId = null;
		}

	} // setProjectId()

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

		if ($this->agent_id !== $v) {
			$this->agent_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::AGENT_ID;
		}

		if ($this->aProjectsRelatedByAgentId !== null && $this->aProjectsRelatedByAgentId->getId() !== $v) {
			$this->aProjectsRelatedByAgentId = null;
		}

	} // setAgentId()

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
			$this->modifiedColumns[] = VocabularyPeer::LAST_UPDATED;
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
			$this->modifiedColumns[] = VocabularyPeer::CREATED_USER_ID;
		}

		if ($this->aUsersRelatedByCreatedUserId !== null && $this->aUsersRelatedByCreatedUserId->getId() !== $v) {
			$this->aUsersRelatedByCreatedUserId = null;
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
			$this->modifiedColumns[] = VocabularyPeer::UPDATED_USER_ID;
		}

		if ($this->aUsersRelatedByUpdatedUserId !== null && $this->aUsersRelatedByUpdatedUserId->getId() !== $v) {
			$this->aUsersRelatedByUpdatedUserId = null;
		}

	} // setUpdatedUserId()

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
			$this->modifiedColumns[] = VocabularyPeer::DELETED_USER_ID;
		}

		if ($this->aUsersRelatedByDeletedUserId !== null && $this->aUsersRelatedByDeletedUserId->getId() !== $v) {
			$this->aUsersRelatedByDeletedUserId = null;
		}

	} // setDeletedUserId()

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
			$this->modifiedColumns[] = VocabularyPeer::CHILD_UPDATED_AT;
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
			$this->modifiedColumns[] = VocabularyPeer::CHILD_UPDATED_USER_ID;
		}

		if ($this->aUsersRelatedByChildUpdatedUserId !== null && $this->aUsersRelatedByChildUpdatedUserId->getId() !== $v) {
			$this->aUsersRelatedByChildUpdatedUserId = null;
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
			$this->modifiedColumns[] = VocabularyPeer::NAME;
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
			$this->modifiedColumns[] = VocabularyPeer::NOTE;
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
			$this->modifiedColumns[] = VocabularyPeer::URI;
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
			$this->modifiedColumns[] = VocabularyPeer::URL;
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
			$this->modifiedColumns[] = VocabularyPeer::BASE_DOMAIN;
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
			$this->modifiedColumns[] = VocabularyPeer::TOKEN;
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
			$this->modifiedColumns[] = VocabularyPeer::COMMUNITY;
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
			$this->modifiedColumns[] = VocabularyPeer::LAST_URI_ID;
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
			$this->modifiedColumns[] = VocabularyPeer::STATUS_ID;
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
			$this->modifiedColumns[] = VocabularyPeer::LANGUAGE;
		}

	} // setLanguage()

	/**
	 * Set the value of [languages] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLanguages($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->languages !== $v) {
			$this->languages = $v;
			$this->modifiedColumns[] = VocabularyPeer::LANGUAGES;
		}

	} // setLanguages()

	/**
	 * Set the value of [profile_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setProfileId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_id !== $v) {
			$this->profile_id = $v;
			$this->modifiedColumns[] = VocabularyPeer::PROFILE_ID;
		}

		if ($this->aProfile !== null && $this->aProfile->getId() !== $v) {
			$this->aProfile = null;
		}

	} // setProfileId()

	/**
	 * Set the value of [ns_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setNsType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ns_type !== $v || $v === 'slash') {
			$this->ns_type = $v;
			$this->modifiedColumns[] = VocabularyPeer::NS_TYPE;
		}

	} // setNsType()

	/**
	 * Set the value of [prefixes] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPrefixes($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prefixes !== $v) {
			$this->prefixes = $v;
			$this->modifiedColumns[] = VocabularyPeer::PREFIXES;
		}

	} // setPrefixes()

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
			$this->modifiedColumns[] = VocabularyPeer::REPO;
		}

	} // setRepo()

	/**
	 * Set the value of [prefix] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPrefix($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prefix !== $v || $v === '') {
			$this->prefix = $v;
			$this->modifiedColumns[] = VocabularyPeer::PREFIX;
		}

	} // setPrefix()

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
			$this->modifiedColumns[] = VocabularyPeer::CREATED_BY;
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
			$this->modifiedColumns[] = VocabularyPeer::UPDATED_BY;
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
			$this->modifiedColumns[] = VocabularyPeer::DELETED_BY;
		}

		if ($this->aUsersRelatedByDeletedBy !== null && $this->aUsersRelatedByDeletedBy->getId() !== $v) {
			$this->aUsersRelatedByDeletedBy = null;
		}

	} // setDeletedBy()

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
			$this->modifiedColumns[] = VocabularyPeer::CHILD_UPDATED_BY;
		}

		if ($this->aUsersRelatedByChildUpdatedBy !== null && $this->aUsersRelatedByChildUpdatedBy->getId() !== $v) {
			$this->aUsersRelatedByChildUpdatedBy = null;
		}

	} // setChildUpdatedBy()

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

			$this->project_id = $rs->getInt($startcol + 4);

			$this->agent_id = $rs->getInt($startcol + 5);

			$this->last_updated = $rs->getTimestamp($startcol + 6, null);

			$this->created_user_id = $rs->getInt($startcol + 7);

			$this->updated_user_id = $rs->getInt($startcol + 8);

			$this->deleted_user_id = $rs->getInt($startcol + 9);

			$this->child_updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->child_updated_user_id = $rs->getInt($startcol + 11);

			$this->name = $rs->getString($startcol + 12);

			$this->note = $rs->getString($startcol + 13);

			$this->uri = $rs->getString($startcol + 14);

			$this->url = $rs->getString($startcol + 15);

			$this->base_domain = $rs->getString($startcol + 16);

			$this->token = $rs->getString($startcol + 17);

			$this->community = $rs->getString($startcol + 18);

			$this->last_uri_id = $rs->getInt($startcol + 19);

			$this->status_id = $rs->getInt($startcol + 20);

			$this->language = $rs->getString($startcol + 21);

			$this->languages = $rs->getString($startcol + 22);

			$this->profile_id = $rs->getInt($startcol + 23);

			$this->ns_type = $rs->getString($startcol + 24);

			$this->prefixes = $rs->getString($startcol + 25);

			$this->repo = $rs->getString($startcol + 26);

			$this->prefix = $rs->getString($startcol + 27);

			$this->created_by = $rs->getInt($startcol + 28);

			$this->updated_by = $rs->getInt($startcol + 29);

			$this->deleted_by = $rs->getInt($startcol + 30);

			$this->child_updated_by = $rs->getInt($startcol + 31);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 32; // 32 = VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Vocabulary object", $e);
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

    foreach (sfMixer::getCallables('BaseVocabulary:delete:pre') as $callable)
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
	

    foreach (sfMixer::getCallables('BaseVocabulary:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseVocabulary:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(VocabularyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(VocabularyPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
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
    foreach (sfMixer::getCallables('BaseVocabulary:save:post') as $callable)
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

			if ($this->aProjectsRelatedByProjectId !== null) {
				if ($this->aProjectsRelatedByProjectId->isModified()) {
					$affectedRows += $this->aProjectsRelatedByProjectId->save($con);
				}
				$this->setProjectsRelatedByProjectId($this->aProjectsRelatedByProjectId);
			}

			if ($this->aProjectsRelatedByAgentId !== null) {
				if ($this->aProjectsRelatedByAgentId->isModified()) {
					$affectedRows += $this->aProjectsRelatedByAgentId->save($con);
				}
				$this->setProjectsRelatedByAgentId($this->aProjectsRelatedByAgentId);
			}

			if ($this->aUsersRelatedByCreatedUserId !== null) {
				if ($this->aUsersRelatedByCreatedUserId->isModified()) {
					$affectedRows += $this->aUsersRelatedByCreatedUserId->save($con);
				}
				$this->setUsersRelatedByCreatedUserId($this->aUsersRelatedByCreatedUserId);
			}

			if ($this->aUsersRelatedByUpdatedUserId !== null) {
				if ($this->aUsersRelatedByUpdatedUserId->isModified()) {
					$affectedRows += $this->aUsersRelatedByUpdatedUserId->save($con);
				}
				$this->setUsersRelatedByUpdatedUserId($this->aUsersRelatedByUpdatedUserId);
			}

			if ($this->aUsersRelatedByDeletedUserId !== null) {
				if ($this->aUsersRelatedByDeletedUserId->isModified()) {
					$affectedRows += $this->aUsersRelatedByDeletedUserId->save($con);
				}
				$this->setUsersRelatedByDeletedUserId($this->aUsersRelatedByDeletedUserId);
			}

			if ($this->aUsersRelatedByChildUpdatedUserId !== null) {
				if ($this->aUsersRelatedByChildUpdatedUserId->isModified()) {
					$affectedRows += $this->aUsersRelatedByChildUpdatedUserId->save($con);
				}
				$this->setUsersRelatedByChildUpdatedUserId($this->aUsersRelatedByChildUpdatedUserId);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->aProfile !== null) {
				if ($this->aProfile->isModified()) {
					$affectedRows += $this->aProfile->save($con);
				}
				$this->setProfile($this->aProfile);
			}

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

			if ($this->collExportss !== null) {
				foreach($this->collExportss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collImportss !== null) {
				foreach($this->collImportss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollections !== null) {
				foreach($this->collCollections as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->collDiscusss !== null) {
				foreach($this->collDiscusss as $referrerFK) {
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

			if ($this->collFileImportHistorys !== null) {
				foreach($this->collFileImportHistorys as $referrerFK) {
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

			if ($this->collVocabularyHasVersions !== null) {
				foreach($this->collVocabularyHasVersions as $referrerFK) {
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

			if ($this->aProjectsRelatedByProjectId !== null) {
				if (!$this->aProjectsRelatedByProjectId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProjectsRelatedByProjectId->getValidationFailures());
				}
			}

			if ($this->aProjectsRelatedByAgentId !== null) {
				if (!$this->aProjectsRelatedByAgentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProjectsRelatedByAgentId->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByCreatedUserId !== null) {
				if (!$this->aUsersRelatedByCreatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByCreatedUserId->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByUpdatedUserId !== null) {
				if (!$this->aUsersRelatedByUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByUpdatedUserId->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByDeletedUserId !== null) {
				if (!$this->aUsersRelatedByDeletedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByDeletedUserId->getValidationFailures());
				}
			}

			if ($this->aUsersRelatedByChildUpdatedUserId !== null) {
				if (!$this->aUsersRelatedByChildUpdatedUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsersRelatedByChildUpdatedUserId->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->aProfile !== null) {
				if (!$this->aProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfile->getValidationFailures());
				}
			}

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


			if (($retval = VocabularyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collExportss !== null) {
					foreach($this->collExportss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collImportss !== null) {
					foreach($this->collImportss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollections !== null) {
					foreach($this->collCollections as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collDiscusss !== null) {
					foreach($this->collDiscusss as $referrerFK) {
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

				if ($this->collFileImportHistorys !== null) {
					foreach($this->collFileImportHistorys as $referrerFK) {
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

				if ($this->collVocabularyHasVersions !== null) {
					foreach($this->collVocabularyHasVersions as $referrerFK) {
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
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getProjectId();
				break;
			case 5:
				return $this->getAgentId();
				break;
			case 6:
				return $this->getLastUpdated();
				break;
			case 7:
				return $this->getCreatedUserId();
				break;
			case 8:
				return $this->getUpdatedUserId();
				break;
			case 9:
				return $this->getDeletedUserId();
				break;
			case 10:
				return $this->getChildUpdatedAt();
				break;
			case 11:
				return $this->getChildUpdatedUserId();
				break;
			case 12:
				return $this->getName();
				break;
			case 13:
				return $this->getNote();
				break;
			case 14:
				return $this->getUri();
				break;
			case 15:
				return $this->getUrl();
				break;
			case 16:
				return $this->getBaseDomain();
				break;
			case 17:
				return $this->getToken();
				break;
			case 18:
				return $this->getCommunity();
				break;
			case 19:
				return $this->getLastUriId();
				break;
			case 20:
				return $this->getStatusId();
				break;
			case 21:
				return $this->getLanguage();
				break;
			case 22:
				return $this->getLanguages();
				break;
			case 23:
				return $this->getProfileId();
				break;
			case 24:
				return $this->getNsType();
				break;
			case 25:
				return $this->getPrefixes();
				break;
			case 26:
				return $this->getRepo();
				break;
			case 27:
				return $this->getPrefix();
				break;
			case 28:
				return $this->getCreatedBy();
				break;
			case 29:
				return $this->getUpdatedBy();
				break;
			case 30:
				return $this->getDeletedBy();
				break;
			case 31:
				return $this->getChildUpdatedBy();
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
		$keys = VocabularyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getProjectId(),
			$keys[5] => $this->getAgentId(),
			$keys[6] => $this->getLastUpdated(),
			$keys[7] => $this->getCreatedUserId(),
			$keys[8] => $this->getUpdatedUserId(),
			$keys[9] => $this->getDeletedUserId(),
			$keys[10] => $this->getChildUpdatedAt(),
			$keys[11] => $this->getChildUpdatedUserId(),
			$keys[12] => $this->getName(),
			$keys[13] => $this->getNote(),
			$keys[14] => $this->getUri(),
			$keys[15] => $this->getUrl(),
			$keys[16] => $this->getBaseDomain(),
			$keys[17] => $this->getToken(),
			$keys[18] => $this->getCommunity(),
			$keys[19] => $this->getLastUriId(),
			$keys[20] => $this->getStatusId(),
			$keys[21] => $this->getLanguage(),
			$keys[22] => $this->getLanguages(),
			$keys[23] => $this->getProfileId(),
			$keys[24] => $this->getNsType(),
			$keys[25] => $this->getPrefixes(),
			$keys[26] => $this->getRepo(),
			$keys[27] => $this->getPrefix(),
			$keys[28] => $this->getCreatedBy(),
			$keys[29] => $this->getUpdatedBy(),
			$keys[30] => $this->getDeletedBy(),
			$keys[31] => $this->getChildUpdatedBy(),
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
		$pos = VocabularyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setProjectId($value);
				break;
			case 5:
				$this->setAgentId($value);
				break;
			case 6:
				$this->setLastUpdated($value);
				break;
			case 7:
				$this->setCreatedUserId($value);
				break;
			case 8:
				$this->setUpdatedUserId($value);
				break;
			case 9:
				$this->setDeletedUserId($value);
				break;
			case 10:
				$this->setChildUpdatedAt($value);
				break;
			case 11:
				$this->setChildUpdatedUserId($value);
				break;
			case 12:
				$this->setName($value);
				break;
			case 13:
				$this->setNote($value);
				break;
			case 14:
				$this->setUri($value);
				break;
			case 15:
				$this->setUrl($value);
				break;
			case 16:
				$this->setBaseDomain($value);
				break;
			case 17:
				$this->setToken($value);
				break;
			case 18:
				$this->setCommunity($value);
				break;
			case 19:
				$this->setLastUriId($value);
				break;
			case 20:
				$this->setStatusId($value);
				break;
			case 21:
				$this->setLanguage($value);
				break;
			case 22:
				$this->setLanguages($value);
				break;
			case 23:
				$this->setProfileId($value);
				break;
			case 24:
				$this->setNsType($value);
				break;
			case 25:
				$this->setPrefixes($value);
				break;
			case 26:
				$this->setRepo($value);
				break;
			case 27:
				$this->setPrefix($value);
				break;
			case 28:
				$this->setCreatedBy($value);
				break;
			case 29:
				$this->setUpdatedBy($value);
				break;
			case 30:
				$this->setDeletedBy($value);
				break;
			case 31:
				$this->setChildUpdatedBy($value);
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
		$keys = VocabularyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProjectId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAgentId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastUpdated($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedUserId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedUserId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDeletedUserId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setChildUpdatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setChildUpdatedUserId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setName($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setNote($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUri($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUrl($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setBaseDomain($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setToken($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCommunity($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLastUriId($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setStatusId($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setLanguage($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setLanguages($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setProfileId($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setNsType($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setPrefixes($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setRepo($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setPrefix($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCreatedBy($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setUpdatedBy($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setDeletedBy($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setChildUpdatedBy($arr[$keys[31]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		if ($this->isColumnModified(VocabularyPeer::ID)) $criteria->add(VocabularyPeer::ID, $this->id);
		if ($this->isColumnModified(VocabularyPeer::CREATED_AT)) $criteria->add(VocabularyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(VocabularyPeer::UPDATED_AT)) $criteria->add(VocabularyPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(VocabularyPeer::DELETED_AT)) $criteria->add(VocabularyPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(VocabularyPeer::PROJECT_ID)) $criteria->add(VocabularyPeer::PROJECT_ID, $this->project_id);
		if ($this->isColumnModified(VocabularyPeer::AGENT_ID)) $criteria->add(VocabularyPeer::AGENT_ID, $this->agent_id);
		if ($this->isColumnModified(VocabularyPeer::LAST_UPDATED)) $criteria->add(VocabularyPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(VocabularyPeer::CREATED_USER_ID)) $criteria->add(VocabularyPeer::CREATED_USER_ID, $this->created_user_id);
		if ($this->isColumnModified(VocabularyPeer::UPDATED_USER_ID)) $criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->updated_user_id);
		if ($this->isColumnModified(VocabularyPeer::DELETED_USER_ID)) $criteria->add(VocabularyPeer::DELETED_USER_ID, $this->deleted_user_id);
		if ($this->isColumnModified(VocabularyPeer::CHILD_UPDATED_AT)) $criteria->add(VocabularyPeer::CHILD_UPDATED_AT, $this->child_updated_at);
		if ($this->isColumnModified(VocabularyPeer::CHILD_UPDATED_USER_ID)) $criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->child_updated_user_id);
		if ($this->isColumnModified(VocabularyPeer::NAME)) $criteria->add(VocabularyPeer::NAME, $this->name);
		if ($this->isColumnModified(VocabularyPeer::NOTE)) $criteria->add(VocabularyPeer::NOTE, $this->note);
		if ($this->isColumnModified(VocabularyPeer::URI)) $criteria->add(VocabularyPeer::URI, $this->uri);
		if ($this->isColumnModified(VocabularyPeer::URL)) $criteria->add(VocabularyPeer::URL, $this->url);
		if ($this->isColumnModified(VocabularyPeer::BASE_DOMAIN)) $criteria->add(VocabularyPeer::BASE_DOMAIN, $this->base_domain);
		if ($this->isColumnModified(VocabularyPeer::TOKEN)) $criteria->add(VocabularyPeer::TOKEN, $this->token);
		if ($this->isColumnModified(VocabularyPeer::COMMUNITY)) $criteria->add(VocabularyPeer::COMMUNITY, $this->community);
		if ($this->isColumnModified(VocabularyPeer::LAST_URI_ID)) $criteria->add(VocabularyPeer::LAST_URI_ID, $this->last_uri_id);
		if ($this->isColumnModified(VocabularyPeer::STATUS_ID)) $criteria->add(VocabularyPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(VocabularyPeer::LANGUAGE)) $criteria->add(VocabularyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(VocabularyPeer::LANGUAGES)) $criteria->add(VocabularyPeer::LANGUAGES, $this->languages);
		if ($this->isColumnModified(VocabularyPeer::PROFILE_ID)) $criteria->add(VocabularyPeer::PROFILE_ID, $this->profile_id);
		if ($this->isColumnModified(VocabularyPeer::NS_TYPE)) $criteria->add(VocabularyPeer::NS_TYPE, $this->ns_type);
		if ($this->isColumnModified(VocabularyPeer::PREFIXES)) $criteria->add(VocabularyPeer::PREFIXES, $this->prefixes);
		if ($this->isColumnModified(VocabularyPeer::REPO)) $criteria->add(VocabularyPeer::REPO, $this->repo);
		if ($this->isColumnModified(VocabularyPeer::PREFIX)) $criteria->add(VocabularyPeer::PREFIX, $this->prefix);
		if ($this->isColumnModified(VocabularyPeer::CREATED_BY)) $criteria->add(VocabularyPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(VocabularyPeer::UPDATED_BY)) $criteria->add(VocabularyPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(VocabularyPeer::DELETED_BY)) $criteria->add(VocabularyPeer::DELETED_BY, $this->deleted_by);
		if ($this->isColumnModified(VocabularyPeer::CHILD_UPDATED_BY)) $criteria->add(VocabularyPeer::CHILD_UPDATED_BY, $this->child_updated_by);

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
		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		$criteria->add(VocabularyPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Vocabulary (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setProjectId($this->project_id);

		$copyObj->setAgentId($this->agent_id);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setCreatedUserId($this->created_user_id);

		$copyObj->setUpdatedUserId($this->updated_user_id);

		$copyObj->setDeletedUserId($this->deleted_user_id);

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

		$copyObj->setLanguages($this->languages);

		$copyObj->setProfileId($this->profile_id);

		$copyObj->setNsType($this->ns_type);

		$copyObj->setPrefixes($this->prefixes);

		$copyObj->setRepo($this->repo);

		$copyObj->setPrefix($this->prefix);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setDeletedBy($this->deleted_by);

		$copyObj->setChildUpdatedBy($this->child_updated_by);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getExportss() as $relObj) {
				$copyObj->addExports($relObj->copy($deepCopy));
			}

			foreach($this->getImportss() as $relObj) {
				$copyObj->addImports($relObj->copy($deepCopy));
			}

			foreach($this->getCollections() as $relObj) {
				$copyObj->addCollection($relObj->copy($deepCopy));
			}

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

			foreach($this->getDiscusss() as $relObj) {
				$copyObj->addDiscuss($relObj->copy($deepCopy));
			}

			foreach($this->getExportHistorys() as $relObj) {
				$copyObj->addExportHistory($relObj->copy($deepCopy));
			}

			foreach($this->getFileImportHistorys() as $relObj) {
				$copyObj->addFileImportHistory($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasVersions() as $relObj) {
				$copyObj->addVocabularyHasVersion($relObj->copy($deepCopy));
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
	 * @return     Vocabulary Clone of current object.
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
	 * @return     VocabularyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VocabularyPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Projects object.
	 *
	 * @param      Projects $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProjectsRelatedByProjectId($v)
	{


		if ($v === null) {
			$this->setProjectId(NULL);
		} else {
			$this->setProjectId($v->getId());
		}


		$this->aProjectsRelatedByProjectId = $v;
	}


	/**
	 * Get the associated Projects object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Projects The associated Projects object.
	 * @throws     PropelException
	 */
	public function getProjectsRelatedByProjectId($con = null)
	{
		if ($this->aProjectsRelatedByProjectId === null && ($this->project_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProjectsPeer.php';

			$this->aProjectsRelatedByProjectId = ProjectsPeer::retrieveByPK($this->project_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProjectsPeer::retrieveByPK($this->project_id, $con);
			   $obj->addProjectssRelatedByProjectId($this);
			 */
		}
		return $this->aProjectsRelatedByProjectId;
	}

	/**
	 * Declares an association between this object and a Projects object.
	 *
	 * @param      Projects $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProjectsRelatedByAgentId($v)
	{


		if ($v === null) {
			$this->setAgentId(NULL);
		} else {
			$this->setAgentId($v->getId());
		}


		$this->aProjectsRelatedByAgentId = $v;
	}


	/**
	 * Get the associated Projects object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Projects The associated Projects object.
	 * @throws     PropelException
	 */
	public function getProjectsRelatedByAgentId($con = null)
	{
		if ($this->aProjectsRelatedByAgentId === null && ($this->agent_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProjectsPeer.php';

			$this->aProjectsRelatedByAgentId = ProjectsPeer::retrieveByPK($this->agent_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProjectsPeer::retrieveByPK($this->agent_id, $con);
			   $obj->addProjectssRelatedByAgentId($this);
			 */
		}
		return $this->aProjectsRelatedByAgentId;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByCreatedUserId($v)
	{


		if ($v === null) {
			$this->setCreatedUserId(NULL);
		} else {
			$this->setCreatedUserId($v->getId());
		}


		$this->aUsersRelatedByCreatedUserId = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByCreatedUserId($con = null)
	{
		if ($this->aUsersRelatedByCreatedUserId === null && ($this->created_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByCreatedUserId = UsersPeer::retrieveByPK($this->created_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->created_user_id, $con);
			   $obj->addUserssRelatedByCreatedUserId($this);
			 */
		}
		return $this->aUsersRelatedByCreatedUserId;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setUpdatedUserId(NULL);
		} else {
			$this->setUpdatedUserId($v->getId());
		}


		$this->aUsersRelatedByUpdatedUserId = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByUpdatedUserId($con = null)
	{
		if ($this->aUsersRelatedByUpdatedUserId === null && ($this->updated_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByUpdatedUserId = UsersPeer::retrieveByPK($this->updated_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->updated_user_id, $con);
			   $obj->addUserssRelatedByUpdatedUserId($this);
			 */
		}
		return $this->aUsersRelatedByUpdatedUserId;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByDeletedUserId($v)
	{


		if ($v === null) {
			$this->setDeletedUserId(NULL);
		} else {
			$this->setDeletedUserId($v->getId());
		}


		$this->aUsersRelatedByDeletedUserId = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByDeletedUserId($con = null)
	{
		if ($this->aUsersRelatedByDeletedUserId === null && ($this->deleted_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByDeletedUserId = UsersPeer::retrieveByPK($this->deleted_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->deleted_user_id, $con);
			   $obj->addUserssRelatedByDeletedUserId($this);
			 */
		}
		return $this->aUsersRelatedByDeletedUserId;
	}

	/**
	 * Declares an association between this object and a Users object.
	 *
	 * @param      Users $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsersRelatedByChildUpdatedUserId($v)
	{


		if ($v === null) {
			$this->setChildUpdatedUserId(NULL);
		} else {
			$this->setChildUpdatedUserId($v->getId());
		}


		$this->aUsersRelatedByChildUpdatedUserId = $v;
	}


	/**
	 * Get the associated Users object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Users The associated Users object.
	 * @throws     PropelException
	 */
	public function getUsersRelatedByChildUpdatedUserId($con = null)
	{
		if ($this->aUsersRelatedByChildUpdatedUserId === null && ($this->child_updated_user_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUsersPeer.php';

			$this->aUsersRelatedByChildUpdatedUserId = UsersPeer::retrieveByPK($this->child_updated_user_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsersPeer::retrieveByPK($this->child_updated_user_id, $con);
			   $obj->addUserssRelatedByChildUpdatedUserId($this);
			 */
		}
		return $this->aUsersRelatedByChildUpdatedUserId;
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
	 * Declares an association between this object and a Profile object.
	 *
	 * @param      Profile $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProfile($v)
	{


		if ($v === null) {
			$this->setProfileId(NULL);
		} else {
			$this->setProfileId($v->getId());
		}


		$this->aProfile = $v;
	}


	/**
	 * Get the associated Profile object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Profile The associated Profile object.
	 * @throws     PropelException
	 */
	public function getProfile($con = null)
	{
		if ($this->aProfile === null && ($this->profile_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProfilePeer.php';

			$this->aProfile = ProfilePeer::retrieveByPK($this->profile_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProfilePeer::retrieveByPK($this->profile_id, $con);
			   $obj->addProfiles($this);
			 */
		}
		return $this->aProfile;
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Exportss from storage.
	 * If this Vocabulary is new, it will return
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

				$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

				ExportsPeer::addSelectColumns($criteria);
				$this->collExportss = ExportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

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

		$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

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
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Exportss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getExportssJoinProfile($criteria = null, $con = null)
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

				$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

				$this->collExportss = ExportsPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportsPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastExportsCriteria) || !$this->lastExportsCriteria->equals($criteria)) {
				$this->collExportss = ExportsPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastExportsCriteria = $criteria;

		return $this->collExportss;
	}

	/**
	 * Temporary storage of collImportss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initImportss()
	{
		if ($this->collImportss === null) {
			$this->collImportss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Importss from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getImportss($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportss === null) {
			if ($this->isNew()) {
			   $this->collImportss = array();
			} else {

				$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				$this->collImportss = ImportsPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

				ImportsPeer::addSelectColumns($criteria);
				if (!isset($this->lastImportsCriteria) || !$this->lastImportsCriteria->equals($criteria)) {
					$this->collImportss = ImportsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastImportsCriteria = $criteria;
		return $this->collImportss;
	}

	/**
	 * Returns the number of related Importss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countImportss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

		return ImportsPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Imports object to this object
	 * through the Imports foreign key attribute
	 *
	 * @param      Imports $l Imports
	 * @return     void
	 * @throws     PropelException
	 */
	public function addImports(Imports $l)
	{
		$this->collImportss[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Importss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getImportssJoinUsersRelatedByImportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportss === null) {
			if ($this->isNew()) {
				$this->collImportss = array();
			} else {

				$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

				$this->collImportss = ImportsPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastImportsCriteria) || !$this->lastImportsCriteria->equals($criteria)) {
				$this->collImportss = ImportsPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		}
		$this->lastImportsCriteria = $criteria;

		return $this->collImportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Importss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getImportssJoinUsersRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportss === null) {
			if ($this->isNew()) {
				$this->collImportss = array();
			} else {

				$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

				$this->collImportss = ImportsPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastImportsCriteria) || !$this->lastImportsCriteria->equals($criteria)) {
				$this->collImportss = ImportsPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		}
		$this->lastImportsCriteria = $criteria;

		return $this->collImportss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Importss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getImportssJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseImportsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImportss === null) {
			if ($this->isNew()) {
				$this->collImportss = array();
			} else {

				$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

				$this->collImportss = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ImportsPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastImportsCriteria) || !$this->lastImportsCriteria->equals($criteria)) {
				$this->collImportss = ImportsPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastImportsCriteria = $criteria;

		return $this->collImportss;
	}

	/**
	 * Temporary storage of collCollections to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollections()
	{
		if ($this->collCollections === null) {
			$this->collCollections = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollections($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
			   $this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollections = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
					$this->collCollections = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionCriteria = $criteria;
		return $this->collCollections;
	}

	/**
	 * Returns the number of related Collections.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollections($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

		return CollectionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Collection object to this object
	 * through the Collection foreign key attribute
	 *
	 * @param      Collection $l Collection
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCollection(Collection $l)
	{
		$this->collCollections[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Collections from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getCollectionsJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCollectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCollections === null) {
			if ($this->isNew()) {
				$this->collCollections = array();
			} else {

				$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastCollectionCriteria) || !$this->lastCollectionCriteria->equals($criteria)) {
				$this->collCollections = CollectionPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastCollectionCriteria = $criteria;

		return $this->collCollections;
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 * If this Vocabulary is new, it will return
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
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptsJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptsJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptsJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptsJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastConceptCriteria = $criteria;

		return $this->collConcepts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Concepts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptsJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptCriteria) || !$this->lastConceptCriteria->equals($criteria)) {
				$this->collConcepts = ConceptPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 * If this Vocabulary is new, it will return
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
	public function getConceptPropertysJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
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
	public function getConceptPropertysJoinUsersRelatedByUpdatedUserId($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByUpdatedUserId($criteria, $con);
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertysJoinProfilePropertyRelatedBySkosPropertyId($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedBySkosPropertyId($criteria, $con);
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
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
	public function getConceptPropertysJoinProfilePropertyRelatedByProfilePropertyId($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinProfilePropertyRelatedByProfilePropertyId($criteria, $con);
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
	public function getConceptPropertysJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
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
	public function getConceptPropertysJoinUsersRelatedByUpdatedBy($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByUpdatedBy($criteria, $con);
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
	public function getConceptPropertysJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyCriteria) || !$this->lastConceptPropertyCriteria->equals($criteria)) {
				$this->collConceptPropertys = ConceptPropertyPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 * If this Vocabulary is new, it will return
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
		$l->setVocabularyRelatedByVocabularyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinFileImportHistory($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinProfileProperty($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedByVocabularyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedByVocabularyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedByVocabularyIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria) || !$this->lastConceptPropertyHistoryRelatedByVocabularyIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedByVocabularyId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 * If this Vocabulary is new, it will return
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
		$l->setVocabularyRelatedBySchemeId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinFileImportHistory($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinProfileProperty($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ConceptPropertyHistorysRelatedBySchemeId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getConceptPropertyHistorysRelatedBySchemeIdJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::SCHEME_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria) || !$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorysRelatedBySchemeId = ConceptPropertyHistoryPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryRelatedBySchemeIdCriteria = $criteria;

		return $this->collConceptPropertyHistorysRelatedBySchemeId;
	}

	/**
	 * Temporary storage of collDiscusss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusss()
	{
		if ($this->collDiscusss === null) {
			$this->collDiscusss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusss($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
			   $this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusss = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
					$this->collDiscusss = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussCriteria = $criteria;
		return $this->collDiscusss;
	}

	/**
	 * Returns the number of related Discusss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusss($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

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
	public function addDiscuss(Discuss $l)
	{
		$this->collDiscusss[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinUsersRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByDeletedUserId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinSchema($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinSchemaPropertyElement($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinConcept($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinDiscussRelatedByRootId($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinDiscussRelatedByParentId($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related Discusss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getDiscusssJoinUsersRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collDiscusss === null) {
			if ($this->isNew()) {
				$this->collDiscusss = array();
			} else {

				$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastDiscussCriteria) || !$this->lastDiscussCriteria->equals($criteria)) {
				$this->collDiscusss = DiscussPeer::doSelectJoinUsersRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastDiscussCriteria = $criteria;

		return $this->collDiscusss;
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
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 * If this Vocabulary is new, it will return
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

				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

				ExportHistoryPeer::addSelectColumns($criteria);
				$this->collExportHistorys = ExportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

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

		$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

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
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

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
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getExportHistorysJoinProfile($criteria = null, $con = null)
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

				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related ExportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
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

				$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByExportedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ExportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastExportHistoryCriteria) || !$this->lastExportHistoryCriteria->equals($criteria)) {
				$this->collExportHistorys = ExportHistoryPeer::doSelectJoinUsersRelatedByExportedBy($criteria, $con);
			}
		}
		$this->lastExportHistoryCriteria = $criteria;

		return $this->collExportHistorys;
	}

	/**
	 * Temporary storage of collFileImportHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileImportHistorys()
	{
		if ($this->collFileImportHistorys === null) {
			$this->collFileImportHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileImportHistorys($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
			   $this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
					$this->collFileImportHistorys = FileImportHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;
		return $this->collFileImportHistorys;
	}

	/**
	 * Returns the number of related FileImportHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileImportHistorys($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

		return FileImportHistoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileImportHistory object to this object
	 * through the FileImportHistory foreign key attribute
	 *
	 * @param      FileImportHistory $l FileImportHistory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImportHistory(FileImportHistory $l)
	{
		$this->collFileImportHistorys[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getFileImportHistorysJoinUsersRelatedByUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByUserId($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getFileImportHistorysJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getFileImportHistorysJoinBatch($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinBatch($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getFileImportHistorysJoinUsersRelatedByImportedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileImportHistoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImportHistorys === null) {
			if ($this->isNew()) {
				$this->collFileImportHistorys = array();
			} else {

				$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinUsersRelatedByImportedBy($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}

	/**
	 * Temporary storage of collVocabularyHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
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
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularyHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
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
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularyHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
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
	 * @param      VocabularyHasUser $l VocabularyHasUser
	 * @return     void
	 * @throws     PropelException
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
	public function getVocabularyHasUsersJoinUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasUserPeer.php';
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

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUsers($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinUsers($criteria, $con);
			}
		}
		$this->lastVocabularyHasUserCriteria = $criteria;

		return $this->collVocabularyHasUsers;
	}

	/**
	 * Temporary storage of collVocabularyHasVersions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularyHasVersions()
	{
		if ($this->collVocabularyHasVersions === null) {
			$this->collVocabularyHasVersions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary has previously
	 * been saved, it will retrieve related VocabularyHasVersions from storage.
	 * If this Vocabulary is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularyHasVersions($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersions === null) {
			if ($this->isNew()) {
			   $this->collVocabularyHasVersions = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyHasVersionCriteria) || !$this->lastVocabularyHasVersionCriteria->equals($criteria)) {
					$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyHasVersionCriteria = $criteria;
		return $this->collVocabularyHasVersions;
	}

	/**
	 * Returns the number of related VocabularyHasVersions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularyHasVersions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

		return VocabularyHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VocabularyHasVersion object to this object
	 * through the VocabularyHasVersion foreign key attribute
	 *
	 * @param      VocabularyHasVersion $l VocabularyHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVocabularyHasVersion(VocabularyHasVersion $l)
	{
		$this->collVocabularyHasVersions[] = $l;
		$l->setVocabulary($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related VocabularyHasVersions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getVocabularyHasVersionsJoinUsersRelatedByCreatedUserId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersions === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasVersions = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastVocabularyHasVersionCriteria) || !$this->lastVocabularyHasVersionCriteria->equals($criteria)) {
				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinUsersRelatedByCreatedUserId($criteria, $con);
			}
		}
		$this->lastVocabularyHasVersionCriteria = $criteria;

		return $this->collVocabularyHasVersions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Vocabulary is new, it will return
	 * an empty collection; or if this Vocabulary has previously
	 * been saved, it will retrieve related VocabularyHasVersions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Vocabulary.
	 */
	public function getVocabularyHasVersionsJoinUsersRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVocabularyHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVocabularyHasVersions === null) {
			if ($this->isNew()) {
				$this->collVocabularyHasVersions = array();
			} else {

				$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasVersionPeer::VOCABULARY_ID, $this->getId());

			if (!isset($this->lastVocabularyHasVersionCriteria) || !$this->lastVocabularyHasVersionCriteria->equals($criteria)) {
				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinUsersRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastVocabularyHasVersionCriteria = $criteria;

		return $this->collVocabularyHasVersions;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseVocabulary:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseVocabulary::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseVocabulary
