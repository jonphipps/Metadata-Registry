<?php

/**
 * Base static class for performing query and update operations on the 'reg_schema_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_schema_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SchemaProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 21;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_schema_property.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_schema_property.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_schema_property.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_schema_property.DELETED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_schema_property.CREATED_USER_ID';

	/** the column name for the UPDATED_USER_ID field */
	const UPDATED_USER_ID = 'reg_schema_property.UPDATED_USER_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_schema_property.SCHEMA_ID';

	/** the column name for the NAME field */
	const NAME = 'reg_schema_property.NAME';

	/** the column name for the LABEL field */
	const LABEL = 'reg_schema_property.LABEL';

	/** the column name for the DEFINITION field */
	const DEFINITION = 'reg_schema_property.DEFINITION';

	/** the column name for the COMMENT field */
	const COMMENT = 'reg_schema_property.COMMENT';

	/** the column name for the TYPE field */
	const TYPE = 'reg_schema_property.TYPE';

	/** the column name for the IS_SUBPROPERTY_OF field */
	const IS_SUBPROPERTY_OF = 'reg_schema_property.IS_SUBPROPERTY_OF';

	/** the column name for the PARENT_URI field */
	const PARENT_URI = 'reg_schema_property.PARENT_URI';

	/** the column name for the URI field */
	const URI = 'reg_schema_property.URI';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_schema_property.STATUS_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_schema_property.LANGUAGE';

	/** the column name for the NOTE field */
	const NOTE = 'reg_schema_property.NOTE';

	/** the column name for the DOMAIN field */
	const DOMAIN = 'reg_schema_property.DOMAIN';

	/** the column name for the ORANGE field */
	const ORANGE = 'reg_schema_property.ORANGE';

	/** the column name for the IS_DEPRECATED field */
	const IS_DEPRECATED = 'reg_schema_property.IS_DEPRECATED';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedUserId', 'UpdatedUserId', 'SchemaId', 'Name', 'Label', 'Definition', 'Comment', 'Type', 'IsSubpropertyOf', 'ParentUri', 'Uri', 'StatusId', 'Language', 'Note', 'Domain', 'Orange', 'IsDeprecated', ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyPeer::ID, SchemaPropertyPeer::CREATED_AT, SchemaPropertyPeer::UPDATED_AT, SchemaPropertyPeer::DELETED_AT, SchemaPropertyPeer::CREATED_USER_ID, SchemaPropertyPeer::UPDATED_USER_ID, SchemaPropertyPeer::SCHEMA_ID, SchemaPropertyPeer::NAME, SchemaPropertyPeer::LABEL, SchemaPropertyPeer::DEFINITION, SchemaPropertyPeer::COMMENT, SchemaPropertyPeer::TYPE, SchemaPropertyPeer::IS_SUBPROPERTY_OF, SchemaPropertyPeer::PARENT_URI, SchemaPropertyPeer::URI, SchemaPropertyPeer::STATUS_ID, SchemaPropertyPeer::LANGUAGE, SchemaPropertyPeer::NOTE, SchemaPropertyPeer::DOMAIN, SchemaPropertyPeer::ORANGE, SchemaPropertyPeer::IS_DEPRECATED, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'created_user_id', 'updated_user_id', 'schema_id', 'name', 'label', 'definition', 'comment', 'type', 'is_subproperty_of', 'parent_uri', 'uri', 'status_id', 'language', 'note', 'domain', 'orange', 'is_deprecated', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'CreatedUserId' => 4, 'UpdatedUserId' => 5, 'SchemaId' => 6, 'Name' => 7, 'Label' => 8, 'Definition' => 9, 'Comment' => 10, 'Type' => 11, 'IsSubpropertyOf' => 12, 'ParentUri' => 13, 'Uri' => 14, 'StatusId' => 15, 'Language' => 16, 'Note' => 17, 'Domain' => 18, 'Orange' => 19, 'IsDeprecated' => 20, ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyPeer::ID => 0, SchemaPropertyPeer::CREATED_AT => 1, SchemaPropertyPeer::UPDATED_AT => 2, SchemaPropertyPeer::DELETED_AT => 3, SchemaPropertyPeer::CREATED_USER_ID => 4, SchemaPropertyPeer::UPDATED_USER_ID => 5, SchemaPropertyPeer::SCHEMA_ID => 6, SchemaPropertyPeer::NAME => 7, SchemaPropertyPeer::LABEL => 8, SchemaPropertyPeer::DEFINITION => 9, SchemaPropertyPeer::COMMENT => 10, SchemaPropertyPeer::TYPE => 11, SchemaPropertyPeer::IS_SUBPROPERTY_OF => 12, SchemaPropertyPeer::PARENT_URI => 13, SchemaPropertyPeer::URI => 14, SchemaPropertyPeer::STATUS_ID => 15, SchemaPropertyPeer::LANGUAGE => 16, SchemaPropertyPeer::NOTE => 17, SchemaPropertyPeer::DOMAIN => 18, SchemaPropertyPeer::ORANGE => 19, SchemaPropertyPeer::IS_DEPRECATED => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'created_user_id' => 4, 'updated_user_id' => 5, 'schema_id' => 6, 'name' => 7, 'label' => 8, 'definition' => 9, 'comment' => 10, 'type' => 11, 'is_subproperty_of' => 12, 'parent_uri' => 13, 'uri' => 14, 'status_id' => 15, 'language' => 16, 'note' => 17, 'domain' => 18, 'orange' => 19, 'is_deprecated' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchemaPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchemaPropertyMapBuilder');
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
			$map = SchemaPropertyPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SchemaPropertyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchemaPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::ID) : SchemaPropertyPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::CREATED_AT) : SchemaPropertyPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::UPDATED_AT) : SchemaPropertyPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::DELETED_AT) : SchemaPropertyPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::CREATED_USER_ID) : SchemaPropertyPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::UPDATED_USER_ID) : SchemaPropertyPeer::UPDATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::SCHEMA_ID) : SchemaPropertyPeer::SCHEMA_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::NAME) : SchemaPropertyPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::LABEL) : SchemaPropertyPeer::LABEL);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::DEFINITION) : SchemaPropertyPeer::DEFINITION);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::COMMENT) : SchemaPropertyPeer::COMMENT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::TYPE) : SchemaPropertyPeer::TYPE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::IS_SUBPROPERTY_OF) : SchemaPropertyPeer::IS_SUBPROPERTY_OF);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::PARENT_URI) : SchemaPropertyPeer::PARENT_URI);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::URI) : SchemaPropertyPeer::URI);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::STATUS_ID) : SchemaPropertyPeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::LANGUAGE) : SchemaPropertyPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::NOTE) : SchemaPropertyPeer::NOTE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::DOMAIN) : SchemaPropertyPeer::DOMAIN);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::ORANGE) : SchemaPropertyPeer::ORANGE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyPeer::alias($tableAlias, SchemaPropertyPeer::IS_DEPRECATED) : SchemaPropertyPeer::IS_DEPRECATED);

	}

	const COUNT = 'COUNT(reg_schema_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_schema_property.ID)';

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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
	 * @return     SchemaProperty
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchemaPropertyPeer::doSelect($critcopy, $con);
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
		return SchemaPropertyPeer::populateObjects(SchemaPropertyPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchemaPropertyPeer::addSelectColumns($criteria);
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
		$cls = SchemaPropertyPeer::getOMClass();
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with their User objects.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyRelatedByCreatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByCreatedUserId();
				$obj2->addSchemaPropertyRelatedByCreatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with their User objects.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyRelatedByUpdatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByUpdatedUserId();
				$obj2->addSchemaPropertyRelatedByUpdatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with their Schema objects.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertys();
				$obj2->addSchemaProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with their Status objects.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertys();
				$obj2->addSchemaProperty($obj1); //CHECKME
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::alias('a3', SchemaPeer::ID));
        $c->addAlias('a3', SchemaPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a5');
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::alias('a5', StatusPeer::ID));
        $c->addAlias('a5', StatusPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();


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
					$temp_obj2->addSchemaPropertyRelatedByCreatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByCreatedUserId();
				$obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertysRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
			}


				// Add objects for joined Schema rows
	
			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchema(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertys();
				$obj4->addSchemaProperty($obj1);
			}


				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addSchemaProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertys();
				$obj5->addSchemaProperty($obj1);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaPropertyRelatedByIsSubpropertyOf table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchemaPropertyRelatedByIsSubpropertyOf(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects except UserRelatedByCreatedUserId.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertys();
				$obj2->addSchemaProperty($obj1);
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
					$temp_obj3->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertys();
				$obj3->addSchemaProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects except UserRelatedByUpdatedUserId.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertys();
				$obj2->addSchemaProperty($obj1);
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
					$temp_obj3->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertys();
				$obj3->addSchemaProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByCreatedUserId();
				$obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertysRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertys();
				$obj4->addSchemaProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects except SchemaPropertyRelatedByIsSubpropertyOf.
	 *
	 * @return array Array of SchemaProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchemaPropertyRelatedByIsSubpropertyOf(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(SchemaPropertyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByCreatedUserId();
				$obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertysRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
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
					$temp_obj4->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertys();
				$obj4->addSchemaProperty($obj1);
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
					$temp_obj5->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initSchemaPropertys();
				$obj5->addSchemaProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of SchemaProperty objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of SchemaProperty objects.
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

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyPeer::NUM_COLUMNS - SchemaPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(SchemaPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertysRelatedByCreatedUserId();
				$obj2->addSchemaPropertyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSchemaPropertysRelatedByUpdatedUserId();
				$obj3->addSchemaPropertyRelatedByUpdatedUserId($obj1);
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
					$temp_obj4->addSchemaProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initSchemaPropertys();
				$obj4->addSchemaProperty($obj1);
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
		return SchemaPropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SchemaProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from SchemaProperty object
		}

		$criteria->remove(SchemaPropertyPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SchemaProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con);
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

			$comparison = $criteria->getComparison(SchemaPropertyPeer::ID);
			$selectCriteria->add(SchemaPropertyPeer::ID, $criteria->remove(SchemaPropertyPeer::ID), $comparison);

		} else { // $values is SchemaProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_schema_property table.
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
			$affectedRows += BasePeer::doDeleteAll(SchemaPropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SchemaProperty or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SchemaProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchemaPropertyPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SchemaProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SchemaProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SchemaProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchemaPropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchemaPropertyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SchemaPropertyPeer::DATABASE_NAME, SchemaPropertyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SchemaPropertyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     SchemaProperty
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SchemaPropertyPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyPeer::ID, $pk);


		$v = SchemaPropertyPeer::doSelect($criteria, $con);

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
			$criteria->add(SchemaPropertyPeer::ID, $pks, Criteria::IN);
			$objs = SchemaPropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSchemaPropertyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSchemaPropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/SchemaPropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchemaPropertyMapBuilder');
}
