<?php


abstract class BaseVocabularyHasUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_vocabulary_has_user';

	
	const CLASS_DEFAULT = 'model.VocabularyHasUser';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const VOCABULARY_ID = 'reg_vocabulary_has_user.VOCABULARY_ID';

	
	const USER_ID = 'reg_vocabulary_has_user.USER_ID';

	
	const IS_MAINTAINER_FOR = 'reg_vocabulary_has_user.IS_MAINTAINER_FOR';

	
	const IS_REGISTRAR_FOR = 'reg_vocabulary_has_user.IS_REGISTRAR_FOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('VocabularyId', 'UserId', 'IsMaintainerFor', 'IsRegistrarFor', ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasUserPeer::VOCABULARY_ID, VocabularyHasUserPeer::USER_ID, VocabularyHasUserPeer::IS_MAINTAINER_FOR, VocabularyHasUserPeer::IS_REGISTRAR_FOR, ),
		BasePeer::TYPE_FIELDNAME => array ('vocabulary_id', 'user_id', 'is_maintainer_for', 'is_registrar_for', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('VocabularyId' => 0, 'UserId' => 1, 'IsMaintainerFor' => 2, 'IsRegistrarFor' => 3, ),
		BasePeer::TYPE_COLNAME => array (VocabularyHasUserPeer::VOCABULARY_ID => 0, VocabularyHasUserPeer::USER_ID => 1, VocabularyHasUserPeer::IS_MAINTAINER_FOR => 2, VocabularyHasUserPeer::IS_REGISTRAR_FOR => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('vocabulary_id' => 0, 'user_id' => 1, 'is_maintainer_for' => 2, 'is_registrar_for' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'model/map/VocabularyHasUserMapBuilder.php';
		return BasePeer::getMapBuilder('model.map.VocabularyHasUserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = VocabularyHasUserPeer::getTableMap();
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
		return str_replace(VocabularyHasUserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(VocabularyHasUserPeer::VOCABULARY_ID);

		$criteria->addSelectColumn(VocabularyHasUserPeer::USER_ID);

		$criteria->addSelectColumn(VocabularyHasUserPeer::IS_MAINTAINER_FOR);

		$criteria->addSelectColumn(VocabularyHasUserPeer::IS_REGISTRAR_FOR);

	}

	const COUNT = 'COUNT(reg_vocabulary_has_user.VOCABULARY_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_vocabulary_has_user.VOCABULARY_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
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
		$objects = VocabularyHasUserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return VocabularyHasUserPeer::populateObjects(VocabularyHasUserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VocabularyHasUserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = VocabularyHasUserPeer::getOMClass();
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
										$temp_obj2->addVocabularyHasUser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVocabulary(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addVocabularyHasUser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

			
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
					$temp_obj2->addVocabularyHasUser($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
			}

				
					
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyHasUser($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initVocabularyHasUsers();
				$obj3->addVocabularyHasUser($obj1);
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
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyHasUserPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);

		$rs = VocabularyHasUserPeer::doSelectRS($criteria, $con);
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

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasUserPeer::VOCABULARY_ID, VocabularyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVocabulary(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyHasUser($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyHasUserPeer::addSelectColumns($c);
		$startcol2 = (VocabularyHasUserPeer::NUM_COLUMNS - VocabularyHasUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyHasUserPeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = VocabularyHasUserPeer::getOMClass();

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
					$temp_obj2->addVocabularyHasUser($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initVocabularyHasUsers();
				$obj2->addVocabularyHasUser($obj1);
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
		return VocabularyHasUserPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(VocabularyHasUserPeer::VOCABULARY_ID);
			$selectCriteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $criteria->remove(VocabularyHasUserPeer::VOCABULARY_ID), $comparison);

			$comparison = $criteria->getComparison(VocabularyHasUserPeer::USER_ID);
			$selectCriteria->add(VocabularyHasUserPeer::USER_ID, $criteria->remove(VocabularyHasUserPeer::USER_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(VocabularyHasUserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(VocabularyHasUserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof VocabularyHasUser) {

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

			$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $vals[0], Criteria::IN);
			$criteria->add(VocabularyHasUserPeer::USER_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(VocabularyHasUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VocabularyHasUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VocabularyHasUserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(VocabularyHasUserPeer::DATABASE_NAME, VocabularyHasUserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = VocabularyHasUserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $vocabulary_id, $user_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(VocabularyHasUserPeer::VOCABULARY_ID, $vocabulary_id);
		$criteria->add(VocabularyHasUserPeer::USER_ID, $user_id);
		$v = VocabularyHasUserPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseVocabularyHasUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'model/map/VocabularyHasUserMapBuilder.php';
	Propel::registerMapBuilder('model.map.VocabularyHasUserMapBuilder');
}
