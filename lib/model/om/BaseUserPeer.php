<?php


abstract class BaseUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_user';

	
	const CLASS_DEFAULT = 'lib.model.User';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_user.ID';

	
	const CREATED_AT = 'reg_user.CREATED_AT';

	
	const LAST_UPDATED = 'reg_user.LAST_UPDATED';

	
	const DELETED_AT = 'reg_user.DELETED_AT';

	
	const NICKNAME = 'reg_user.NICKNAME';

	
	const SALUTATION = 'reg_user.SALUTATION';

	
	const FIRST_NAME = 'reg_user.FIRST_NAME';

	
	const LAST_NAME = 'reg_user.LAST_NAME';

	
	const EMAIL = 'reg_user.EMAIL';

	
	const SHA1_PASSWORD = 'reg_user.SHA1_PASSWORD';

	
	const SALT = 'reg_user.SALT';

	
	const WANT_TO_BE_MODERATOR = 'reg_user.WANT_TO_BE_MODERATOR';

	
	const IS_MODERATOR = 'reg_user.IS_MODERATOR';

	
	const IS_ADMINISTRATOR = 'reg_user.IS_ADMINISTRATOR';

	
	const DELETIONS = 'reg_user.DELETIONS';

	
	const PASSWORD = 'reg_user.PASSWORD';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'DeletedAt', 'Nickname', 'Salutation', 'FirstName', 'LastName', 'Email', 'Sha1Password', 'Salt', 'WantToBeModerator', 'IsModerator', 'IsAdministrator', 'Deletions', 'Password', ),
		BasePeer::TYPE_COLNAME => array (UserPeer::ID, UserPeer::CREATED_AT, UserPeer::LAST_UPDATED, UserPeer::DELETED_AT, UserPeer::NICKNAME, UserPeer::SALUTATION, UserPeer::FIRST_NAME, UserPeer::LAST_NAME, UserPeer::EMAIL, UserPeer::SHA1_PASSWORD, UserPeer::SALT, UserPeer::WANT_TO_BE_MODERATOR, UserPeer::IS_MODERATOR, UserPeer::IS_ADMINISTRATOR, UserPeer::DELETIONS, UserPeer::PASSWORD, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'deleted_at', 'nickname', 'salutation', 'first_name', 'last_name', 'email', 'sha1_password', 'salt', 'want_to_be_moderator', 'is_moderator', 'is_administrator', 'deletions', 'password', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'DeletedAt' => 3, 'Nickname' => 4, 'Salutation' => 5, 'FirstName' => 6, 'LastName' => 7, 'Email' => 8, 'Sha1Password' => 9, 'Salt' => 10, 'WantToBeModerator' => 11, 'IsModerator' => 12, 'IsAdministrator' => 13, 'Deletions' => 14, 'Password' => 15, ),
		BasePeer::TYPE_COLNAME => array (UserPeer::ID => 0, UserPeer::CREATED_AT => 1, UserPeer::LAST_UPDATED => 2, UserPeer::DELETED_AT => 3, UserPeer::NICKNAME => 4, UserPeer::SALUTATION => 5, UserPeer::FIRST_NAME => 6, UserPeer::LAST_NAME => 7, UserPeer::EMAIL => 8, UserPeer::SHA1_PASSWORD => 9, UserPeer::SALT => 10, UserPeer::WANT_TO_BE_MODERATOR => 11, UserPeer::IS_MODERATOR => 12, UserPeer::IS_ADMINISTRATOR => 13, UserPeer::DELETIONS => 14, UserPeer::PASSWORD => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'deleted_at' => 3, 'nickname' => 4, 'salutation' => 5, 'first_name' => 6, 'last_name' => 7, 'email' => 8, 'sha1_password' => 9, 'salt' => 10, 'want_to_be_moderator' => 11, 'is_moderator' => 12, 'is_administrator' => 13, 'deletions' => 14, 'password' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserPeer::ID);

		$criteria->addSelectColumn(UserPeer::CREATED_AT);

		$criteria->addSelectColumn(UserPeer::LAST_UPDATED);

		$criteria->addSelectColumn(UserPeer::DELETED_AT);

		$criteria->addSelectColumn(UserPeer::NICKNAME);

		$criteria->addSelectColumn(UserPeer::SALUTATION);

		$criteria->addSelectColumn(UserPeer::FIRST_NAME);

		$criteria->addSelectColumn(UserPeer::LAST_NAME);

		$criteria->addSelectColumn(UserPeer::EMAIL);

		$criteria->addSelectColumn(UserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(UserPeer::SALT);

		$criteria->addSelectColumn(UserPeer::WANT_TO_BE_MODERATOR);

		$criteria->addSelectColumn(UserPeer::IS_MODERATOR);

		$criteria->addSelectColumn(UserPeer::IS_ADMINISTRATOR);

		$criteria->addSelectColumn(UserPeer::DELETIONS);

		$criteria->addSelectColumn(UserPeer::PASSWORD);

	}

	const COUNT = 'COUNT(reg_user.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_user.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserPeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			
			return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserPeer::populateObjects(UserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserPeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		$cls = UserPeer::getOMClass();
		$cls = Propel::import($cls);
		
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return UserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUserPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} else {
			$criteria = $values->buildCriteria(); 
		}

		$criteria->remove(UserPeer::ID); 


		
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			
			
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseUserPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseUserPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUserPeer', $values, $con);
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
			$criteria = clone $values; 

			$comparison = $criteria->getComparison(UserPeer::ID);
			$selectCriteria->add(UserPeer::ID, $criteria->remove(UserPeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseUserPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseUserPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 
		try {
			
			
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof User) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserPeer::ID, (array) $values, Criteria::IN);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 

		try {
			
			
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(User $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

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

		return BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $pk);


		$v = UserPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
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
			$criteria->add(UserPeer::ID, $pks, Criteria::IN);
			$objs = UserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 


if (Propel::isInit()) {
	
	
	try {
		BaseUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/UserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UserMapBuilder');
}
