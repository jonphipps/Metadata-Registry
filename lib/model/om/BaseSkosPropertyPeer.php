<?php


abstract class BaseSkosPropertyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'reg_skos_property';

	
	const CLASS_DEFAULT = 'lib.model.SkosProperty';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'reg_skos_property.ID';

	
	const PARENT_ID = 'reg_skos_property.PARENT_ID';

	
	const INVERSE_ID = 'reg_skos_property.INVERSE_ID';

	
	const NAME = 'reg_skos_property.NAME';

	
	const URI = 'reg_skos_property.URI';

	
	const OBJECT_TYPE = 'reg_skos_property.OBJECT_TYPE';

	
	const DISPLAY_ORDER = 'reg_skos_property.DISPLAY_ORDER';

	
	const PICKLIST_ORDER = 'reg_skos_property.PICKLIST_ORDER';

	
	const LABEL = 'reg_skos_property.LABEL';

	
	const DEFINITION = 'reg_skos_property.DEFINITION';

	
	const COMMENT = 'reg_skos_property.COMMENT';

	
	const EXAMPLES = 'reg_skos_property.EXAMPLES';

	
	const IS_REQUIRED = 'reg_skos_property.IS_REQUIRED';

	
	const IS_RECIPROCAL = 'reg_skos_property.IS_RECIPROCAL';

	
	const IS_SINGLETON = 'reg_skos_property.IS_SINGLETON';

	
	const IS_SCHEME = 'reg_skos_property.IS_SCHEME';

	
	const IS_IN_PICKLIST = 'reg_skos_property.IS_IN_PICKLIST';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ParentId', 'InverseId', 'Name', 'Uri', 'ObjectType', 'DisplayOrder', 'PicklistOrder', 'Label', 'Definition', 'Comment', 'Examples', 'IsRequired', 'IsReciprocal', 'IsSingleton', 'IsScheme', 'IsInPicklist', ),
		BasePeer::TYPE_COLNAME => array (SkosPropertyPeer::ID, SkosPropertyPeer::PARENT_ID, SkosPropertyPeer::INVERSE_ID, SkosPropertyPeer::NAME, SkosPropertyPeer::URI, SkosPropertyPeer::OBJECT_TYPE, SkosPropertyPeer::DISPLAY_ORDER, SkosPropertyPeer::PICKLIST_ORDER, SkosPropertyPeer::LABEL, SkosPropertyPeer::DEFINITION, SkosPropertyPeer::COMMENT, SkosPropertyPeer::EXAMPLES, SkosPropertyPeer::IS_REQUIRED, SkosPropertyPeer::IS_RECIPROCAL, SkosPropertyPeer::IS_SINGLETON, SkosPropertyPeer::IS_SCHEME, SkosPropertyPeer::IS_IN_PICKLIST, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'parent_id', 'inverse_id', 'name', 'uri', 'object_type', 'display_order', 'picklist_order', 'label', 'definition', 'comment', 'examples', 'is_required', 'is_reciprocal', 'is_singleton', 'is_scheme', 'is_in_picklist', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ParentId' => 1, 'InverseId' => 2, 'Name' => 3, 'Uri' => 4, 'ObjectType' => 5, 'DisplayOrder' => 6, 'PicklistOrder' => 7, 'Label' => 8, 'Definition' => 9, 'Comment' => 10, 'Examples' => 11, 'IsRequired' => 12, 'IsReciprocal' => 13, 'IsSingleton' => 14, 'IsScheme' => 15, 'IsInPicklist' => 16, ),
		BasePeer::TYPE_COLNAME => array (SkosPropertyPeer::ID => 0, SkosPropertyPeer::PARENT_ID => 1, SkosPropertyPeer::INVERSE_ID => 2, SkosPropertyPeer::NAME => 3, SkosPropertyPeer::URI => 4, SkosPropertyPeer::OBJECT_TYPE => 5, SkosPropertyPeer::DISPLAY_ORDER => 6, SkosPropertyPeer::PICKLIST_ORDER => 7, SkosPropertyPeer::LABEL => 8, SkosPropertyPeer::DEFINITION => 9, SkosPropertyPeer::COMMENT => 10, SkosPropertyPeer::EXAMPLES => 11, SkosPropertyPeer::IS_REQUIRED => 12, SkosPropertyPeer::IS_RECIPROCAL => 13, SkosPropertyPeer::IS_SINGLETON => 14, SkosPropertyPeer::IS_SCHEME => 15, SkosPropertyPeer::IS_IN_PICKLIST => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'parent_id' => 1, 'inverse_id' => 2, 'name' => 3, 'uri' => 4, 'object_type' => 5, 'display_order' => 6, 'picklist_order' => 7, 'label' => 8, 'definition' => 9, 'comment' => 10, 'examples' => 11, 'is_required' => 12, 'is_reciprocal' => 13, 'is_singleton' => 14, 'is_scheme' => 15, 'is_in_picklist' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SkosPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SkosPropertyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SkosPropertyPeer::getTableMap();
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
		return str_replace(SkosPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SkosPropertyPeer::ID);

		$criteria->addSelectColumn(SkosPropertyPeer::PARENT_ID);

		$criteria->addSelectColumn(SkosPropertyPeer::INVERSE_ID);

		$criteria->addSelectColumn(SkosPropertyPeer::NAME);

		$criteria->addSelectColumn(SkosPropertyPeer::URI);

		$criteria->addSelectColumn(SkosPropertyPeer::OBJECT_TYPE);

		$criteria->addSelectColumn(SkosPropertyPeer::DISPLAY_ORDER);

		$criteria->addSelectColumn(SkosPropertyPeer::PICKLIST_ORDER);

		$criteria->addSelectColumn(SkosPropertyPeer::LABEL);

		$criteria->addSelectColumn(SkosPropertyPeer::DEFINITION);

		$criteria->addSelectColumn(SkosPropertyPeer::COMMENT);

		$criteria->addSelectColumn(SkosPropertyPeer::EXAMPLES);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_REQUIRED);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_RECIPROCAL);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_SINGLETON);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_SCHEME);

		$criteria->addSelectColumn(SkosPropertyPeer::IS_IN_PICKLIST);

	}

	const COUNT = 'COUNT(reg_skos_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_skos_property.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SkosPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SkosPropertyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SkosPropertyPeer::doSelectRS($criteria, $con);
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
		$objects = SkosPropertyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SkosPropertyPeer::populateObjects(SkosPropertyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SkosPropertyPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SkosPropertyPeer::getOMClass();
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
		return SkosPropertyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SkosPropertyPeer::ID); 

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
			$comparison = $criteria->getComparison(SkosPropertyPeer::ID);
			$selectCriteria->add(SkosPropertyPeer::ID, $criteria->remove(SkosPropertyPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SkosPropertyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SkosPropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SkosProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SkosPropertyPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SkosProperty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SkosPropertyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SkosPropertyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SkosPropertyPeer::DATABASE_NAME, SkosPropertyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SkosPropertyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SkosPropertyPeer::DATABASE_NAME);

		$criteria->add(SkosPropertyPeer::ID, $pk);


		$v = SkosPropertyPeer::doSelect($criteria, $con);

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
			$criteria->add(SkosPropertyPeer::ID, $pks, Criteria::IN);
			$objs = SkosPropertyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSkosPropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SkosPropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SkosPropertyMapBuilder');
}
