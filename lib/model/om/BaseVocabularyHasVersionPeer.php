<?php

/**
 * Base static class for performing query and update operations on the 'reg_vocabulary_has_version' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVocabularyHasVersionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_vocabulary_has_version';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.VocabularyHasVersion';

	/** The total number of columns. */
	const NUM_COLUMNS = 8;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_vocabulary_has_version.ID';

	/** the column name for the NAME field */
	const NAME = 'reg_vocabulary_has_version.NAME';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_vocabulary_has_version.CREATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_vocabulary_has_version.DELETED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_vocabulary_has_version.UPDATED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_vocabulary_has_version.CREATED_USER_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_vocabulary_has_version.VOCABULARY_ID';

	/** the column name for the TIMESLICE field */
	const TIMESLICE = 'reg_vocabulary_has_version.TIMESLICE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'CreatedAt', 'DeletedAt', 'UpdatedAt', 'CreatedUserId', 'VocabularyId', 'Timeslice', ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasVersionPeer::ID, VocabularyHasVersionPeer::NAME, VocabularyHasVersionPeer::CREATED_AT, VocabularyHasVersionPeer::DELETED_AT, VocabularyHasVersionPeer::UPDATED_AT, VocabularyHasVersionPeer::CREATED_USER_ID, VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyHasVersionPeer::TIMESLICE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'created_at', 'deleted_at', 'updated_at', 'created_user_id', 'vocabulary_id', 'timeslice', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'CreatedAt' => 2, 'DeletedAt' => 3, 'UpdatedAt' => 4, 'CreatedUserId' => 5, 'VocabularyId' => 6, 'Timeslice' => 7, ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasVersionPeer::ID => 0, VocabularyHasVersionPeer::NAME => 1, VocabularyHasVersionPeer::CREATED_AT => 2, VocabularyHasVersionPeer::DELETED_AT => 3, VocabularyHasVersionPeer::UPDATED_AT => 4, VocabularyHasVersionPeer::CREATED_USER_ID => 5, VocabularyHasVersionPeer::VOCABULARY_ID => 6, VocabularyHasVersionPeer::TIMESLICE => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'created_at' => 2, 'deleted_at' => 3, 'updated_at' => 4, 'created_user_id' => 5, 'vocabulary_id' => 6, 'timeslice' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VocabularyHasVersionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VocabularyHasVersionMapBuilder');
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
			$map = VocabularyHasVersionPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. VocabularyHasVersionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VocabularyHasVersionPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::ID) : VocabularyHasVersionPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::NAME) : VocabularyHasVersionPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::CREATED_AT) : VocabularyHasVersionPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::DELETED_AT) : VocabularyHasVersionPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::UPDATED_AT) : VocabularyHasVersionPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::CREATED_USER_ID) : VocabularyHasVersionPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::VOCABULARY_ID) : VocabularyHasVersionPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasVersionPeer::alias($tableAlias, VocabularyHasVersionPeer::TIMESLICE) : VocabularyHasVersionPeer::TIMESLICE);

	}

	const COUNT = 'COUNT(reg_vocabulary_has_version.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_vocabulary_has_version.ID)';

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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
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
	 * @return     VocabularyHasVersion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VocabularyHasVersionPeer::doSelect($critcopy, $con);
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
		return VocabularyHasVersionPeer::populateObjects(VocabularyHasVersionPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseVocabularyHasVersionPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasVersionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VocabularyHasVersionPeer::addSelectColumns($criteria);
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
		$cls = VocabularyHasVersionPeer::getOMClass();
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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasVersion objects pre-filled with their User objects.
	 *
	 * @return array Array of VocabularyHasVersion objects.
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

		VocabularyHasVersionPeer::addSelectColumns($c);
		$startcol = (VocabularyHasVersionPeer::NUM_COLUMNS - VocabularyHasVersionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasVersionPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasVersion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasVersions();
				$obj2->addVocabularyHasVersion($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of VocabularyHasVersion objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of VocabularyHasVersion objects.
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

		VocabularyHasVersionPeer::addSelectColumns($c);
		$startcol = (VocabularyHasVersionPeer::NUM_COLUMNS - VocabularyHasVersionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasVersionPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasVersion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasVersions();
				$obj2->addVocabularyHasVersion($obj1); //CHECKME
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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasVersion objects pre-filled with all related objects.
	 *
	 * @return array Array of VocabularyHasVersion objects.
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

		VocabularyHasVersionPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasVersionPeer::NUM_COLUMNS - VocabularyHasVersionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::alias('a2', VocabularyPeer::ID));
        $c->addAlias('a2', VocabularyPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasVersionPeer::getOMClass();


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
					$temp_obj2->addVocabularyHasVersion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasVersions();
				$obj2->addVocabularyHasVersion($obj1);
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
					$temp_obj3->addVocabularyHasVersion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularyHasVersions();
				$obj3->addVocabularyHasVersion($obj1);
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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasVersionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = VocabularyHasVersionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasVersion objects pre-filled with all related objects except User.
	 *
	 * @return array Array of VocabularyHasVersion objects.
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

		VocabularyHasVersionPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasVersionPeer::NUM_COLUMNS - VocabularyHasVersionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasVersionPeer::VOCABULARY_ID, VocabularyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasVersionPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasVersion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasVersions();
				$obj2->addVocabularyHasVersion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of VocabularyHasVersion objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of VocabularyHasVersion objects.
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

		VocabularyHasVersionPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasVersionPeer::NUM_COLUMNS - VocabularyHasVersionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasVersionPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasVersionPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasVersion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasVersions();
				$obj2->addVocabularyHasVersion($obj1);
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
		return VocabularyHasVersionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a VocabularyHasVersion or Criteria object.
	 *
	 * @param      mixed $values Criteria or VocabularyHasVersion object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyHasVersionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyHasVersionPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from VocabularyHasVersion object
		}

		$criteria->remove(VocabularyHasVersionPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseVocabularyHasVersionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasVersionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a VocabularyHasVersion or Criteria object.
	 *
	 * @param      mixed $values Criteria or VocabularyHasVersion object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyHasVersionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyHasVersionPeer', $values, $con);
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

			$comparison = $criteria->getComparison(VocabularyHasVersionPeer::ID);
			$selectCriteria->add(VocabularyHasVersionPeer::ID, $criteria->remove(VocabularyHasVersionPeer::ID), $comparison);

		} else { // $values is VocabularyHasVersion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseVocabularyHasVersionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasVersionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_vocabulary_has_version table.
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
			$affectedRows += BasePeer::doDeleteAll(VocabularyHasVersionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a VocabularyHasVersion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or VocabularyHasVersion object or primary key or array of primary keys
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
			$con = Propel::getConnection(VocabularyHasVersionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof VocabularyHasVersion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VocabularyHasVersionPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given VocabularyHasVersion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      VocabularyHasVersion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(VocabularyHasVersion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VocabularyHasVersionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VocabularyHasVersionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(VocabularyHasVersionPeer::DATABASE_NAME, VocabularyHasVersionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = VocabularyHasVersionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     VocabularyHasVersion
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VocabularyHasVersionPeer::DATABASE_NAME);

		$criteria->add(VocabularyHasVersionPeer::ID, $pk);


		$v = VocabularyHasVersionPeer::doSelect($criteria, $con);

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
			$criteria->add(VocabularyHasVersionPeer::ID, $pks, Criteria::IN);
			$objs = VocabularyHasVersionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseVocabularyHasVersionPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseVocabularyHasVersionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/VocabularyHasVersionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VocabularyHasVersionMapBuilder');
}
