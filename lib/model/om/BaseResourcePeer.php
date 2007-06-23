<?php


abstract class BaseResourcePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_resource';

	
	const CLASS_DEFAULT = 'lib.model.Resource';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_resource.ID';

	
	const TYPE = 'reg_resource.TYPE';

	
	const AGENT_ID = 'reg_resource.AGENT_ID';

	
	const CREATED_AT = 'reg_resource.CREATED_AT';

	
	const UPDATE_AT = 'reg_resource.UPDATE_AT';

	
	const NAME = 'reg_resource.NAME';

	
	const NOTE = 'reg_resource.NOTE';

	
	const URI = 'reg_resource.URI';

	
	const URL = 'reg_resource.URL';

	
	const BASE_DOMAIN = 'reg_resource.BASE_DOMAIN';

	
	const TOKEN = 'reg_resource.TOKEN';

	
	const COMMUNITY = 'reg_resource.COMMUNITY';

	
	const LAST_URI_ID = 'reg_resource.LAST_URI_ID';

	
	const CLASSKEY_1 = '1';

	
	const CLASSKEY_SCHEMA = '1';

	
	const CLASSNAME_1 = 'lib.model.Schema';

	
	const CLASSKEY_2 = '2';

	
	const CLASSKEY_PROFILE = '2';

	
	const CLASSNAME_2 = 'lib.model.Profile';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Type', 'AgentId', 'CreatedAt', 'UpdateAt', 'Name', 'Note', 'Uri', 'Url', 'BaseDomain', 'Token', 'Community', 'LastUriId', ),
		BasePeer::TYPE_COLNAME => array (ResourcePeer::ID, ResourcePeer::TYPE, ResourcePeer::AGENT_ID, ResourcePeer::CREATED_AT, ResourcePeer::UPDATE_AT, ResourcePeer::NAME, ResourcePeer::NOTE, ResourcePeer::URI, ResourcePeer::URL, ResourcePeer::BASE_DOMAIN, ResourcePeer::TOKEN, ResourcePeer::COMMUNITY, ResourcePeer::LAST_URI_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'type', 'agent_id', 'created_at', 'update_at', 'name', 'note', 'uri', 'url', 'base_domain', 'token', 'community', 'last_uri_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Type' => 1, 'AgentId' => 2, 'CreatedAt' => 3, 'UpdateAt' => 4, 'Name' => 5, 'Note' => 6, 'Uri' => 7, 'Url' => 8, 'BaseDomain' => 9, 'Token' => 10, 'Community' => 11, 'LastUriId' => 12, ),
		BasePeer::TYPE_COLNAME => array (ResourcePeer::ID => 0, ResourcePeer::TYPE => 1, ResourcePeer::AGENT_ID => 2, ResourcePeer::CREATED_AT => 3, ResourcePeer::UPDATE_AT => 4, ResourcePeer::NAME => 5, ResourcePeer::NOTE => 6, ResourcePeer::URI => 7, ResourcePeer::URL => 8, ResourcePeer::BASE_DOMAIN => 9, ResourcePeer::TOKEN => 10, ResourcePeer::COMMUNITY => 11, ResourcePeer::LAST_URI_ID => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'type' => 1, 'agent_id' => 2, 'created_at' => 3, 'update_at' => 4, 'name' => 5, 'note' => 6, 'uri' => 7, 'url' => 8, 'base_domain' => 9, 'token' => 10, 'community' => 11, 'last_uri_id' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ResourceMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ResourceMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ResourcePeer::getTableMap();
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
		return str_replace(ResourcePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ResourcePeer::ID);

		$criteria->addSelectColumn(ResourcePeer::TYPE);

		$criteria->addSelectColumn(ResourcePeer::AGENT_ID);

		$criteria->addSelectColumn(ResourcePeer::CREATED_AT);

		$criteria->addSelectColumn(ResourcePeer::UPDATE_AT);

		$criteria->addSelectColumn(ResourcePeer::NAME);

		$criteria->addSelectColumn(ResourcePeer::NOTE);

		$criteria->addSelectColumn(ResourcePeer::URI);

		$criteria->addSelectColumn(ResourcePeer::URL);

		$criteria->addSelectColumn(ResourcePeer::BASE_DOMAIN);

		$criteria->addSelectColumn(ResourcePeer::TOKEN);

		$criteria->addSelectColumn(ResourcePeer::COMMUNITY);

		$criteria->addSelectColumn(ResourcePeer::LAST_URI_ID);

	}

	const COUNT = 'COUNT(reg_resource.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_resource.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResourcePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResourcePeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ResourcePeer::doSelectRS($criteria, $con);
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
		$objects = ResourcePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ResourcePeer::populateObjects(ResourcePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseResourcePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseResourcePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ResourcePeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		while($rs->next()) {
		
			
			$cls = Propel::import(ResourcePeer::getOMClass($rs, 1));
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAgent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResourcePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResourcePeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ResourcePeer::AGENT_ID, AgentPeer::ID);

		$rs = ResourcePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAgent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ResourcePeer::addSelectColumns($c);
		$startcol = (ResourcePeer::NUM_COLUMNS - ResourcePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AgentPeer::addSelectColumns($c);

		$c->addJoin(ResourcePeer::AGENT_ID, AgentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ResourcePeer::getOMClass($rs, 1);

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAgent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addResource($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initResources();
				$obj2->addResource($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ResourcePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ResourcePeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ResourcePeer::AGENT_ID, AgentPeer::ID);

		$rs = ResourcePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ResourcePeer::addSelectColumns($c);
		$startcol2 = (ResourcePeer::NUM_COLUMNS - ResourcePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		$c->addJoin(ResourcePeer::AGENT_ID, AgentPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ResourcePeer::getOMClass($rs, 1);

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = AgentPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addResource($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initResources();
				$obj2->addResource($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass(ResultSet $rs, $colnum)
	{
		try {

			$omClass = null;
			$classKey = $rs->getString($colnum - 1 + 2);

			switch($classKey) {

				case self::CLASSKEY_1:
					$omClass = self::CLASSNAME_1;
					break;

				case self::CLASSKEY_2:
					$omClass = self::CLASSNAME_2;
					break;

				default:
					$omClass = self::CLASS_DEFAULT;

			} 

		} catch (Exception $e) {
			throw new PropelException('Unable to get OM class.', $e);
		}
		return $omClass;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseResourcePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseResourcePeer', $values, $con);
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

		$criteria->remove(ResourcePeer::ID); 


		
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			
			
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseResourcePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseResourcePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseResourcePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseResourcePeer', $values, $con);
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

			$comparison = $criteria->getComparison(ResourcePeer::ID);
			$selectCriteria->add(ResourcePeer::ID, $criteria->remove(ResourcePeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseResourcePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseResourcePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ResourcePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ResourcePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof Resource) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ResourcePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Resource $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ResourcePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ResourcePeer::TABLE_NAME);

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

		return BasePeer::doValidate(ResourcePeer::DATABASE_NAME, ResourcePeer::TABLE_NAME, $columns);
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ResourcePeer::DATABASE_NAME);

		$criteria->add(ResourcePeer::ID, $pk);


		$v = ResourcePeer::doSelect($criteria, $con);

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
			$criteria->add(ResourcePeer::ID, $pks, Criteria::IN);
			$objs = ResourcePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 


if (Propel::isInit()) {
	
	
	try {
		BaseResourcePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/ResourceMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ResourceMapBuilder');
}
