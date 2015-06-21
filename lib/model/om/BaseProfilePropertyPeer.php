<?php

/**
 * Base static class for performing query and update operations on the 'profile_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProfilePropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'profile_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ProfileProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 35;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'profile_property.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'profile_property.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'profile_property.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'profile_property.DELETED_AT';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'profile_property.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'profile_property.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'profile_property.DELETED_BY';

	/** the column name for the PROFILE_ID field */
	const PROFILE_ID = 'profile_property.PROFILE_ID';

	/** the column name for the NAME field */
	const NAME = 'profile_property.NAME';

	/** the column name for the LABEL field */
	const LABEL = 'profile_property.LABEL';

	/** the column name for the DEFINITION field */
	const DEFINITION = 'profile_property.DEFINITION';

	/** the column name for the COMMENT field */
	const COMMENT = 'profile_property.COMMENT';

	/** the column name for the TYPE field */
	const TYPE = 'profile_property.TYPE';

	/** the column name for the URI field */
	const URI = 'profile_property.URI';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'profile_property.STATUS_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'profile_property.LANGUAGE';

	/** the column name for the NOTE field */
	const NOTE = 'profile_property.NOTE';

	/** the column name for the DISPLAY_ORDER field */
	const DISPLAY_ORDER = 'profile_property.DISPLAY_ORDER';

	/** the column name for the EXPORT_ORDER field */
	const EXPORT_ORDER = 'profile_property.EXPORT_ORDER';

	/** the column name for the PICKLIST_ORDER field */
	const PICKLIST_ORDER = 'profile_property.PICKLIST_ORDER';

	/** the column name for the EXAMPLES field */
	const EXAMPLES = 'profile_property.EXAMPLES';

	/** the column name for the IS_REQUIRED field */
	const IS_REQUIRED = 'profile_property.IS_REQUIRED';

	/** the column name for the IS_RECIPROCAL field */
	const IS_RECIPROCAL = 'profile_property.IS_RECIPROCAL';

	/** the column name for the IS_SINGLETON field */
	const IS_SINGLETON = 'profile_property.IS_SINGLETON';

	/** the column name for the IS_IN_PICKLIST field */
	const IS_IN_PICKLIST = 'profile_property.IS_IN_PICKLIST';

	/** the column name for the IS_IN_EXPORT field */
	const IS_IN_EXPORT = 'profile_property.IS_IN_EXPORT';

	/** the column name for the INVERSE_PROFILE_PROPERTY_ID field */
	const INVERSE_PROFILE_PROPERTY_ID = 'profile_property.INVERSE_PROFILE_PROPERTY_ID';

	/** the column name for the IS_IN_CLASS_PICKLIST field */
	const IS_IN_CLASS_PICKLIST = 'profile_property.IS_IN_CLASS_PICKLIST';

	/** the column name for the IS_IN_PROPERTY_PICKLIST field */
	const IS_IN_PROPERTY_PICKLIST = 'profile_property.IS_IN_PROPERTY_PICKLIST';

	/** the column name for the IS_IN_RDF field */
	const IS_IN_RDF = 'profile_property.IS_IN_RDF';

	/** the column name for the IS_IN_XSD field */
	const IS_IN_XSD = 'profile_property.IS_IN_XSD';

	/** the column name for the IS_ATTRIBUTE field */
	const IS_ATTRIBUTE = 'profile_property.IS_ATTRIBUTE';

	/** the column name for the HAS_LANGUAGE field */
	const HAS_LANGUAGE = 'profile_property.HAS_LANGUAGE';

	/** the column name for the IS_OBJECT_PROP field */
	const IS_OBJECT_PROP = 'profile_property.IS_OBJECT_PROP';

	/** the column name for the IS_IN_FORM field */
	const IS_IN_FORM = 'profile_property.IS_IN_FORM';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedBy', 'UpdatedBy', 'DeletedBy', 'ProfileId', 'Name', 'Label', 'Definition', 'Comment', 'Type', 'Uri', 'StatusId', 'Language', 'Note', 'DisplayOrder', 'ExportOrder', 'PicklistOrder', 'Examples', 'IsRequired', 'IsReciprocal', 'IsSingleton', 'IsInPicklist', 'IsInExport', 'InverseProfilePropertyId', 'IsInClassPicklist', 'IsInPropertyPicklist', 'IsInRdf', 'IsInXsd', 'IsAttribute', 'HasLanguage', 'IsObjectProp', 'IsInForm', ),
		BasePeer::TYPE_COLNAME => array (ProfilePropertyPeer::ID, ProfilePropertyPeer::CREATED_AT, ProfilePropertyPeer::UPDATED_AT, ProfilePropertyPeer::DELETED_AT, ProfilePropertyPeer::CREATED_BY, ProfilePropertyPeer::UPDATED_BY, ProfilePropertyPeer::DELETED_BY, ProfilePropertyPeer::PROFILE_ID, ProfilePropertyPeer::NAME, ProfilePropertyPeer::LABEL, ProfilePropertyPeer::DEFINITION, ProfilePropertyPeer::COMMENT, ProfilePropertyPeer::TYPE, ProfilePropertyPeer::URI, ProfilePropertyPeer::STATUS_ID, ProfilePropertyPeer::LANGUAGE, ProfilePropertyPeer::NOTE, ProfilePropertyPeer::DISPLAY_ORDER, ProfilePropertyPeer::EXPORT_ORDER, ProfilePropertyPeer::PICKLIST_ORDER, ProfilePropertyPeer::EXAMPLES, ProfilePropertyPeer::IS_REQUIRED, ProfilePropertyPeer::IS_RECIPROCAL, ProfilePropertyPeer::IS_SINGLETON, ProfilePropertyPeer::IS_IN_PICKLIST, ProfilePropertyPeer::IS_IN_EXPORT, ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID, ProfilePropertyPeer::IS_IN_CLASS_PICKLIST, ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST, ProfilePropertyPeer::IS_IN_RDF, ProfilePropertyPeer::IS_IN_XSD, ProfilePropertyPeer::IS_ATTRIBUTE, ProfilePropertyPeer::HAS_LANGUAGE, ProfilePropertyPeer::IS_OBJECT_PROP, ProfilePropertyPeer::IS_IN_FORM, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'profile_id', 'name', 'label', 'definition', 'comment', 'type', 'uri', 'status_id', 'language', 'note', 'display_order', 'export_order', 'picklist_order', 'examples', 'is_required', 'is_reciprocal', 'is_singleton', 'is_in_picklist', 'is_in_export', 'inverse_profile_property_id', 'is_in_class_picklist', 'is_in_property_picklist', 'is_in_rdf', 'is_in_xsd', 'is_attribute', 'has_language', 'is_object_prop', 'is_in_form', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'CreatedBy' => 4, 'UpdatedBy' => 5, 'DeletedBy' => 6, 'ProfileId' => 7, 'Name' => 8, 'Label' => 9, 'Definition' => 10, 'Comment' => 11, 'Type' => 12, 'Uri' => 13, 'StatusId' => 14, 'Language' => 15, 'Note' => 16, 'DisplayOrder' => 17, 'ExportOrder' => 18, 'PicklistOrder' => 19, 'Examples' => 20, 'IsRequired' => 21, 'IsReciprocal' => 22, 'IsSingleton' => 23, 'IsInPicklist' => 24, 'IsInExport' => 25, 'InverseProfilePropertyId' => 26, 'IsInClassPicklist' => 27, 'IsInPropertyPicklist' => 28, 'IsInRdf' => 29, 'IsInXsd' => 30, 'IsAttribute' => 31, 'HasLanguage' => 32, 'IsObjectProp' => 33, 'IsInForm' => 34, ),
		BasePeer::TYPE_COLNAME => array (ProfilePropertyPeer::ID => 0, ProfilePropertyPeer::CREATED_AT => 1, ProfilePropertyPeer::UPDATED_AT => 2, ProfilePropertyPeer::DELETED_AT => 3, ProfilePropertyPeer::CREATED_BY => 4, ProfilePropertyPeer::UPDATED_BY => 5, ProfilePropertyPeer::DELETED_BY => 6, ProfilePropertyPeer::PROFILE_ID => 7, ProfilePropertyPeer::NAME => 8, ProfilePropertyPeer::LABEL => 9, ProfilePropertyPeer::DEFINITION => 10, ProfilePropertyPeer::COMMENT => 11, ProfilePropertyPeer::TYPE => 12, ProfilePropertyPeer::URI => 13, ProfilePropertyPeer::STATUS_ID => 14, ProfilePropertyPeer::LANGUAGE => 15, ProfilePropertyPeer::NOTE => 16, ProfilePropertyPeer::DISPLAY_ORDER => 17, ProfilePropertyPeer::EXPORT_ORDER => 18, ProfilePropertyPeer::PICKLIST_ORDER => 19, ProfilePropertyPeer::EXAMPLES => 20, ProfilePropertyPeer::IS_REQUIRED => 21, ProfilePropertyPeer::IS_RECIPROCAL => 22, ProfilePropertyPeer::IS_SINGLETON => 23, ProfilePropertyPeer::IS_IN_PICKLIST => 24, ProfilePropertyPeer::IS_IN_EXPORT => 25, ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID => 26, ProfilePropertyPeer::IS_IN_CLASS_PICKLIST => 27, ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST => 28, ProfilePropertyPeer::IS_IN_RDF => 29, ProfilePropertyPeer::IS_IN_XSD => 30, ProfilePropertyPeer::IS_ATTRIBUTE => 31, ProfilePropertyPeer::HAS_LANGUAGE => 32, ProfilePropertyPeer::IS_OBJECT_PROP => 33, ProfilePropertyPeer::IS_IN_FORM => 34, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'created_by' => 4, 'updated_by' => 5, 'deleted_by' => 6, 'profile_id' => 7, 'name' => 8, 'label' => 9, 'definition' => 10, 'comment' => 11, 'type' => 12, 'uri' => 13, 'status_id' => 14, 'language' => 15, 'note' => 16, 'display_order' => 17, 'export_order' => 18, 'picklist_order' => 19, 'examples' => 20, 'is_required' => 21, 'is_reciprocal' => 22, 'is_singleton' => 23, 'is_in_picklist' => 24, 'is_in_export' => 25, 'inverse_profile_property_id' => 26, 'is_in_class_picklist' => 27, 'is_in_property_picklist' => 28, 'is_in_rdf' => 29, 'is_in_xsd' => 30, 'is_attribute' => 31, 'has_language' => 32, 'is_object_prop' => 33, 'is_in_form' => 34, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProfilePropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProfilePropertyMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProfilePropertyPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ProfilePropertyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ProfilePropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $tableAlias = null)
	{

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::ID) : ProfilePropertyPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::CREATED_AT) : ProfilePropertyPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::UPDATED_AT) : ProfilePropertyPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::DELETED_AT) : ProfilePropertyPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::CREATED_BY) : ProfilePropertyPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::UPDATED_BY) : ProfilePropertyPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::DELETED_BY) : ProfilePropertyPeer::DELETED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::PROFILE_ID) : ProfilePropertyPeer::PROFILE_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::NAME) : ProfilePropertyPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::LABEL) : ProfilePropertyPeer::LABEL);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::DEFINITION) : ProfilePropertyPeer::DEFINITION);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::COMMENT) : ProfilePropertyPeer::COMMENT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::TYPE) : ProfilePropertyPeer::TYPE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::URI) : ProfilePropertyPeer::URI);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::STATUS_ID) : ProfilePropertyPeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::LANGUAGE) : ProfilePropertyPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::NOTE) : ProfilePropertyPeer::NOTE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::DISPLAY_ORDER) : ProfilePropertyPeer::DISPLAY_ORDER);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::EXPORT_ORDER) : ProfilePropertyPeer::EXPORT_ORDER);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::PICKLIST_ORDER) : ProfilePropertyPeer::PICKLIST_ORDER);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::EXAMPLES) : ProfilePropertyPeer::EXAMPLES);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_REQUIRED) : ProfilePropertyPeer::IS_REQUIRED);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_RECIPROCAL) : ProfilePropertyPeer::IS_RECIPROCAL);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_SINGLETON) : ProfilePropertyPeer::IS_SINGLETON);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_PICKLIST) : ProfilePropertyPeer::IS_IN_PICKLIST);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_EXPORT) : ProfilePropertyPeer::IS_IN_EXPORT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID) : ProfilePropertyPeer::INVERSE_PROFILE_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_CLASS_PICKLIST) : ProfilePropertyPeer::IS_IN_CLASS_PICKLIST);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST) : ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_RDF) : ProfilePropertyPeer::IS_IN_RDF);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_XSD) : ProfilePropertyPeer::IS_IN_XSD);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_ATTRIBUTE) : ProfilePropertyPeer::IS_ATTRIBUTE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::HAS_LANGUAGE) : ProfilePropertyPeer::HAS_LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_OBJECT_PROP) : ProfilePropertyPeer::IS_OBJECT_PROP);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePropertyPeer::alias($tableAlias, ProfilePropertyPeer::IS_IN_FORM) : ProfilePropertyPeer::IS_IN_FORM);

	}

	const COUNT = 'COUNT(profile_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT profile_property.ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     ProfileProperty
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ProfilePropertyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProfilePropertyPeer::populateObjects(ProfilePropertyPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProfilePropertyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseProfilePropertyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProfilePropertyPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ProfilePropertyPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Profile table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProfile(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Status table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinStatus(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with their User objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfilePropertyRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilePropertysRelatedByCreatedBy();
				$obj2->addProfilePropertyRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with their User objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfilePropertyRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilePropertysRelatedByUpdatedBy();
				$obj2->addProfilePropertyRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with their User objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfilePropertyRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilePropertysRelatedByDeletedBy();
				$obj2->addProfilePropertyRelatedByDeletedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with their Profile objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePeer::addSelectColumns($c);

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilePropertys();
				$obj2->addProfileProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with their Status objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatusPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilePropertys();
				$obj2->addProfileProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::alias('a3', UserPeer::ID));
        $c->addAlias('a3', UserPeer::TABLE_NAME);

		ProfilePeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

        $c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::alias('a4', ProfilePeer::ID));
        $c->addAlias('a4', ProfilePeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::alias('a5', StatusPeer::ID));
        $c->addAlias('a5', StatusPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfilePropertyRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertysRelatedByCreatedBy();
				$obj2->addProfilePropertyRelatedByCreatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfilePropertyRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertysRelatedByUpdatedBy();
				$obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfilePropertyRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilePropertysRelatedByDeletedBy();
				$obj4->addProfilePropertyRelatedByDeletedBy($obj1);
			}


				// Add objects for joined Profile rows
	
			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilePropertys();
				$obj5->addProfileProperty($obj1);
			}


				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addProfileProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initProfilePropertys();
				$obj6->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Profile table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfile(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Status table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptStatus(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfilePropertyRelatedByInverseProfilePropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfilePropertyRelatedByInverseProfilePropertyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except UserRelatedByCreatedBy.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfilePeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertys();
				$obj2->addProfileProperty($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertys();
				$obj3->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except UserRelatedByUpdatedBy.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfilePeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertys();
				$obj2->addProfileProperty($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertys();
				$obj3->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except UserRelatedByDeletedBy.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProfilePeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertys();
				$obj2->addProfileProperty($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertys();
				$obj3->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except Profile.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfilePropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertysRelatedByCreatedBy();
				$obj2->addProfilePropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertysRelatedByUpdatedBy();
				$obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfilePropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilePropertysRelatedByDeletedBy();
				$obj4->addProfilePropertyRelatedByDeletedBy($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilePropertys();
				$obj5->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfilePropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertysRelatedByCreatedBy();
				$obj2->addProfilePropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertysRelatedByUpdatedBy();
				$obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfilePropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilePropertysRelatedByDeletedBy();
				$obj4->addProfilePropertyRelatedByDeletedBy($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilePropertys();
				$obj5->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ProfileProperty objects pre-filled with all related objects except ProfilePropertyRelatedByInverseProfilePropertyId.
	 *
	 * @return array Array of ProfileProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfilePropertyRelatedByInverseProfilePropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol2 = (ProfilePropertyPeer::NUM_COLUMNS - ProfilePropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePropertyPeer::CREATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::DELETED_BY, UserPeer::ID);

		$c->addJoin(ProfilePropertyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(ProfilePropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfilePropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilePropertysRelatedByCreatedBy();
				$obj2->addProfilePropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilePropertysRelatedByUpdatedBy();
				$obj3->addProfilePropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfilePropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilePropertysRelatedByDeletedBy();
				$obj4->addProfilePropertyRelatedByDeletedBy($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilePropertys();
				$obj5->addProfileProperty($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addProfileProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initProfilePropertys();
				$obj6->addProfileProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return ProfilePropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ProfileProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProfileProperty object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProfilePropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProfilePropertyPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ProfileProperty object
		}

		$criteria->remove(ProfilePropertyPeer::ID); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseProfilePropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseProfilePropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ProfileProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or ProfileProperty object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProfilePropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProfilePropertyPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ProfilePropertyPeer::ID);
			$selectCriteria->add(ProfilePropertyPeer::ID, $criteria->remove(ProfilePropertyPeer::ID), $comparison);

		} else { // $values is ProfileProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseProfilePropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseProfilePropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the profile_property table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ProfilePropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ProfileProperty or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ProfileProperty object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ProfilePropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ProfileProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProfilePropertyPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given ProfileProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ProfileProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ProfileProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProfilePropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProfilePropertyPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(ProfilePropertyPeer::DATABASE_NAME, ProfilePropertyPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     ProfileProperty
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ProfilePropertyPeer::DATABASE_NAME);

		$criteria->add(ProfilePropertyPeer::ID, $pk);


		$v = ProfilePropertyPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ProfilePropertyPeer::ID, $pks, Criteria::IN);
			$objs = ProfilePropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseProfilePropertyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseProfilePropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ProfilePropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProfilePropertyMapBuilder');
}
