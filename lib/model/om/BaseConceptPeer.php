<?php


abstract class BaseConceptPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_concept';

	
	const CLASS_DEFAULT = 'lib.model.Concept';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_concept.ID';

	
	const CREATED_AT = 'reg_concept.CREATED_AT';

	
	const LAST_UPDATED = 'reg_concept.LAST_UPDATED';

	
	const URI = 'reg_concept.URI';

	
	const VOCABULARY_ID = 'reg_concept.VOCABULARY_ID';

	
	const IS_TOP_CONCEPT = 'reg_concept.IS_TOP_CONCEPT';

	
	const PREF_LABEL_ID = 'reg_concept.PREF_LABEL_ID';

	
	const PREF_LABEL = 'reg_concept.PREF_LABEL';

	
	const STATUS_ID = 'reg_concept.STATUS_ID';

	
	const LANGUAGE = 'reg_concept.LANGUAGE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'Uri', 'VocabularyId', 'IsTopConcept', 'PrefLabelId', 'PrefLabel', 'StatusId', 'Language', ),
		BasePeer::TYPE_COLNAME => array (ConceptPeer::ID, ConceptPeer::CREATED_AT, ConceptPeer::LAST_UPDATED, ConceptPeer::URI, ConceptPeer::VOCABULARY_ID, ConceptPeer::IS_TOP_CONCEPT, ConceptPeer::PREF_LABEL_ID, ConceptPeer::PREF_LABEL, ConceptPeer::STATUS_ID, ConceptPeer::LANGUAGE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'uri', 'vocabulary_id', 'is_top_concept', 'pref_label_id', 'pref_label', 'status_id', 'language', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'Uri' => 3, 'VocabularyId' => 4, 'IsTopConcept' => 5, 'PrefLabelId' => 6, 'PrefLabel' => 7, 'StatusId' => 8, 'Language' => 9, ),
		BasePeer::TYPE_COLNAME => array (ConceptPeer::ID => 0, ConceptPeer::CREATED_AT => 1, ConceptPeer::LAST_UPDATED => 2, ConceptPeer::URI => 3, ConceptPeer::VOCABULARY_ID => 4, ConceptPeer::IS_TOP_CONCEPT => 5, ConceptPeer::PREF_LABEL_ID => 6, ConceptPeer::PREF_LABEL => 7, ConceptPeer::STATUS_ID => 8, ConceptPeer::LANGUAGE => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'uri' => 3, 'vocabulary_id' => 4, 'is_top_concept' => 5, 'pref_label_id' => 6, 'pref_label' => 7, 'status_id' => 8, 'language' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConceptPeer::getTableMap();
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
		return str_replace(ConceptPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptPeer::ID);

		$criteria->addSelectColumn(ConceptPeer::CREATED_AT);

		$criteria->addSelectColumn(ConceptPeer::LAST_UPDATED);

		$criteria->addSelectColumn(ConceptPeer::URI);

		$criteria->addSelectColumn(ConceptPeer::VOCABULARY_ID);

		$criteria->addSelectColumn(ConceptPeer::IS_TOP_CONCEPT);

		$criteria->addSelectColumn(ConceptPeer::PREF_LABEL_ID);

		$criteria->addSelectColumn(ConceptPeer::PREF_LABEL);

		$criteria->addSelectColumn(ConceptPeer::STATUS_ID);

		$criteria->addSelectColumn(ConceptPeer::LANGUAGE);

	}

	const COUNT = 'COUNT(reg_concept.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		
		$criteria = clone $criteria;

		
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}

		
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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
		$objects = ConceptPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptPeer::populateObjects(ConceptPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptPeer::addSelectColumns($criteria);
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		
		
		return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		
		$cls = ConceptPeer::getOMClass();
		$cls = Propel::import($cls);
		
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPeer::addSelectColumns($c);
		$startcol = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
										$temp_obj2->addConcept($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1); 			}
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

		ConceptPeer::addSelectColumns($c);
		$startcol = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptPropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
										$temp_obj2->addConcept($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1); 			}
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

		ConceptPeer::addSelectColumns($c);
		$startcol = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
										$temp_obj2->addConcept($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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

		ConceptPeer::addSelectColumns($c);
		$startcol2 = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVocabulary(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConcept($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1);
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
					$temp_obj3->addConcept($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConcepts();
				$obj3->addConcept($obj1);
			}

				
					
			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConcept($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConcepts();
				$obj4->addConcept($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$rs = ConceptPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPeer::addSelectColumns($c);
		$startcol2 = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
					$temp_obj2->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConcepts();
				$obj3->addConcept($obj1);
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

		ConceptPeer::addSelectColumns($c);
		$startcol2 = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
					$temp_obj2->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConcepts();
				$obj3->addConcept($obj1);
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

		ConceptPeer::addSelectColumns($c);
		$startcol2 = (ConceptPeer::NUM_COLUMNS - ConceptPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VocabularyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VocabularyPeer::NUM_COLUMNS;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPeer::PREF_LABEL_ID, ConceptPropertyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ConceptPeer::getOMClass();

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
					$temp_obj2->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConcepts();
				$obj2->addConcept($obj1);
			}

			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptProperty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConcept($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConcepts();
				$obj3->addConcept($obj1);
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
		return ConceptPeer::CLASS_DEFAULT;
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

		$criteria->remove(ConceptPeer::ID); 


		
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

			$comparison = $criteria->getComparison(ConceptPeer::ID);
			$selectCriteria->add(ConceptPeer::ID, $criteria->remove(ConceptPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ConceptPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConceptPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
		} elseif ($values instanceof Concept) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Concept $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptPeer::TABLE_NAME);

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

		return BasePeer::doValidate(ConceptPeer::DATABASE_NAME, ConceptPeer::TABLE_NAME, $columns);
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ConceptPeer::DATABASE_NAME);

		$criteria->add(ConceptPeer::ID, $pk);


		$v = ConceptPeer::doSelect($criteria, $con);

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
			$criteria->add(ConceptPeer::ID, $pks, Criteria::IN);
			$objs = ConceptPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 


if (Propel::isInit()) {
	
	
	try {
		BaseConceptPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	
	
	require_once 'lib/model/map/ConceptMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptMapBuilder');
}
