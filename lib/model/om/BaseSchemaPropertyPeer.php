<?php

/**
 * Base static class for performing query and update operations on the 'reg_schema_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSchemaPropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_schema_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SchemaProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_schema_property.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_schema_property.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_schema_property.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_schema_property.DELETED_AT';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_schema_property.CREATED_USER_ID';

	/** the column name for the UPDATED_USER_ID field */
	const UPDATED_USER_ID = 'reg_schema_property.UPDATED_USER_ID';

	/** the column name for the SCHEMA_ID field */
	const SCHEMA_ID = 'reg_schema_property.SCHEMA_ID';

	/** the column name for the TOKEN field */
	const TOKEN = 'reg_schema_property.TOKEN';

	/** the column name for the LABEL field */
	const LABEL = 'reg_schema_property.LABEL';

	/** the column name for the DEFINITION field */
	const DEFINITION = 'reg_schema_property.DEFINITION';

	/** the column name for the COMMENT field */
	const COMMENT = 'reg_schema_property.COMMENT';

	/** the column name for the TYPE field */
	const TYPE = 'reg_schema_property.TYPE';

	/** the column name for the IS_SUBPROPERTY_ID field */
	const IS_SUBPROPERTY_ID = 'reg_schema_property.IS_SUBPROPERTY_ID';

	/** the column name for the IS_SUBPROPERTY field */
	const IS_SUBPROPERTY = 'reg_schema_property.IS_SUBPROPERTY';

	/** the column name for the HAS_SUBPROPERTY_ID field */
	const HAS_SUBPROPERTY_ID = 'reg_schema_property.HAS_SUBPROPERTY_ID';

	/** the column name for the HAS_SUBPROPERTY field */
	const HAS_SUBPROPERTY = 'reg_schema_property.HAS_SUBPROPERTY';

	/** the column name for the URI field */
	const URI = 'reg_schema_property.URI';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedUserId', 'UpdatedUserId', 'SchemaId', 'Token', 'Label', 'Definition', 'Comment', 'Type', 'IsSubpropertyId', 'IsSubproperty', 'HasSubpropertyId', 'HasSubproperty', 'Uri', ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyPeer::ID, SchemaPropertyPeer::CREATED_AT, SchemaPropertyPeer::UPDATED_AT, SchemaPropertyPeer::DELETED_AT, SchemaPropertyPeer::CREATED_USER_ID, SchemaPropertyPeer::UPDATED_USER_ID, SchemaPropertyPeer::SCHEMA_ID, SchemaPropertyPeer::TOKEN, SchemaPropertyPeer::LABEL, SchemaPropertyPeer::DEFINITION, SchemaPropertyPeer::COMMENT, SchemaPropertyPeer::TYPE, SchemaPropertyPeer::IS_SUBPROPERTY_ID, SchemaPropertyPeer::IS_SUBPROPERTY, SchemaPropertyPeer::HAS_SUBPROPERTY_ID, SchemaPropertyPeer::HAS_SUBPROPERTY, SchemaPropertyPeer::URI, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'created_user_id', 'updated_user_id', 'schema_id', 'token', 'label', 'definition', 'comment', 'type', 'is_subproperty_id', 'is_subproperty', 'has_subproperty_id', 'has_subproperty', 'uri', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'CreatedUserId' => 4, 'UpdatedUserId' => 5, 'SchemaId' => 6, 'Token' => 7, 'Label' => 8, 'Definition' => 9, 'Comment' => 10, 'Type' => 11, 'IsSubpropertyId' => 12, 'IsSubproperty' => 13, 'HasSubpropertyId' => 14, 'HasSubproperty' => 15, 'Uri' => 16, ),
		BasePeer::TYPE_COLNAME => array (SchemaPropertyPeer::ID => 0, SchemaPropertyPeer::CREATED_AT => 1, SchemaPropertyPeer::UPDATED_AT => 2, SchemaPropertyPeer::DELETED_AT => 3, SchemaPropertyPeer::CREATED_USER_ID => 4, SchemaPropertyPeer::UPDATED_USER_ID => 5, SchemaPropertyPeer::SCHEMA_ID => 6, SchemaPropertyPeer::TOKEN => 7, SchemaPropertyPeer::LABEL => 8, SchemaPropertyPeer::DEFINITION => 9, SchemaPropertyPeer::COMMENT => 10, SchemaPropertyPeer::TYPE => 11, SchemaPropertyPeer::IS_SUBPROPERTY_ID => 12, SchemaPropertyPeer::IS_SUBPROPERTY => 13, SchemaPropertyPeer::HAS_SUBPROPERTY_ID => 14, SchemaPropertyPeer::HAS_SUBPROPERTY => 15, SchemaPropertyPeer::URI => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'created_user_id' => 4, 'updated_user_id' => 5, 'schema_id' => 6, 'token' => 7, 'label' => 8, 'definition' => 9, 'comment' => 10, 'type' => 11, 'is_subproperty_id' => 12, 'is_subproperty' => 13, 'has_subproperty_id' => 14, 'has_subproperty' => 15, 'uri' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SchemaPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SchemaPropertyMapBuilder');
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
			$map = SchemaPropertyPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SchemaPropertyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchemaPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
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
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SchemaPropertyPeer::ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::CREATED_AT);

		$criteria->addSelectColumn(SchemaPropertyPeer::UPDATED_AT);

		$criteria->addSelectColumn(SchemaPropertyPeer::DELETED_AT);

		$criteria->addSelectColumn(SchemaPropertyPeer::CREATED_USER_ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::UPDATED_USER_ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::SCHEMA_ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::TOKEN);

		$criteria->addSelectColumn(SchemaPropertyPeer::LABEL);

		$criteria->addSelectColumn(SchemaPropertyPeer::DEFINITION);

		$criteria->addSelectColumn(SchemaPropertyPeer::COMMENT);

		$criteria->addSelectColumn(SchemaPropertyPeer::TYPE);

		$criteria->addSelectColumn(SchemaPropertyPeer::IS_SUBPROPERTY_ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::IS_SUBPROPERTY);

		$criteria->addSelectColumn(SchemaPropertyPeer::HAS_SUBPROPERTY_ID);

		$criteria->addSelectColumn(SchemaPropertyPeer::HAS_SUBPROPERTY);

		$criteria->addSelectColumn(SchemaPropertyPeer::URI);

	}

	const COUNT = 'COUNT(reg_schema_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_schema_property.ID)';

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
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SchemaPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SchemaPropertyPeer::doSelectRS($criteria, $con);
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
	 * @return     SchemaProperty
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchemaPropertyPeer::doSelect($critcopy, $con);
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
		return SchemaPropertyPeer::populateObjects(SchemaPropertyPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SchemaPropertyPeer::addSelectColumns($criteria);
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
		$cls = SchemaPropertyPeer::getOMClass();
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
		return SchemaPropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SchemaProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from SchemaProperty object
		}

		$criteria->remove(SchemaPropertyPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SchemaProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con);
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

			$comparison = $criteria->getComparison(SchemaPropertyPeer::ID);
			$selectCriteria->add(SchemaPropertyPeer::ID, $criteria->remove(SchemaPropertyPeer::ID), $comparison);

		} else { // $values is SchemaProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSchemaPropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSchemaPropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_schema_property table.
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
			$affectedRows += BasePeer::doDeleteAll(SchemaPropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SchemaProperty or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SchemaProperty object or primary key or array of primary keys
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
			$con = Propel::getConnection(SchemaPropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SchemaProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchemaPropertyPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SchemaProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SchemaProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SchemaProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchemaPropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchemaPropertyPeer::TABLE_NAME);

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

		return BasePeer::doValidate(SchemaPropertyPeer::DATABASE_NAME, SchemaPropertyPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     SchemaProperty
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SchemaPropertyPeer::DATABASE_NAME);

		$criteria->add(SchemaPropertyPeer::ID, $pk);


		$v = SchemaPropertyPeer::doSelect($criteria, $con);

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
			$criteria->add(SchemaPropertyPeer::ID, $pks, Criteria::IN);
			$objs = SchemaPropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSchemaPropertyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSchemaPropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/SchemaPropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SchemaPropertyMapBuilder');
}
