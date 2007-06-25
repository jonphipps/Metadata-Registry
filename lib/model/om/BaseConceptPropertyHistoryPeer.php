<?php


abstract class BaseConceptPropertyHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_concept_property_history';

	
	const CLASS_DEFAULT = 'lib.model.ConceptPropertyHistory';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_concept_property_history.ID';

	
	const CREATED_AT = 'reg_concept_property_history.CREATED_AT';

	
	const ACTION = 'reg_concept_property_history.ACTION';

	
	const CONCEPT_PROPERTY_ID = 'reg_concept_property_history.CONCEPT_PROPERTY_ID';

	
	const CONCEPT_ID = 'reg_concept_property_history.CONCEPT_ID';

	
	const SKOS_PROPERTY_ID = 'reg_concept_property_history.SKOS_PROPERTY_ID';

	
	const OBJECT = 'reg_concept_property_history.OBJECT';

	
	const SCHEME_ID = 'reg_concept_property_history.SCHEME_ID';

	
	const RELATED_CONCEPT_ID = 'reg_concept_property_history.RELATED_CONCEPT_ID';

	
	const LANGUAGE = 'reg_concept_property_history.LANGUAGE';

	
	const STATUS_ID = 'reg_concept_property_history.STATUS_ID';

	
	const CREATED_USER_ID = 'reg_concept_property_history.CREATED_USER_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'Action', 'ConceptPropertyId', 'ConceptId', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', 'CreatedUserId', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyHistoryPeer::ID, ConceptPropertyHistoryPeer::CREATED_AT, ConceptPropertyHistoryPeer::ACTION, ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, ConceptPropertyHistoryPeer::OBJECT, ConceptPropertyHistoryPeer::SCHEME_ID, ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPropertyHistoryPeer::LANGUAGE, ConceptPropertyHistoryPeer::STATUS_ID, ConceptPropertyHistoryPeer::CREATED_USER_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'action', 'concept_property_id', 'concept_id', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', 'created_user_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'Action' => 2, 'ConceptPropertyId' => 3, 'ConceptId' => 4, 'SkosPropertyId' => 5, 'Object' => 6, 'SchemeId' => 7, 'RelatedConceptId' => 8, 'Language' => 9, 'StatusId' => 10, 'CreatedUserId' => 11, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyHistoryPeer::ID => 0, ConceptPropertyHistoryPeer::CREATED_AT => 1, ConceptPropertyHistoryPeer::ACTION => 2, ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID => 3, ConceptPropertyHistoryPeer::CONCEPT_ID => 4, ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID => 5, ConceptPropertyHistoryPeer::OBJECT => 6, ConceptPropertyHistoryPeer::SCHEME_ID => 7, ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID => 8, ConceptPropertyHistoryPeer::LANGUAGE => 9, ConceptPropertyHistoryPeer::STATUS_ID => 10, ConceptPropertyHistoryPeer::CREATED_USER_ID => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'action' => 2, 'concept_property_id' => 3, 'concept_id' => 4, 'skos_property_id' => 5, 'object' => 6, 'scheme_id' => 7, 'related_concept_id' => 8, 'language' => 9, 'status_id' => 10, 'created_user_id' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptPropertyHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptPropertyHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConceptPropertyHistoryPeer::getTableMap();
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
		return str_replace(ConceptPropertyHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CREATED_AT);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::ACTION);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::OBJECT);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::SCHEME_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::LANGUAGE);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::STATUS_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CREATED_USER_ID);

	}

	const COUNT = 'COUNT(reg_concept_property_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_property_history.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = ConceptPropertyHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptPropertyHistoryPeer::populateObjects(ConceptPropertyHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptPropertyHistoryPeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		$cls = ConceptPropertyHistoryPeer::getOMClass();
		$cls = Propel::import($cls);
		
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSkosProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinConceptRelatedByRelatedConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptPropertyHistoryRelatedByConceptId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByConceptId();
				$obj2->addConceptPropertyHistoryRelatedByConceptId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSkosProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SkosPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SkosPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSkosProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); 			}
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinConceptRelatedByRelatedConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj2->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); 			}
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

				
					
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

				
					
			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

				
					
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

				
					
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

				
					
			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

				
					
			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUser(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj8->initConceptPropertyHistorys();
				$obj8->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSkosProperty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptConceptRelatedByRelatedConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByConceptId();
				$obj2->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSkosProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorys();
				$obj3->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorys();
				$obj6->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUser(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSkosProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorys();
				$obj3->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStatus(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorys();
				$obj6->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSkosProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorys();
				$obj6->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUser(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorys();
				$obj6->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUser(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptConceptRelatedByRelatedConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSkosProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorys();
				$obj3->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getStatus(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorys();
				$obj6->addConceptPropertyHistory($obj1);
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUser(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyHistoryPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorys();
				$obj4->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
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
		return ConceptPropertyHistoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con);
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

		$criteria->remove(ConceptPropertyHistoryPeer::ID); 


		
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			
			
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con);
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

			$comparison = $criteria->getComparison(ConceptPropertyHistoryPeer::ID);
			$selectCriteria->add(ConceptPropertyHistoryPeer::ID, $criteria->remove(ConceptPropertyHistoryPeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ConceptPropertyHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof ConceptPropertyHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptPropertyHistoryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ConceptPropertyHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptPropertyHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptPropertyHistoryPeer::TABLE_NAME);

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

		return BasePeer::doValidate(ConceptPropertyHistoryPeer::DATABASE_NAME, ConceptPropertyHistoryPeer::TABLE_NAME, $columns);
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ConceptPropertyHistoryPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyHistoryPeer::ID, $pk);


		$v = ConceptPropertyHistoryPeer::doSelect($criteria, $con);

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
			$criteria->add(ConceptPropertyHistoryPeer::ID, $pks, Criteria::IN);
			$objs = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 


if (Propel::isInit()) {
	
	
	try {
		BaseConceptPropertyHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/ConceptPropertyHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptPropertyHistoryMapBuilder');
}
