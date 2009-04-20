<?php

/**
 * Base static class for performing query and update operations on the 'reg_schema_property_element' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyElementPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_schema_property_element';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SchemaPropertyElement';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_schema_property_element.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_schema_property_element.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_schema_property_element.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_schema_property_element.DELETED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_schema_property_element.CREATED_USER_ID';

	/** the column name for the UPDATED_USER_ID field */
	const UPDATED_USER_ID = 'reg_schema_property_element.UPDATED_USER_ID';

	/** the column name for the SCHEMA_PROPERTY_ID field */
	const SCHEMA_PROPERTY_ID = 'reg_schema_property_element.SCHEMA_PROPERTY_ID';

	/** the column name for the PROFILE_PROPERTY_ID field */
	const PROFILE_PROPERTY_ID = 'reg_schema_property_element.PROFILE_PROPERTY_ID';

	/** the column name for the IS_SCHEMA_PROPERTY field */
	const IS_SCHEMA_PROPERTY = 'reg_schema_property_element.IS_SCHEMA_PROPERTY';

	/** the column name for the OBJECT field */
	const OBJECT = 'reg_schema_property_element.OBJECT';

	/** the column name for the RELATED_SCHEMA_PROPERTY_ID field */
	const RELATED_SCHEMA_PROPERTY_ID = 'reg_schema_property_element.RELATED_SCHEMA_PROPERTY_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_schema_property_element.LANGUAGE';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_schema_property_element.STATUS_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedUserId', 'UpdatedUserId', 'SchemaPropertyId', 'ProfilePropertyId', 'IsSchemaProperty', 'Object', 'RelatedSchemaPropertyId', 'Language', 'StatusId', ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyElementPeer::ID, SchemaPropertyElementPeer::CREATED_AT, SchemaPropertyElementPeer::UPDATED_AT, SchemaPropertyElementPeer::DELETED_AT, SchemaPropertyElementPeer::CREATED_USER_ID, SchemaPropertyElementPeer::UPDATED_USER_ID, SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY, SchemaPropertyElementPeer::OBJECT, SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyElementPeer::LANGUAGE, SchemaPropertyElementPeer::STATUS_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'created_user_id', 'updated_user_id', 'schema_property_id', 'profile_property_id', 'is_schema_property', 'object', 'related_schema_property_id', 'language', 'status_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'CreatedUserId' => 4, 'UpdatedUserId' => 5, 'SchemaPropertyId' => 6, 'ProfilePropertyId' => 7, 'IsSchemaProperty' => 8, 'Object' => 9, 'RelatedSchemaPropertyId' => 10, 'Language' => 11, 'StatusId' => 12, ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyElementPeer::ID => 0, SchemaPropertyElementPeer::CREATED_AT => 1, SchemaPropertyElementPeer::UPDATED_AT => 2, SchemaPropertyElementPeer::DELETED_AT => 3, SchemaPropertyElementPeer::CREATED_USER_ID => 4, SchemaPropertyElementPeer::UPDATED_USER_ID => 5, SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID => 6, SchemaPropertyElementPeer::PROFILE_PROPERTY_ID => 7, SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY => 8, SchemaPropertyElementPeer::OBJECT => 9, SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID => 10, SchemaPropertyElementPeer::LANGUAGE => 11, SchemaPropertyElementPeer::STATUS_ID => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'created_user_id' => 4, 'updated_user_id' => 5, 'schema_property_id' => 6, 'profile_property_id' => 7, 'is_schema_property' => 8, 'object' => 9, 'related_schema_property_id' => 10, 'language' => 11, 'status_id' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchemaPropertyElementMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchemaPropertyElementMapBuilder');
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
			$map = SchemaPropertyElementPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SchemaPropertyElementPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchemaPropertyElementPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::ID) : SchemaPropertyElementPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::CREATED_AT) : SchemaPropertyElementPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::UPDATED_AT) : SchemaPropertyElementPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::DELETED_AT) : SchemaPropertyElementPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::CREATED_USER_ID) : SchemaPropertyElementPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::UPDATED_USER_ID) : SchemaPropertyElementPeer::UPDATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID) : SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::PROFILE_PROPERTY_ID) : SchemaPropertyElementPeer::PROFILE_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY) : SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::OBJECT) : SchemaPropertyElementPeer::OBJECT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID) : SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::LANGUAGE) : SchemaPropertyElementPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyElementPeer::alias($tableAlias, SchemaPropertyElementPeer::STATUS_ID) : SchemaPropertyElementPeer::STATUS_ID);

	}

	const COUNT = 'COUNT(reg_schema_property_element.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_schema_property_element.ID)';

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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
	 * @return     SchemaPropertyElement
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchemaPropertyElementPeer::doSelect($critcopy, $con);
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
		return SchemaPropertyElementPeer::populateObjects(SchemaPropertyElementPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchemaPropertyElementPeer::addSelectColumns($criteria);
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
		$cls = SchemaPropertyElementPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their User objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their User objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addSchemaPropertyElementRelatedByUpdatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj2->addSchemaPropertyElementRelatedByUpdatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their ProfileProperty objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyElement($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElements();
				$obj2->addSchemaPropertyElement($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj2->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with their Status objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyElement($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyElements();
				$obj2->addSchemaPropertyElement($obj1); //CHECKME
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		SchemaPropertyPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::alias('a3', SchemaPropertyPeer::ID));
        $c->addAlias('a3', SchemaPropertyPeer::TABLE_NAME);

		ProfilePropertyPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::alias('a4', ProfilePropertyPeer::ID));
        $c->addAlias('a4', ProfilePropertyPeer::TABLE_NAME);

		SchemaPropertyPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::alias('a5', SchemaPropertyPeer::ID));
        $c->addAlias('a5', SchemaPropertyPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::alias('a6', StatusPeer::ID));
        $c->addAlias('a6', StatusPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedUserId(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
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
					$temp_obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
			}


				// Add objects for joined ProfileProperty rows
	
			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfileProperty(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElement($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
			}


				// Add objects for joined SchemaProperty rows
	
			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
			}


				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addSchemaPropertyElement($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initSchemaPropertyElements();
				$obj7->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyElementPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyElementPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except UserRelatedByCreatedUserId.
	 *
	 * @return array Array of SchemaPropertyElement objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPropertyPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElements();
				$obj3->addSchemaPropertyElement($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj4->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
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
					$temp_obj5->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except UserRelatedByUpdatedUserId.
	 *
	 * @return array Array of SchemaPropertyElement objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPropertyPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchemaPropertyRelatedBySchemaPropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj2->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElements();
				$obj3->addSchemaPropertyElement($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj4->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
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
					$temp_obj5->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except SchemaPropertyRelatedBySchemaPropertyId.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElements();
				$obj4->addSchemaPropertyElement($obj1);
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
					$temp_obj5->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except ProfileProperty.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
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
					$temp_obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaPropertyRelatedByRelatedSchemaPropertyId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj5->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
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
					$temp_obj6->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElements();
				$obj6->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except SchemaPropertyRelatedByRelatedSchemaPropertyId.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfileProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElements();
				$obj4->addSchemaPropertyElement($obj1);
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
					$temp_obj5->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaPropertyElement objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of SchemaPropertyElement objects.
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

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyElementPeer::NUM_COLUMNS - SchemaPropertyElementPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyElementPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyElementPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyElementsRelatedByCreatedUserId();
				$obj2->addSchemaPropertyElementRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertyElementsRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyElementRelatedByUpdatedUserId($obj1);
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
					$temp_obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertyElementsRelatedBySchemaPropertyId();
				$obj4->addSchemaPropertyElementRelatedBySchemaPropertyId($obj1);
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
					$temp_obj5->addSchemaPropertyElement($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertyElements();
				$obj5->addSchemaPropertyElement($obj1);
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
					$temp_obj6->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initSchemaPropertyElementsRelatedByRelatedSchemaPropertyId();
				$obj6->addSchemaPropertyElementRelatedByRelatedSchemaPropertyId($obj1);
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
		return SchemaPropertyElementPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SchemaPropertyElement or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElement object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyElementPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from SchemaPropertyElement object
		}

		$criteria->remove(SchemaPropertyElementPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseSchemaPropertyElementPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SchemaPropertyElement or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElement object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyElementPeer', $values, $con);
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

			$comparison = $criteria->getComparison(SchemaPropertyElementPeer::ID);
			$selectCriteria->add(SchemaPropertyElementPeer::ID, $criteria->remove(SchemaPropertyElementPeer::ID), $comparison);

		} else { // $values is SchemaPropertyElement object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyElementPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyElementPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_schema_property_element table.
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
			$affectedRows += BasePeer::doDeleteAll(SchemaPropertyElementPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SchemaPropertyElement or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyElement object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchemaPropertyElementPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SchemaPropertyElement) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchemaPropertyElementPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SchemaPropertyElement object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SchemaPropertyElement $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SchemaPropertyElement $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchemaPropertyElementPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchemaPropertyElementPeer::TABLE_NAME);

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

		return BasePeer::doValidate(SchemaPropertyElementPeer::DATABASE_NAME, SchemaPropertyElementPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     SchemaPropertyElement
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SchemaPropertyElementPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyElementPeer::ID, $pk);


		$v = SchemaPropertyElementPeer::doSelect($criteria, $con);

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
			$criteria->add(SchemaPropertyElementPeer::ID, $pks, Criteria::IN);
			$objs = SchemaPropertyElementPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSchemaPropertyElementPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSchemaPropertyElementPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/SchemaPropertyElementMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchemaPropertyElementMapBuilder');
}
