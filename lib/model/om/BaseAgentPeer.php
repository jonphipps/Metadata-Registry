<?php


abstract class BaseAgentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_agent';

	
	const CLASS_DEFAULT = 'lib.model.Agent';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_agent.ID';

	
	const CREATED_AT = 'reg_agent.CREATED_AT';

	
	const LAST_UPDATED = 'reg_agent.LAST_UPDATED';

	
	const ORG_EMAIL = 'reg_agent.ORG_EMAIL';

	
	const ORG_NAME = 'reg_agent.ORG_NAME';

	
	const IND_AFFILIATION = 'reg_agent.IND_AFFILIATION';

	
	const IND_ROLE = 'reg_agent.IND_ROLE';

	
	const ADDRESS1 = 'reg_agent.ADDRESS1';

	
	const ADDRESS2 = 'reg_agent.ADDRESS2';

	
	const CITY = 'reg_agent.CITY';

	
	const STATE = 'reg_agent.STATE';

	
	const POSTAL_CODE = 'reg_agent.POSTAL_CODE';

	
	const COUNTRY = 'reg_agent.COUNTRY';

	
	const PHONE = 'reg_agent.PHONE';

	
	const WEB_ADDRESS = 'reg_agent.WEB_ADDRESS';

	
	const TYPE = 'reg_agent.TYPE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'OrgEmail', 'OrgName', 'IndAffiliation', 'IndRole', 'Address1', 'Address2', 'City', 'State', 'PostalCode', 'Country', 'Phone', 'WebAddress', 'Type', ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID, AgentPeer::CREATED_AT, AgentPeer::LAST_UPDATED, AgentPeer::ORG_EMAIL, AgentPeer::ORG_NAME, AgentPeer::IND_AFFILIATION, AgentPeer::IND_ROLE, AgentPeer::ADDRESS1, AgentPeer::ADDRESS2, AgentPeer::CITY, AgentPeer::STATE, AgentPeer::POSTAL_CODE, AgentPeer::COUNTRY, AgentPeer::PHONE, AgentPeer::WEB_ADDRESS, AgentPeer::TYPE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'org_email', 'org_name', 'ind_affiliation', 'ind_role', 'address1', 'address2', 'city', 'state', 'postal_code', 'country', 'phone', 'web_address', 'type', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'OrgEmail' => 3, 'OrgName' => 4, 'IndAffiliation' => 5, 'IndRole' => 6, 'Address1' => 7, 'Address2' => 8, 'City' => 9, 'State' => 10, 'PostalCode' => 11, 'Country' => 12, 'Phone' => 13, 'WebAddress' => 14, 'Type' => 15, ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID => 0, AgentPeer::CREATED_AT => 1, AgentPeer::LAST_UPDATED => 2, AgentPeer::ORG_EMAIL => 3, AgentPeer::ORG_NAME => 4, AgentPeer::IND_AFFILIATION => 5, AgentPeer::IND_ROLE => 6, AgentPeer::ADDRESS1 => 7, AgentPeer::ADDRESS2 => 8, AgentPeer::CITY => 9, AgentPeer::STATE => 10, AgentPeer::POSTAL_CODE => 11, AgentPeer::COUNTRY => 12, AgentPeer::PHONE => 13, AgentPeer::WEB_ADDRESS => 14, AgentPeer::TYPE => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'org_email' => 3, 'org_name' => 4, 'ind_affiliation' => 5, 'ind_role' => 6, 'address1' => 7, 'address2' => 8, 'city' => 9, 'state' => 10, 'postal_code' => 11, 'country' => 12, 'phone' => 13, 'web_address' => 14, 'type' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AgentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AgentMapBuilder');
	}
	
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
		return str_replace(AgentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
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

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
		$objects = AgentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AgentPeer::populateObjects(AgentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AgentPeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		$cls = AgentPeer::getOMClass();
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
		return AgentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentPeer', $values, $con);
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

		$criteria->remove(AgentPeer::ID); 


		
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			
			
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAgentPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentPeer', $values, $con);
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

			$comparison = $criteria->getComparison(AgentPeer::ID);
			$selectCriteria->add(AgentPeer::ID, $criteria->remove(AgentPeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAgentPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(AgentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof Agent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AgentPeer::ID, (array) $values, Criteria::IN);
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

		return BasePeer::doValidate(AgentPeer::DATABASE_NAME, AgentPeer::TABLE_NAME, $columns);
	}

	
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

} 


if (Propel::isInit()) {
	
	
	try {
		BaseAgentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/AgentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AgentMapBuilder');
}
