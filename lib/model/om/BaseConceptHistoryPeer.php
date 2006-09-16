<?php


abstract class BaseConceptHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_concept_history';

	
	const CLASS_DEFAULT = 'lib.model.ConceptHistory';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SID = 'reg_concept_history.SID';

	
	const CONCEPT_PROPERTY_ID = 'reg_concept_history.CONCEPT_PROPERTY_ID';

	
	const USER_ID = 'reg_concept_history.USER_ID';

	
	const CHANGED_AT = 'reg_concept_history.CHANGED_AT';

	
	const OLD_VALUES = 'reg_concept_history.OLD_VALUES';

	
	const NEW_VALUES = 'reg_concept_history.NEW_VALUES';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Sid', 'ConceptPropertyId', 'UserId', 'ChangedAt', 'OldValues', 'NewValues', ),
		BasePeer::TYPE_COLNAME => array (ConceptHistoryPeer::SID, ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptHistoryPeer::USER_ID, ConceptHistoryPeer::CHANGED_AT, ConceptHistoryPeer::OLD_VALUES, ConceptHistoryPeer::NEW_VALUES, ),
		BasePeer::TYPE_FIELDNAME => array ('sid', 'concept_property_id', 'user_id', 'changed_at', 'old_values', 'new_values', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Sid' => 0, 'ConceptPropertyId' => 1, 'UserId' => 2, 'ChangedAt' => 3, 'OldValues' => 4, 'NewValues' => 5, ),
		BasePeer::TYPE_COLNAME => array (ConceptHistoryPeer::SID => 0, ConceptHistoryPeer::CONCEPT_PROPERTY_ID => 1, ConceptHistoryPeer::USER_ID => 2, ConceptHistoryPeer::CHANGED_AT => 3, ConceptHistoryPeer::OLD_VALUES => 4, ConceptHistoryPeer::NEW_VALUES => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('sid' => 0, 'concept_property_id' => 1, 'user_id' => 2, 'changed_at' => 3, 'old_values' => 4, 'new_values' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConceptHistoryPeer::getTableMap();
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
		return str_replace(ConceptHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptHistoryPeer::SID);

		$criteria->addSelectColumn(ConceptHistoryPeer::CONCEPT_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptHistoryPeer::USER_ID);

		$criteria->addSelectColumn(ConceptHistoryPeer::CHANGED_AT);

		$criteria->addSelectColumn(ConceptHistoryPeer::OLD_VALUES);

		$criteria->addSelectColumn(ConceptHistoryPeer::NEW_VALUES);

	}

	const COUNT = 'COUNT(reg_concept_history.SID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_history.SID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = ConceptHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptHistoryPeer::populateObjects(ConceptHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptHistoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ConceptHistoryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConceptProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
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

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
			}

				
					
			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptHistorys();
				$obj3->addConceptHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);

		$rs = ConceptHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptHistoryPeer::NUM_COLUMNS - ConceptHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptHistoryPeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptHistorys();
				$obj2->addConceptHistory($obj1);
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
		return ConceptHistoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(ConceptHistoryPeer::SID);
			$selectCriteria->add(ConceptHistoryPeer::SID, $criteria->remove(ConceptHistoryPeer::SID), $comparison);

			$comparison = $criteria->getComparison(ConceptHistoryPeer::CONCEPT_PROPERTY_ID);
			$selectCriteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $criteria->remove(ConceptHistoryPeer::CONCEPT_PROPERTY_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ConceptHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConceptHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ConceptHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(ConceptHistoryPeer::SID, $vals[0], Criteria::IN);
			$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(ConceptHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConceptHistoryPeer::DATABASE_NAME, ConceptHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConceptHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $sid, $concept_property_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ConceptHistoryPeer::SID, $sid);
		$criteria->add(ConceptHistoryPeer::CONCEPT_PROPERTY_ID, $concept_property_id);
		$v = ConceptHistoryPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseConceptHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ConceptHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptHistoryMapBuilder');
}
