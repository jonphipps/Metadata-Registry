<?php

/**
 * Base static class for performing query and update operations on the 'arc_triple' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseArcTriplePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'arc_triple';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ArcTriple';

	/** The total number of columns. */
	const NUM_COLUMNS = 10;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the T field */
	const T = 'arc_triple.T';

	/** the column name for the S field */
	const S = 'arc_triple.S';

	/** the column name for the P field */
	const P = 'arc_triple.P';

	/** the column name for the O field */
	const O = 'arc_triple.O';

	/** the column name for the O_LANG_DT field */
	const O_LANG_DT = 'arc_triple.O_LANG_DT';

	/** the column name for the O_COMP field */
	const O_COMP = 'arc_triple.O_COMP';

	/** the column name for the S_TYPE field */
	const S_TYPE = 'arc_triple.S_TYPE';

	/** the column name for the O_TYPE field */
	const O_TYPE = 'arc_triple.O_TYPE';

	/** the column name for the MISC field */
	const MISC = 'arc_triple.MISC';

	/** the column name for the ID field */
	const ID = 'arc_triple.ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('T', 'S', 'P', 'O', 'OLangDt', 'OComp', 'SType', 'OType', 'Misc', 'Id', ),
		BasePeer::TYPE_COLNAME => array (ArcTriplePeer::T, ArcTriplePeer::S, ArcTriplePeer::P, ArcTriplePeer::O, ArcTriplePeer::O_LANG_DT, ArcTriplePeer::O_COMP, ArcTriplePeer::S_TYPE, ArcTriplePeer::O_TYPE, ArcTriplePeer::MISC, ArcTriplePeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('t', 's', 'p', 'o', 'o_lang_dt', 'o_comp', 's_type', 'o_type', 'misc', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('T' => 0, 'S' => 1, 'P' => 2, 'O' => 3, 'OLangDt' => 4, 'OComp' => 5, 'SType' => 6, 'OType' => 7, 'Misc' => 8, 'Id' => 9, ),
		BasePeer::TYPE_COLNAME => array (ArcTriplePeer::T => 0, ArcTriplePeer::S => 1, ArcTriplePeer::P => 2, ArcTriplePeer::O => 3, ArcTriplePeer::O_LANG_DT => 4, ArcTriplePeer::O_COMP => 5, ArcTriplePeer::S_TYPE => 6, ArcTriplePeer::O_TYPE => 7, ArcTriplePeer::MISC => 8, ArcTriplePeer::ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('t' => 0, 's' => 1, 'p' => 2, 'o' => 3, 'o_lang_dt' => 4, 'o_comp' => 5, 's_type' => 6, 'o_type' => 7, 'misc' => 8, 'id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ArcTripleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ArcTripleMapBuilder');
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
			$map = ArcTriplePeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ArcTriplePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ArcTriplePeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::T) : ArcTriplePeer::T);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::S) : ArcTriplePeer::S);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::P) : ArcTriplePeer::P);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::O) : ArcTriplePeer::O);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::O_LANG_DT) : ArcTriplePeer::O_LANG_DT);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::O_COMP) : ArcTriplePeer::O_COMP);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::S_TYPE) : ArcTriplePeer::S_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::O_TYPE) : ArcTriplePeer::O_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::MISC) : ArcTriplePeer::MISC);

        $criteria->addSelectColumn(($tableAlias) ? ArcTriplePeer::alias($tableAlias, ArcTriplePeer::ID) : ArcTriplePeer::ID);

	}

	const COUNT = 'COUNT(arc_triple.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT arc_triple.ID)';

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
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
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
	 * @return     ArcTriple
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ArcTriplePeer::doSelect($critcopy, $con);
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
		return ArcTriplePeer::populateObjects(ArcTriplePeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseArcTriplePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseArcTriplePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ArcTriplePeer::addSelectColumns($criteria);
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
		$cls = ArcTriplePeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related ArcS2val table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinArcS2val(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcId2valRelatedByP table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinArcId2valRelatedByP(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcO2val table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinArcO2val(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcId2valRelatedByOLangDt table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinArcId2valRelatedByOLangDt(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with their ArcS2val objects.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinArcS2val(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ArcS2valPeer::addSelectColumns($c);

		$c->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcS2valPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getArcS2val(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addArcTriple($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with their ArcId2val objects.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinArcId2valRelatedByP(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ArcId2valPeer::addSelectColumns($c);

		$c->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcId2valPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getArcId2valRelatedByP(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addArcTripleRelatedByP($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initArcTriplesRelatedByP();
				$obj2->addArcTripleRelatedByP($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with their ArcO2val objects.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinArcO2val(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ArcO2valPeer::addSelectColumns($c);

		$c->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcO2valPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getArcO2val(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addArcTriple($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with their ArcId2val objects.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinArcId2valRelatedByOLangDt(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ArcId2valPeer::addSelectColumns($c);

		$c->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcId2valPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getArcId2valRelatedByOLangDt(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addArcTripleRelatedByOLangDt($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initArcTriplesRelatedByOLangDt();
				$obj2->addArcTripleRelatedByOLangDt($obj1); //CHECKME
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
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with all related objects.
	 *
	 * @return array Array of ArcTriple objects.
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

		ArcTriplePeer::addSelectColumns($c);
		$startcol2 = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ArcS2valPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + ArcS2valPeer::NUM_COLUMNS;

        $c->addJoin(ArcTriplePeer::S, ArcS2valPeer::alias('a1', ArcS2valPeer::ID));
        $c->addAlias('a1', ArcS2valPeer::TABLE_NAME);

		ArcId2valPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + ArcId2valPeer::NUM_COLUMNS;

        $c->addJoin(ArcTriplePeer::P, ArcId2valPeer::alias('a2', ArcId2valPeer::ID));
        $c->addAlias('a2', ArcId2valPeer::TABLE_NAME);

		ArcO2valPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + ArcO2valPeer::NUM_COLUMNS;

        $c->addJoin(ArcTriplePeer::O, ArcO2valPeer::alias('a3', ArcO2valPeer::ID));
        $c->addAlias('a3', ArcO2valPeer::TABLE_NAME);

		ArcId2valPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + ArcId2valPeer::NUM_COLUMNS;

        $c->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::alias('a4', ArcId2valPeer::ID));
        $c->addAlias('a4', ArcId2valPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined ArcS2val rows
	
			$omClass = ArcS2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getArcS2val(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addArcTriple($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1);
			}


				// Add objects for joined ArcId2val rows
	
			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getArcId2valRelatedByP(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addArcTripleRelatedByP($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initArcTriplesRelatedByP();
				$obj3->addArcTripleRelatedByP($obj1);
			}


				// Add objects for joined ArcO2val rows
	
			$omClass = ArcO2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getArcO2val(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addArcTriple($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initArcTriples();
				$obj4->addArcTriple($obj1);
			}


				// Add objects for joined ArcId2val rows
	
			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getArcId2valRelatedByOLangDt(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addArcTripleRelatedByOLangDt($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initArcTriplesRelatedByOLangDt();
				$obj5->addArcTripleRelatedByOLangDt($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcS2val table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptArcS2val(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcId2valRelatedByP table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptArcId2valRelatedByP(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcO2val table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptArcO2val(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ArcId2valRelatedByOLangDt table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptArcId2valRelatedByOLangDt(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ArcTriplePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$criteria->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$rs = ArcTriplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with all related objects except ArcS2val.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptArcS2val(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol2 = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ArcId2valPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ArcId2valPeer::NUM_COLUMNS;

		ArcO2valPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ArcO2valPeer::NUM_COLUMNS;

		ArcId2valPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ArcId2valPeer::NUM_COLUMNS;

		$c->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$c->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);

		$c->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getArcId2valRelatedByP(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addArcTripleRelatedByP($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initArcTriplesRelatedByP();
				$obj2->addArcTripleRelatedByP($obj1);
			}

			$omClass = ArcO2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getArcO2val(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initArcTriples();
				$obj3->addArcTriple($obj1);
			}

			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getArcId2valRelatedByOLangDt(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addArcTripleRelatedByOLangDt($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initArcTriplesRelatedByOLangDt();
				$obj4->addArcTripleRelatedByOLangDt($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with all related objects except ArcId2valRelatedByP.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptArcId2valRelatedByP(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol2 = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ArcS2valPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ArcS2valPeer::NUM_COLUMNS;

		ArcO2valPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ArcO2valPeer::NUM_COLUMNS;

		$c->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$c->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcS2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getArcS2val(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1);
			}

			$omClass = ArcO2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getArcO2val(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initArcTriples();
				$obj3->addArcTriple($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with all related objects except ArcO2val.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptArcO2val(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol2 = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ArcS2valPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ArcS2valPeer::NUM_COLUMNS;

		ArcId2valPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ArcId2valPeer::NUM_COLUMNS;

		ArcId2valPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ArcId2valPeer::NUM_COLUMNS;

		$c->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$c->addJoin(ArcTriplePeer::P, ArcId2valPeer::ID);

		$c->addJoin(ArcTriplePeer::O_LANG_DT, ArcId2valPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcS2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getArcS2val(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1);
			}

			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getArcId2valRelatedByP(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addArcTripleRelatedByP($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initArcTriplesRelatedByP();
				$obj3->addArcTripleRelatedByP($obj1);
			}

			$omClass = ArcId2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getArcId2valRelatedByOLangDt(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addArcTripleRelatedByOLangDt($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initArcTriplesRelatedByOLangDt();
				$obj4->addArcTripleRelatedByOLangDt($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ArcTriple objects pre-filled with all related objects except ArcId2valRelatedByOLangDt.
	 *
	 * @return array Array of ArcTriple objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptArcId2valRelatedByOLangDt(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ArcTriplePeer::addSelectColumns($c);
		$startcol2 = (ArcTriplePeer::NUM_COLUMNS - ArcTriplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ArcS2valPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ArcS2valPeer::NUM_COLUMNS;

		ArcO2valPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ArcO2valPeer::NUM_COLUMNS;

		$c->addJoin(ArcTriplePeer::S, ArcS2valPeer::ID);

		$c->addJoin(ArcTriplePeer::O, ArcO2valPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ArcTriplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ArcS2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getArcS2val(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initArcTriples();
				$obj2->addArcTriple($obj1);
			}

			$omClass = ArcO2valPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getArcO2val(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addArcTriple($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initArcTriples();
				$obj3->addArcTriple($obj1);
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
		return ArcTriplePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ArcTriple or Criteria object.
	 *
	 * @param      mixed $values Criteria or ArcTriple object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseArcTriplePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseArcTriplePeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from ArcTriple object
		}

		$criteria->remove(ArcTriplePeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseArcTriplePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseArcTriplePeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ArcTriple or Criteria object.
	 *
	 * @param      mixed $values Criteria or ArcTriple object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseArcTriplePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseArcTriplePeer', $values, $con);
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

			$comparison = $criteria->getComparison(ArcTriplePeer::ID);
			$selectCriteria->add(ArcTriplePeer::ID, $criteria->remove(ArcTriplePeer::ID), $comparison);

		} else { // $values is ArcTriple object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseArcTriplePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseArcTriplePeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the arc_triple table.
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
			$affectedRows += BasePeer::doDeleteAll(ArcTriplePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ArcTriple or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ArcTriple object or primary key or array of primary keys
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
			$con = Propel::getConnection(ArcTriplePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ArcTriple) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ArcTriplePeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given ArcTriple object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ArcTriple $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(ArcTriple $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ArcTriplePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ArcTriplePeer::TABLE_NAME);

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

		return BasePeer::doValidate(ArcTriplePeer::DATABASE_NAME, ArcTriplePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     ArcTriple
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ArcTriplePeer::DATABASE_NAME);

		$criteria->add(ArcTriplePeer::ID, $pk);


		$v = ArcTriplePeer::doSelect($criteria, $con);

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
			$criteria->add(ArcTriplePeer::ID, $pks, Criteria::IN);
			$objs = ArcTriplePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseArcTriplePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseArcTriplePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ArcTripleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ArcTripleMapBuilder');
}
