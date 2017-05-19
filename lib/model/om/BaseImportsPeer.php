<?php

/**
 * Base static class for performing query and update operations on the 'imports' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseImportsPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'imports';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Imports';

	/** The total number of columns. */
	const NUM_COLUMNS = 21;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'imports.ID';

	/** the column name for the SOURCE_FILE_NAME field */
	const SOURCE_FILE_NAME = 'imports.SOURCE_FILE_NAME';

	/** the column name for the SOURCE field */
	const SOURCE = 'imports.SOURCE';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'imports.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'imports.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'imports.DELETED_AT';

	/** the column name for the MAP field */
	const MAP = 'imports.MAP';

	/** the column name for the IMPORTED_BY field */
	const IMPORTED_BY = 'imports.IMPORTED_BY';

	/** the column name for the FILE_NAME field */
	const FILE_NAME = 'imports.FILE_NAME';

	/** the column name for the FILE_TYPE field */
	const FILE_TYPE = 'imports.FILE_TYPE';

	/** the column name for the RESULTS field */
	const RESULTS = 'imports.RESULTS';

	/** the column name for the TOTAL_PROCESSED_COUNT field */
	const TOTAL_PROCESSED_COUNT = 'imports.TOTAL_PROCESSED_COUNT';

	/** the column name for the ERROR_COUNT field */
	const ERROR_COUNT = 'imports.ERROR_COUNT';

	/** the column name for the SUCCESS_COUNT field */
	const SUCCESS_COUNT = 'imports.SUCCESS_COUNT';

	/** the column name for the BATCH_ID field */
	const BATCH_ID = 'imports.BATCH_ID';

	/** the column name for the THING_COLLECTION_ID field */
	const THING_COLLECTION_ID = 'imports.THING_COLLECTION_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'imports.VOCABULARY_ID';

	/** the column name for the ELEMENT_SET_ID field */
	const ELEMENT_SET_ID = 'imports.ELEMENT_SET_ID';

	/** the column name for the TOKEN field */
	const TOKEN = 'imports.TOKEN';

	/** the column name for the USER_ID field */
	const USER_ID = 'imports.USER_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'imports.SCHEMA_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'SourceFileName', 'Source', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'Map', 'ImportedBy', 'FileName', 'FileType', 'Results', 'TotalProcessedCount', 'ErrorCount', 'SuccessCount', 'BatchId', 'ThingCollectionId', 'VocabularyId', 'ElementSetId', 'Token', 'UserId', 'SchemaId', ),
		BasePeer::TYPE_COLNAME => array (ImportsPeer::ID, ImportsPeer::SOURCE_FILE_NAME, ImportsPeer::SOURCE, ImportsPeer::CREATED_AT, ImportsPeer::UPDATED_AT, ImportsPeer::DELETED_AT, ImportsPeer::MAP, ImportsPeer::IMPORTED_BY, ImportsPeer::FILE_NAME, ImportsPeer::FILE_TYPE, ImportsPeer::RESULTS, ImportsPeer::TOTAL_PROCESSED_COUNT, ImportsPeer::ERROR_COUNT, ImportsPeer::SUCCESS_COUNT, ImportsPeer::BATCH_ID, ImportsPeer::THING_COLLECTION_ID, ImportsPeer::VOCABULARY_ID, ImportsPeer::ELEMENT_SET_ID, ImportsPeer::TOKEN, ImportsPeer::USER_ID, ImportsPeer::SCHEMA_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'source_file_name', 'source', 'created_at', 'updated_at', 'deleted_at', 'map', 'imported_by', 'file_name', 'file_type', 'results', 'total_processed_count', 'error_count', 'success_count', 'batch_id', 'thing_collection_id', 'vocabulary_id', 'element_set_id', 'token', 'user_id', 'schema_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'SourceFileName' => 1, 'Source' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'DeletedAt' => 5, 'Map' => 6, 'ImportedBy' => 7, 'FileName' => 8, 'FileType' => 9, 'Results' => 10, 'TotalProcessedCount' => 11, 'ErrorCount' => 12, 'SuccessCount' => 13, 'BatchId' => 14, 'ThingCollectionId' => 15, 'VocabularyId' => 16, 'ElementSetId' => 17, 'Token' => 18, 'UserId' => 19, 'SchemaId' => 20, ),
		BasePeer::TYPE_COLNAME => array (ImportsPeer::ID => 0, ImportsPeer::SOURCE_FILE_NAME => 1, ImportsPeer::SOURCE => 2, ImportsPeer::CREATED_AT => 3, ImportsPeer::UPDATED_AT => 4, ImportsPeer::DELETED_AT => 5, ImportsPeer::MAP => 6, ImportsPeer::IMPORTED_BY => 7, ImportsPeer::FILE_NAME => 8, ImportsPeer::FILE_TYPE => 9, ImportsPeer::RESULTS => 10, ImportsPeer::TOTAL_PROCESSED_COUNT => 11, ImportsPeer::ERROR_COUNT => 12, ImportsPeer::SUCCESS_COUNT => 13, ImportsPeer::BATCH_ID => 14, ImportsPeer::THING_COLLECTION_ID => 15, ImportsPeer::VOCABULARY_ID => 16, ImportsPeer::ELEMENT_SET_ID => 17, ImportsPeer::TOKEN => 18, ImportsPeer::USER_ID => 19, ImportsPeer::SCHEMA_ID => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'source_file_name' => 1, 'source' => 2, 'created_at' => 3, 'updated_at' => 4, 'deleted_at' => 5, 'map' => 6, 'imported_by' => 7, 'file_name' => 8, 'file_type' => 9, 'results' => 10, 'total_processed_count' => 11, 'error_count' => 12, 'success_count' => 13, 'batch_id' => 14, 'thing_collection_id' => 15, 'vocabulary_id' => 16, 'element_set_id' => 17, 'token' => 18, 'user_id' => 19, 'schema_id' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ImportsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ImportsMapBuilder');
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
			$map = ImportsPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ImportsPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ImportsPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::ID) : ImportsPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::SOURCE_FILE_NAME) : ImportsPeer::SOURCE_FILE_NAME);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::SOURCE) : ImportsPeer::SOURCE);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::CREATED_AT) : ImportsPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::UPDATED_AT) : ImportsPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::DELETED_AT) : ImportsPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::MAP) : ImportsPeer::MAP);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::IMPORTED_BY) : ImportsPeer::IMPORTED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::FILE_NAME) : ImportsPeer::FILE_NAME);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::FILE_TYPE) : ImportsPeer::FILE_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::RESULTS) : ImportsPeer::RESULTS);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::TOTAL_PROCESSED_COUNT) : ImportsPeer::TOTAL_PROCESSED_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::ERROR_COUNT) : ImportsPeer::ERROR_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::SUCCESS_COUNT) : ImportsPeer::SUCCESS_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::BATCH_ID) : ImportsPeer::BATCH_ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::THING_COLLECTION_ID) : ImportsPeer::THING_COLLECTION_ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::VOCABULARY_ID) : ImportsPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::ELEMENT_SET_ID) : ImportsPeer::ELEMENT_SET_ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::TOKEN) : ImportsPeer::TOKEN);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::USER_ID) : ImportsPeer::USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? ImportsPeer::alias($tableAlias, ImportsPeer::SCHEMA_ID) : ImportsPeer::SCHEMA_ID);

	}

	const COUNT = 'COUNT(imports.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT imports.ID)';

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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ImportsPeer::doSelectRS($criteria, $con);
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
	 * @return     Imports
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ImportsPeer::doSelect($critcopy, $con);
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
		return ImportsPeer::populateObjects(ImportsPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseImportsPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseImportsPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ImportsPeer::addSelectColumns($criteria);
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
		$cls = ImportsPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByImportedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByImportedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Imports objects pre-filled with their Users objects.
	 *
	 * @return array Array of Imports objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByImportedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImportsPeer::addSelectColumns($c);
		$startcol = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByImportedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addImportsRelatedByImportedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initImportssRelatedByImportedBy();
				$obj2->addImportsRelatedByImportedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of Imports objects.
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

		ImportsPeer::addSelectColumns($c);
		$startcol = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

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
					$temp_obj2->addImports($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initImportss();
				$obj2->addImports($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with their Users objects.
	 *
	 * @return array Array of Imports objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImportsPeer::addSelectColumns($c);
		$startcol = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addImportsRelatedByUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initImportssRelatedByUserId();
				$obj2->addImportsRelatedByUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with their Schema objects.
	 *
	 * @return array Array of Imports objects.
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

		ImportsPeer::addSelectColumns($c);
		$startcol = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

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
					$temp_obj2->addImports($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initImportss();
				$obj2->addImports($obj1); //CHECKME
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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$criteria->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);

		$criteria->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Imports objects pre-filled with all related objects.
	 *
	 * @return array Array of Imports objects.
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

		ImportsPeer::addSelectColumns($c);
		$startcol2 = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::alias('a1', UsersPeer::ID));
        $c->addAlias('a1', UsersPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::alias('a2', VocabularyPeer::ID));
        $c->addAlias('a2', VocabularyPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ImportsPeer::USER_ID, UsersPeer::alias('a3', UsersPeer::ID));
        $c->addAlias('a3', UsersPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::alias('a4', SchemaPeer::ID));
        $c->addAlias('a4', SchemaPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUsersRelatedByImportedBy(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImportsRelatedByImportedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initImportssRelatedByImportedBy();
				$obj2->addImportsRelatedByImportedBy($obj1);
			}


				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addImports($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initImportss();
				$obj3->addImports($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByUserId(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addImportsRelatedByUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initImportssRelatedByUserId();
				$obj4->addImportsRelatedByUserId($obj1);
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
					$temp_obj5->addImports($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initImportss();
				$obj5->addImports($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByImportedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByImportedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$criteria->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);

		$criteria->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ImportsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImportsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$criteria->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);

		$rs = ImportsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Imports objects pre-filled with all related objects except UsersRelatedByImportedBy.
	 *
	 * @return array Array of Imports objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByImportedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImportsPeer::addSelectColumns($c);
		$startcol2 = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initImportss();
				$obj2->addImports($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initImportss();
				$obj3->addImports($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of Imports objects.
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

		ImportsPeer::addSelectColumns($c);
		$startcol2 = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$c->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);

		$c->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUsersRelatedByImportedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImportsRelatedByImportedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initImportssRelatedByImportedBy();
				$obj2->addImportsRelatedByImportedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addImportsRelatedByUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initImportssRelatedByUserId();
				$obj3->addImportsRelatedByUserId($obj1);
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
					$temp_obj4->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initImportss();
				$obj4->addImports($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with all related objects except UsersRelatedByUserId.
	 *
	 * @return array Array of Imports objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImportsPeer::addSelectColumns($c);
		$startcol2 = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ImportsPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initImportss();
				$obj2->addImports($obj1);
			}

			$omClass = SchemaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSchema(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initImportss();
				$obj3->addImports($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Imports objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of Imports objects.
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

		ImportsPeer::addSelectColumns($c);
		$startcol2 = (ImportsPeer::NUM_COLUMNS - ImportsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ImportsPeer::IMPORTED_BY, UsersPeer::ID);

		$c->addJoin(ImportsPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ImportsPeer::USER_ID, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImportsPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUsersRelatedByImportedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImportsRelatedByImportedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initImportssRelatedByImportedBy();
				$obj2->addImportsRelatedByImportedBy($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addImports($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initImportss();
				$obj3->addImports($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByUserId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addImportsRelatedByUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initImportssRelatedByUserId();
				$obj4->addImportsRelatedByUserId($obj1);
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
		return ImportsPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Imports or Criteria object.
	 *
	 * @param      mixed $values Criteria or Imports object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseImportsPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseImportsPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Imports object
		}

		$criteria->remove(ImportsPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseImportsPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseImportsPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Imports or Criteria object.
	 *
	 * @param      mixed $values Criteria or Imports object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseImportsPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseImportsPeer', $values, $con);
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

			$comparison = $criteria->getComparison(ImportsPeer::ID);
			$selectCriteria->add(ImportsPeer::ID, $criteria->remove(ImportsPeer::ID), $comparison);

		} else { // $values is Imports object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseImportsPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseImportsPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the imports table.
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
			$affectedRows += BasePeer::doDeleteAll(ImportsPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Imports or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Imports object or primary key or array of primary keys
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
			$con = Propel::getConnection(ImportsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Imports) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ImportsPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Imports object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Imports $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Imports $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ImportsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ImportsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ImportsPeer::DATABASE_NAME, ImportsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ImportsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Imports
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ImportsPeer::DATABASE_NAME);

		$criteria->add(ImportsPeer::ID, $pk);


		$v = ImportsPeer::doSelect($criteria, $con);

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
			$criteria->add(ImportsPeer::ID, $pks, Criteria::IN);
			$objs = ImportsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseImportsPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseImportsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ImportsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ImportsMapBuilder');
}
