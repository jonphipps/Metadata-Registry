<?php

/**
 * Base static class for performing query and update operations on the 'users' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseUsersPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'users';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Users';

	/** The total number of columns. */
	const NUM_COLUMNS = 23;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'users.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'users.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'users.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'users.DELETED_AT';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'users.LAST_UPDATED';

	/** the column name for the NICKNAME field */
	const NICKNAME = 'users.NICKNAME';

	/** the column name for the SALUTATION field */
	const SALUTATION = 'users.SALUTATION';

	/** the column name for the FIRST_NAME field */
	const FIRST_NAME = 'users.FIRST_NAME';

	/** the column name for the LAST_NAME field */
	const LAST_NAME = 'users.LAST_NAME';

	/** the column name for the EMAIL field */
	const EMAIL = 'users.EMAIL';

	/** the column name for the SHA1_PASSWORD field */
	const SHA1_PASSWORD = 'users.SHA1_PASSWORD';

	/** the column name for the SALT field */
	const SALT = 'users.SALT';

	/** the column name for the WANT_TO_BE_MODERATOR field */
	const WANT_TO_BE_MODERATOR = 'users.WANT_TO_BE_MODERATOR';

	/** the column name for the IS_MODERATOR field */
	const IS_MODERATOR = 'users.IS_MODERATOR';

	/** the column name for the IS_ADMINISTRATOR field */
	const IS_ADMINISTRATOR = 'users.IS_ADMINISTRATOR';

	/** the column name for the DELETIONS field */
	const DELETIONS = 'users.DELETIONS';

	/** the column name for the PASSWORD field */
	const PASSWORD = 'users.PASSWORD';

	/** the column name for the STATUS field */
	const STATUS = 'users.STATUS';

	/** the column name for the CULTURE field */
	const CULTURE = 'users.CULTURE';

	/** the column name for the CONFIRMATION_CODE field */
	const CONFIRMATION_CODE = 'users.CONFIRMATION_CODE';

	/** the column name for the NAME field */
	const NAME = 'users.NAME';

	/** the column name for the CONFIRMED field */
	const CONFIRMED = 'users.CONFIRMED';

	/** the column name for the REMEMBER_TOKEN field */
	const REMEMBER_TOKEN = 'users.REMEMBER_TOKEN';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'LastUpdated', 'Nickname', 'Salutation', 'FirstName', 'LastName', 'Email', 'Sha1Password', 'Salt', 'WantToBeModerator', 'IsModerator', 'IsAdministrator', 'Deletions', 'Password', 'Status', 'Culture', 'ConfirmationCode', 'Name', 'Confirmed', 'RememberToken', ),
		BasePeer::TYPE_COLNAME => array (UsersPeer::ID, UsersPeer::CREATED_AT, UsersPeer::UPDATED_AT, UsersPeer::DELETED_AT, UsersPeer::LAST_UPDATED, UsersPeer::NICKNAME, UsersPeer::SALUTATION, UsersPeer::FIRST_NAME, UsersPeer::LAST_NAME, UsersPeer::EMAIL, UsersPeer::SHA1_PASSWORD, UsersPeer::SALT, UsersPeer::WANT_TO_BE_MODERATOR, UsersPeer::IS_MODERATOR, UsersPeer::IS_ADMINISTRATOR, UsersPeer::DELETIONS, UsersPeer::PASSWORD, UsersPeer::STATUS, UsersPeer::CULTURE, UsersPeer::CONFIRMATION_CODE, UsersPeer::NAME, UsersPeer::CONFIRMED, UsersPeer::REMEMBER_TOKEN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'last_updated', 'nickname', 'salutation', 'first_name', 'last_name', 'email', 'sha1_password', 'salt', 'want_to_be_moderator', 'is_moderator', 'is_administrator', 'deletions', 'password', 'status', 'culture', 'confirmation_code', 'name', 'confirmed', 'remember_token', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'LastUpdated' => 4, 'Nickname' => 5, 'Salutation' => 6, 'FirstName' => 7, 'LastName' => 8, 'Email' => 9, 'Sha1Password' => 10, 'Salt' => 11, 'WantToBeModerator' => 12, 'IsModerator' => 13, 'IsAdministrator' => 14, 'Deletions' => 15, 'Password' => 16, 'Status' => 17, 'Culture' => 18, 'ConfirmationCode' => 19, 'Name' => 20, 'Confirmed' => 21, 'RememberToken' => 22, ),
		BasePeer::TYPE_COLNAME => array (UsersPeer::ID => 0, UsersPeer::CREATED_AT => 1, UsersPeer::UPDATED_AT => 2, UsersPeer::DELETED_AT => 3, UsersPeer::LAST_UPDATED => 4, UsersPeer::NICKNAME => 5, UsersPeer::SALUTATION => 6, UsersPeer::FIRST_NAME => 7, UsersPeer::LAST_NAME => 8, UsersPeer::EMAIL => 9, UsersPeer::SHA1_PASSWORD => 10, UsersPeer::SALT => 11, UsersPeer::WANT_TO_BE_MODERATOR => 12, UsersPeer::IS_MODERATOR => 13, UsersPeer::IS_ADMINISTRATOR => 14, UsersPeer::DELETIONS => 15, UsersPeer::PASSWORD => 16, UsersPeer::STATUS => 17, UsersPeer::CULTURE => 18, UsersPeer::CONFIRMATION_CODE => 19, UsersPeer::NAME => 20, UsersPeer::CONFIRMED => 21, UsersPeer::REMEMBER_TOKEN => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'last_updated' => 4, 'nickname' => 5, 'salutation' => 6, 'first_name' => 7, 'last_name' => 8, 'email' => 9, 'sha1_password' => 10, 'salt' => 11, 'want_to_be_moderator' => 12, 'is_moderator' => 13, 'is_administrator' => 14, 'deletions' => 15, 'password' => 16, 'status' => 17, 'culture' => 18, 'confirmation_code' => 19, 'name' => 20, 'confirmed' => 21, 'remember_token' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UsersMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UsersMapBuilder');
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
			$map = UsersPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. UsersPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UsersPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::ID) : UsersPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::CREATED_AT) : UsersPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::UPDATED_AT) : UsersPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::DELETED_AT) : UsersPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::LAST_UPDATED) : UsersPeer::LAST_UPDATED);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::NICKNAME) : UsersPeer::NICKNAME);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::SALUTATION) : UsersPeer::SALUTATION);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::FIRST_NAME) : UsersPeer::FIRST_NAME);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::LAST_NAME) : UsersPeer::LAST_NAME);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::EMAIL) : UsersPeer::EMAIL);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::SHA1_PASSWORD) : UsersPeer::SHA1_PASSWORD);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::SALT) : UsersPeer::SALT);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::WANT_TO_BE_MODERATOR) : UsersPeer::WANT_TO_BE_MODERATOR);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::IS_MODERATOR) : UsersPeer::IS_MODERATOR);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::IS_ADMINISTRATOR) : UsersPeer::IS_ADMINISTRATOR);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::DELETIONS) : UsersPeer::DELETIONS);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::PASSWORD) : UsersPeer::PASSWORD);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::STATUS) : UsersPeer::STATUS);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::CULTURE) : UsersPeer::CULTURE);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::CONFIRMATION_CODE) : UsersPeer::CONFIRMATION_CODE);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::NAME) : UsersPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::CONFIRMED) : UsersPeer::CONFIRMED);

        $criteria->addSelectColumn(($tableAlias) ? UsersPeer::alias($tableAlias, UsersPeer::REMEMBER_TOKEN) : UsersPeer::REMEMBER_TOKEN);

	}

	const COUNT = 'COUNT(users.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT users.ID)';

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
			$criteria->addSelectColumn(UsersPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsersPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UsersPeer::doSelectRS($criteria, $con);
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
	 * @return     Users
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UsersPeer::doSelect($critcopy, $con);
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
		return UsersPeer::populateObjects(UsersPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseUsersPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseUsersPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UsersPeer::addSelectColumns($criteria);
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
		$cls = UsersPeer::getOMClass();
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
		return UsersPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Users or Criteria object.
	 *
	 * @param      mixed $values Criteria or Users object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsersPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsersPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Users object
		}

		$criteria->remove(UsersPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseUsersPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseUsersPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Users or Criteria object.
	 *
	 * @param      mixed $values Criteria or Users object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsersPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsersPeer', $values, $con);
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

			$comparison = $criteria->getComparison(UsersPeer::ID);
			$selectCriteria->add(UsersPeer::ID, $criteria->remove(UsersPeer::ID), $comparison);

		} else { // $values is Users object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseUsersPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseUsersPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the users table.
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
			$affectedRows += BasePeer::doDeleteAll(UsersPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Users or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Users object or primary key or array of primary keys
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
			$con = Propel::getConnection(UsersPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Users) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsersPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Users object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Users $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Users $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsersPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsersPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UsersPeer::DATABASE_NAME, UsersPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsersPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Users
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(UsersPeer::DATABASE_NAME);

		$criteria->add(UsersPeer::ID, $pk);


		$v = UsersPeer::doSelect($criteria, $con);

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
			$criteria->add(UsersPeer::ID, $pks, Criteria::IN);
			$objs = UsersPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseUsersPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseUsersPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/UsersMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UsersMapBuilder');
}
