<?php


abstract class BaseConceptPropertyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_concept_property';

	
	const CLASS_DEFAULT = 'lib.model.ConceptProperty';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_concept_property.ID';

	
	const CREATED_AT = 'reg_concept_property.CREATED_AT';

	
	const LAST_UPDATED = 'reg_concept_property.LAST_UPDATED';

	
	const CONCEPT_ID = 'reg_concept_property.CONCEPT_ID';

	
	const SKOS_PROPERTY_ID = 'reg_concept_property.SKOS_PROPERTY_ID';

	
	const OBJECT = 'reg_concept_property.OBJECT';

	
	const SCHEME_ID = 'reg_concept_property.SCHEME_ID';

	
	const RELATED_CONCEPT_ID = 'reg_concept_property.RELATED_CONCEPT_ID';

	
	const LANGUAGE = 'reg_concept_property.LANGUAGE';

	
	const STATUS_ID = 'reg_concept_property.STATUS_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'ConceptId', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID, ConceptPropertyPeer::CREATED_AT, ConceptPropertyPeer::LAST_UPDATED, ConceptPropertyPeer::CONCEPT_ID, ConceptPropertyPeer::SKOS_PROPERTY_ID, ConceptPropertyPeer::OBJECT, ConceptPropertyPeer::SCHEME_ID, ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPropertyPeer::LANGUAGE, ConceptPropertyPeer::STATUS_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'concept_id', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'ConceptId' => 3, 'SkosPropertyId' => 4, 'Object' => 5, 'SchemeId' => 6, 'RelatedConceptId' => 7, 'Language' => 8, 'StatusId' => 9, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID => 0, ConceptPropertyPeer::CREATED_AT => 1, ConceptPropertyPeer::LAST_UPDATED => 2, ConceptPropertyPeer::CONCEPT_ID => 3, ConceptPropertyPeer::SKOS_PROPERTY_ID => 4, ConceptPropertyPeer::OBJECT => 5, ConceptPropertyPeer::SCHEME_ID => 6, ConceptPropertyPeer::RELATED_CONCEPT_ID => 7, ConceptPropertyPeer::LANGUAGE => 8, ConceptPropertyPeer::STATUS_ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'concept_id' => 3, 'skos_property_id' => 4, 'object' => 5, 'scheme_id' => 6, 'related_concept_id' => 7, 'language' => 8, 'status_id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptPropertyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConceptPropertyPeer::getTableMap();
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
		return str_replace(ConceptPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptPropertyPeer::ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::CREATED_AT);

		$criteria->addSelectColumn(ConceptPropertyPeer::LAST_UPDATED);

		$criteria->addSelectColumn(ConceptPropertyPeer::CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::SKOS_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::OBJECT);

		$criteria->addSelectColumn(ConceptPropertyPeer::SCHEME_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::RELATED_CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::LANGUAGE);

		$criteria->addSelectColumn(ConceptPropertyPeer::STATUS_ID);

	}

	const COUNT = 'COUNT(reg_concept_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_property.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
		$objects = ConceptPropertyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptPropertyPeer::populateObjects(ConceptPropertyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptPropertyPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ConceptPropertyPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinLookup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyRelatedByConceptId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1); 			}
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SkosPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
										$temp_obj2->addConceptProperty($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); 			}
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
										$temp_obj2->addConceptProperty($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinLookup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LookupPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LookupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getLookup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptProperty($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); 			}
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
										$temp_obj2->addConceptPropertyRelatedByRelatedConceptId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByRelatedConceptId();
				$obj2->addConceptPropertyRelatedByRelatedConceptId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + LookupPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByConceptId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1);
			}

				
					
			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSkosProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

				
					
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
			}

				
					
			$omClass = LookupPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getLookup(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
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
					$temp_obj6->addConceptPropertyRelatedByRelatedConceptId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptLookup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LookupPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSkosProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LookupPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
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
					$temp_obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LookupPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1);
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
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
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
					$temp_obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptLookup(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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
					$temp_obj2->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1);
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
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
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
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
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
					$temp_obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LookupPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);		

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSkosProperty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabulary(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
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
		return ConceptPropertyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ConceptPropertyPeer::ID); 

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
			$comparison = $criteria->getComparison(ConceptPropertyPeer::ID);
			$selectCriteria->add(ConceptPropertyPeer::ID, $criteria->remove(ConceptPropertyPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ConceptPropertyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ConceptProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptPropertyPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ConceptProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptPropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptPropertyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConceptPropertyPeer::DATABASE_NAME, ConceptPropertyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConceptPropertyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);

		$criteria->add(ConceptPropertyPeer::ID, $pk);


		$v = ConceptPropertyPeer::doSelect($criteria, $con);

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
			$criteria->add(ConceptPropertyPeer::ID, $pks, Criteria::IN);
			$objs = ConceptPropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseConceptPropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ConceptPropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptPropertyMapBuilder');
}
