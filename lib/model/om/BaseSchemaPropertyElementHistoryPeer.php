<?php

/**
 * Base static class for performing query and update operations on the 'reg_schema_property_element_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyElementHistoryPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_schema_property_element_history';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SchemaPropertyElementHistory';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_schema_property_element_history.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_schema_property_element_history.CREATED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_schema_property_element_history.CREATED_USER_ID';

	/** the column name for the ACTION field */
	const ACTION = 'reg_schema_property_element_history.ACTION';

	/** the column name for the SCHEMA_PROPERTY_ELEMENT_ID field */
	const SCHEMA_PROPERTY_ELEMENT_ID = 'reg_schema_property_element_history.SCHEMA_PROPERTY_ELEMENT_ID';

	/** the column name for the SCHEMA_PROPERTY_ID field */
	const SCHEMA_PROPERTY_ID = 'reg_schema_property_element_history.SCHEMA_PROPERTY_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_schema_property_element_history.SCHEMA_ID';

	/** the column name for the PROFILE_PROPERTY_ID field */
	const PROFILE_PROPERTY_ID = 'reg_schema_property_element_history.PROFILE_PROPERTY_ID';

	/** the column name for the OBJECT field */
	const OBJECT = 'reg_schema_property_element_history.OBJECT';

	/** the column name for the RELATED_SCHEMA_PROPERTY_ID field */
	const RELATED_SCHEMA_PROPERTY_ID = 'reg_schema_property_element_history.RELATED_SCHEMA_PROPERTY_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_schema_property_element_history.LANGUAGE';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_schema_property_element_history.STATUS_ID';

	/** the column name for the CHANGE_NOTE field */
	const CHANGE_NOTE = 'reg_schema_property_element_history.CHANGE_NOTE';

	/** the column name for the IMPORT_ID field */
	const IMPORT_ID = 'reg_schema_property_element_history.IMPORT_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'CreatedUserId', 'Action', 'SchemaPropertyElementId', 'SchemaPropertyId', 'SchemaId', 'ProfilePropertyId', 'Object', 'RelatedSchemaPropertyId', 'Language', 'StatusId', 'ChangeNote', 'ImportId', ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyElementHistoryPeer::ID, SchemaPropertyElementHistoryPeer::CREATED_AT, SchemaPropertyElementHistoryPeer::CREATED_USER_ID, SchemaPropertyElementHistoryPeer::ACTION, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, SchemaPropertyElementHistoryPeer::OBJECT, SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyElementHistoryPeer::LANGUAGE, SchemaPropertyElementHistoryPeer::STATUS_ID, SchemaPropertyElementHistoryPeer::CHANGE_NOTE, SchemaPropertyElementHistoryPeer::IMPORT_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'created_user_id', 'action', 'schema_property_element_id', 'schema_property_id', 'schema_id', 'profile_property_id', 'object', 'related_schema_property_id', 'language', 'status_id', 'change_note', 'import_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'CreatedUserId' => 2, 'Action' => 3, 'SchemaPropertyElementId' => 4, 'SchemaPropertyId' => 5, 'SchemaId' => 6, 'ProfilePropertyId' => 7, 'Object' => 8, 'RelatedSchemaPropertyId' => 9, 'Language' => 10, 'StatusId' => 11, 'ChangeNote' => 12, 'ImportId' => 13, ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyElementHistoryPeer::ID => 0, SchemaPropertyElementHistoryPeer::CREATED_AT => 1, SchemaPropertyElementHistoryPeer::CREATED_USER_ID => 2, SchemaPropertyElementHistoryPeer::ACTION => 3, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID => 4, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID => 5, SchemaPropertyElementHistoryPeer::SCHEMA_ID => 6, SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID => 7, SchemaPropertyElementHistoryPeer::OBJECT => 8, SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID => 9, SchemaPropertyElementHistoryPeer::LANGUAGE => 10, SchemaPropertyElementHistoryPeer::STATUS_ID => 11, SchemaPropertyElementHistoryPeer::CHANGE_NOTE => 12, SchemaPropertyElementHistoryPeer::IMPORT_ID => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'created_user_id' => 2, 'action' => 3, 'schema_property_element_id' => 4, 'schema_property_id' => 5, 'schema_id' => 6, 'profile_property_id' => 7, 'object' => 8, 'related_schema_property_id' => 9, 'language' => 10, 'status_id' => 11, 'change_note' => 12, 'import_id' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchemaPropertyElementHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchemaPropertyElementHistoryMapBuilder');
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
			$map = SchemaPropertyElementHistoryPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SchemaPropertyElementHistoryPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchemaPropertyElementHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::ID) : SchemaPropertyElementHistoryPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::CREATED_AT) : SchemaPropertyElementHistoryPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::CREATED_USER_ID) : SchemaPropertyElementHistoryPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::ACTION) : SchemaPropertyElementHistoryPeer::ACTION);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID) : SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID) : SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::SCHEMA_ID) : SchemaPropertyElementHistoryPeer::SCHEMA_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID) : SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::OBJECT) : SchemaPropertyElementHistoryPeer::OBJECT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID) : SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::LANGUAGE) : SchemaPropertyElementHistoryPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::STATUS_ID) : SchemaPropertyElementHistoryPeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::CHANGE_NOTE) : SchemaPropertyElementHistoryPeer::CHANGE_NOTE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementHistoryPeer::alias($tableAlias, SchemaPropertyElementHistoryPeer::IMPORT_ID) : SchemaPropertyElementHistoryPeer::IMPORT_ID);

	}

	const COUNT = 'COUNT(reg_schema_property_element_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_schema_property_element_history.ID)';

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
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
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
	 * @return     SchemaPropertyElementHistory
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchemaPropertyElementHistoryPeer::doSelect($critcopy, $con);
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
		return SchemaPropertyElementHistoryPeer::populateObjects(SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistoryPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementHistoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchemaPropertyElementHistoryPeer::addSelectColumns($criteria);
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
		$cls = SchemaPropertyElementHistoryPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related User table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyElement table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSchemaPropertyElement(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyRelatedBySchemaPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSchemaPropertyRelatedBySchemaPropertyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Schema table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSchema(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfileProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProfileProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyRelatedByRelatedSchemaPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSchemaPropertyRelatedByRelatedSchemaPropertyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related FileImportHistory table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinFileImportHistory(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their User objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their SchemaPropertyElement objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchemaPropertyElement(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyElementPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyElementPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchemaPropertyRelatedBySchemaPropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj2->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their Schema objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchema(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their ProfileProperty objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProfileProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchemaPropertyRelatedByRelatedSchemaPropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj2->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their Status objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
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

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with their FileImportHistory objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFileImportHistory(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FileImportHistoryPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FileImportHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1); //CHECKME
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
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
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

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		SchemaPropertyElementPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::alias('a2', SchemaPropertyElementPeer::ID));
        $c->addAlias('a2', SchemaPropertyElementPeer::TABLE_NAME);

		SchemaPropertyPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::alias('a3', SchemaPropertyPeer::ID));
        $c->addAlias('a3', SchemaPropertyPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::alias('a4', SchemaPeer::ID));
        $c->addAlias('a4', SchemaPeer::TABLE_NAME);

		ProfilePropertyPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + ProfilePropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::alias('a5', ProfilePropertyPeer::ID));
        $c->addAlias('a5', ProfilePropertyPeer::TABLE_NAME);

		SchemaPropertyPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::alias('a6', SchemaPropertyPeer::ID));
        $c->addAlias('a6', SchemaPropertyPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a7');
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::alias('a7', StatusPeer::ID));
        $c->addAlias('a7', StatusPeer::TABLE_NAME);

		FileImportHistoryPeer::addSelectColumns($c, 'a8');
		$startcol10 = $startcol9 + FileImportHistoryPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::alias('a8', FileImportHistoryPeer::ID));
        $c->addAlias('a8', FileImportHistoryPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUser(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}


				// Add objects for joined SchemaPropertyElement rows
	
			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}


				// Add objects for joined SchemaProperty rows
	
			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}


				// Add objects for joined Schema rows
	
			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchema(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}


				// Add objects for joined ProfileProperty rows
	
			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getProfileProperty(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorys();
				$obj6->addSchemaPropertyElementHistory($obj1);
			}


				// Add objects for joined SchemaProperty rows
	
			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}


				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}


				// Add objects for joined FileImportHistory rows
	
			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getFileImportHistory(); // CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addSchemaPropertyElementHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj9->initSchemaPropertyElementHistorys();
				$obj9->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related User table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyElement table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchemaPropertyElement(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyRelatedBySchemaPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchemaPropertyRelatedBySchemaPropertyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Schema table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchema(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfileProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfileProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyRelatedByRelatedSchemaPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchemaPropertyRelatedByRelatedSchemaPropertyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related FileImportHistory table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptFileImportHistory(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except User.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj3->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorys();
				$obj4->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except SchemaPropertyElement.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchemaPropertyElement(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj3->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorys();
				$obj4->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except SchemaPropertyRelatedBySchemaPropertyId.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchemaPropertyRelatedBySchemaPropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorys();
				$obj4->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
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
					$temp_obj6->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorys();
				$obj6->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchema(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except ProfileProperty.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfileProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except SchemaPropertyRelatedByRelatedSchemaPropertyId.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchemaPropertyRelatedByRelatedSchemaPropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorys();
				$obj4->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
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
					$temp_obj6->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorys();
				$obj6->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorys();
				$obj7->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
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

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + SchemaPropertyPeer::NUM_COLUMNS;

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + FileImportHistoryPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::IMPORT_ID, FileImportHistoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorys();
				$obj6->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = FileImportHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getFileImportHistory(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElementHistory objects pre-filled with all related objects except FileImportHistory.
	 *
	 * @return array Array of SchemaPropertyElementHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptFileImportHistory(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementHistoryPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementHistoryPeer::NUM_COLUMNS - SchemaPropertyElementHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyElementPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementHistoryPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementHistoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementHistorys();
				$obj2->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementHistorys();
				$obj3->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementHistorysRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementHistoryRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementHistorys();
				$obj5->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementHistorys();
				$obj6->addSchemaPropertyElementHistory($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElementHistorysRelatedByRelatedSchemaPropertyId();
				$obj7->addSchemaPropertyElementHistoryRelatedByRelatedSchemaPropertyId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addSchemaPropertyElementHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initSchemaPropertyElementHistorys();
				$obj8->addSchemaPropertyElementHistory($obj1);
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
		return SchemaPropertyElementHistoryPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SchemaPropertyElementHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElementHistory object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyElementHistoryPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from SchemaPropertyElementHistory object
		}

		$criteria->remove(SchemaPropertyElementHistoryPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SchemaPropertyElementHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElementHistory object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyElementHistoryPeer', $values, $con);
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

			$comparison = $criteria->getComparison(SchemaPropertyElementHistoryPeer::ID);
			$selectCriteria->add(SchemaPropertyElementHistoryPeer::ID, $criteria->remove(SchemaPropertyElementHistoryPeer::ID), $comparison);

		} else { // $values is SchemaPropertyElementHistory object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementHistoryPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_schema_property_element_history table.
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
			$affectedRows += BasePeer::doDeleteAll(SchemaPropertyElementHistoryPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SchemaPropertyElementHistory or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElementHistory object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchemaPropertyElementHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SchemaPropertyElementHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchemaPropertyElementHistoryPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SchemaPropertyElementHistory object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SchemaPropertyElementHistory $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SchemaPropertyElementHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchemaPropertyElementHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchemaPropertyElementHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchemaPropertyElementHistoryPeer::DATABASE_NAME, SchemaPropertyElementHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchemaPropertyElementHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     SchemaPropertyElementHistory
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SchemaPropertyElementHistoryPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyElementHistoryPeer::ID, $pk);


		$v = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(SchemaPropertyElementHistoryPeer::ID, $pks, Criteria::IN);
			$objs = SchemaPropertyElementHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSchemaPropertyElementHistoryPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSchemaPropertyElementHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/SchemaPropertyElementHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchemaPropertyElementHistoryMapBuilder');
}
