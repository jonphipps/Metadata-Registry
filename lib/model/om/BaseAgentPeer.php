<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by AgentPeer::getOMClass()
include_once 'model/Agent.php';

/**
 * Base static class for performing query and update operations on the 'reg_agent' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseAgentPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_agent';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'model.Agent';

	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_agent.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_agent.CREATED_AT';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'reg_agent.LAST_UPDATED';

	/** the column name for the ORG_EMAIL field */
	const ORG_EMAIL = 'reg_agent.ORG_EMAIL';

	/** the column name for the ORG_NAME field */
	const ORG_NAME = 'reg_agent.ORG_NAME';

	/** the column name for the IND_AFFILIATION field */
	const IND_AFFILIATION = 'reg_agent.IND_AFFILIATION';

	/** the column name for the IND_ROLE field */
	const IND_ROLE = 'reg_agent.IND_ROLE';

	/** the column name for the ADDRESS1 field */
	const ADDRESS1 = 'reg_agent.ADDRESS1';

	/** the column name for the ADDRESS2 field */
	const ADDRESS2 = 'reg_agent.ADDRESS2';

	/** the column name for the CITY field */
	const CITY = 'reg_agent.CITY';

	/** the column name for the STATE field */
	const STATE = 'reg_agent.STATE';

	/** the column name for the POSTAL_CODE field */
	const POSTAL_CODE = 'reg_agent.POSTAL_CODE';

	/** the column name for the COUNTRY field */
	const COUNTRY = 'reg_agent.COUNTRY';

	/** the column name for the PHONE field */
	const PHONE = 'reg_agent.PHONE';

	/** the column name for the WEB_ADDRESS field */
	const WEB_ADDRESS = 'reg_agent.WEB_ADDRESS';

	/** the column name for the TYPE field */
	const TYPE = 'reg_agent.TYPE';

	/** A key representing a particular subclass */
	const CLASSKEY_INDIVIDUAL = 'INDIVIDUAL';

	/** A class that can be returned by this peer. */
	const CLASSNAME_INDIVIDUAL = 'model.Individual';

	/** A key representing a particular subclass */
	const CLASSKEY_ORGANIZATION = 'ORGANIZATION';

	/** A class that can be returned by this peer. */
	const CLASSNAME_ORGANIZATION = 'model.Organization';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'OrgEmail', 'OrgName', 'IndAffiliation', 'IndRole', 'Address1', 'Address2', 'City', 'State', 'PostalCode', 'Country', 'Phone', 'WebAddress', 'Type', ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID, AgentPeer::CREATED_AT, AgentPeer::LAST_UPDATED, AgentPeer::ORG_EMAIL, AgentPeer::ORG_NAME, AgentPeer::IND_AFFILIATION, AgentPeer::IND_ROLE, AgentPeer::ADDRESS1, AgentPeer::ADDRESS2, AgentPeer::CITY, AgentPeer::STATE, AgentPeer::POSTAL_CODE, AgentPeer::COUNTRY, AgentPeer::PHONE, AgentPeer::WEB_ADDRESS, AgentPeer::TYPE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'org_email', 'org_name', 'ind_affiliation', 'ind_role', 'address1', 'address2', 'city', 'state', 'postal_code', 'country', 'phone', 'web_address', 'type', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'OrgEmail' => 3, 'OrgName' => 4, 'IndAffiliation' => 5, 'IndRole' => 6, 'Address1' => 7, 'Address2' => 8, 'City' => 9, 'State' => 10, 'PostalCode' => 11, 'Country' => 12, 'Phone' => 13, 'WebAddress' => 14, 'Type' => 15, ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID => 0, AgentPeer::CREATED_AT => 1, AgentPeer::LAST_UPDATED => 2, AgentPeer::ORG_EMAIL => 3, AgentPeer::ORG_NAME => 4, AgentPeer::IND_AFFILIATION => 5, AgentPeer::IND_ROLE => 6, AgentPeer::ADDRESS1 => 7, AgentPeer::ADDRESS2 => 8, AgentPeer::CITY => 9, AgentPeer::STATE => 10, AgentPeer::POSTAL_CODE => 11, AgentPeer::COUNTRY => 12, AgentPeer::PHONE => 13, AgentPeer::WEB_ADDRESS => 14, AgentPeer::TYPE => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'org_email' => 3, 'org_name' => 4, 'ind_affiliation' => 5, 'ind_role' => 6, 'address1' => 7, 'address2' => 8, 'city' => 9, 'state' => 10, 'postal_code' => 11, 'country' => 12, 'phone' => 13, 'web_address' => 14, 'type' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * @return MapBuilder the map builder for this peer
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'model/map/AgentMapBuilder.php';
		return BasePeer::getMapBuilder('model.map.AgentMapBuilder');
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
			$map = AgentPeer::getTableMap();
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
	 * @param string $column The column name for current table. (i.e. AgentPeer::COLUMN_NAME).
	 * @return string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AgentPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(AgentPeer::ID);

		$criteria->addSelectColumn(AgentPeer::CREATED_AT);

		$criteria->addSelectColumn(AgentPeer::LAST_UPDATED);

		$criteria->addSelectColumn(AgentPeer::ORG_EMAIL);

		$criteria->addSelectColumn(AgentPeer::ORG_NAME);

		$criteria->addSelectColumn(AgentPeer::IND_AFFILIATION);

		$criteria->addSelectColumn(AgentPeer::IND_ROLE);

		$criteria->addSelectColumn(AgentPeer::ADDRESS1);

		$criteria->addSelectColumn(AgentPeer::ADDRESS2);

		$criteria->addSelectColumn(AgentPeer::CITY);

		$criteria->addSelectColumn(AgentPeer::STATE);

		$criteria->addSelectColumn(AgentPeer::POSTAL_CODE);

		$criteria->addSelectColumn(AgentPeer::COUNTRY);

		$criteria->addSelectColumn(AgentPeer::PHONE);

		$criteria->addSelectColumn(AgentPeer::WEB_ADDRESS);

		$criteria->addSelectColumn(AgentPeer::TYPE);

	}

	const COUNT = 'COUNT(reg_agent.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_agent.ID)';

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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
	 * @return Agent
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AgentPeer::doSelect($critcopy, $con);
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
		return AgentPeer::populateObjects(AgentPeer::doSelectRS($criteria, $con));
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
			AgentPeer::addSelectColumns($criteria);
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
	
		// populate the object(s)
		while($rs->next()) {
		
			// class must be set each time from the record row
			$cls = Propel::import(AgentPeer::getOMClass($rs, 1));
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
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
	 * The returned Class will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @param ResultSet $rs ResultSet with pointer to record containing om class.
	 * @param int $colnum Column to examine for OM class information (first is 1).
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getOMClass(ResultSet $rs, $colnum)
	{
		try {

			$omClass = null;
			$classKey = $rs->getString($colnum - 1 + 16);

			switch($classKey) {

				case self::CLASSKEY_INDIVIDUAL:
					$omClass = self::CLASSNAME_INDIVIDUAL;
					break;

				case self::CLASSKEY_ORGANIZATION:
					$omClass = self::CLASSNAME_ORGANIZATION;
					break;

				default:
					$omClass = self::CLASS_DEFAULT;

			} // switch

		} catch (Exception $e) {
			throw new PropelException('Unable to get OM class.', $e);
		}
		return $omClass;
	}

	/**
	 * Method perform an INSERT on the database, given a Agent or Criteria object.
	 *
	 * @param mixed $values Criteria or Agent object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from Agent object
		}

		$criteria->remove(AgentPeer::ID); // remove pkey col since this table uses auto-increment


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
	 * Method perform an UPDATE on the database, given a Agent or Criteria object.
	 *
	 * @param mixed $values Criteria or Agent object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(AgentPeer::ID);
			$selectCriteria->add(AgentPeer::ID, $criteria->remove(AgentPeer::ID), $comparison);

		} else { // $values is Agent object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the reg_agent table.
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
			$affectedRows += BasePeer::doDeleteAll(AgentPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Agent or Criteria object OR a primary key value.
	 *
	 * @param mixed $values Criteria or Agent object or primary key or array of primary keys
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Agent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AgentPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Agent object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param Agent $obj The object to validate.
	 * @param mixed $cols Column name or array of column names.
	 *
	 * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Agent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AgentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AgentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AgentPeer::DATABASE_NAME, AgentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AgentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param mixed $pk the primary key.
	 * @param Connection $con the connection to use
	 * @return Agent
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		$criteria->add(AgentPeer::ID, $pk);


		$v = AgentPeer::doSelect($criteria, $con);
        return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param array $pks List of primary keys
	 * @param Connection $con the connection to use
	 * @throws PropelException Any exceptions caught during processing will be
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
			$criteria->add(AgentPeer::ID, $pks, Criteria::IN);
			$objs = AgentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseAgentPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseAgentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'model/map/AgentMapBuilder.php';
	Propel::registerMapBuilder('model.map.AgentMapBuilder');
}
