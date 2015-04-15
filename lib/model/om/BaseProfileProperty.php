<?php

/**
 * Base class that represents a row from the 'profile_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProfileProperty extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProfilePropertyPeer
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
	 * The value for the profile_id field.
	 * @var        int
	 */
	protected $profile_id;


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
	protected $type = 'property';


	/**
	 * The value for the uri field.
	 * @var        string
	 */
	protected $uri;


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
	 * The value for the note field.
	 * @var        string
	 */
	protected $note;


	/**
	 * The value for the display_order field.
	 * @var        int
	 */
	protected $display_order;


	/**
	 * The value for the export_order field.
	 * @var        int
	 */
	protected $export_order;


	/**
	 * The value for the picklist_order field.
	 * @var        int
	 */
	protected $picklist_order;


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
	 * The value for the is_in_picklist field.
	 * @var        boolean
	 */
	protected $is_in_picklist = true;


	/**
	 * The value for the is_in_export field.
	 * @var        boolean
	 */
	protected $is_in_export = true;


	/**
	 * The value for the inverse_profile_property_id field.
	 * @var        int
	 */
	protected $inverse_profile_property_id;


	/**
	 * The value for the is_in_class_picklist field.
	 * @var        boolean
	 */
	protected $is_in_class_picklist = true;


	/**
	 * The value for the is_in_property_picklist field.
	 * @var        boolean
	 */
	protected $is_in_property_picklist = true;


	/**
	 * The value for the is_in_rdf field.
	 * @var        boolean
	 */
	protected $is_in_rdf = true;


	/**
	 * The value for the is_in_xsd field.
	 * @var        boolean
	 */
	protected $is_in_xsd = true;


	/**
	 * The value for the is_attribute field.
	 * @var        boolean
	 */
	protected $is_attribute = false;


	/**
	 * The value for the has_language field.
	 * @var        boolean
	 */
	protected $has_language = false;


	/**
	 * The value for the is_object_prop field.
	 * @var        boolean
	 */
	protected $is_object_prop = true;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByCreatedBy;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByUpdatedBy;

	/**
	 * @var        User
	 */
	protected $aUserRelatedByDeletedBy;

	/**
	 * @var        Profile
	 */
	protected $aProfile;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        ProfileProperty
	 */
	protected $aProfilePropertyRelatedByInverseProfilePropertyId;

	/**
	 * Collection to store aggregation of collProfilePropertysRelatedByInverseProfilePropertyId.
	 * @var        array
	 */
	protected $collProfilePropertysRelatedByInverseProfilePropertyId;

	/**
	 * The criteria used to select the current contents of collProfilePropertysRelatedByInverseProfilePropertyId.
	 * @var        Criteria
	 */
	protected $lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = null;

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
	 * Get the [profile_id] column value.
	 * 
	 * @return     int
	 */
	public function getProfileId()
	{

		return $this->profile_id;
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
	 * Get the [display_order] column value.
	 * 
	 * @return     int
	 */
	public function getDisplayOrder()
	{

		return $this->display_order;
	}

	/**
	 * Get the [export_order] column value.
	 * 
	 * @return     int
	 */
	public function getExportOrder()
	{

		return $this->export_order;
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
	 * Get the [is_in_picklist] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInPicklist()
	{

		return $this->is_in_picklist;
	}

	/**
	 * Get the [is_in_export] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInExport()
	{

		return $this->is_in_export;
	}

	/**
	 * Get the [inverse_profile_property_id] column value.
	 * 
	 * @return     int
	 */
	public function getInverseProfilePropertyId()
	{

		return $this->inverse_profile_property_id;
	}

	/**
	 * Get the [is_in_class_picklist] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInClassPicklist()
	{

		return $this->is_in_class_picklist;
	}

	/**
	 * Get the [is_in_property_picklist] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInPropertyPicklist()
	{

		return $this->is_in_property_picklist;
	}

	/**
	 * Get the [is_in_rdf] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInRdf()
	{

		return $this->is_in_rdf;
	}

	/**
	 * Get the [is_in_xsd] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsInXsd()
	{

		return $this->is_in_xsd;
	}

	/**
	 * Get the [is_attribute] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsAttribute()
	{

		return $this->is_attribute;
	}

	/**
	 * Get the [has_language] column value.
	 * 
	 * @return     boolean
	 */
	public function getHasLanguage()
	{

		return $this->has_language;
	}

	/**
	 * Get the [is_object_prop] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsObjectProp()
	{

		return $this->is_object_prop;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::ID;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::UPDATED_AT;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::DELETED_AT;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::CREATED_BY;
		}

		if ($this->aUserRelatedByCreatedBy !== null && $this->aUserRelatedByCreatedBy->getId() !== $v) {
			$this->aUserRelatedByCreatedBy = null;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::UPDATED_BY;
		}

		if ($this->aUserRelatedByUpdatedBy !== null && $this->aUserRelatedByUpdatedBy->getId() !== $v) {
			$this->aUserRelatedByUpdatedBy = null;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::DELETED_BY;
		}

		if ($this->aUserRelatedByDeletedBy !== null && $this->aUserRelatedByDeletedBy->getId() !== $v) {
			$this->aUserRelatedByDeletedBy = null;
		}

	} // setDeletedBy()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::PROFILE_ID;
		}

		if ($this->aProfile !== null && $this->aProfile->getId() !== $v) {
			$this->aProfile = null;
		}

	} // setProfileId()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::NAME;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::LABEL;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::DEFINITION;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::COMMENT;
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

		if ($this->type !== $v || $v === 'property') {
			$this->type = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::TYPE;
		}

	} // setType()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::URI;
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

		if ($this->status_id !== $v || $v === 1) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::STATUS_ID;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::LANGUAGE;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::NOTE;
		}

	} // setNote()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::DISPLAY_ORDER;
		}

	} // setDisplayOrder()

	/**
	 * Set the value of [export_order] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setExportOrder($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->export_order !== $v) {
			$this->export_order = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::EXPORT_ORDER;
		}

	} // setExportOrder()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::PICKLIST_ORDER;
		}

	} // setPicklistOrder()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::EXAMPLES;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_REQUIRED;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_RECIPROCAL;
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
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_SINGLETON;
		}

	} // setIsSingleton()

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
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_PICKLIST;
		}

	} // setIsInPicklist()

	/**
	 * Set the value of [is_in_export] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInExport($v)
	{

		if ($this->is_in_export !== $v || $v === true) {
			$this->is_in_export = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_EXPORT;
		}

	} // setIsInExport()

	/**
	 * Set the value of [inverse_profile_property_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setInverseProfilePropertyId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inverse_profile_property_id !== $v) {
			$this->inverse_profile_property_id = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID;
		}

		if ($this->aProfilePropertyRelatedByInverseProfilePropertyId !== null && $this->aProfilePropertyRelatedByInverseProfilePropertyId->getId() !== $v) {
			$this->aProfilePropertyRelatedByInverseProfilePropertyId = null;
		}

	} // setInverseProfilePropertyId()

	/**
	 * Set the value of [is_in_class_picklist] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInClassPicklist($v)
	{

		if ($this->is_in_class_picklist !== $v || $v === true) {
			$this->is_in_class_picklist = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_CLASS_PICKLIST;
		}

	} // setIsInClassPicklist()

	/**
	 * Set the value of [is_in_property_picklist] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInPropertyPicklist($v)
	{

		if ($this->is_in_property_picklist !== $v || $v === true) {
			$this->is_in_property_picklist = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST;
		}

	} // setIsInPropertyPicklist()

	/**
	 * Set the value of [is_in_rdf] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInRdf($v)
	{

		if ($this->is_in_rdf !== $v || $v === true) {
			$this->is_in_rdf = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_RDF;
		}

	} // setIsInRdf()

	/**
	 * Set the value of [is_in_xsd] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsInXsd($v)
	{

		if ($this->is_in_xsd !== $v || $v === true) {
			$this->is_in_xsd = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_IN_XSD;
		}

	} // setIsInXsd()

	/**
	 * Set the value of [is_attribute] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsAttribute($v)
	{

		if ($this->is_attribute !== $v || $v === false) {
			$this->is_attribute = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_ATTRIBUTE;
		}

	} // setIsAttribute()

	/**
	 * Set the value of [has_language] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setHasLanguage($v)
	{

		if ($this->has_language !== $v || $v === false) {
			$this->has_language = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::HAS_LANGUAGE;
		}

	} // setHasLanguage()

	/**
	 * Set the value of [is_object_prop] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIsObjectProp($v)
	{

		if ($this->is_object_prop !== $v || $v === true) {
			$this->is_object_prop = $v;
			$this->modifiedColumns[] = ProfilePropertyPeer::IS_OBJECT_PROP;
		}

	} // setIsObjectProp()

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

			$this->profile_id = $rs->getInt($startcol + 7);

			$this->name = $rs->getString($startcol + 8);

			$this->label = $rs->getString($startcol + 9);

			$this->definition = $rs->getString($startcol + 10);

			$this->comment = $rs->getString($startcol + 11);

			$this->type = $rs->getString($startcol + 12);

			$this->uri = $rs->getString($startcol + 13);

			$this->status_id = $rs->getInt($startcol + 14);

			$this->language = $rs->getString($startcol + 15);

			$this->note = $rs->getString($startcol + 16);

			$this->display_order = $rs->getInt($startcol + 17);

			$this->export_order = $rs->getInt($startcol + 18);

			$this->picklist_order = $rs->getInt($startcol + 19);

			$this->examples = $rs->getString($startcol + 20);

			$this->is_required = $rs->getBoolean($startcol + 21);

			$this->is_reciprocal = $rs->getBoolean($startcol + 22);

			$this->is_singleton = $rs->getBoolean($startcol + 23);

			$this->is_in_picklist = $rs->getBoolean($startcol + 24);

			$this->is_in_export = $rs->getBoolean($startcol + 25);

			$this->inverse_profile_property_id = $rs->getInt($startcol + 26);

			$this->is_in_class_picklist = $rs->getBoolean($startcol + 27);

			$this->is_in_property_picklist = $rs->getBoolean($startcol + 28);

			$this->is_in_rdf = $rs->getBoolean($startcol + 29);

			$this->is_in_xsd = $rs->getBoolean($startcol + 30);

			$this->is_attribute = $rs->getBoolean($startcol + 31);

			$this->has_language = $rs->getBoolean($startcol + 32);

			$this->is_object_prop = $rs->getBoolean($startcol + 33);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 34; // 34 = ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ProfileProperty object", $e);
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

    foreach (sfMixer::getCallables('BaseProfileProperty:delete:pre') as $callable)
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
			$con = Propel::getConnection(ProfilePropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProfilePropertyPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseProfileProperty:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseProfileProperty:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ProfilePropertyPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProfilePropertyPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProfilePropertyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseProfileProperty:save:post') as $callable)
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

			if ($this->aUserRelatedByCreatedBy !== null) {
				if ($this->aUserRelatedByCreatedBy->isModified()) {
					$affectedRows += $this->aUserRelatedByCreatedBy->save($con);
				}
				$this->setUserRelatedByCreatedBy($this->aUserRelatedByCreatedBy);
			}

			if ($this->aUserRelatedByUpdatedBy !== null) {
				if ($this->aUserRelatedByUpdatedBy->isModified()) {
					$affectedRows += $this->aUserRelatedByUpdatedBy->save($con);
				}
				$this->setUserRelatedByUpdatedBy($this->aUserRelatedByUpdatedBy);
			}

			if ($this->aUserRelatedByDeletedBy !== null) {
				if ($this->aUserRelatedByDeletedBy->isModified()) {
					$affectedRows += $this->aUserRelatedByDeletedBy->save($con);
				}
				$this->setUserRelatedByDeletedBy($this->aUserRelatedByDeletedBy);
			}

			if ($this->aProfile !== null) {
				if ($this->aProfile->isModified()) {
					$affectedRows += $this->aProfile->save($con);
				}
				$this->setProfile($this->aProfile);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->aProfilePropertyRelatedByInverseProfilePropertyId !== null) {
				if ($this->aProfilePropertyRelatedByInverseProfilePropertyId->isModified()) {
					$affectedRows += $this->aProfilePropertyRelatedByInverseProfilePropertyId->save($con);
				}
				$this->setProfilePropertyRelatedByInverseProfilePropertyId($this->aProfilePropertyRelatedByInverseProfilePropertyId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProfilePropertyPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProfilePropertyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProfilePropertysRelatedByInverseProfilePropertyId !== null) {
				foreach($this->collProfilePropertysRelatedByInverseProfilePropertyId as $referrerFK) {
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

			if ($this->collSchemaPropertyElementHistorys !== null) {
				foreach($this->collSchemaPropertyElementHistorys as $referrerFK) {
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

			if ($this->aUserRelatedByCreatedBy !== null) {
				if (!$this->aUserRelatedByCreatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedBy->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByUpdatedBy !== null) {
				if (!$this->aUserRelatedByUpdatedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedBy->getValidationFailures());
				}
			}

			if ($this->aUserRelatedByDeletedBy !== null) {
				if (!$this->aUserRelatedByDeletedBy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserRelatedByDeletedBy->getValidationFailures());
				}
			}

			if ($this->aProfile !== null) {
				if (!$this->aProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfile->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}

			if ($this->aProfilePropertyRelatedByInverseProfilePropertyId !== null) {
				if (!$this->aProfilePropertyRelatedByInverseProfilePropertyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProfilePropertyRelatedByInverseProfilePropertyId->getValidationFailures());
				}
			}


			if (($retval = ProfilePropertyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSchemaPropertyElements !== null) {
					foreach($this->collSchemaPropertyElements as $referrerFK) {
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
		$pos = ProfilePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getProfileId();
				break;
			case 8:
				return $this->getName();
				break;
			case 9:
				return $this->getLabel();
				break;
			case 10:
				return $this->getDefinition();
				break;
			case 11:
				return $this->getComment();
				break;
			case 12:
				return $this->getType();
				break;
			case 13:
				return $this->getUri();
				break;
			case 14:
				return $this->getStatusId();
				break;
			case 15:
				return $this->getLanguage();
				break;
			case 16:
				return $this->getNote();
				break;
			case 17:
				return $this->getDisplayOrder();
				break;
			case 18:
				return $this->getExportOrder();
				break;
			case 19:
				return $this->getPicklistOrder();
				break;
			case 20:
				return $this->getExamples();
				break;
			case 21:
				return $this->getIsRequired();
				break;
			case 22:
				return $this->getIsReciprocal();
				break;
			case 23:
				return $this->getIsSingleton();
				break;
			case 24:
				return $this->getIsInPicklist();
				break;
			case 25:
				return $this->getIsInExport();
				break;
			case 26:
				return $this->getInverseProfilePropertyId();
				break;
			case 27:
				return $this->getIsInClassPicklist();
				break;
			case 28:
				return $this->getIsInPropertyPicklist();
				break;
			case 29:
				return $this->getIsInRdf();
				break;
			case 30:
				return $this->getIsInXsd();
				break;
			case 31:
				return $this->getIsAttribute();
				break;
			case 32:
				return $this->getHasLanguage();
				break;
			case 33:
				return $this->getIsObjectProp();
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
		$keys = ProfilePropertyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getDeletedAt(),
			$keys[4] => $this->getCreatedBy(),
			$keys[5] => $this->getUpdatedBy(),
			$keys[6] => $this->getDeletedBy(),
			$keys[7] => $this->getProfileId(),
			$keys[8] => $this->getName(),
			$keys[9] => $this->getLabel(),
			$keys[10] => $this->getDefinition(),
			$keys[11] => $this->getComment(),
			$keys[12] => $this->getType(),
			$keys[13] => $this->getUri(),
			$keys[14] => $this->getStatusId(),
			$keys[15] => $this->getLanguage(),
			$keys[16] => $this->getNote(),
			$keys[17] => $this->getDisplayOrder(),
			$keys[18] => $this->getExportOrder(),
			$keys[19] => $this->getPicklistOrder(),
			$keys[20] => $this->getExamples(),
			$keys[21] => $this->getIsRequired(),
			$keys[22] => $this->getIsReciprocal(),
			$keys[23] => $this->getIsSingleton(),
			$keys[24] => $this->getIsInPicklist(),
			$keys[25] => $this->getIsInExport(),
			$keys[26] => $this->getInverseProfilePropertyId(),
			$keys[27] => $this->getIsInClassPicklist(),
			$keys[28] => $this->getIsInPropertyPicklist(),
			$keys[29] => $this->getIsInRdf(),
			$keys[30] => $this->getIsInXsd(),
			$keys[31] => $this->getIsAttribute(),
			$keys[32] => $this->getHasLanguage(),
			$keys[33] => $this->getIsObjectProp(),
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
		$pos = ProfilePropertyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setProfileId($value);
				break;
			case 8:
				$this->setName($value);
				break;
			case 9:
				$this->setLabel($value);
				break;
			case 10:
				$this->setDefinition($value);
				break;
			case 11:
				$this->setComment($value);
				break;
			case 12:
				$this->setType($value);
				break;
			case 13:
				$this->setUri($value);
				break;
			case 14:
				$this->setStatusId($value);
				break;
			case 15:
				$this->setLanguage($value);
				break;
			case 16:
				$this->setNote($value);
				break;
			case 17:
				$this->setDisplayOrder($value);
				break;
			case 18:
				$this->setExportOrder($value);
				break;
			case 19:
				$this->setPicklistOrder($value);
				break;
			case 20:
				$this->setExamples($value);
				break;
			case 21:
				$this->setIsRequired($value);
				break;
			case 22:
				$this->setIsReciprocal($value);
				break;
			case 23:
				$this->setIsSingleton($value);
				break;
			case 24:
				$this->setIsInPicklist($value);
				break;
			case 25:
				$this->setIsInExport($value);
				break;
			case 26:
				$this->setInverseProfilePropertyId($value);
				break;
			case 27:
				$this->setIsInClassPicklist($value);
				break;
			case 28:
				$this->setIsInPropertyPicklist($value);
				break;
			case 29:
				$this->setIsInRdf($value);
				break;
			case 30:
				$this->setIsInXsd($value);
				break;
			case 31:
				$this->setIsAttribute($value);
				break;
			case 32:
				$this->setHasLanguage($value);
				break;
			case 33:
				$this->setIsObjectProp($value);
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
		$keys = ProfilePropertyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeletedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedBy($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeletedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setProfileId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLabel($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDefinition($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setComment($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setType($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUri($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setStatusId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLanguage($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setNote($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDisplayOrder($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setExportOrder($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setPicklistOrder($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setExamples($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setIsRequired($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setIsReciprocal($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setIsSingleton($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setIsInPicklist($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setIsInExport($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setInverseProfilePropertyId($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setIsInClassPicklist($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setIsInPropertyPicklist($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setIsInRdf($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setIsInXsd($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setIsAttribute($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setHasLanguage($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setIsObjectProp($arr[$keys[33]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProfilePropertyPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProfilePropertyPeer::ID)) $criteria->add(ProfilePropertyPeer::ID, $this->id);
		if ($this->isColumnModified(ProfilePropertyPeer::CREATED_AT)) $criteria->add(ProfilePropertyPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProfilePropertyPeer::UPDATED_AT)) $criteria->add(ProfilePropertyPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ProfilePropertyPeer::DELETED_AT)) $criteria->add(ProfilePropertyPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(ProfilePropertyPeer::CREATED_BY)) $criteria->add(ProfilePropertyPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(ProfilePropertyPeer::UPDATED_BY)) $criteria->add(ProfilePropertyPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(ProfilePropertyPeer::DELETED_BY)) $criteria->add(ProfilePropertyPeer::DELETED_BY, $this->deleted_by);
		if ($this->isColumnModified(ProfilePropertyPeer::PROFILE_ID)) $criteria->add(ProfilePropertyPeer::PROFILE_ID, $this->profile_id);
		if ($this->isColumnModified(ProfilePropertyPeer::NAME)) $criteria->add(ProfilePropertyPeer::NAME, $this->name);
		if ($this->isColumnModified(ProfilePropertyPeer::LABEL)) $criteria->add(ProfilePropertyPeer::LABEL, $this->label);
		if ($this->isColumnModified(ProfilePropertyPeer::DEFINITION)) $criteria->add(ProfilePropertyPeer::DEFINITION, $this->definition);
		if ($this->isColumnModified(ProfilePropertyPeer::COMMENT)) $criteria->add(ProfilePropertyPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(ProfilePropertyPeer::TYPE)) $criteria->add(ProfilePropertyPeer::TYPE, $this->type);
		if ($this->isColumnModified(ProfilePropertyPeer::URI)) $criteria->add(ProfilePropertyPeer::URI, $this->uri);
		if ($this->isColumnModified(ProfilePropertyPeer::STATUS_ID)) $criteria->add(ProfilePropertyPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ProfilePropertyPeer::LANGUAGE)) $criteria->add(ProfilePropertyPeer::LANGUAGE, $this->language);
		if ($this->isColumnModified(ProfilePropertyPeer::NOTE)) $criteria->add(ProfilePropertyPeer::NOTE, $this->note);
		if ($this->isColumnModified(ProfilePropertyPeer::DISPLAY_ORDER)) $criteria->add(ProfilePropertyPeer::DISPLAY_ORDER, $this->display_order);
		if ($this->isColumnModified(ProfilePropertyPeer::EXPORT_ORDER)) $criteria->add(ProfilePropertyPeer::EXPORT_ORDER, $this->export_order);
		if ($this->isColumnModified(ProfilePropertyPeer::PICKLIST_ORDER)) $criteria->add(ProfilePropertyPeer::PICKLIST_ORDER, $this->picklist_order);
		if ($this->isColumnModified(ProfilePropertyPeer::EXAMPLES)) $criteria->add(ProfilePropertyPeer::EXAMPLES, $this->examples);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_REQUIRED)) $criteria->add(ProfilePropertyPeer::IS_REQUIRED, $this->is_required);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_RECIPROCAL)) $criteria->add(ProfilePropertyPeer::IS_RECIPROCAL, $this->is_reciprocal);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_SINGLETON)) $criteria->add(ProfilePropertyPeer::IS_SINGLETON, $this->is_singleton);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_PICKLIST)) $criteria->add(ProfilePropertyPeer::IS_IN_PICKLIST, $this->is_in_picklist);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_EXPORT)) $criteria->add(ProfilePropertyPeer::IS_IN_EXPORT, $this->is_in_export);
		if ($this->isColumnModified(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID)) $criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->inverse_profile_property_id);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_CLASS_PICKLIST)) $criteria->add(ProfilePropertyPeer::IS_IN_CLASS_PICKLIST, $this->is_in_class_picklist);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST)) $criteria->add(ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST, $this->is_in_property_picklist);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_RDF)) $criteria->add(ProfilePropertyPeer::IS_IN_RDF, $this->is_in_rdf);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_IN_XSD)) $criteria->add(ProfilePropertyPeer::IS_IN_XSD, $this->is_in_xsd);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_ATTRIBUTE)) $criteria->add(ProfilePropertyPeer::IS_ATTRIBUTE, $this->is_attribute);
		if ($this->isColumnModified(ProfilePropertyPeer::HAS_LANGUAGE)) $criteria->add(ProfilePropertyPeer::HAS_LANGUAGE, $this->has_language);
		if ($this->isColumnModified(ProfilePropertyPeer::IS_OBJECT_PROP)) $criteria->add(ProfilePropertyPeer::IS_OBJECT_PROP, $this->is_object_prop);

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
		$criteria = new Criteria(ProfilePropertyPeer::DATABASE_NAME);

		$criteria->add(ProfilePropertyPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ProfileProperty (or compatible) type.
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

		$copyObj->setProfileId($this->profile_id);

		$copyObj->setName($this->name);

		$copyObj->setLabel($this->label);

		$copyObj->setDefinition($this->definition);

		$copyObj->setComment($this->comment);

		$copyObj->setType($this->type);

		$copyObj->setUri($this->uri);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLanguage($this->language);

		$copyObj->setNote($this->note);

		$copyObj->setDisplayOrder($this->display_order);

		$copyObj->setExportOrder($this->export_order);

		$copyObj->setPicklistOrder($this->picklist_order);

		$copyObj->setExamples($this->examples);

		$copyObj->setIsRequired($this->is_required);

		$copyObj->setIsReciprocal($this->is_reciprocal);

		$copyObj->setIsSingleton($this->is_singleton);

		$copyObj->setIsInPicklist($this->is_in_picklist);

		$copyObj->setIsInExport($this->is_in_export);

		$copyObj->setInverseProfilePropertyId($this->inverse_profile_property_id);

		$copyObj->setIsInClassPicklist($this->is_in_class_picklist);

		$copyObj->setIsInPropertyPicklist($this->is_in_property_picklist);

		$copyObj->setIsInRdf($this->is_in_rdf);

		$copyObj->setIsInXsd($this->is_in_xsd);

		$copyObj->setIsAttribute($this->is_attribute);

		$copyObj->setHasLanguage($this->has_language);

		$copyObj->setIsObjectProp($this->is_object_prop);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getProfilePropertysRelatedByInverseProfilePropertyId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addProfilePropertyRelatedByInverseProfilePropertyId($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElements() as $relObj) {
				$copyObj->addSchemaPropertyElement($relObj->copy($deepCopy));
			}

			foreach($this->getSchemaPropertyElementHistorys() as $relObj) {
				$copyObj->addSchemaPropertyElementHistory($relObj->copy($deepCopy));
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
	 * @return     ProfileProperty Clone of current object.
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
	 * @return     ProfilePropertyPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProfilePropertyPeer();
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
	public function setUserRelatedByCreatedBy($v)
	{


		if ($v === null) {
			$this->setCreatedBy(NULL);
		} else {
			$this->setCreatedBy($v->getId());
		}


		$this->aUserRelatedByCreatedBy = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByCreatedBy($con = null)
	{
		if ($this->aUserRelatedByCreatedBy === null && ($this->created_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByCreatedBy = UserPeer::retrieveByPK($this->created_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->created_by, $con);
			   $obj->addUsersRelatedByCreatedBy($this);
			 */
		}
		return $this->aUserRelatedByCreatedBy;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByUpdatedBy($v)
	{


		if ($v === null) {
			$this->setUpdatedBy(NULL);
		} else {
			$this->setUpdatedBy($v->getId());
		}


		$this->aUserRelatedByUpdatedBy = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByUpdatedBy($con = null)
	{
		if ($this->aUserRelatedByUpdatedBy === null && ($this->updated_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByUpdatedBy = UserPeer::retrieveByPK($this->updated_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->updated_by, $con);
			   $obj->addUsersRelatedByUpdatedBy($this);
			 */
		}
		return $this->aUserRelatedByUpdatedBy;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUserRelatedByDeletedBy($v)
	{


		if ($v === null) {
			$this->setDeletedBy(NULL);
		} else {
			$this->setDeletedBy($v->getId());
		}


		$this->aUserRelatedByDeletedBy = $v;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserRelatedByDeletedBy($con = null)
	{
		if ($this->aUserRelatedByDeletedBy === null && ($this->deleted_by !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUserRelatedByDeletedBy = UserPeer::retrieveByPK($this->deleted_by, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UserPeer::retrieveByPK($this->deleted_by, $con);
			   $obj->addUsersRelatedByDeletedBy($this);
			 */
		}
		return $this->aUserRelatedByDeletedBy;
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
	 * Declares an association between this object and a ProfileProperty object.
	 *
	 * @param      ProfileProperty $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setProfilePropertyRelatedByInverseProfilePropertyId($v)
	{


		if ($v === null) {
			$this->setInverseProfilePropertyId(NULL);
		} else {
			$this->setInverseProfilePropertyId($v->getId());
		}


		$this->aProfilePropertyRelatedByInverseProfilePropertyId = $v;
	}


	/**
	 * Get the associated ProfileProperty object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     ProfileProperty The associated ProfileProperty object.
	 * @throws     PropelException
	 */
	public function getProfilePropertyRelatedByInverseProfilePropertyId($con = null)
	{
		if ($this->aProfilePropertyRelatedByInverseProfilePropertyId === null && ($this->inverse_profile_property_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseProfilePropertyPeer.php';

			$this->aProfilePropertyRelatedByInverseProfilePropertyId = ProfilePropertyPeer::retrieveByPK($this->inverse_profile_property_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ProfilePropertyPeer::retrieveByPK($this->inverse_profile_property_id, $con);
			   $obj->addProfilePropertysRelatedByInverseProfilePropertyId($this);
			 */
		}
		return $this->aProfilePropertyRelatedByInverseProfilePropertyId;
	}

	/**
	 * Temporary storage of collProfilePropertysRelatedByInverseProfilePropertyId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initProfilePropertysRelatedByInverseProfilePropertyId()
	{
		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 * If this ProfileProperty is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyId($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
			   $this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				ProfilePropertyPeer::addSelectColumns($criteria);
				if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
					$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;
		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
	}

	/**
	 * Returns the number of related ProfilePropertysRelatedByInverseProfilePropertyId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countProfilePropertysRelatedByInverseProfilePropertyId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

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
	public function addProfilePropertyRelatedByInverseProfilePropertyId(ProfileProperty $l)
	{
		$this->collProfilePropertysRelatedByInverseProfilePropertyId[] = $l;
		$l->setProfilePropertyRelatedByInverseProfilePropertyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyIdJoinUserRelatedByCreatedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByCreatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByCreatedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;

		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyIdJoinUserRelatedByUpdatedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByUpdatedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByUpdatedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;

		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyIdJoinUserRelatedByDeletedBy($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByDeletedBy($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinUserRelatedByDeletedBy($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;

		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyIdJoinProfile($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;

		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related ProfilePropertysRelatedByInverseProfilePropertyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getProfilePropertysRelatedByInverseProfilePropertyIdJoinStatus($criteria = null, $con = null)
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

		if ($this->collProfilePropertysRelatedByInverseProfilePropertyId === null) {
			if ($this->isNew()) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = array();
			} else {

				$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria) || !$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria->equals($criteria)) {
				$this->collProfilePropertysRelatedByInverseProfilePropertyId = ProfilePropertyPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastProfilePropertyRelatedByInverseProfilePropertyIdCriteria = $criteria;

		return $this->collProfilePropertysRelatedByInverseProfilePropertyId;
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
	 * Otherwise if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 * If this ProfileProperty is new, it will return
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				SchemaPropertyElementPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

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

		$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

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
		$l->setProfileProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByCreatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinUserRelatedByUpdatedUserId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getSchemaPropertyElementsJoinSchemaPropertyRelatedBySchemaPropertyId($criteria = null, $con = null)
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getSchemaPropertyElementsJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria = null, $con = null)
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElements from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementCriteria) || !$this->lastSchemaPropertyElementCriteria->equals($criteria)) {
				$this->collSchemaPropertyElements = SchemaPropertyElementPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementCriteria = $criteria;

		return $this->collSchemaPropertyElements;
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
	 * Otherwise if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 * If this ProfileProperty is new, it will return
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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

		$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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
		$l->setProfileProperty($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getSchemaPropertyElementHistorysJoinUser($criteria = null, $con = null)
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyElement($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchema($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

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
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinStatus($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ProfileProperty is new, it will return
	 * an empty collection; or if this ProfileProperty has previously
	 * been saved, it will retrieve related SchemaPropertyElementHistorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ProfileProperty.
	 */
	public function getSchemaPropertyElementHistorysJoinFileImportHistory($criteria = null, $con = null)
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

				$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, $this->getId());

			if (!isset($this->lastSchemaPropertyElementHistoryCriteria) || !$this->lastSchemaPropertyElementHistoryCriteria->equals($criteria)) {
				$this->collSchemaPropertyElementHistorys = SchemaPropertyElementHistoryPeer::doSelectJoinFileImportHistory($criteria, $con);
			}
		}
		$this->lastSchemaPropertyElementHistoryCriteria = $criteria;

		return $this->collSchemaPropertyElementHistorys;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseProfileProperty:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseProfileProperty::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseProfileProperty
