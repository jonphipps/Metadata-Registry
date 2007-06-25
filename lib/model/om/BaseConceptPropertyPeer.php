<?php


abstract class BaseConceptPropertyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_concept_property';

	
	const CLASS_DEFAULT = 'lib.model.ConceptProperty';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_concept_property.ID';

	
	const CREATED_AT = 'reg_concept_property.CREATED_AT';

	
	const LAST_UPDATED = 'reg_concept_property.LAST_UPDATED';

	
	const DELETED_AT = 'reg_concept_property.DELETED_AT';

	
	const CONCEPT_ID = 'reg_concept_property.CONCEPT_ID';

	
	const PRIMARY_PREF_LABEL = 'reg_concept_property.PRIMARY_PREF_LABEL';

	
	const SKOS_PROPERTY_ID = 'reg_concept_property.SKOS_PROPERTY_ID';

	
	const OBJECT = 'reg_concept_property.OBJECT';

	
	const SCHEME_ID = 'reg_concept_property.SCHEME_ID';

	
	const RELATED_CONCEPT_ID = 'reg_concept_property.RELATED_CONCEPT_ID';

	
	const LANGUAGE = 'reg_concept_property.LANGUAGE';

	
	const STATUS_ID = 'reg_concept_property.STATUS_ID';

	
	const CREATED_USER_ID = 'reg_concept_property.CREATED_USER_ID';

	
	const UPDATED_USER_ID = 'reg_concept_property.UPDATED_USER_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'DeletedAt', 'ConceptId', 'PrimaryPrefLabel', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', 'CreatedUserId', 'UpdatedUserId', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID, ConceptPropertyPeer::CREATED_AT, ConceptPropertyPeer::LAST_UPDATED, ConceptPropertyPeer::DELETED_AT, ConceptPropertyPeer::CONCEPT_ID, ConceptPropertyPeer::PRIMARY_PREF_LABEL, ConceptPropertyPeer::SKOS_PROPERTY_ID, ConceptPropertyPeer::OBJECT, ConceptPropertyPeer::SCHEME_ID, ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPropertyPeer::LANGUAGE, ConceptPropertyPeer::STATUS_ID, ConceptPropertyPeer::CREATED_USER_ID, ConceptPropertyPeer::UPDATED_USER_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'deleted_at', 'concept_id', 'primary_pref_label', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', 'created_user_id', 'updated_user_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'DeletedAt' => 3, 'ConceptId' => 4, 'PrimaryPrefLabel' => 5, 'SkosPropertyId' => 6, 'Object' => 7, 'SchemeId' => 8, 'RelatedConceptId' => 9, 'Language' => 10, 'StatusId' => 11, 'CreatedUserId' => 12, 'UpdatedUserId' => 13, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID => 0, ConceptPropertyPeer::CREATED_AT => 1, ConceptPropertyPeer::LAST_UPDATED => 2, ConceptPropertyPeer::DELETED_AT => 3, ConceptPropertyPeer::CONCEPT_ID => 4, ConceptPropertyPeer::PRIMARY_PREF_LABEL => 5, ConceptPropertyPeer::SKOS_PROPERTY_ID => 6, ConceptPropertyPeer::OBJECT => 7, ConceptPropertyPeer::SCHEME_ID => 8, ConceptPropertyPeer::RELATED_CONCEPT_ID => 9, ConceptPropertyPeer::LANGUAGE => 10, ConceptPropertyPeer::STATUS_ID => 11, ConceptPropertyPeer::CREATED_USER_ID => 12, ConceptPropertyPeer::UPDATED_USER_ID => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'deleted_at' => 3, 'concept_id' => 4, 'primary_pref_label' => 5, 'skos_property_id' => 6, 'object' => 7, 'scheme_id' => 8, 'related_concept_id' => 9, 'language' => 10, 'status_id' => 11, 'created_user_id' => 12, 'updated_user_id' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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

		$criteria->addSelectColumn(ConceptPropertyPeer::DELETED_AT);

		$criteria->addSelectColumn(ConceptPropertyPeer::CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::PRIMARY_PREF_LABEL);

		$criteria->addSelectColumn(ConceptPropertyPeer::SKOS_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::OBJECT);

		$criteria->addSelectColumn(ConceptPropertyPeer::SCHEME_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::RELATED_CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::LANGUAGE);

		$criteria->addSelectColumn(ConceptPropertyPeer::STATUS_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::CREATED_USER_ID);

		$criteria->addSelectColumn(ConceptPropertyPeer::UPDATED_USER_ID);

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

    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyPeer', $criteria, $con);
    }


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


	
	public static function doCountJoinStatus(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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


	
	public static function doSelectJoinStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

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


	
	public static function doSelectJoinUserRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUserRelatedByUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addConceptPropertyRelatedByUpdatedUserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByUpdatedUserId();
				$obj2->addConceptPropertyRelatedByUpdatedUserId($obj1); 			}
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

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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

				
					
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedByRelatedConceptId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByRelatedConceptId();
				$obj5->addConceptPropertyRelatedByRelatedConceptId($obj1);
			}

				
					
			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptProperty($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

				
					
			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByCreatedUserId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertysRelatedByCreatedUserId();
				$obj7->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

				
					
			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByUpdatedUserId($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj8->initConceptPropertysRelatedByUpdatedUserId();
				$obj8->addConceptPropertyRelatedByUpdatedUserId($obj1);
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

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

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

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);


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

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByCreatedUserId();
				$obj5->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByUpdatedUserId();
				$obj6->addConceptPropertyRelatedByUpdatedUserId($obj1);
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

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);


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

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertysRelatedByRelatedConceptId();
				$obj4->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByCreatedUserId();
				$obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertysRelatedByUpdatedUserId();
				$obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
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

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);


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

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByRelatedConceptId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertysRelatedByRelatedConceptId();
				$obj4->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByCreatedUserId();
				$obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertysRelatedByUpdatedUserId();
				$obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
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

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);


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

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertysRelatedByCreatedUserId();
				$obj5->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByUpdatedUserId();
				$obj6->addConceptPropertyRelatedByUpdatedUserId($obj1);
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

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UserPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UserPeer::ID);


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

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByCreatedUserId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertysRelatedByCreatedUserId();
				$obj6->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUserRelatedByUpdatedUserId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertysRelatedByUpdatedUserId();
				$obj7->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserRelatedByCreatedUserId(Criteria $c, $con = null)
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

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);


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

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserRelatedByUpdatedUserId(Criteria $c, $con = null)
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

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);


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

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
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

    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con);
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

		
    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con);
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

			$comparison = $criteria->getComparison(ConceptPropertyPeer::ID);
			$selectCriteria->add(ConceptPropertyPeer::ID, $criteria->remove(ConceptPropertyPeer::ID), $comparison);

		} else { 
			$criteria = $values->buildCriteria(); 
			$selectCriteria = $values->buildPkeyCriteria(); 
		}

		
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con, $ret);
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
			$criteria = clone $values; 
		} elseif ($values instanceof ConceptProperty) {

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

		return BasePeer::doValidate(ConceptPropertyPeer::DATABASE_NAME, ConceptPropertyPeer::TABLE_NAME, $columns);
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
