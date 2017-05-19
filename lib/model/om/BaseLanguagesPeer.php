<?php

/**
 * Base static class for performing query and update operations on the 'languages' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseLanguagesPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'languages';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Languages';

	/** The total number of columns. */
	const NUM_COLUMNS = 12;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'languages.ID';

	/** the column name for the NAME field */
	const NAME = 'languages.NAME';

	/** the column name for the APP_NAME field */
	const APP_NAME = 'languages.APP_NAME';

	/** the column name for the FLAG field */
	const FLAG = 'languages.FLAG';

	/** the column name for the ABBR field */
	const ABBR = 'languages.ABBR';

	/** the column name for the SCRIPT field */
	const SCRIPT = 'languages.SCRIPT';

	/** the column name for the NATIVE field */
	const NATIVE = 'languages.NATIVE';

	/** the column name for the ACTIVE field */
	const ACTIVE = 'languages.ACTIVE';

	/** the column name for the DEFAULT field */
	const DEFAULT = 'languages.DEFAULT';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'languages.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'languages.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'languages.DELETED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'AppName', 'Flag', 'Abbr', 'Script', 'Native', 'Active', 'Default', 'CreatedAt', 'UpdatedAt', 'DeletedAt', ),
		BasePeer::TYPE_COLNAME => array (LanguagesPeer::ID, LanguagesPeer::NAME, LanguagesPeer::APP_NAME, LanguagesPeer::FLAG, LanguagesPeer::ABBR, LanguagesPeer::SCRIPT, LanguagesPeer::NATIVE, LanguagesPeer::ACTIVE, LanguagesPeer::DEFAULT, LanguagesPeer::CREATED_AT, LanguagesPeer::UPDATED_AT, LanguagesPeer::DELETED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'app_name', 'flag', 'abbr', 'script', 'native', 'active', 'default', 'created_at', 'updated_at', 'deleted_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'AppName' => 2, 'Flag' => 3, 'Abbr' => 4, 'Script' => 5, 'Native' => 6, 'Active' => 7, 'Default' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'DeletedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (LanguagesPeer::ID => 0, LanguagesPeer::NAME => 1, LanguagesPeer::APP_NAME => 2, LanguagesPeer::FLAG => 3, LanguagesPeer::ABBR => 4, LanguagesPeer::SCRIPT => 5, LanguagesPeer::NATIVE => 6, LanguagesPeer::ACTIVE => 7, LanguagesPeer::DEFAULT => 8, LanguagesPeer::CREATED_AT => 9, LanguagesPeer::UPDATED_AT => 10, LanguagesPeer::DELETED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'app_name' => 2, 'flag' => 3, 'abbr' => 4, 'script' => 5, 'native' => 6, 'active' => 7, 'default' => 8, 'created_at' => 9, 'updated_at' => 10, 'deleted_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/LanguagesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.LanguagesMapBuilder');
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
			$map = LanguagesPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. LanguagesPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(LanguagesPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::ID) : LanguagesPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::NAME) : LanguagesPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::APP_NAME) : LanguagesPeer::APP_NAME);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::FLAG) : LanguagesPeer::FLAG);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::ABBR) : LanguagesPeer::ABBR);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::SCRIPT) : LanguagesPeer::SCRIPT);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::NATIVE) : LanguagesPeer::NATIVE);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::ACTIVE) : LanguagesPeer::ACTIVE);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::DEFAULT) : LanguagesPeer::DEFAULT);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::CREATED_AT) : LanguagesPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::UPDATED_AT) : LanguagesPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? LanguagesPeer::alias($tableAlias, LanguagesPeer::DELETED_AT) : LanguagesPeer::DELETED_AT);

	}

	const COUNT = 'COUNT(languages.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT languages.ID)';

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
			$criteria->addSelectColumn(LanguagesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LanguagesPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = LanguagesPeer::doSelectRS($criteria, $con);
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
	 * @return     Languages
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = LanguagesPeer::doSelect($critcopy, $con);
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
		return LanguagesPeer::populateObjects(LanguagesPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseLanguagesPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseLanguagesPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			LanguagesPeer::addSelectColumns($criteria);
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
		$cls = LanguagesPeer::getOMClass();
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
		return LanguagesPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Languages or Criteria object.
	 *
	 * @param      mixed $values Criteria or Languages object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguagesPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLanguagesPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Languages object
		}

		$criteria->remove(LanguagesPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseLanguagesPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseLanguagesPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Languages or Criteria object.
	 *
	 * @param      mixed $values Criteria or Languages object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseLanguagesPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLanguagesPeer', $values, $con);
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

			$comparison = $criteria->getComparison(LanguagesPeer::ID);
			$selectCriteria->add(LanguagesPeer::ID, $criteria->remove(LanguagesPeer::ID), $comparison);

		} else { // $values is Languages object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseLanguagesPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseLanguagesPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the languages table.
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
			$affectedRows += BasePeer::doDeleteAll(LanguagesPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Languages or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Languages object or primary key or array of primary keys
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
			$con = Propel::getConnection(LanguagesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Languages) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LanguagesPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Languages object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Languages $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Languages $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LanguagesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LanguagesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(LanguagesPeer::DATABASE_NAME, LanguagesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = LanguagesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Languages
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(LanguagesPeer::DATABASE_NAME);

		$criteria->add(LanguagesPeer::ID, $pk);


		$v = LanguagesPeer::doSelect($criteria, $con);

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
			$criteria->add(LanguagesPeer::ID, $pks, Criteria::IN);
			$objs = LanguagesPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseLanguagesPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseLanguagesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/LanguagesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.LanguagesMapBuilder');
}
