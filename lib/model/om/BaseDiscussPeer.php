<?php

/**
 * Base static class for performing query and update operations on the 'reg_discuss' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDiscussPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_discuss';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Discuss';

	/** The total number of columns. */
	const NUM_COLUMNS = 20;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_discuss.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_discuss.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_discuss.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_discuss.DELETED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_discuss.CREATED_USER_ID';

	/** the column name for the DELETED_USER_ID field */
	const DELETED_USER_ID = 'reg_discuss.DELETED_USER_ID';

	/** the column name for the URI field */
	const URI = 'reg_discuss.URI';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_discuss.SCHEMA_ID';

	/** the column name for the SCHEMA_PROPERTY_ID field */
	const SCHEMA_PROPERTY_ID = 'reg_discuss.SCHEMA_PROPERTY_ID';

	/** the column name for the SCHEMA_PROPERTY_ELEMENT_ID field */
	const SCHEMA_PROPERTY_ELEMENT_ID = 'reg_discuss.SCHEMA_PROPERTY_ELEMENT_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_discuss.VOCABULARY_ID';

	/** the column name for the CONCEPT_ID field */
	const CONCEPT_ID = 'reg_discuss.CONCEPT_ID';

	/** the column name for the CONCEPT_PROPERTY_ID field */
	const CONCEPT_PROPERTY_ID = 'reg_discuss.CONCEPT_PROPERTY_ID';

	/** the column name for the ROOT_ID field */
	const ROOT_ID = 'reg_discuss.ROOT_ID';

	/** the column name for the PARENT_ID field */
	const PARENT_ID = 'reg_discuss.PARENT_ID';

	/** the column name for the SUBJECT field */
	const SUBJECT = 'reg_discuss.SUBJECT';

	/** the column name for the CONTENT field */
	const CONTENT = 'reg_discuss.CONTENT';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'reg_discuss.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'reg_discuss.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'reg_discuss.DELETED_BY';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedUserId', 'DeletedUserId', 'Uri', 'SchemaId', 'SchemaPropertyId', 'SchemaPropertyElementId', 'VocabularyId', 'ConceptId', 'ConceptPropertyId', 'RootId', 'ParentId', 'Subject', 'Content', 'CreatedBy', 'UpdatedBy', 'DeletedBy', ),
		BasePeer::TYPE_COLNAME => array (DiscussPeer::ID, DiscussPeer::CREATED_AT, DiscussPeer::UPDATED_AT, DiscussPeer::DELETED_AT, DiscussPeer::CREATED_USER_ID, DiscussPeer::DELETED_USER_ID, DiscussPeer::URI, DiscussPeer::SCHEMA_ID, DiscussPeer::SCHEMA_PROPERTY_ID, DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, DiscussPeer::VOCABULARY_ID, DiscussPeer::CONCEPT_ID, DiscussPeer::CONCEPT_PROPERTY_ID, DiscussPeer::ROOT_ID, DiscussPeer::PARENT_ID, DiscussPeer::SUBJECT, DiscussPeer::CONTENT, DiscussPeer::CREATED_BY, DiscussPeer::UPDATED_BY, DiscussPeer::DELETED_BY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'created_user_id', 'deleted_user_id', 'uri', 'schema_id', 'schema_property_id', 'schema_property_element_id', 'vocabulary_id', 'concept_id', 'concept_property_id', 'root_id', 'parent_id', 'subject', 'content', 'created_by', 'updated_by', 'deleted_by', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'CreatedUserId' => 4, 'DeletedUserId' => 5, 'Uri' => 6, 'SchemaId' => 7, 'SchemaPropertyId' => 8, 'SchemaPropertyElementId' => 9, 'VocabularyId' => 10, 'ConceptId' => 11, 'ConceptPropertyId' => 12, 'RootId' => 13, 'ParentId' => 14, 'Subject' => 15, 'Content' => 16, 'CreatedBy' => 17, 'UpdatedBy' => 18, 'DeletedBy' => 19, ),
		BasePeer::TYPE_COLNAME => array (DiscussPeer::ID => 0, DiscussPeer::CREATED_AT => 1, DiscussPeer::UPDATED_AT => 2, DiscussPeer::DELETED_AT => 3, DiscussPeer::CREATED_USER_ID => 4, DiscussPeer::DELETED_USER_ID => 5, DiscussPeer::URI => 6, DiscussPeer::SCHEMA_ID => 7, DiscussPeer::SCHEMA_PROPERTY_ID => 8, DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID => 9, DiscussPeer::VOCABULARY_ID => 10, DiscussPeer::CONCEPT_ID => 11, DiscussPeer::CONCEPT_PROPERTY_ID => 12, DiscussPeer::ROOT_ID => 13, DiscussPeer::PARENT_ID => 14, DiscussPeer::SUBJECT => 15, DiscussPeer::CONTENT => 16, DiscussPeer::CREATED_BY => 17, DiscussPeer::UPDATED_BY => 18, DiscussPeer::DELETED_BY => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'created_user_id' => 4, 'deleted_user_id' => 5, 'uri' => 6, 'schema_id' => 7, 'schema_property_id' => 8, 'schema_property_element_id' => 9, 'vocabulary_id' => 10, 'concept_id' => 11, 'concept_property_id' => 12, 'root_id' => 13, 'parent_id' => 14, 'subject' => 15, 'content' => 16, 'created_by' => 17, 'updated_by' => 18, 'deleted_by' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DiscussMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DiscussMapBuilder');
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
			$map = DiscussPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. DiscussPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(DiscussPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::ID) : DiscussPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CREATED_AT) : DiscussPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::UPDATED_AT) : DiscussPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::DELETED_AT) : DiscussPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CREATED_USER_ID) : DiscussPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::DELETED_USER_ID) : DiscussPeer::DELETED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::URI) : DiscussPeer::URI);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::SCHEMA_ID) : DiscussPeer::SCHEMA_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::SCHEMA_PROPERTY_ID) : DiscussPeer::SCHEMA_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID) : DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::VOCABULARY_ID) : DiscussPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CONCEPT_ID) : DiscussPeer::CONCEPT_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CONCEPT_PROPERTY_ID) : DiscussPeer::CONCEPT_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::ROOT_ID) : DiscussPeer::ROOT_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::PARENT_ID) : DiscussPeer::PARENT_ID);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::SUBJECT) : DiscussPeer::SUBJECT);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CONTENT) : DiscussPeer::CONTENT);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::CREATED_BY) : DiscussPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::UPDATED_BY) : DiscussPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? DiscussPeer::alias($tableAlias, DiscussPeer::DELETED_BY) : DiscussPeer::DELETED_BY);

	}

	const COUNT = 'COUNT(reg_discuss.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_discuss.ID)';

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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DiscussPeer::doSelectRS($criteria, $con);
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
	 * @return     Discuss
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DiscussPeer::doSelect($critcopy, $con);
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
		return DiscussPeer::populateObjects(DiscussPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseDiscussPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDiscussPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DiscussPeer::addSelectColumns($criteria);
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
		$cls = DiscussPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByDeletedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSchemaProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Vocabulary table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concept table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinConcept(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Users objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Users objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByDeletedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscussRelatedByDeletedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusssRelatedByDeletedUserId();
				$obj2->addDiscussRelatedByDeletedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Schema objects.
	 *
	 * @return array Array of Discuss objects.
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

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSchemaProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SchemaPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their SchemaPropertyElement objects.
	 *
	 * @return array Array of Discuss objects.
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

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyElementPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Concept objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConcept(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their ConceptProperty objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPropertyPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscuss($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Users objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscussRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedBy();
				$obj2->addDiscussRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with their Users objects.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addDiscussRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscusssRelatedByDeletedBy();
				$obj2->addDiscussRelatedByDeletedBy($obj1); //CHECKME
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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects.
	 *
	 * @return array Array of Discuss objects.
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

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::alias('a1', UsersPeer::ID));
        $c->addAlias('a1', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::alias('a2', UsersPeer::ID));
        $c->addAlias('a2', UsersPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::alias('a3', SchemaPeer::ID));
        $c->addAlias('a3', SchemaPeer::TABLE_NAME);

		SchemaPropertyPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::alias('a4', SchemaPropertyPeer::ID));
        $c->addAlias('a4', SchemaPropertyPeer::TABLE_NAME);

		SchemaPropertyElementPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::alias('a5', SchemaPropertyElementPeer::ID));
        $c->addAlias('a5', SchemaPropertyElementPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::alias('a6', VocabularyPeer::ID));
        $c->addAlias('a6', VocabularyPeer::TABLE_NAME);

		ConceptPeer::addSelectColumns($c, 'a7');
		$startcol9 = $startcol8 + ConceptPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::alias('a7', ConceptPeer::ID));
        $c->addAlias('a7', ConceptPeer::TABLE_NAME);

		ConceptPropertyPeer::addSelectColumns($c, 'a8');
		$startcol10 = $startcol9 + ConceptPropertyPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::alias('a8', ConceptPropertyPeer::ID));
        $c->addAlias('a8', ConceptPropertyPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a11');
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::alias('a11', UsersPeer::ID));
        $c->addAlias('a11', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a12');
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::alias('a12', UsersPeer::ID));
        $c->addAlias('a12', UsersPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}


				// Add objects for joined SchemaProperty rows
	
			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}


				// Add objects for joined SchemaPropertyElement rows
	
			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}


				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getVocabulary(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}


				// Add objects for joined Concept rows
	
			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConcept(); // CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}


				// Add objects for joined ConceptProperty rows
	
			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getConceptProperty(); // CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscuss($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusss();
				$obj9->addDiscuss($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10 = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByCreatedBy(); // CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByCreatedBy();
				$obj10->addDiscussRelatedByCreatedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11 = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByDeletedBy(); // CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addDiscussRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj11->initDiscusssRelatedByDeletedBy();
				$obj11->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByDeletedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related SchemaProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSchemaProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Vocabulary table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concept table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConcept(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related DiscussRelatedByRootId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptDiscussRelatedByRootId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related DiscussRelatedByParentId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptDiscussRelatedByParentId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscussPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscussPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$criteria->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$criteria->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = DiscussPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except UsersRelatedByCreatedUserId.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusss();
				$obj3->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except UsersRelatedByDeletedUserId.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByDeletedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusss();
				$obj3->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of Discuss objects.
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

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except SchemaProperty.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSchemaProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except SchemaPropertyElement.
	 *
	 * @return array Array of Discuss objects.
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

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except Concept.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConcept(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + VocabularyPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except ConceptProperty.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusssRelatedByCreatedBy();
				$obj9->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByDeletedBy();
				$obj10->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except DiscussRelatedByRootId.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptDiscussRelatedByRootId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusss();
				$obj9->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByCreatedBy();
				$obj10->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initDiscusssRelatedByDeletedBy();
				$obj11->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except DiscussRelatedByParentId.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptDiscussRelatedByParentId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + ConceptPropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(DiscussPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(DiscussPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDiscussRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusssRelatedByCreatedUserId();
				$obj2->addDiscussRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscussRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusssRelatedByDeletedUserId();
				$obj3->addDiscussRelatedByDeletedUserId($obj1);
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
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initDiscusss();
				$obj8->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initDiscusss();
				$obj9->addDiscuss($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addDiscussRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initDiscusssRelatedByCreatedBy();
				$obj10->addDiscussRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addDiscussRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initDiscusssRelatedByDeletedBy();
				$obj11->addDiscussRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except UsersRelatedByCreatedBy.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusss();
				$obj3->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Discuss objects pre-filled with all related objects except UsersRelatedByDeletedBy.
	 *
	 * @return array Array of Discuss objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DiscussPeer::addSelectColumns($c);
		$startcol2 = (DiscussPeer::NUM_COLUMNS - DiscussPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SchemaPeer::NUM_COLUMNS;

		SchemaPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPropertyPeer::NUM_COLUMNS;

		SchemaPropertyElementPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPropertyElementPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(DiscussPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ID, SchemaPropertyPeer::ID);

		$c->addJoin(DiscussPeer::SCHEMA_PROPERTY_ELEMENT_ID, SchemaPropertyElementPeer::ID);

		$c->addJoin(DiscussPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(DiscussPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscussPeer::getOMClass();

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
					$temp_obj2->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscusss();
				$obj2->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchemaProperty(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDiscusss();
				$obj3->addDiscuss($obj1);
			}

			$omClass = SchemaPropertyElementPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSchemaPropertyElement(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDiscusss();
				$obj4->addDiscuss($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDiscusss();
				$obj5->addDiscuss($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConcept(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDiscusss();
				$obj6->addDiscuss($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addDiscuss($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initDiscusss();
				$obj7->addDiscuss($obj1);
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
		return DiscussPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Discuss or Criteria object.
	 *
	 * @param      mixed $values Criteria or Discuss object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDiscussPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDiscussPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Discuss object
		}

		$criteria->remove(DiscussPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseDiscussPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDiscussPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Discuss or Criteria object.
	 *
	 * @param      mixed $values Criteria or Discuss object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDiscussPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDiscussPeer', $values, $con);
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

			$comparison = $criteria->getComparison(DiscussPeer::ID);
			$selectCriteria->add(DiscussPeer::ID, $criteria->remove(DiscussPeer::ID), $comparison);

		} else { // $values is Discuss object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDiscussPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDiscussPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_discuss table.
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
			$affectedRows += BasePeer::doDeleteAll(DiscussPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Discuss or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Discuss object or primary key or array of primary keys
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
			$con = Propel::getConnection(DiscussPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Discuss) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DiscussPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Discuss object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Discuss $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Discuss $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DiscussPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DiscussPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DiscussPeer::DATABASE_NAME, DiscussPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DiscussPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Discuss
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DiscussPeer::DATABASE_NAME);

		$criteria->add(DiscussPeer::ID, $pk);


		$v = DiscussPeer::doSelect($criteria, $con);

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
			$criteria->add(DiscussPeer::ID, $pks, Criteria::IN);
			$objs = DiscussPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseDiscussPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseDiscussPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/DiscussMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DiscussMapBuilder');
}
