<?php

/**
 * Base static class for performing query and update operations on the 'reg_export_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseExportHistoryPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_export_history';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ExportHistory';

	/** The total number of columns. */
	const NUM_COLUMNS = 18;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_export_history.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_export_history.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_export_history.UPDATED_AT';

	/** the column name for the USER_ID field */
	const USER_ID = 'reg_export_history.USER_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_export_history.VOCABULARY_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_export_history.SCHEMA_ID';

	/** the column name for the EXCLUDE_DEPRECATED field */
	const EXCLUDE_DEPRECATED = 'reg_export_history.EXCLUDE_DEPRECATED';

	/** the column name for the INCLUDE_GENERATED field */
	const INCLUDE_GENERATED = 'reg_export_history.INCLUDE_GENERATED';

	/** the column name for the INCLUDE_DELETED field */
	const INCLUDE_DELETED = 'reg_export_history.INCLUDE_DELETED';

	/** the column name for the INCLUDE_NOT_ACCEPTED field */
	const INCLUDE_NOT_ACCEPTED = 'reg_export_history.INCLUDE_NOT_ACCEPTED';

	/** the column name for the SELECTED_COLUMNS field */
	const SELECTED_COLUMNS = 'reg_export_history.SELECTED_COLUMNS';

	/** the column name for the SELECTED_LANGUAGE field */
	const SELECTED_LANGUAGE = 'reg_export_history.SELECTED_LANGUAGE';

	/** the column name for the PUBLISHED_ENGLISH_VERSION field */
	const PUBLISHED_ENGLISH_VERSION = 'reg_export_history.PUBLISHED_ENGLISH_VERSION';

	/** the column name for the PUBLISHED_LANGUAGE_VERSION field */
	const PUBLISHED_LANGUAGE_VERSION = 'reg_export_history.PUBLISHED_LANGUAGE_VERSION';

	/** the column name for the LAST_VOCAB_UPDATE field */
	const LAST_VOCAB_UPDATE = 'reg_export_history.LAST_VOCAB_UPDATE';

	/** the column name for the PROFILE_ID field */
	const PROFILE_ID = 'reg_export_history.PROFILE_ID';

	/** the column name for the FILE field */
	const FILE = 'reg_export_history.FILE';

	/** the column name for the MAP field */
	const MAP = 'reg_export_history.MAP';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'UserId', 'VocabularyId', 'SchemaId', 'ExcludeDeprecated', 'IncludeGenerated', 'IncludeDeleted', 'IncludeNotAccepted', 'SelectedColumns', 'SelectedLanguage', 'PublishedEnglishVersion', 'PublishedLanguageVersion', 'LastVocabUpdate', 'ProfileId', 'File', 'Map', ),
		BasePeer::TYPE_COLNAME => array (ExportHistoryPeer::ID, ExportHistoryPeer::CREATED_AT, ExportHistoryPeer::UPDATED_AT, ExportHistoryPeer::USER_ID, ExportHistoryPeer::VOCABULARY_ID, ExportHistoryPeer::SCHEMA_ID, ExportHistoryPeer::EXCLUDE_DEPRECATED, ExportHistoryPeer::INCLUDE_GENERATED, ExportHistoryPeer::INCLUDE_DELETED, ExportHistoryPeer::INCLUDE_NOT_ACCEPTED, ExportHistoryPeer::SELECTED_COLUMNS, ExportHistoryPeer::SELECTED_LANGUAGE, ExportHistoryPeer::PUBLISHED_ENGLISH_VERSION, ExportHistoryPeer::PUBLISHED_LANGUAGE_VERSION, ExportHistoryPeer::LAST_VOCAB_UPDATE, ExportHistoryPeer::PROFILE_ID, ExportHistoryPeer::FILE, ExportHistoryPeer::MAP, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'user_id', 'vocabulary_id', 'schema_id', 'exclude_deprecated', 'include_generated', 'include_deleted', 'include_not_accepted', 'selected_columns', 'selected_language', 'published_english_version', 'published_language_version', 'last_vocab_update', 'profile_id', 'file', 'map', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'UserId' => 3, 'VocabularyId' => 4, 'SchemaId' => 5, 'ExcludeDeprecated' => 6, 'IncludeGenerated' => 7, 'IncludeDeleted' => 8, 'IncludeNotAccepted' => 9, 'SelectedColumns' => 10, 'SelectedLanguage' => 11, 'PublishedEnglishVersion' => 12, 'PublishedLanguageVersion' => 13, 'LastVocabUpdate' => 14, 'ProfileId' => 15, 'File' => 16, 'Map' => 17, ),
		BasePeer::TYPE_COLNAME => array (ExportHistoryPeer::ID => 0, ExportHistoryPeer::CREATED_AT => 1, ExportHistoryPeer::UPDATED_AT => 2, ExportHistoryPeer::USER_ID => 3, ExportHistoryPeer::VOCABULARY_ID => 4, ExportHistoryPeer::SCHEMA_ID => 5, ExportHistoryPeer::EXCLUDE_DEPRECATED => 6, ExportHistoryPeer::INCLUDE_GENERATED => 7, ExportHistoryPeer::INCLUDE_DELETED => 8, ExportHistoryPeer::INCLUDE_NOT_ACCEPTED => 9, ExportHistoryPeer::SELECTED_COLUMNS => 10, ExportHistoryPeer::SELECTED_LANGUAGE => 11, ExportHistoryPeer::PUBLISHED_ENGLISH_VERSION => 12, ExportHistoryPeer::PUBLISHED_LANGUAGE_VERSION => 13, ExportHistoryPeer::LAST_VOCAB_UPDATE => 14, ExportHistoryPeer::PROFILE_ID => 15, ExportHistoryPeer::FILE => 16, ExportHistoryPeer::MAP => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'user_id' => 3, 'vocabulary_id' => 4, 'schema_id' => 5, 'exclude_deprecated' => 6, 'include_generated' => 7, 'include_deleted' => 8, 'include_not_accepted' => 9, 'selected_columns' => 10, 'selected_language' => 11, 'published_english_version' => 12, 'published_language_version' => 13, 'last_vocab_update' => 14, 'profile_id' => 15, 'file' => 16, 'map' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ExportHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ExportHistoryMapBuilder');
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
			$map = ExportHistoryPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ExportHistoryPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ExportHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::ID) : ExportHistoryPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::CREATED_AT) : ExportHistoryPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::UPDATED_AT) : ExportHistoryPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::USER_ID) : ExportHistoryPeer::USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::VOCABULARY_ID) : ExportHistoryPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::SCHEMA_ID) : ExportHistoryPeer::SCHEMA_ID);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::EXCLUDE_DEPRECATED) : ExportHistoryPeer::EXCLUDE_DEPRECATED);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::INCLUDE_GENERATED) : ExportHistoryPeer::INCLUDE_GENERATED);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::INCLUDE_DELETED) : ExportHistoryPeer::INCLUDE_DELETED);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::INCLUDE_NOT_ACCEPTED) : ExportHistoryPeer::INCLUDE_NOT_ACCEPTED);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::SELECTED_COLUMNS) : ExportHistoryPeer::SELECTED_COLUMNS);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::SELECTED_LANGUAGE) : ExportHistoryPeer::SELECTED_LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::PUBLISHED_ENGLISH_VERSION) : ExportHistoryPeer::PUBLISHED_ENGLISH_VERSION);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::PUBLISHED_LANGUAGE_VERSION) : ExportHistoryPeer::PUBLISHED_LANGUAGE_VERSION);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::LAST_VOCAB_UPDATE) : ExportHistoryPeer::LAST_VOCAB_UPDATE);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::PROFILE_ID) : ExportHistoryPeer::PROFILE_ID);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::FILE) : ExportHistoryPeer::FILE);

        $criteria->addSelectColumn(($tableAlias) ? ExportHistoryPeer::alias($tableAlias, ExportHistoryPeer::MAP) : ExportHistoryPeer::MAP);

	}

	const COUNT = 'COUNT(reg_export_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_export_history.ID)';

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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
	 * @return     ExportHistory
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ExportHistoryPeer::doSelect($critcopy, $con);
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
		return ExportHistoryPeer::populateObjects(ExportHistoryPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseExportHistoryPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseExportHistoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ExportHistoryPeer::addSelectColumns($criteria);
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
		$cls = ExportHistoryPeer::getOMClass();
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with their User objects.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with their Schema objects.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPeer::addSelectColumns($c);

		$c->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with their Profile objects.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePeer::addSelectColumns($c);

		$c->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1); //CHECKME
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with all related objects.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol2 = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ExportHistoryPeer::USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::alias('a2', VocabularyPeer::ID));
        $c->addAlias('a2', VocabularyPeer::TABLE_NAME);

		SchemaPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

        $c->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::alias('a3', SchemaPeer::ID));
        $c->addAlias('a3', SchemaPeer::TABLE_NAME);

		ProfilePeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

        $c->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::alias('a4', ProfilePeer::ID));
        $c->addAlias('a4', ProfilePeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();


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
					$temp_obj2->addExportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1);
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
					$temp_obj3->addExportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initExportHistorys();
				$obj3->addExportHistory($obj1);
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
					$temp_obj4->addExportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initExportHistorys();
				$obj4->addExportHistory($obj1);
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
					$temp_obj5->addExportHistory($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initExportHistorys();
				$obj5->addExportHistory($obj1);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ExportHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$rs = ExportHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with all related objects except User.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol2 = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1);
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
					$temp_obj3->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initExportHistorys();
				$obj3->addExportHistory($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initExportHistorys();
				$obj4->addExportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol2 = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SchemaPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);

		$c->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1);
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
					$temp_obj3->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initExportHistorys();
				$obj3->addExportHistory($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initExportHistorys();
				$obj4->addExportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with all related objects except Schema.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol2 = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ExportHistoryPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1);
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
					$temp_obj3->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initExportHistorys();
				$obj3->addExportHistory($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initExportHistorys();
				$obj4->addExportHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ExportHistory objects pre-filled with all related objects except Profile.
	 *
	 * @return array Array of ExportHistory objects.
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

		ExportHistoryPeer::addSelectColumns($c);
		$startcol2 = (ExportHistoryPeer::NUM_COLUMNS - ExportHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		SchemaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SchemaPeer::NUM_COLUMNS;

		$c->addJoin(ExportHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(ExportHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ExportHistoryPeer::SCHEMA_ID, SchemaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ExportHistoryPeer::getOMClass();

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
					$temp_obj2->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initExportHistorys();
				$obj2->addExportHistory($obj1);
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
					$temp_obj3->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initExportHistorys();
				$obj3->addExportHistory($obj1);
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
					$temp_obj4->addExportHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initExportHistorys();
				$obj4->addExportHistory($obj1);
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
		return ExportHistoryPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ExportHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or ExportHistory object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseExportHistoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseExportHistoryPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from ExportHistory object
		}

		$criteria->remove(ExportHistoryPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseExportHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseExportHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ExportHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or ExportHistory object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseExportHistoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseExportHistoryPeer', $values, $con);
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

			$comparison = $criteria->getComparison(ExportHistoryPeer::ID);
			$selectCriteria->add(ExportHistoryPeer::ID, $criteria->remove(ExportHistoryPeer::ID), $comparison);

		} else { // $values is ExportHistory object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseExportHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseExportHistoryPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_export_history table.
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
			$affectedRows += BasePeer::doDeleteAll(ExportHistoryPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ExportHistory or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ExportHistory object or primary key or array of primary keys
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
			$con = Propel::getConnection(ExportHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ExportHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ExportHistoryPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given ExportHistory object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ExportHistory $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ExportHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ExportHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ExportHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ExportHistoryPeer::DATABASE_NAME, ExportHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ExportHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     ExportHistory
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ExportHistoryPeer::DATABASE_NAME);

		$criteria->add(ExportHistoryPeer::ID, $pk);


		$v = ExportHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(ExportHistoryPeer::ID, $pks, Criteria::IN);
			$objs = ExportHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseExportHistoryPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseExportHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ExportHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ExportHistoryMapBuilder');
}
