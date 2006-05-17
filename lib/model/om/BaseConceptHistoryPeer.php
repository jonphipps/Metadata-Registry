<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by ConceptHistoryPeer::getOMClass()
include_once 'model/ConceptHistory.php';

/**
 * Base static class for performing query and update operations on the 'reg_concept_history' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseConceptHistoryPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_concept_history';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'model.ConceptHistory';

	/** The total number of columns. */
	const NUM_COLUMNS = 6;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the SID field */
	const SID = 'reg_concept_history.SID';

	/** the column name for the CONCEPT_PROPERTY_ID field */
	const CONCEPT_PROPERTY_ID = 'reg_concept_history.CONCEPT_PROPERTY_ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'reg_concept_history.USER_ID';

	/** the column name for the CHANGED_AT field */
	const CHANGED_AT = 'reg_concept_history.CHANGED_AT';

	/** the column name for the OLD_VALUES field */
	const OLD_VALUES = 'reg_concept_history.OLD_VALUES';

	/** the column name for the NEW_VALUES field */
	const NEW_VALUES = 'reg_concept_history.NEW_VALUES';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Sid', 'ConceptPropertyId', 'UserId', 'ChangedAt', 'OldValues', 'NewValues', ),
		BasePeer::TYPE_COLNAME => array (ConceptHistoryPeer::SID, ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptHistoryPeer::USER_ID, ConceptHistoryPeer::CHANGED_AT, ConceptHistoryPeer::OLD_VALUES, ConceptHistoryPeer::NEW_VALUES, ),
		BasePeer::TYPE_FIELDNAME => array ('sid', 'concept_property_id', 'user_id', 'changed_at', 'old_values', 'new_values', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Sid' => 0, 'ConceptPropertyId' => 1, 'UserId' => 2, 'ChangedAt' => 3, 'OldValues' => 4, 'NewValues' => 5, ),
		BasePeer::TYPE_COLNAME => array (ConceptHistoryPeer::SID => 0, ConceptHistoryPeer::CONCEPT_PROPERTY_ID => 1, ConceptHistoryPeer::USER_ID => 2, ConceptHistoryPeer::CHANGED_AT => 3, ConceptHistoryPeer::OLD_VALUES => 4, ConceptHistoryPeer::NEW_VALUES => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('sid' => 0, 'concept_property_id' => 1, 'user_id' => 2, 'changed_at' => 3, 'old_values' => 4, 'new_values' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	/**
	 * @return MapBuilder the map builder for this peer
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'model/map/ConceptHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('model.map.ConceptHistoryMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return array The PHP to DB name map for this peer
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConceptHistoryPeer::getTableMap();
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
	 * @param string $name field name
	 * @param string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param string $toType   One of the class type constants
	 * @return string translated name of the field.
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
	 * @param  string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return array A list of field names
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
	 * @param string $alias The alias for the current table.
	 * @param string $column The column name for current table. (i.e. ConceptHistoryPeer::COLUMN_NAME).
	 * @return string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ConceptHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param criteria object containing the columns to add.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptHistoryPeer::SID);

		$criteria->addSelectColumn(ConceptHistoryPeer::CONCEPT_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptHistoryPeer::USER_ID);

		$criteria->addSelectColumn(ConceptHistoryPeer::CHANGED_AT);

		$criteria->addSelectColumn(ConceptHistoryPeer::OLD_VALUES);

		$criteria->addSelectColumn(ConceptHistoryPeer::NEW_VALUES);

	}

	const COUNT = 'COUNT(reg_concept_history.SID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_history.SID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
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
	 * @param Criteria $criteria object used to create the SELECT statement.
	 * @param Connection $con
	 * @return ConceptHistory
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ConceptHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param Connection $con
	 * @return array Array of selected Objects
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptHistoryPeer::populateObjects(ConceptHistoryPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param Connection $con the connection to use
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return ResultSet The resultset object with numerically-indexed fields.
	 * @see BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptHistoryPeer::addSelectColumns($criteria);
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
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ConceptHistoryPeer::getOMClass();
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
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptHistory objects pre-filled with their User objects.
	 *
	 * @return array Array of ConceptHistory objects.
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptHistory objects pre-filled with their ConceptProperty objects.
	 *
	 * @return array Array of ConceptHistory objects.
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1); //CHECKME
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
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptHistory objects pre-filled with all related objects.
	 *
	 * @return array Array of ConceptHistory objects.
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			
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
					$temp_obj2->addConceptHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
			}

				
				// Add objects for joined ConceptProperty rows
	
			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptProperty(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptHistorys();
				$obj3->addConceptHistory($obj1);
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
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptHistory objects pre-filled with all related objects except User.
	 *
	 * @return array Array of ConceptHistory objects.
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptHistory objects pre-filled with all related objects except ConceptProperty.
	 *
	 * @return array Array of ConceptHistory objects.
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return TableMap
	 * @throws PropelException Any exceptions caught during processing will be
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
	 * @return string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return ConceptHistoryPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ConceptHistory or Criteria object.
	 *
	 * @param mixed $values Criteria or ConceptHistory object containing data that is used to create the INSERT statement.
	 * @param Connection $con the connection to use
	 * @return mixed The new primary key.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ConceptHistory object
		}


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

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ConceptHistory or Criteria object.
	 *
	 * @param mixed $values Criteria or ConceptHistory object containing data that is used to create the UPDATE statement.
	 * @param Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return int The number of affected rows (if supported by underlying database driver).
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ConceptHistoryPeer::SID);
			$selectCriteria->add(ConceptHistoryPeer::SID, $criteria->remove(ConceptHistoryPeer::SID), $comparison);

			$comparison = $criteria->getComparison(ConceptHistoryPeer::CONCEPT_PROPERTY_ID);
			$selectCriteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $criteria->remove(ConceptHistoryPeer::CONCEPT_PROPERTY_ID), $comparison);

		} else { // $values is ConceptHistory object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the reg_concept_history table.
	 *
	 * @return int The number of affected rows (if supported by underlying database driver).
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
			$affectedRows += BasePeer::doDeleteAll(ConceptHistoryPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ConceptHistory or Criteria object OR a primary key value.
	 *
	 * @param mixed $values Criteria or ConceptHistory object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param Connection $con the connection to use
	 * @return int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ConceptHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(ConceptHistoryPeer::SID, $vals[0], Criteria::IN);
			$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given ConceptHistory object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param ConceptHistory $obj The object to validate.
	 * @param mixed $cols Column name or array of column names.
	 *
	 * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ConceptHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConceptHistoryPeer::DATABASE_NAME, ConceptHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConceptHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param string $sid
	   @param int $concept_property_id
	   
	 * @param Connection $con
	 * @return ConceptHistory
	 */
	public static function retrieveByPK( $sid, $concept_property_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ConceptHistoryPeer::SID, $sid);
		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $concept_property_id);
		$v = ConceptHistoryPeer::doSelect($criteria, $con);
        return !empty($v) ? $v[0] : null;
	}
} // BaseConceptHistoryPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseConceptHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'model/map/ConceptHistoryMapBuilder.php';
	Propel::registerMapBuilder('model.map.ConceptHistoryMapBuilder');
}
