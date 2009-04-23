<?php

/**
 * Base static class for performing query and update operations on the 'reg_skos_property' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Apr 22 15:10:11 2009
 *
 * @package    lib.model.om
 */
abstract class BaseSkosPropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_skos_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.SkosProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'reg_skos_property.ID';

	/** the column name for the PARENT_ID field */
	const PARENT_ID = 'reg_skos_property.PARENT_ID';

	/** the column name for the INVERSE_ID field */
	const INVERSE_ID = 'reg_skos_property.INVERSE_ID';

	/** the column name for the NAME field */
	const NAME = 'reg_skos_property.NAME';

	/** the column name for the URI field */
	const URI = 'reg_skos_property.URI';

	/** the column name for the OBJECT_TYPE field */
	const OBJECT_TYPE = 'reg_skos_property.OBJECT_TYPE';

	/** the column name for the DISPLAY_ORDER field */
	const DISPLAY_ORDER = 'reg_skos_property.DISPLAY_ORDER';

	/** the column name for the PICKLIST_ORDER field */
	const PICKLIST_ORDER = 'reg_skos_property.PICKLIST_ORDER';

	/** the column name for the LABEL field */
	const LABEL = 'reg_skos_property.LABEL';

	/** the column name for the DEFINITION field */
	const DEFINITION = 'reg_skos_property.DEFINITION';

	/** the column name for the COMMENT field */
	const COMMENT = 'reg_skos_property.COMMENT';

	/** the column name for the EXAMPLES field */
	const EXAMPLES = 'reg_skos_property.EXAMPLES';

	/** the column name for the IS_REQUIRED field */
	const IS_REQUIRED = 'reg_skos_property.IS_REQUIRED';

	/** the column name for the IS_RECIPROCAL field */
	const IS_RECIPROCAL = 'reg_skos_property.IS_RECIPROCAL';

	/** the column name for the IS_SINGLETON field */
	const IS_SINGLETON = 'reg_skos_property.IS_SINGLETON';

	/** the column name for the IS_SCHEME field */
	const IS_SCHEME = 'reg_skos_property.IS_SCHEME';

	/** the column name for the IS_IN_PICKLIST field */
	const IS_IN_PICKLIST = 'reg_skos_property.IS_IN_PICKLIST';

	/**
	 * An identiy map to hold any loaded instances of SkosProperty objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array SkosProperty[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ParentId', 'InverseId', 'Name', 'Uri', 'ObjectType', 'DisplayOrder', 'PicklistOrder', 'Label', 'Definition', 'Comment', 'Examples', 'IsRequired', 'IsReciprocal', 'IsSingleton', 'IsScheme', 'IsInPicklist', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'parentId', 'inverseId', 'name', 'uri', 'objectType', 'displayOrder', 'picklistOrder', 'label', 'definition', 'comment', 'examples', 'isRequired', 'isReciprocal', 'isSingleton', 'isScheme', 'isInPicklist', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::PARENT_ID, self::INVERSE_ID, self::NAME, self::URI, self::OBJECT_TYPE, self::DISPLAY_ORDER, self::PICKLIST_ORDER, self::LABEL, self::DEFINITION, self::COMMENT, self::EXAMPLES, self::IS_REQUIRED, self::IS_RECIPROCAL, self::IS_SINGLETON, self::IS_SCHEME, self::IS_IN_PICKLIST, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'parent_id', 'inverse_id', 'name', 'uri', 'object_type', 'display_order', 'picklist_order', 'label', 'definition', 'comment', 'examples', 'is_required', 'is_reciprocal', 'is_singleton', 'is_scheme', 'is_in_picklist', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ParentId' => 1, 'InverseId' => 2, 'Name' => 3, 'Uri' => 4, 'ObjectType' => 5, 'DisplayOrder' => 6, 'PicklistOrder' => 7, 'Label' => 8, 'Definition' => 9, 'Comment' => 10, 'Examples' => 11, 'IsRequired' => 12, 'IsReciprocal' => 13, 'IsSingleton' => 14, 'IsScheme' => 15, 'IsInPicklist' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'parentId' => 1, 'inverseId' => 2, 'name' => 3, 'uri' => 4, 'objectType' => 5, 'displayOrder' => 6, 'picklistOrder' => 7, 'label' => 8, 'definition' => 9, 'comment' => 10, 'examples' => 11, 'isRequired' => 12, 'isReciprocal' => 13, 'isSingleton' => 14, 'isScheme' => 15, 'isInPicklist' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::PARENT_ID => 1, self::INVERSE_ID => 2, self::NAME => 3, self::URI => 4, self::OBJECT_TYPE => 5, self::DISPLAY_ORDER => 6, self::PICKLIST_ORDER => 7, self::LABEL => 8, self::DEFINITION => 9, self::COMMENT => 10, self::EXAMPLES => 11, self::IS_REQUIRED => 12, self::IS_RECIPROCAL => 13, self::IS_SINGLETON => 14, self::IS_SCHEME => 15, self::IS_IN_PICKLIST => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'parent_id' => 1, 'inverse_id' => 2, 'name' => 3, 'uri' => 4, 'object_type' => 5, 'display_order' => 6, 'picklist_order' => 7, 'label' => 8, 'definition' => 9, 'comment' => 10, 'examples' => 11, 'is_required' => 12, 'is_reciprocal' => 13, 'is_singleton' => 14, 'is_scheme' => 15, 'is_in_picklist' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new SkosPropertyMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
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
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
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
	 * @param      string $column The column name for current table. (i.e. SkosPropertyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SkosPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(SkosPropertyPeer::ID);

		$criteria->addSelectColumn(SkosPropertyPeer::PARENT_ID);

		$criteria->addSelectColumn(SkosPropertyPeer::INVERSE_ID);

		$criteria->addSelectColumn(SkosPropertyPeer::NAME);

		$criteria->addSelectColumn(SkosPropertyPeer::URI);

		$criteria->addSelectColumn(SkosPropertyPeer::OBJECT_TYPE);

		$criteria->addSelectColumn(SkosPropertyPeer::DISPLAY_ORDER);

		$criteria->addSelectColumn(SkosPropertyPeer::PICKLIST_ORDER);

		$criteria->addSelectColumn(SkosPropertyPeer::LABEL);

		$criteria->addSelectColumn(SkosPropertyPeer::DEFINITION);

		$criteria->addSelectColumn(SkosPropertyPeer::COMMENT);

		$criteria->addSelectColumn(SkosPropertyPeer::EXAMPLES);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_REQUIRED);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_RECIPROCAL);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_SINGLETON);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_SCHEME);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_IN_PICKLIST);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(SkosPropertyPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SkosPropertyPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSkosPropertyPeer', $criteria, $con);
    }


		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     SkosProperty
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SkosPropertyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SkosPropertyPeer::populateObjects(SkosPropertyPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseSkosPropertyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SkosPropertyPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      SkosProperty $value A SkosProperty object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(SkosProperty $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A SkosProperty object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof SkosProperty) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or SkosProperty object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     SkosProperty Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = SkosPropertyPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SkosPropertyPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SkosPropertyPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SkosPropertyPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array(array('id'), array('name'), array('uri'));
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
		return SkosPropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SkosProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SkosProperty object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSkosPropertyPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from SkosProperty object
		}

		if ($criteria->containsKey(SkosPropertyPeer::ID) && $criteria->keyContainsValue(SkosPropertyPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.SkosPropertyPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSkosPropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a SkosProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or SkosProperty object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSkosPropertyPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(SkosPropertyPeer::ID);
			$selectCriteria->add(SkosPropertyPeer::ID, $criteria->remove(SkosPropertyPeer::ID), $comparison);

		} else { // $values is SkosProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSkosPropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSkosPropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_skos_property table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SkosPropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SkosProperty or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SkosProperty object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			SkosPropertyPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof SkosProperty) {
			// invalidate the cache for this single object
			SkosPropertyPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SkosPropertyPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				SkosPropertyPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given SkosProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SkosProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SkosProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SkosPropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SkosPropertyPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(SkosPropertyPeer::DATABASE_NAME, SkosPropertyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SkosPropertyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     SkosProperty
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = SkosPropertyPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);
		$criteria->add(SkosPropertyPeer::ID, $pk);

		$v = SkosPropertyPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);
			$criteria->add(SkosPropertyPeer::ID, $pks, Criteria::IN);
			$objs = SkosPropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSkosPropertyPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the SkosPropertyPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the SkosPropertyPeer class:
//
// Propel::getDatabaseMap(SkosPropertyPeer::DATABASE_NAME)->addTableBuilder(SkosPropertyPeer::TABLE_NAME, SkosPropertyPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseSkosPropertyPeer::DATABASE_NAME)->addTableBuilder(BaseSkosPropertyPeer::TABLE_NAME, BaseSkosPropertyPeer::getMapBuilder());

