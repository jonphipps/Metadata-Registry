<?php

/**
 * Base static class for performing query and update operations on the 'reg_vocabulary_has_user' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVocabularyHasUserPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_vocabulary_has_user';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.VocabularyHasUser';

	/** The total number of columns. */
	const NUM_COLUMNS = 9;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_vocabulary_has_user.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_vocabulary_has_user.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_vocabulary_has_user.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_vocabulary_has_user.DELETED_AT';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_vocabulary_has_user.VOCABULARY_ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'reg_vocabulary_has_user.USER_ID';

	/** the column name for the IS_MAINTAINER_FOR field */
	const IS_MAINTAINER_FOR = 'reg_vocabulary_has_user.IS_MAINTAINER_FOR';

	/** the column name for the IS_REGISTRAR_FOR field */
	const IS_REGISTRAR_FOR = 'reg_vocabulary_has_user.IS_REGISTRAR_FOR';

	/** the column name for the IS_ADMIN_FOR field */
	const IS_ADMIN_FOR = 'reg_vocabulary_has_user.IS_ADMIN_FOR';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'VocabularyId', 'UserId', 'IsMaintainerFor', 'IsRegistrarFor', 'IsAdminFor', ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasUserPeer::ID, VocabularyHasUserPeer::CREATED_AT, VocabularyHasUserPeer::UPDATED_AT, VocabularyHasUserPeer::DELETED_AT, VocabularyHasUserPeer::VOCABULARY_ID, VocabularyHasUserPeer::USER_ID, VocabularyHasUserPeer::IS_MAINTAINER_FOR, VocabularyHasUserPeer::IS_REGISTRAR_FOR, VocabularyHasUserPeer::IS_ADMIN_FOR, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'vocabulary_id', 'user_id', 'is_maintainer_for', 'is_registrar_for', 'is_admin_for', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'VocabularyId' => 4, 'UserId' => 5, 'IsMaintainerFor' => 6, 'IsRegistrarFor' => 7, 'IsAdminFor' => 8, ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasUserPeer::ID => 0, VocabularyHasUserPeer::CREATED_AT => 1, VocabularyHasUserPeer::UPDATED_AT => 2, VocabularyHasUserPeer::DELETED_AT => 3, VocabularyHasUserPeer::VOCABULARY_ID => 4, VocabularyHasUserPeer::USER_ID => 5, VocabularyHasUserPeer::IS_MAINTAINER_FOR => 6, VocabularyHasUserPeer::IS_REGISTRAR_FOR => 7, VocabularyHasUserPeer::IS_ADMIN_FOR => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'vocabulary_id' => 4, 'user_id' => 5, 'is_maintainer_for' => 6, 'is_registrar_for' => 7, 'is_admin_for' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VocabularyHasUserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VocabularyHasUserMapBuilder');
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
			$map = VocabularyHasUserPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. VocabularyHasUserPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VocabularyHasUserPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::ID) : VocabularyHasUserPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::CREATED_AT) : VocabularyHasUserPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::UPDATED_AT) : VocabularyHasUserPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::DELETED_AT) : VocabularyHasUserPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::VOCABULARY_ID) : VocabularyHasUserPeer::VOCABULARY_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::USER_ID) : VocabularyHasUserPeer::USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::IS_MAINTAINER_FOR) : VocabularyHasUserPeer::IS_MAINTAINER_FOR);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::IS_REGISTRAR_FOR) : VocabularyHasUserPeer::IS_REGISTRAR_FOR);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyHasUserPeer::alias($tableAlias, VocabularyHasUserPeer::IS_ADMIN_FOR) : VocabularyHasUserPeer::IS_ADMIN_FOR);

	}

	const COUNT = 'COUNT(reg_vocabulary_has_user.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_vocabulary_has_user.ID)';

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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
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
	 * @return     VocabularyHasUser
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VocabularyHasUserPeer::doSelect($critcopy, $con);
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
		return VocabularyHasUserPeer::populateObjects(VocabularyHasUserPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseVocabularyHasUserPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasUserPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VocabularyHasUserPeer::addSelectColumns($criteria);
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
		$cls = VocabularyHasUserPeer::getOMClass();
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasUser objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of VocabularyHasUser objects.
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasUser($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of VocabularyHasUser objects pre-filled with their User objects.
	 *
	 * @return array Array of VocabularyHasUser objects.
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasUser($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1); //CHECKME
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasUser objects pre-filled with all related objects.
	 *
	 * @return array Array of VocabularyHasUser objects.
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::alias('a1', VocabularyPeer::ID));
        $c->addAlias('a1', VocabularyPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVocabulary(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyHasUser($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUser(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyHasUser($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularyHasUsers();
				$obj3->addVocabularyHasUser($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VocabularyHasUser objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of VocabularyHasUser objects.
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasUser($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of VocabularyHasUser objects pre-filled with all related objects except User.
	 *
	 * @return array Array of VocabularyHasUser objects.
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasUser($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
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
		return VocabularyHasUserPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a VocabularyHasUser or Criteria object.
	 *
	 * @param      mixed $values Criteria or VocabularyHasUser object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyHasUserPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyHasUserPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from VocabularyHasUser object
		}

		$criteria->remove(VocabularyHasUserPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseVocabularyHasUserPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasUserPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a VocabularyHasUser or Criteria object.
	 *
	 * @param      mixed $values Criteria or VocabularyHasUser object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyHasUserPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyHasUserPeer', $values, $con);
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

			$comparison = $criteria->getComparison(VocabularyHasUserPeer::ID);
			$selectCriteria->add(VocabularyHasUserPeer::ID, $criteria->remove(VocabularyHasUserPeer::ID), $comparison);

		} else { // $values is VocabularyHasUser object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseVocabularyHasUserPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyHasUserPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_vocabulary_has_user table.
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
			$affectedRows += BasePeer::doDeleteAll(VocabularyHasUserPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a VocabularyHasUser or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or VocabularyHasUser object or primary key or array of primary keys
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
			$con = Propel::getConnection(VocabularyHasUserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof VocabularyHasUser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VocabularyHasUserPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given VocabularyHasUser object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      VocabularyHasUser $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(VocabularyHasUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VocabularyHasUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VocabularyHasUserPeer::TABLE_NAME);

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

		return BasePeer::doValidate(VocabularyHasUserPeer::DATABASE_NAME, VocabularyHasUserPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     VocabularyHasUser
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VocabularyHasUserPeer::DATABASE_NAME);

		$criteria->add(VocabularyHasUserPeer::ID, $pk);


		$v = VocabularyHasUserPeer::doSelect($criteria, $con);

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
			$criteria->add(VocabularyHasUserPeer::ID, $pks, Criteria::IN);
			$objs = VocabularyHasUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseVocabularyHasUserPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseVocabularyHasUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/VocabularyHasUserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VocabularyHasUserMapBuilder');
}
