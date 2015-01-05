<?php

/**
 * Base class that represents a row from the 'reg_user' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseUser extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserPeer
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
	 * The value for the last_updated field.
	 * @var        int
	 */
	protected $last_updated;


	/**
	 * The value for the deleted_at field.
	 * @var        int
	 */
	protected $deleted_at;


	/**
	 * The value for the nickname field.
	 * @var        string
	 */
	protected $nickname;


	/**
	 * The value for the salutation field.
	 * @var        string
	 */
	protected $salutation;


	/**
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;


	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;


	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;


	/**
	 * The value for the sha1_password field.
	 * @var        string
	 */
	protected $sha1_password;


	/**
	 * The value for the salt field.
	 * @var        string
	 */
	protected $salt;


	/**
	 * The value for the want_to_be_moderator field.
	 * @var        boolean
	 */
	protected $want_to_be_moderator = false;


	/**
	 * The value for the is_moderator field.
	 * @var        boolean
	 */
	protected $is_moderator = false;


	/**
	 * The value for the is_administrator field.
	 * @var        boolean
	 */
	protected $is_administrator = false;


	/**
	 * The value for the deletions field.
	 * @var        int
	 */
	protected $deletions = 0;


	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * Collection to store aggregation of collProfilesRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilesRelatedByChildUpdatedBy.
	 * @var        array
	 */
	protected $collProfilesRelatedByChildUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilesRelatedByChildUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfileRelatedByChildUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByCreatedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByCreatedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByCreatedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByCreatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByUpdatedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByUpdatedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByUpdatedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByUpdatedByCriteria = null;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByDeletedBy.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByDeletedBy;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByDeletedBy.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByDeletedByCriteria = null;

	/**
	 * Collection to store aggregation of collAgentHasUsers.
	 * @var        array
	 */
	protected $collAgentHasUsers;

	/**
	 * The criteria used to select the current contents of collAgentHasUsers.
	 * @var        Criteria
	 */
	protected $lastAgentHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collCollectionsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collCollectionsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collCollectionsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collCollectionsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastCollectionRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collConceptsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collConceptsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collConceptPropertysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collConceptPropertysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collConceptPropertysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastConceptPropertyRelatedByUpdatedUserIdCriteria = null;

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
	 * Collection to store aggregation of collDiscusssRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collDiscusssRelatedByDeletedUserId.
	 * @var        array
	 */
	protected $collDiscusssRelatedByDeletedUserId;

	/**
	 * The criteria used to select the current contents of collDiscusssRelatedByDeletedUserId.
	 * @var        Criteria
	 */
	protected $lastDiscussRelatedByDeletedUserIdCriteria = null;

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
	 * Collection to store aggregation of collSchemasRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemasRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemasRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemasRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemasRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementsRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collSchemaPropertyElementsRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementsRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaPropertyElementHistorys.
	 * @var        array
	 */
	protected $collSchemaPropertyElementHistorys;

	/**
	 * The criteria used to select the current contents of collSchemaPropertyElementHistorys.
	 * @var        Criteria
	 */
	protected $lastSchemaPropertyElementHistoryCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByCreatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByCreatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByCreatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByCreatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByUpdatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByUpdatedUserIdCriteria = null;

	/**
	 * Collection to store aggregation of collVocabularysRelatedByChildUpdatedUserId.
	 * @var        array
	 */
	protected $collVocabularysRelatedByChildUpdatedUserId;

	/**
	 * The criteria used to select the current contents of collVocabularysRelatedByChildUpdatedUserId.
	 * @var        Criteria
	 */
	protected $lastVocabularyRelatedByChildUpdatedUserIdCriteria = null;

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
	 * Collection to store aggregation of collSchemaHasUsers.
	 * @var        array
	 */
	protected $collSchemaHasUsers;

	/**
	 * The criteria used to select the current contents of collSchemaHasUsers.
	 * @var        Criteria
	 */
	protected $lastSchemaHasUserCriteria = null;

	/**
	 * Collection to store aggregation of collSchemaHasVersions.
	 * @var        array
	 */
	protected $collSchemaHasVersions;

	/**
	 * The criteria used to select the current contents of collSchemaHasVersions.
	 * @var        Criteria
	 */
	protected $lastSchemaHasVersionCriteria = null;

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
	 * Get the [nickname] column value.
	 * 
	 * @return     string
	 */
	public function getNickname()
	{

		return $this->nickname;
	}

	/**
	 * Get the [salutation] column value.
	 * 
	 * @return     string
	 */
	public function getSalutation()
	{

		return $this->salutation;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{

		return $this->first_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{

		return $this->last_name;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{

		return $this->email;
	}

	/**
	 * Get the [sha1_password] column value.
	 * 
	 * @return     string
	 */
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	/**
	 * Get the [salt] column value.
	 * 
	 * @return     string
	 */
	public function getSalt()
	{

		return $this->salt;
	}

	/**
	 * Get the [want_to_be_moderator] column value.
	 * 
	 * @return     boolean
	 */
	public function getWantToBeModerator()
	{

		return $this->want_to_be_moderator;
	}

	/**
	 * Get the [is_moderator] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsModerator()
	{

		return $this->is_moderator;
	}

	/**
	 * Get the [is_administrator] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsAdministrator()
	{

		return $this->is_administrator;
	}

	/**
	 * Get the [deletions] column value.
	 * 
	 * @return     int
	 */
	public function getDeletions()
	{

		return $this->deletions;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{

		return $this->password;
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
			$this->modifiedColumns[] = UserPeer::ID;
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
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
		}

	} // setCreatedAt()

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
			$this->modifiedColumns[] = UserPeer::LAST_UPDATED;
		}

	} // setLastUpdated()

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
			$this->modifiedColumns[] = UserPeer::DELETED_AT;
		}

	} // setDeletedAt()

	/**
	 * Set the value of [nickname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setNickname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v) {
			$this->nickname = $v;
			$this->modifiedColumns[] = UserPeer::NICKNAME;
		}

	} // setNickname()

	/**
	 * Set the value of [salutation] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSalutation($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salutation !== $v) {
			$this->salutation = $v;
			$this->modifiedColumns[] = UserPeer::SALUTATION;
		}

	} // setSalutation()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFirstName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

	} // setFirstName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setLastName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

	} // setLastName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} // setEmail()

	/**
	 * Set the value of [sha1_password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSha1Password($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UserPeer::SHA1_PASSWORD;
		}

	} // setSha1Password()

	/**
	 * Set the value of [salt] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSalt($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UserPeer::SALT;
		}

	} // setSalt()

	/**
	 * Set the value of [want_to_be_moderator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setWantToBeModerator($v)
	{

		if ($this->want_to_be_moderator !== $v || $v === false) {
			$this->want_to_be_moderator = $v;
			$this->modifiedColumns[] = UserPeer::WANT_TO_BE_MODERATOR;
		}

	} // setWantToBeModerator()

	/**
	 * Set the value of [is_moderator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsModerator($v)
	{

		if ($this->is_moderator !== $v || $v === false) {
			$this->is_moderator = $v;
			$this->modifiedColumns[] = UserPeer::IS_MODERATOR;
		}

	} // setIsModerator()

	/**
	 * Set the value of [is_administrator] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsAdministrator($v)
	{

		if ($this->is_administrator !== $v || $v === false) {
			$this->is_administrator = $v;
			$this->modifiedColumns[] = UserPeer::IS_ADMINISTRATOR;
		}

	} // setIsAdministrator()

	/**
	 * Set the value of [deletions] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDeletions($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deletions !== $v || $v === 0) {
			$this->deletions = $v;
			$this->modifiedColumns[] = UserPeer::DELETIONS;
		}

	} // setDeletions()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPassword($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD;
		}

	} // setPassword()

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

			$this->last_updated = $rs->getTimestamp($startcol + 2, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 3, null);

			$this->nickname = $rs->getString($startcol + 4);

			$this->salutation = $rs->getString($startcol + 5);

			$this->first_name = $rs->getString($startcol + 6);

			$this->last_name = $rs->getString($startcol + 7);

			$this->email = $rs->getString($startcol + 8);

			$this->sha1_password = $rs->getString($startcol + 9);

			$this->salt = $rs->getString($startcol + 10);

			$this->want_to_be_moderator = $rs->getBoolean($startcol + 11);

			$this->is_moderator = $rs->getBoolean($startcol + 12);

			$this->is_administrator = $rs->getBoolean($startcol + 13);

			$this->deletions = $rs->getInt($startcol + 14);

			$this->password = $rs->getString($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = UserPeer::NUM_COLUMNS - UserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
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

    foreach (sfMixer::getCallables('BaseUser:delete:pre') as $callable)
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUser:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUser:save:post') as $callable)
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
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProfilesRelatedByCreatedBy !== null) {
				foreach($this->collProfilesRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByUpdatedBy !== null) {
				foreach($this->collProfilesRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByDeletedBy !== null) {
				foreach($this->collProfilesRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilesRelatedByChildUpdatedBy !== null) {
				foreach($this->collProfilesRelatedByChildUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByCreatedBy !== null) {
				foreach($this->collProfilePropertysRelatedByCreatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByUpdatedBy !== null) {
				foreach($this->collProfilePropertysRelatedByUpdatedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProfilePropertysRelatedByDeletedBy !== null) {
				foreach($this->collProfilePropertysRelatedByDeletedBy as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentHasUsers !== null) {
				foreach($this->collAgentHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByCreatedUserId !== null) {
				foreach($this->collCollectionsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCollectionsRelatedByUpdatedUserId !== null) {
				foreach($this->collCollectionsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByCreatedUserId !== null) {
				foreach($this->collConceptsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptsRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
				foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
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

			if ($this->collDiscusssRelatedByCreatedUserId !== null) {
				foreach($this->collDiscusssRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscusssRelatedByDeletedUserId !== null) {
				foreach($this->collDiscusssRelatedByDeletedUserId as $referrerFK) {
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

			if ($this->collSchemasRelatedByCreatedUserId !== null) {
				foreach($this->collSchemasRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemasRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemasRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaPropertysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertysRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemaPropertysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByCreatedUserId !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId !== null) {
				foreach($this->collSchemaPropertyElementsRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaPropertyElementHistorys !== null) {
				foreach($this->collSchemaPropertyElementHistorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByCreatedUserId !== null) {
				foreach($this->collVocabularysRelatedByCreatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByUpdatedUserId !== null) {
				foreach($this->collVocabularysRelatedByUpdatedUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVocabularysRelatedByChildUpdatedUserId !== null) {
				foreach($this->collVocabularysRelatedByChildUpdatedUserId as $referrerFK) {
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

			if ($this->collSchemaHasUsers !== null) {
				foreach($this->collSchemaHasUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSchemaHasVersions !== null) {
				foreach($this->collSchemaHasVersions as $referrerFK) {
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


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProfilesRelatedByCreatedBy !== null) {
					foreach($this->collProfilesRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByUpdatedBy !== null) {
					foreach($this->collProfilesRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByDeletedBy !== null) {
					foreach($this->collProfilesRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilesRelatedByChildUpdatedBy !== null) {
					foreach($this->collProfilesRelatedByChildUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByCreatedBy !== null) {
					foreach($this->collProfilePropertysRelatedByCreatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByUpdatedBy !== null) {
					foreach($this->collProfilePropertysRelatedByUpdatedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProfilePropertysRelatedByDeletedBy !== null) {
					foreach($this->collProfilePropertysRelatedByDeletedBy as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentHasUsers !== null) {
					foreach($this->collAgentHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByCreatedUserId !== null) {
					foreach($this->collCollectionsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCollectionsRelatedByUpdatedUserId !== null) {
					foreach($this->collCollectionsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByCreatedUserId !== null) {
					foreach($this->collConceptsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptsRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByCreatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptPropertysRelatedByUpdatedUserId !== null) {
					foreach($this->collConceptPropertysRelatedByUpdatedUserId as $referrerFK) {
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

				if ($this->collDiscusssRelatedByCreatedUserId !== null) {
					foreach($this->collDiscusssRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscusssRelatedByDeletedUserId !== null) {
					foreach($this->collDiscusssRelatedByDeletedUserId as $referrerFK) {
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

				if ($this->collSchemasRelatedByCreatedUserId !== null) {
					foreach($this->collSchemasRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemasRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemasRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaPropertysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertysRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemaPropertysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByCreatedUserId !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId !== null) {
					foreach($this->collSchemaPropertyElementsRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaPropertyElementHistorys !== null) {
					foreach($this->collSchemaPropertyElementHistorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByCreatedUserId !== null) {
					foreach($this->collVocabularysRelatedByCreatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByUpdatedUserId !== null) {
					foreach($this->collVocabularysRelatedByUpdatedUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVocabularysRelatedByChildUpdatedUserId !== null) {
					foreach($this->collVocabularysRelatedByChildUpdatedUserId as $referrerFK) {
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

				if ($this->collSchemaHasUsers !== null) {
					foreach($this->collSchemaHasUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSchemaHasVersions !== null) {
					foreach($this->collSchemaHasVersions as $referrerFK) {
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getLastUpdated();
				break;
			case 3:
				return $this->getDeletedAt();
				break;
			case 4:
				return $this->getNickname();
				break;
			case 5:
				return $this->getSalutation();
				break;
			case 6:
				return $this->getFirstName();
				break;
			case 7:
				return $this->getLastName();
				break;
			case 8:
				return $this->getEmail();
				break;
			case 9:
				return $this->getSha1Password();
				break;
			case 10:
				return $this->getSalt();
				break;
			case 11:
				return $this->getWantToBeModerator();
				break;
			case 12:
				return $this->getIsModerator();
				break;
			case 13:
				return $this->getIsAdministrator();
				break;
			case 14:
				return $this->getDeletions();
				break;
			case 15:
				return $this->getPassword();
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
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getLastUpdated(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getNickname(),
			$keys[5] => $this->getSalutation(),
			$keys[6] => $this->getFirstName(),
			$keys[7] => $this->getLastName(),
			$keys[8] => $this->getEmail(),
			$keys[9] => $this->getSha1Password(),
			$keys[10] => $this->getSalt(),
			$keys[11] => $this->getWantToBeModerator(),
			$keys[12] => $this->getIsModerator(),
			$keys[13] => $this->getIsAdministrator(),
			$keys[14] => $this->getDeletions(),
			$keys[15] => $this->getPassword(),
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setLastUpdated($value);
				break;
			case 3:
				$this->setDeletedAt($value);
				break;
			case 4:
				$this->setNickname($value);
				break;
			case 5:
				$this->setSalutation($value);
				break;
			case 6:
				$this->setFirstName($value);
				break;
			case 7:
				$this->setLastName($value);
				break;
			case 8:
				$this->setEmail($value);
				break;
			case 9:
				$this->setSha1Password($value);
				break;
			case 10:
				$this->setSalt($value);
				break;
			case 11:
				$this->setWantToBeModerator($value);
				break;
			case 12:
				$this->setIsModerator($value);
				break;
			case 13:
				$this->setIsAdministrator($value);
				break;
			case 14:
				$this->setDeletions($value);
				break;
			case 15:
				$this->setPassword($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLastUpdated($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNickname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSalutation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFirstName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLastName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSha1Password($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSalt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setWantToBeModerator($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsModerator($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsAdministrator($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDeletions($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPassword($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserPeer::LAST_UPDATED)) $criteria->add(UserPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(UserPeer::DELETED_AT)) $criteria->add(UserPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(UserPeer::NICKNAME)) $criteria->add(UserPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(UserPeer::SALUTATION)) $criteria->add(UserPeer::SALUTATION, $this->salutation);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::SHA1_PASSWORD)) $criteria->add(UserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UserPeer::SALT)) $criteria->add(UserPeer::SALT, $this->salt);
		if ($this->isColumnModified(UserPeer::WANT_TO_BE_MODERATOR)) $criteria->add(UserPeer::WANT_TO_BE_MODERATOR, $this->want_to_be_moderator);
		if ($this->isColumnModified(UserPeer::IS_MODERATOR)) $criteria->add(UserPeer::IS_MODERATOR, $this->is_moderator);
		if ($this->isColumnModified(UserPeer::IS_ADMINISTRATOR)) $criteria->add(UserPeer::IS_ADMINISTRATOR, $this->is_administrator);
		if ($this->isColumnModified(UserPeer::DELETIONS)) $criteria->add(UserPeer::DELETIONS, $this->deletions);
		if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);

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
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setLastUpdated($this->last_updated);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setNickname($this->nickname);

		$copyObj->setSalutation($this->salutation);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setWantToBeModerator($this->want_to_be_moderator);

		$copyObj->setIsModerator($this->is_moderator);

		$copyObj->setIsAdministrator($this->is_administrator);

		$copyObj->setDeletions($this->deletions);

		$copyObj->setPassword($this->password);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getProfilesRelatedByCreatedBy() as $relObj) {
				$copyObj->addProfileRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByUpdatedBy() as $relObj) {
				$copyObj->addProfileRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByDeletedBy() as $relObj) {
				$copyObj->addProfileRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilesRelatedByChildUpdatedBy() as $relObj) {
				$copyObj->addProfileRelatedByChildUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByCreatedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByCreatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByUpdatedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByUpdatedBy($relObj->copy($deepCopy));
			}

			foreach($this->getProfilePropertysRelatedByDeletedBy() as $relObj) {
				$copyObj->addProfilePropertyRelatedByDeletedBy($relObj->copy($deepCopy));
			}

			foreach($this->getAgentHasUsers() as $relObj) {
				$copyObj->addAgentHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addCollectionRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getCollectionsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addCollectionRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addConceptPropertyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getConceptPropertyHistorys() as $relObj) {
				$copyObj->addConceptPropertyHistory($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByCreatedUserId() as $relObj) {
				$copyObj->addDiscussRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getDiscusssRelatedByDeletedUserId() as $relObj) {
				$copyObj->addDiscussRelatedByDeletedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getFileImportHistorys() as $relObj) {
				$copyObj->addFileImportHistory($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemasRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByCreatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementsRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addSchemaPropertyElementRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorys() as $relObj) {
				$copyObj->addSchemaPropertyElementHistory($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByCreatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByCreatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByUpdatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularysRelatedByChildUpdatedUserId() as $relObj) {
				$copyObj->addVocabularyRelatedByChildUpdatedUserId($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasUsers() as $relObj) {
				$copyObj->addVocabularyHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getVocabularyHasVersions() as $relObj) {
				$copyObj->addVocabularyHasVersion($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaHasUsers() as $relObj) {
				$copyObj->addSchemaHasUser($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaHasVersions() as $relObj) {
				$copyObj->addSchemaHasVersion($relObj->copy($deepCopy));
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
	 * @return     User Clone of current object.
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
	 * @return     UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collProfilesRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByCreatedBy()
	{
		if ($this->collProfilesRelatedByCreatedBy === null) {
			$this->collProfilesRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByCreatedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByCreatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByCreatedByCriteria) || !$this->lastProfileRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByCreatedByCriteria = $criteria;
		return $this->collProfilesRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByCreatedBy(Profile $l)
	{
		$this->collProfilesRelatedByCreatedBy[] = $l;
		$l->setUserRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByCreatedByJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByCreatedByCriteria) || !$this->lastProfileRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastProfileRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilesRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByCreatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByCreatedByCriteria) || !$this->lastProfileRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByCreatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilesRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByUpdatedBy()
	{
		if ($this->collProfilesRelatedByUpdatedBy === null) {
			$this->collProfilesRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByUpdatedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByUpdatedByCriteria) || !$this->lastProfileRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByUpdatedByCriteria = $criteria;
		return $this->collProfilesRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByUpdatedBy(Profile $l)
	{
		$this->collProfilesRelatedByUpdatedBy[] = $l;
		$l->setUserRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByUpdatedByJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByUpdatedByCriteria) || !$this->lastProfileRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastProfileRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByUpdatedByCriteria) || !$this->lastProfileRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByDeletedBy()
	{
		if ($this->collProfilesRelatedByDeletedBy === null) {
			$this->collProfilesRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByDeletedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByDeletedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByDeletedByCriteria) || !$this->lastProfileRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByDeletedByCriteria = $criteria;
		return $this->collProfilesRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByDeletedBy(Profile $l)
	{
		$this->collProfilesRelatedByDeletedBy[] = $l;
		$l->setUserRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByDeletedByJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByDeletedByCriteria) || !$this->lastProfileRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastProfileRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilesRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByDeletedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByDeletedByCriteria) || !$this->lastProfileRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByDeletedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilesRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collProfilesRelatedByChildUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilesRelatedByChildUpdatedBy()
	{
		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			$this->collProfilesRelatedByChildUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByChildUpdatedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilesRelatedByChildUpdatedBy($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilesRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				ProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProfileRelatedByChildUpdatedByCriteria) || !$this->lastProfileRelatedByChildUpdatedByCriteria->equals($criteria)) {
					$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfileRelatedByChildUpdatedByCriteria = $criteria;
		return $this->collProfilesRelatedByChildUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilesRelatedByChildUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilesRelatedByChildUpdatedBy($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

		return ProfilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute
	 *
	 * @param      Profile $l Profile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProfileRelatedByChildUpdatedBy(Profile $l)
	{
		$this->collProfilesRelatedByChildUpdatedBy[] = $l;
		$l->setUserRelatedByChildUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByChildUpdatedByJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByChildUpdatedByCriteria) || !$this->lastProfileRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastProfileRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByChildUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilesRelatedByChildUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilesRelatedByChildUpdatedByJoinStatus($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseProfilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProfilesRelatedByChildUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilesRelatedByChildUpdatedBy = array();
			} else {

				$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePeer::CHILD_UPDATED_BY, $this->getId());

			if (!isset($this->lastProfileRelatedByChildUpdatedByCriteria) || !$this->lastProfileRelatedByChildUpdatedByCriteria->equals($criteria)) {
				$this->collProfilesRelatedByChildUpdatedBy = ProfilePeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfileRelatedByChildUpdatedByCriteria = $criteria;

		return $this->collProfilesRelatedByChildUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByCreatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByCreatedBy()
	{
		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			$this->collProfilePropertysRelatedByCreatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByCreatedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByCreatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByCreatedBy($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

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
	public function addProfilePropertyRelatedByCreatedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByCreatedBy[] = $l;
		$l->setUserRelatedByCreatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinProfile($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinStatus($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByCreatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByCreatedByJoinSchema($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByCreatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByCreatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::CREATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByCreatedByCriteria) || !$this->lastProfilePropertyRelatedByCreatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByCreatedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByCreatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByCreatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByUpdatedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByUpdatedBy()
	{
		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			$this->collProfilePropertysRelatedByUpdatedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByUpdatedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByUpdatedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByUpdatedBy($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

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
	public function addProfilePropertyRelatedByUpdatedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByUpdatedBy[] = $l;
		$l->setUserRelatedByUpdatedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinProfile($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinStatus($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByUpdatedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByUpdatedByJoinSchema($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByUpdatedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByUpdatedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByUpdatedByCriteria) || !$this->lastProfilePropertyRelatedByUpdatedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByUpdatedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByUpdatedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByUpdatedBy;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByDeletedBy to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByDeletedBy()
	{
		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			$this->collProfilePropertysRelatedByDeletedBy = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;
		return $this->collProfilePropertysRelatedByDeletedBy;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByDeletedBy.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByDeletedBy($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

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
	public function addProfilePropertyRelatedByDeletedBy(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByDeletedBy[] = $l;
		$l->setUserRelatedByDeletedBy($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinProfile($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinStatus($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinProfilePropertyRelatedByInverseProfilePropertyId($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByDeletedBy from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getProfilePropertysRelatedByDeletedByJoinSchema($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByDeletedBy === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByDeletedBy = array();
			} else {

				$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::DELETED_BY, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByDeletedByCriteria) || !$this->lastProfilePropertyRelatedByDeletedByCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByDeletedBy = ProfilePropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByDeletedByCriteria = $criteria;

		return $this->collProfilePropertysRelatedByDeletedBy;
	}

	/**
	 * Temporary storage of collAgentHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
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
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
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

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				AgentHasUserPeer::addSelectColumns($criteria);
				$this->collAgentHasUsers = AgentHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

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
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

		return AgentHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AgentHasUser object to this object
	 * through the AgentHasUser foreign key attribute
	 *
	 * @param      AgentHasUser $l AgentHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgentHasUser(AgentHasUser $l)
	{
		$this->collAgentHasUsers[] = $l;
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related AgentHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getAgentHasUsersJoinAgent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAgentHasUserPeer.php';
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

				$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AgentHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastAgentHasUserCriteria) || !$this->lastAgentHasUserCriteria->equals($criteria)) {
				$this->collAgentHasUsers = AgentHasUserPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastAgentHasUserCriteria = $criteria;

		return $this->collAgentHasUsers;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByCreatedUserId()
	{
		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			$this->collCollectionsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collCollectionsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related CollectionsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

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
	public function addCollectionRelatedByCreatedUserId(Collection $l)
	{
		$this->collCollectionsRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getCollectionsRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getCollectionsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByCreatedUserIdCriteria) || !$this->lastCollectionRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByCreatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collCollectionsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCollectionsRelatedByUpdatedUserId()
	{
		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			$this->collCollectionsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCollectionsRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				CollectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collCollectionsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related CollectionsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCollectionsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

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
	public function addCollectionRelatedByUpdatedUserId(Collection $l)
	{
		$this->collCollectionsRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getCollectionsRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related CollectionsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getCollectionsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collCollectionsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collCollectionsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CollectionPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastCollectionRelatedByUpdatedUserIdCriteria) || !$this->lastCollectionRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collCollectionsRelatedByUpdatedUserId = CollectionPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastCollectionRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collCollectionsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collConceptsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByCreatedUserId()
	{
		if ($this->collConceptsRelatedByCreatedUserId === null) {
			$this->collConceptsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related ConceptsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

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
	public function addConceptRelatedByCreatedUserId(Concept $l)
	{
		$this->collConceptsRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByCreatedUserIdCriteria) || !$this->lastConceptRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByCreatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collConceptsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptsRelatedByUpdatedUserId()
	{
		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			$this->collConceptsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptsRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				ConceptPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related ConceptsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

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
	public function addConceptRelatedByUpdatedUserId(Concept $l)
	{
		$this->collConceptsRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptRelatedByUpdatedUserIdCriteria) || !$this->lastConceptRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptsRelatedByUpdatedUserId = ConceptPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByCreatedUserId()
	{
		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			$this->collConceptPropertysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

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
	public function addConceptPropertyRelatedByCreatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinSkosProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByCreatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByCreatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collConceptPropertysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initConceptPropertysRelatedByUpdatedUserId()
	{
		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			$this->collConceptPropertysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getConceptPropertysRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				ConceptPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related ConceptPropertysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countConceptPropertysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

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
	public function addConceptPropertyRelatedByUpdatedUserId(ConceptProperty $l)
	{
		$this->collConceptPropertysRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinSkosProperty($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinConceptRelatedByRelatedConceptId($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collConceptPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collConceptPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collConceptPropertysRelatedByUpdatedUserId = ConceptPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collConceptPropertysRelatedByUpdatedUserId;
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
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 * If this User is new, it will return
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				ConceptPropertyHistoryPeer::addSelectColumns($criteria);
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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

		$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedByVocabularyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getConceptPropertyHistorysJoinSkosProperty($criteria = null, $con = null)
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinSkosProperty($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinVocabularyRelatedBySchemeId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinConceptRelatedByRelatedConceptId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

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
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related ConceptPropertyHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ConceptPropertyHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastConceptPropertyHistoryCriteria) || !$this->lastConceptPropertyHistoryCriteria->equals($criteria)) {
				$this->collConceptPropertyHistorys = ConceptPropertyHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastConceptPropertyHistoryCriteria = $criteria;

		return $this->collConceptPropertyHistorys;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByCreatedUserId()
	{
		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			$this->collDiscusssRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collDiscusssRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

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
	public function addDiscussRelatedByCreatedUserId(Discuss $l)
	{
		$this->collDiscusssRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinSchemaPropertyElement($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinConcept($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinDiscussRelatedByRootId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByCreatedUserIdJoinDiscussRelatedByParentId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByCreatedUserId = array();
			} else {

				$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByCreatedUserIdCriteria) || !$this->lastDiscussRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByCreatedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collDiscusssRelatedByDeletedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDiscusssRelatedByDeletedUserId()
	{
		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			$this->collDiscusssRelatedByDeletedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDiscusssRelatedByDeletedUserId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
			   $this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				DiscussPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
					$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;
		return $this->collDiscusssRelatedByDeletedUserId;
	}

	/**
	 * Returns the number of related DiscusssRelatedByDeletedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDiscusssRelatedByDeletedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

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
	public function addDiscussRelatedByDeletedUserId(Discuss $l)
	{
		$this->collDiscusssRelatedByDeletedUserId[] = $l;
		$l->setUserRelatedByDeletedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchema($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchemaProperty($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinSchemaPropertyElement($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinVocabulary($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinConcept($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConcept($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinConceptProperty($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinConceptProperty($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinDiscussRelatedByRootId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByRootId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related DiscusssRelatedByDeletedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getDiscusssRelatedByDeletedUserIdJoinDiscussRelatedByParentId($criteria = null, $con = null)
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

		if ($this->collDiscusssRelatedByDeletedUserId === null) {
			if ($this->isNew()) {
				$this->collDiscusssRelatedByDeletedUserId = array();
			} else {

				$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(DiscussPeer::DELETED_USER_ID, $this->getId());

			if (!isset($this->lastDiscussRelatedByDeletedUserIdCriteria) || !$this->lastDiscussRelatedByDeletedUserIdCriteria->equals($criteria)) {
				$this->collDiscusssRelatedByDeletedUserId = DiscussPeer::doSelectJoinDiscussRelatedByParentId($criteria, $con);
			}
		}
		$this->lastDiscussRelatedByDeletedUserIdCriteria = $criteria;

		return $this->collDiscusssRelatedByDeletedUserId;
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
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 * If this User is new, it will return
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

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				FileImportHistoryPeer::addSelectColumns($criteria);
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

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

		$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

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
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getFileImportHistorysJoinVocabulary($criteria = null, $con = null)
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

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related FileImportHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
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

				$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FileImportHistoryPeer::USER_ID, $this->getId());

			if (!isset($this->lastFileImportHistoryCriteria) || !$this->lastFileImportHistoryCriteria->equals($criteria)) {
				$this->collFileImportHistorys = FileImportHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastFileImportHistoryCriteria = $criteria;

		return $this->collFileImportHistorys;
	}

	/**
	 * Temporary storage of collSchemasRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByCreatedUserId()
	{
		if ($this->collSchemasRelatedByCreatedUserId === null) {
			$this->collSchemasRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemasRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemasRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

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
	public function addSchemaRelatedByCreatedUserId(Schema $l)
	{
		$this->collSchemasRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinAgent($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByCreatedUserIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByCreatedUserIdCriteria) || !$this->lastSchemaRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByCreatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemasRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemasRelatedByUpdatedUserId()
	{
		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			$this->collSchemasRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemasRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				SchemaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemasRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemasRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemasRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

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
	public function addSchemaRelatedByUpdatedUserId(Schema $l)
	{
		$this->collSchemasRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinAgent($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemasRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemasRelatedByUpdatedUserIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collSchemasRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemasRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemasRelatedByUpdatedUserId = SchemaPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastSchemaRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemasRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByCreatedUserId()
	{
		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			$this->collSchemaPropertysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

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
	public function addSchemaPropertyRelatedByCreatedUserId(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinSchema($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByCreatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertysRelatedByUpdatedUserId()
	{
		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			$this->collSchemaPropertysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertysRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

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
	public function addSchemaPropertyRelatedByUpdatedUserId(SchemaProperty $l)
	{
		$this->collSchemaPropertysRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinSchema($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinSchemaPropertyRelatedByIsSubpropertyOf($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemaPropertysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertysRelatedByUpdatedUserId = SchemaPropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertysRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByCreatedUserId()
	{
		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

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
	public function addSchemaPropertyElementRelatedByCreatedUserId(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinProfileProperty($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByCreatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementsRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementsRelatedByUpdatedUserId()
	{
		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related SchemaPropertyElementsRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementsRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

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
	public function addSchemaPropertyElementRelatedByUpdatedUserId(SchemaPropertyElement $l)
	{
		$this->collSchemaPropertyElementsRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinProfileProperty($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementsRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementsRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementsRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria) || !$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementsRelatedByUpdatedUserId = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collSchemaPropertyElementsRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collSchemaPropertyElementHistorys to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaPropertyElementHistorys()
	{
		if ($this->collSchemaPropertyElementHistorys === null) {
			$this->collSchemaPropertyElementHistorys = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaPropertyElementHistorys($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
			   $this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
					$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;
		return $this->collSchemaPropertyElementHistorys;
	}

	/**
	 * Returns the number of related SchemaPropertyElementHistorys.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaPropertyElementHistorys($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

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
	public function addSchemaPropertyElementHistory(SchemaPropertyElementHistory $l)
	{
		$this->collSchemaPropertyElementHistorys[] = $l;
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyElement($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinSchema($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinProfileProperty($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinProfileProperty($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaPropertyElementHistorysJoinStatus($criteria = null, $con = null)
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

		if ($this->collSchemaPropertyElementHistorys === null) {
			if ($this->isNew()) {
				$this->collSchemaPropertyElementHistorys = array();
			} else {

				$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByCreatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByCreatedUserId()
	{
		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			$this->collVocabularysRelatedByCreatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByCreatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByCreatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByCreatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByCreatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

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
	public function addVocabularyRelatedByCreatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByCreatedUserId[] = $l;
		$l->setUserRelatedByCreatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinAgent($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByCreatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByCreatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByCreatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByCreatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByCreatedUserIdCriteria) || !$this->lastVocabularyRelatedByCreatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByCreatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByCreatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByCreatedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByUpdatedUserId()
	{
		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			$this->collVocabularysRelatedByUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByUpdatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

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
	public function addVocabularyRelatedByUpdatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByUpdatedUserId[] = $l;
		$l->setUserRelatedByUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinAgent($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByUpdatedUserId;
	}

	/**
	 * Temporary storage of collVocabularysRelatedByChildUpdatedUserId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVocabularysRelatedByChildUpdatedUserId()
	{
		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			$this->collVocabularysRelatedByChildUpdatedUserId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVocabularysRelatedByChildUpdatedUserId($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
			   $this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				VocabularyPeer::addSelectColumns($criteria);
				if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
					$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;
		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}

	/**
	 * Returns the number of related VocabularysRelatedByChildUpdatedUserId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVocabularysRelatedByChildUpdatedUserId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

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
	public function addVocabularyRelatedByChildUpdatedUserId(Vocabulary $l)
	{
		$this->collVocabularysRelatedByChildUpdatedUserId[] = $l;
		$l->setUserRelatedByChildUpdatedUserId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinAgent($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinAgent($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularysRelatedByChildUpdatedUserId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularysRelatedByChildUpdatedUserIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collVocabularysRelatedByChildUpdatedUserId === null) {
			if ($this->isNew()) {
				$this->collVocabularysRelatedByChildUpdatedUserId = array();
			} else {

				$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyPeer::CHILD_UPDATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyRelatedByChildUpdatedUserIdCriteria) || !$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria->equals($criteria)) {
				$this->collVocabularysRelatedByChildUpdatedUserId = VocabularyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastVocabularyRelatedByChildUpdatedUserIdCriteria = $criteria;

		return $this->collVocabularysRelatedByChildUpdatedUserId;
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
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 * If this User is new, it will return
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

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				VocabularyHasUserPeer::addSelectColumns($criteria);
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

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

		$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

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
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularyHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularyHasUsersJoinVocabulary($criteria = null, $con = null)
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

				$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastVocabularyHasUserCriteria) || !$this->lastVocabularyHasUserCriteria->equals($criteria)) {
				$this->collVocabularyHasUsers = VocabularyHasUserPeer::doSelectJoinVocabulary($criteria, $con);
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
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related VocabularyHasVersions from storage.
	 * If this User is new, it will return
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

				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

				VocabularyHasVersionPeer::addSelectColumns($criteria);
				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

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

		$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

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
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VocabularyHasVersions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getVocabularyHasVersionsJoinVocabulary($criteria = null, $con = null)
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

				$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VocabularyHasVersionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastVocabularyHasVersionCriteria) || !$this->lastVocabularyHasVersionCriteria->equals($criteria)) {
				$this->collVocabularyHasVersions = VocabularyHasVersionPeer::doSelectJoinVocabulary($criteria, $con);
			}
		}
		$this->lastVocabularyHasVersionCriteria = $criteria;

		return $this->collVocabularyHasVersions;
	}

	/**
	 * Temporary storage of collSchemaHasUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaHasUsers()
	{
		if ($this->collSchemaHasUsers === null) {
			$this->collSchemaHasUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaHasUsers from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaHasUsers($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasUsers === null) {
			if ($this->isNew()) {
			   $this->collSchemaHasUsers = array();
			} else {

				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				SchemaHasUserPeer::addSelectColumns($criteria);
				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				SchemaHasUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaHasUserCriteria) || !$this->lastSchemaHasUserCriteria->equals($criteria)) {
					$this->collSchemaHasUsers = SchemaHasUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaHasUserCriteria = $criteria;
		return $this->collSchemaHasUsers;
	}

	/**
	 * Returns the number of related SchemaHasUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaHasUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

		return SchemaHasUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaHasUser object to this object
	 * through the SchemaHasUser foreign key attribute
	 *
	 * @param      SchemaHasUser $l SchemaHasUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaHasUser(SchemaHasUser $l)
	{
		$this->collSchemaHasUsers[] = $l;
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaHasUsers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaHasUsersJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasUsers === null) {
			if ($this->isNew()) {
				$this->collSchemaHasUsers = array();
			} else {

				$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaHasUserPeer::USER_ID, $this->getId());

			if (!isset($this->lastSchemaHasUserCriteria) || !$this->lastSchemaHasUserCriteria->equals($criteria)) {
				$this->collSchemaHasUsers = SchemaHasUserPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaHasUserCriteria = $criteria;

		return $this->collSchemaHasUsers;
	}

	/**
	 * Temporary storage of collSchemaHasVersions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSchemaHasVersions()
	{
		if ($this->collSchemaHasVersions === null) {
			$this->collSchemaHasVersions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User has previously
	 * been saved, it will retrieve related SchemaHasVersions from storage.
	 * If this User is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSchemaHasVersions($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersions === null) {
			if ($this->isNew()) {
			   $this->collSchemaHasVersions = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				$this->collSchemaHasVersions = SchemaHasVersionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				SchemaHasVersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastSchemaHasVersionCriteria) || !$this->lastSchemaHasVersionCriteria->equals($criteria)) {
					$this->collSchemaHasVersions = SchemaHasVersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSchemaHasVersionCriteria = $criteria;
		return $this->collSchemaHasVersions;
	}

	/**
	 * Returns the number of related SchemaHasVersions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSchemaHasVersions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

		return SchemaHasVersionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SchemaHasVersion object to this object
	 * through the SchemaHasVersion foreign key attribute
	 *
	 * @param      SchemaHasVersion $l SchemaHasVersion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSchemaHasVersion(SchemaHasVersion $l)
	{
		$this->collSchemaHasVersions[] = $l;
		$l->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related SchemaHasVersions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 */
	public function getSchemaHasVersionsJoinSchema($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSchemaHasVersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSchemaHasVersions === null) {
			if ($this->isNew()) {
				$this->collSchemaHasVersions = array();
			} else {

				$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

				$this->collSchemaHasVersions = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaHasVersionPeer::CREATED_USER_ID, $this->getId());

			if (!isset($this->lastSchemaHasVersionCriteria) || !$this->lastSchemaHasVersionCriteria->equals($criteria)) {
				$this->collSchemaHasVersions = SchemaHasVersionPeer::doSelectJoinSchema($criteria, $con);
			}
		}
		$this->lastSchemaHasVersionCriteria = $criteria;

		return $this->collSchemaHasVersions;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseUser
