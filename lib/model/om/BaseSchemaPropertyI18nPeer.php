<?php

/**
 * Base static class for performing query and update operations on the 'reg_schema_property_i18n' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyI18nPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_schema_property_i18n';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SchemaPropertyI18n';

	/** The total number of columns. */
	const NUM_COLUMNS = 8;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_schema_property_i18n.ID';

	/** the column name for the CULTURE field */
	const CULTURE = 'reg_schema_property_i18n.CULTURE';

	/** the column name for the NAME field */
	const NAME = 'reg_schema_property_i18n.NAME';

	/** the column name for the LABEL field */
	const LABEL = 'reg_schema_property_i18n.LABEL';

	/** the column name for the LEXICAL_URI field */
	const LEXICAL_URI = 'reg_schema_property_i18n.LEXICAL_URI';

	/** the column name for the DEFINITION field */
	const DEFINITION = 'reg_schema_property_i18n.DEFINITION';

	/** the column name for the COMMENT field */
	const COMMENT = 'reg_schema_property_i18n.COMMENT';

	/** the column name for the NOTE field */
	const NOTE = 'reg_schema_property_i18n.NOTE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Culture', 'Name', 'Label', 'LexicalUri', 'Definition', 'Comment', 'Note', ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyI18nPeer::ID, SchemaPropertyI18nPeer::CULTURE, SchemaPropertyI18nPeer::NAME, SchemaPropertyI18nPeer::LABEL, SchemaPropertyI18nPeer::LEXICAL_URI, SchemaPropertyI18nPeer::DEFINITION, SchemaPropertyI18nPeer::COMMENT, SchemaPropertyI18nPeer::NOTE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'culture', 'name', 'label', 'lexical_uri', 'definition', 'comment', 'note', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Culture' => 1, 'Name' => 2, 'Label' => 3, 'LexicalUri' => 4, 'Definition' => 5, 'Comment' => 6, 'Note' => 7, ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyI18nPeer::ID => 0, SchemaPropertyI18nPeer::CULTURE => 1, SchemaPropertyI18nPeer::NAME => 2, SchemaPropertyI18nPeer::LABEL => 3, SchemaPropertyI18nPeer::LEXICAL_URI => 4, SchemaPropertyI18nPeer::DEFINITION => 5, SchemaPropertyI18nPeer::COMMENT => 6, SchemaPropertyI18nPeer::NOTE => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'culture' => 1, 'name' => 2, 'label' => 3, 'lexical_uri' => 4, 'definition' => 5, 'comment' => 6, 'note' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchemaPropertyI18nMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchemaPropertyI18nMapBuilder');
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
			$map = SchemaPropertyI18nPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SchemaPropertyI18nPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchemaPropertyI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::ID) : SchemaPropertyI18nPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::CULTURE) : SchemaPropertyI18nPeer::CULTURE);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::NAME) : SchemaPropertyI18nPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::LABEL) : SchemaPropertyI18nPeer::LABEL);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::LEXICAL_URI) : SchemaPropertyI18nPeer::LEXICAL_URI);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::DEFINITION) : SchemaPropertyI18nPeer::DEFINITION);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::COMMENT) : SchemaPropertyI18nPeer::COMMENT);

        $criteria->addSelectColumn(($tableAlias) ? SchemaPropertyI18nPeer::alias($tableAlias, SchemaPropertyI18nPeer::NOTE) : SchemaPropertyI18nPeer::NOTE);

	}

	const COUNT = 'COUNT(reg_schema_property_i18n.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_schema_property_i18n.ID)';

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
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchemaPropertyI18nPeer::doSelectRS($criteria, $con);
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
	 * @return     SchemaPropertyI18n
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchemaPropertyI18nPeer::doSelect($critcopy, $con);
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
		return SchemaPropertyI18nPeer::populateObjects(SchemaPropertyI18nPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyI18nPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyI18nPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchemaPropertyI18nPeer::addSelectColumns($criteria);
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
		$cls = SchemaPropertyI18nPeer::getOMClass();
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
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyI18nPeer::ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyI18nPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyI18n objects pre-filled with their SchemaProperty objects.
	 *
	 * @return array Array of SchemaPropertyI18n objects.
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

		SchemaPropertyI18nPeer::addSelectColumns($c);
		$startcol = (SchemaPropertyI18nPeer::NUM_COLUMNS - SchemaPropertyI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SchemaPropertyPeer::addSelectColumns($c);

		$c->addJoin(SchemaPropertyI18nPeer::ID, SchemaPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyI18nPeer::getOMClass();

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
					$temp_obj2->addSchemaPropertyI18n($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initSchemaPropertyI18ns();
				$obj2->addSchemaPropertyI18n($obj1); //CHECKME
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
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyI18nPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SchemaPropertyI18nPeer::ID, SchemaPropertyPeer::ID);

		$rs = SchemaPropertyI18nPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of SchemaPropertyI18n objects pre-filled with all related objects.
	 *
	 * @return array Array of SchemaPropertyI18n objects.
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

		SchemaPropertyI18nPeer::addSelectColumns($c);
		$startcol2 = (SchemaPropertyI18nPeer::NUM_COLUMNS - SchemaPropertyI18nPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SchemaPropertyPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + SchemaPropertyPeer::NUM_COLUMNS;

        $c->addJoin(SchemaPropertyI18nPeer::ID, SchemaPropertyPeer::alias('a1', SchemaPropertyPeer::ID));
        $c->addAlias('a1', SchemaPropertyPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SchemaPropertyI18nPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined SchemaProperty rows
	
			$omClass = SchemaPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSchemaProperty(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSchemaPropertyI18n($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initSchemaPropertyI18ns();
				$obj2->addSchemaPropertyI18n($obj1);
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
		return SchemaPropertyI18nPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SchemaPropertyI18n or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyI18n object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyI18nPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyI18nPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from SchemaPropertyI18n object
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

		
    foreach (sfMixer::getCallables('BaseSchemaPropertyI18nPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyI18nPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SchemaPropertyI18n or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyI18n object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyI18nPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyI18nPeer', $values, $con);
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

			$comparison = $criteria->getComparison(SchemaPropertyI18nPeer::ID);
			$selectCriteria->add(SchemaPropertyI18nPeer::ID, $criteria->remove(SchemaPropertyI18nPeer::ID), $comparison);

			$comparison = $criteria->getComparison(SchemaPropertyI18nPeer::CULTURE);
			$selectCriteria->add(SchemaPropertyI18nPeer::CULTURE, $criteria->remove(SchemaPropertyI18nPeer::CULTURE), $comparison);

		} else { // $values is SchemaPropertyI18n object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyI18nPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyI18nPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_schema_property_i18n table.
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
			$affectedRows += BasePeer::doDeleteAll(SchemaPropertyI18nPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SchemaPropertyI18n or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SchemaPropertyI18n object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchemaPropertyI18nPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SchemaPropertyI18n) {

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

			$criteria->add(SchemaPropertyI18nPeer::ID, $vals[0], Criteria::IN);
			$criteria->add(SchemaPropertyI18nPeer::CULTURE, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given SchemaPropertyI18n object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SchemaPropertyI18n $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SchemaPropertyI18n $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchemaPropertyI18nPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchemaPropertyI18nPeer::TABLE_NAME);

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

		return BasePeer::doValidate(SchemaPropertyI18nPeer::DATABASE_NAME, SchemaPropertyI18nPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $id
	   @param string $culture
	   
	 * @param      Connection $con
	 * @return     SchemaPropertyI18n
	 */
	public static function retrieveByPK( $id, $culture, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(SchemaPropertyI18nPeer::ID, $id);
		$criteria->add(SchemaPropertyI18nPeer::CULTURE, $culture);
		$v = SchemaPropertyI18nPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseSchemaPropertyI18nPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSchemaPropertyI18nPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/SchemaPropertyI18nMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchemaPropertyI18nMapBuilder');
}
