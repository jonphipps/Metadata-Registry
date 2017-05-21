<?php

/**
 * Base static class for performing query and update operations on the 'reg_file_import_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseFileImportHistoryPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_file_import_history';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.FileImportHistory';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_file_import_history.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_file_import_history.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_file_import_history.UPDATED_AT';

	/** the column name for the MAP field */
	const MAP = 'reg_file_import_history.MAP';

	/** the column name for the USER_ID field */
	const USER_ID = 'reg_file_import_history.USER_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_file_import_history.VOCABULARY_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_file_import_history.SCHEMA_ID';

	/** the column name for the FILE_NAME field */
	const FILE_NAME = 'reg_file_import_history.FILE_NAME';

	/** the column name for the SOURCE field */
	const SOURCE = 'reg_file_import_history.SOURCE';

	/** the column name for the SOURCE_FILE_NAME field */
	const SOURCE_FILE_NAME = 'reg_file_import_history.SOURCE_FILE_NAME';

	/** the column name for the FILE_TYPE field */
	const FILE_TYPE = 'reg_file_import_history.FILE_TYPE';

	/** the column name for the BATCH_ID field */
	const BATCH_ID = 'reg_file_import_history.BATCH_ID';

	/** the column name for the RESULTS field */
	const RESULTS = 'reg_file_import_history.RESULTS';

	/** the column name for the TOTAL_PROCESSED_COUNT field */
	const TOTAL_PROCESSED_COUNT = 'reg_file_import_history.TOTAL_PROCESSED_COUNT';

	/** the column name for the ERROR_COUNT field */
	const ERROR_COUNT = 'reg_file_import_history.ERROR_COUNT';

	/** the column name for the SUCCESS_COUNT field */
	const SUCCESS_COUNT = 'reg_file_import_history.SUCCESS_COUNT';

	/** the column name for the TOKEN field */
	const TOKEN = 'reg_file_import_history.TOKEN';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'Map', 'UserId', 'VocabularyId', 'SchemaId', 'FileName', 'Source', 'SourceFileName', 'FileType', 'BatchId', 'Results', 'TotalProcessedCount', 'ErrorCount', 'SuccessCount', 'Token', ),
		BasePeer::TYPE_COLNAME => array (FileImportHistoryPeer::ID, FileImportHistoryPeer::CREATED_AT, FileImportHistoryPeer::UPDATED_AT, FileImportHistoryPeer::MAP, FileImportHistoryPeer::USER_ID, FileImportHistoryPeer::VOCABULARY_ID, FileImportHistoryPeer::SCHEMA_ID, FileImportHistoryPeer::FILE_NAME, FileImportHistoryPeer::SOURCE, FileImportHistoryPeer::SOURCE_FILE_NAME, FileImportHistoryPeer::FILE_TYPE, FileImportHistoryPeer::BATCH_ID, FileImportHistoryPeer::RESULTS, FileImportHistoryPeer::TOTAL_PROCESSED_COUNT, FileImportHistoryPeer::ERROR_COUNT, FileImportHistoryPeer::SUCCESS_COUNT, FileImportHistoryPeer::TOKEN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'map', 'user_id', 'vocabulary_id', 'schema_id', 'file_name', 'source', 'source_file_name', 'file_type', 'batch_id', 'results', 'total_processed_count', 'error_count', 'success_count', 'token', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'Map' => 3, 'UserId' => 4, 'VocabularyId' => 5, 'SchemaId' => 6, 'FileName' => 7, 'Source' => 8, 'SourceFileName' => 9, 'FileType' => 10, 'BatchId' => 11, 'Results' => 12, 'TotalProcessedCount' => 13, 'ErrorCount' => 14, 'SuccessCount' => 15, 'Token' => 16, ),
		BasePeer::TYPE_COLNAME => array (FileImportHistoryPeer::ID => 0, FileImportHistoryPeer::CREATED_AT => 1, FileImportHistoryPeer::UPDATED_AT => 2, FileImportHistoryPeer::MAP => 3, FileImportHistoryPeer::USER_ID => 4, FileImportHistoryPeer::VOCABULARY_ID => 5, FileImportHistoryPeer::SCHEMA_ID => 6, FileImportHistoryPeer::FILE_NAME => 7, FileImportHistoryPeer::SOURCE => 8, FileImportHistoryPeer::SOURCE_FILE_NAME => 9, FileImportHistoryPeer::FILE_TYPE => 10, FileImportHistoryPeer::BATCH_ID => 11, FileImportHistoryPeer::RESULTS => 12, FileImportHistoryPeer::TOTAL_PROCESSED_COUNT => 13, FileImportHistoryPeer::ERROR_COUNT => 14, FileImportHistoryPeer::SUCCESS_COUNT => 15, FileImportHistoryPeer::TOKEN => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'map' => 3, 'user_id' => 4, 'vocabulary_id' => 5, 'schema_id' => 6, 'file_name' => 7, 'source' => 8, 'source_file_name' => 9, 'file_type' => 10, 'batch_id' => 11, 'results' => 12, 'total_processed_count' => 13, 'error_count' => 14, 'success_count' => 15, 'token' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FileImportHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FileImportHistoryMapBuilder');
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
			$map = FileImportHistoryPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. FileImportHistoryPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FileImportHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::ID) : FileImportHistoryPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::CREATED_AT) : FileImportHistoryPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::UPDATED_AT) : FileImportHistoryPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::MAP) : FileImportHistoryPeer::MAP);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::USER_ID) : FileImportHistoryPeer::USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::VOCABULARY_ID) : FileImportHistoryPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::SCHEMA_ID) : FileImportHistoryPeer::SCHEMA_ID);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::FILE_NAME) : FileImportHistoryPeer::FILE_NAME);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::SOURCE) : FileImportHistoryPeer::SOURCE);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::SOURCE_FILE_NAME) : FileImportHistoryPeer::SOURCE_FILE_NAME);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::FILE_TYPE) : FileImportHistoryPeer::FILE_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::BATCH_ID) : FileImportHistoryPeer::BATCH_ID);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::RESULTS) : FileImportHistoryPeer::RESULTS);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::TOTAL_PROCESSED_COUNT) : FileImportHistoryPeer::TOTAL_PROCESSED_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::ERROR_COUNT) : FileImportHistoryPeer::ERROR_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::SUCCESS_COUNT) : FileImportHistoryPeer::SUCCESS_COUNT);

        $criteria->addSelectColumn(($tableAlias) ? FileImportHistoryPeer::alias($tableAlias, FileImportHistoryPeer::TOKEN) : FileImportHistoryPeer::TOKEN);

	}

	const COUNT = 'COUNT(reg_file_import_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_file_import_history.ID)';

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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
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
	 * @return     FileImportHistory
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FileImportHistoryPeer::doSelect($critcopy, $con);
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
		return FileImportHistoryPeer::populateObjects(FileImportHistoryPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseFileImportHistoryPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseFileImportHistoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FileImportHistoryPeer::addSelectColumns($criteria);
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
		$cls = FileImportHistoryPeer::getOMClass();
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Batch table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinBatch(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with their User objects.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with their Schema objects.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with their Batch objects.
	 *
	 * @return array Array of FileImportHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinBatch(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BatchPeer::addSelectColumns($c);

		$c->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BatchPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBatch(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFileImportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1); //CHECKME
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with all related objects.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol2 = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::alias('a2', VocabularyPeer::ID));
        $c->addAlias('a2', VocabularyPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::alias('a3', SchemaPeer::ID));
        $c->addAlias('a3', SchemaPeer::TABLE_NAME);

		BatchPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + BatchPeer::NUM_COLUMNS;

        $c->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::alias('a4', BatchPeer::ID));
        $c->addAlias('a4', BatchPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();


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
					$temp_obj2->addFileImportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1);
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
					$temp_obj3->addFileImportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initFileImportHistorys();
				$obj3->addFileImportHistory($obj1);
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
					$temp_obj4->addFileImportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initFileImportHistorys();
				$obj4->addFileImportHistory($obj1);
			}


				// Add objects for joined Batch rows
	
			$omClass = BatchPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBatch(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFileImportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initFileImportHistorys();
				$obj5->addFileImportHistory($obj1);
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Batch table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptBatch(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FileImportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = FileImportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with all related objects except User.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol2 = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		BatchPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BatchPeer::NUM_COLUMNS;

		$c->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1);
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
					$temp_obj3->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFileImportHistorys();
				$obj3->addFileImportHistory($obj1);
			}

			$omClass = BatchPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBatch(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFileImportHistorys();
				$obj4->addFileImportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol2 = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		BatchPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BatchPeer::NUM_COLUMNS;

		$c->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1);
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
					$temp_obj3->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFileImportHistorys();
				$obj3->addFileImportHistory($obj1);
			}

			$omClass = BatchPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBatch(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFileImportHistorys();
				$obj4->addFileImportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of FileImportHistory objects.
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

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol2 = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		BatchPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BatchPeer::NUM_COLUMNS;

		$c->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(FileImportHistoryPeer::BATCH_ID, BatchPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1);
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
					$temp_obj3->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFileImportHistorys();
				$obj3->addFileImportHistory($obj1);
			}

			$omClass = BatchPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBatch(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFileImportHistorys();
				$obj4->addFileImportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of FileImportHistory objects pre-filled with all related objects except Batch.
	 *
	 * @return array Array of FileImportHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptBatch(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileImportHistoryPeer::addSelectColumns($c);
		$startcol2 = (FileImportHistoryPeer::NUM_COLUMNS - FileImportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(FileImportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(FileImportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(FileImportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FileImportHistoryPeer::getOMClass();

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
					$temp_obj2->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFileImportHistorys();
				$obj2->addFileImportHistory($obj1);
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
					$temp_obj3->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFileImportHistorys();
				$obj3->addFileImportHistory($obj1);
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
					$temp_obj4->addFileImportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFileImportHistorys();
				$obj4->addFileImportHistory($obj1);
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
		return FileImportHistoryPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a FileImportHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or FileImportHistory object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImportHistoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileImportHistoryPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from FileImportHistory object
		}

		$criteria->remove(FileImportHistoryPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseFileImportHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFileImportHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a FileImportHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or FileImportHistory object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImportHistoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileImportHistoryPeer', $values, $con);
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

			$comparison = $criteria->getComparison(FileImportHistoryPeer::ID);
			$selectCriteria->add(FileImportHistoryPeer::ID, $criteria->remove(FileImportHistoryPeer::ID), $comparison);

		} else { // $values is FileImportHistory object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFileImportHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFileImportHistoryPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_file_import_history table.
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
			$affectedRows += BasePeer::doDeleteAll(FileImportHistoryPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FileImportHistory or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FileImportHistory object or primary key or array of primary keys
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
			$con = Propel::getConnection(FileImportHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof FileImportHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FileImportHistoryPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given FileImportHistory object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      FileImportHistory $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(FileImportHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FileImportHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FileImportHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FileImportHistoryPeer::DATABASE_NAME, FileImportHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FileImportHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     FileImportHistory
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FileImportHistoryPeer::DATABASE_NAME);

		$criteria->add(FileImportHistoryPeer::ID, $pk);


		$v = FileImportHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(FileImportHistoryPeer::ID, $pks, Criteria::IN);
			$objs = FileImportHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseFileImportHistoryPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseFileImportHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/FileImportHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FileImportHistoryMapBuilder');
}
