<?php


abstract class BaseVocabularyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_vocabulary';

	
	const CLASS_DEFAULT = 'lib.model.Vocabulary';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_vocabulary.ID';

	
	const AGENT_ID = 'reg_vocabulary.AGENT_ID';

	
	const CREATED_AT = 'reg_vocabulary.CREATED_AT';

	
	const LAST_UPDATED = 'reg_vocabulary.LAST_UPDATED';

	
	const NAME = 'reg_vocabulary.NAME';

	
	const NOTE = 'reg_vocabulary.NOTE';

	
	const URI = 'reg_vocabulary.URI';

	
	const URL = 'reg_vocabulary.URL';

	
	const BASE_DOMAIN = 'reg_vocabulary.BASE_DOMAIN';

	
	const TOKEN = 'reg_vocabulary.TOKEN';

	
	const COMMUNITY = 'reg_vocabulary.COMMUNITY';

	
	const LAST_URI_ID = 'reg_vocabulary.LAST_URI_ID';

	
	const STATUS_ID = 'reg_vocabulary.STATUS_ID';

	
	const LANGUAGE = 'reg_vocabulary.LANGUAGE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AgentId', 'CreatedAt', 'LastUpdated', 'Name', 'Note', 'Uri', 'Url', 'BaseDomain', 'Token', 'Community', 'LastUriId', 'StatusId', 'Language', ),
		BasePeer::TYPE_COLNAME => array (VocabularyPeer::ID, VocabularyPeer::AGENT_ID, VocabularyPeer::CREATED_AT, VocabularyPeer::LAST_UPDATED, VocabularyPeer::NAME, VocabularyPeer::NOTE, VocabularyPeer::URI, VocabularyPeer::URL, VocabularyPeer::BASE_DOMAIN, VocabularyPeer::TOKEN, VocabularyPeer::COMMUNITY, VocabularyPeer::LAST_URI_ID, VocabularyPeer::STATUS_ID, VocabularyPeer::LANGUAGE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'agent_id', 'created_at', 'last_updated', 'name', 'note', 'uri', 'url', 'base_domain', 'token', 'community', 'last_uri_id', 'status_id', 'language', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AgentId' => 1, 'CreatedAt' => 2, 'LastUpdated' => 3, 'Name' => 4, 'Note' => 5, 'Uri' => 6, 'Url' => 7, 'BaseDomain' => 8, 'Token' => 9, 'Community' => 10, 'LastUriId' => 11, 'StatusId' => 12, 'Language' => 13, ),
		BasePeer::TYPE_COLNAME => array (VocabularyPeer::ID => 0, VocabularyPeer::AGENT_ID => 1, VocabularyPeer::CREATED_AT => 2, VocabularyPeer::LAST_UPDATED => 3, VocabularyPeer::NAME => 4, VocabularyPeer::NOTE => 5, VocabularyPeer::URI => 6, VocabularyPeer::URL => 7, VocabularyPeer::BASE_DOMAIN => 8, VocabularyPeer::TOKEN => 9, VocabularyPeer::COMMUNITY => 10, VocabularyPeer::LAST_URI_ID => 11, VocabularyPeer::STATUS_ID => 12, VocabularyPeer::LANGUAGE => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'agent_id' => 1, 'created_at' => 2, 'last_updated' => 3, 'name' => 4, 'note' => 5, 'uri' => 6, 'url' => 7, 'base_domain' => 8, 'token' => 9, 'community' => 10, 'last_uri_id' => 11, 'status_id' => 12, 'language' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VocabularyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VocabularyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = VocabularyPeer::getTableMap();
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
		return str_replace(VocabularyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(VocabularyPeer::ID);

		$criteria->addSelectColumn(VocabularyPeer::AGENT_ID);

		$criteria->addSelectColumn(VocabularyPeer::CREATED_AT);

		$criteria->addSelectColumn(VocabularyPeer::LAST_UPDATED);

		$criteria->addSelectColumn(VocabularyPeer::NAME);

		$criteria->addSelectColumn(VocabularyPeer::NOTE);

		$criteria->addSelectColumn(VocabularyPeer::URI);

		$criteria->addSelectColumn(VocabularyPeer::URL);

		$criteria->addSelectColumn(VocabularyPeer::BASE_DOMAIN);

		$criteria->addSelectColumn(VocabularyPeer::TOKEN);

		$criteria->addSelectColumn(VocabularyPeer::COMMUNITY);

		$criteria->addSelectColumn(VocabularyPeer::LAST_URI_ID);

		$criteria->addSelectColumn(VocabularyPeer::STATUS_ID);

		$criteria->addSelectColumn(VocabularyPeer::LANGUAGE);

	}

	const COUNT = 'COUNT(reg_vocabulary.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_vocabulary.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
		$objects = VocabularyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return VocabularyPeer::populateObjects(VocabularyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VocabularyPeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		$cls = VocabularyPeer::getOMClass();
		$cls = Propel::import($cls);
		
		while($rs->next()) {
		
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AgentPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
										$temp_obj2->addVocabulary($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = StatusPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getStatus(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addVocabulary($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			
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
					$temp_obj2->addVocabulary($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1);
			}

				
					
			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabulary($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initVocabularys();
				$obj3->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAgent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAgent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		StatusPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getStatus(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabulary($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = AgentPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabulary($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return VocabularyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} else {
			$criteria = $values->buildCriteria(); 
		}

		$criteria->remove(VocabularyPeer::ID); 


		
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			
			
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 

			$comparison = $criteria->getComparison(VocabularyPeer::ID);
			$selectCriteria->add(VocabularyPeer::ID, $criteria->remove(VocabularyPeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 
		try {
			
			
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(VocabularyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof Vocabulary) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VocabularyPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Vocabulary $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VocabularyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VocabularyPeer::TABLE_NAME);

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

		return BasePeer::doValidate(VocabularyPeer::DATABASE_NAME, VocabularyPeer::TABLE_NAME, $columns);
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		$criteria->add(VocabularyPeer::ID, $pk);


		$v = VocabularyPeer::doSelect($criteria, $con);

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
			$criteria->add(VocabularyPeer::ID, $pks, Criteria::IN);
			$objs = VocabularyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 


if (Propel::isInit()) {
	
	
	try {
		BaseVocabularyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/VocabularyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VocabularyMapBuilder');
}
