<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by ConceptPropertyPeer::getOMClass()
include_once 'model/ConceptProperty.php';

/**
 * Base static class for performing query and update operations on the 'reg_concept_property' table.
 *
 * 
 *
 * @package model.om
 */
abstract class BaseConceptPropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_concept_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'model.ConceptProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 10;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_concept_property.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_concept_property.CREATED_AT';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'reg_concept_property.LAST_UPDATED';

	/** the column name for the CONCEPT_ID field */
	const CONCEPT_ID = 'reg_concept_property.CONCEPT_ID';

	/** the column name for the SKOS_PROPERTY_ID field */
	const SKOS_PROPERTY_ID = 'reg_concept_property.SKOS_PROPERTY_ID';

	/** the column name for the OBJECT field */
	const OBJECT = 'reg_concept_property.OBJECT';

	/** the column name for the SCHEME_ID field */
	const SCHEME_ID = 'reg_concept_property.SCHEME_ID';

	/** the column name for the RELATED_CONCEPT_ID field */
	const RELATED_CONCEPT_ID = 'reg_concept_property.RELATED_CONCEPT_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_concept_property.LANGUAGE';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_concept_property.STATUS_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'LastUpdated', 'ConceptId', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID, ConceptPropertyPeer::CREATED_AT, ConceptPropertyPeer::LAST_UPDATED, ConceptPropertyPeer::CONCEPT_ID, ConceptPropertyPeer::SKOS_PROPERTY_ID, ConceptPropertyPeer::OBJECT, ConceptPropertyPeer::SCHEME_ID, ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPropertyPeer::LANGUAGE, ConceptPropertyPeer::STATUS_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'last_updated', 'concept_id', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'LastUpdated' => 2, 'ConceptId' => 3, 'SkosPropertyId' => 4, 'Object' => 5, 'SchemeId' => 6, 'RelatedConceptId' => 7, 'Language' => 8, 'StatusId' => 9, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID => 0, ConceptPropertyPeer::CREATED_AT => 1, ConceptPropertyPeer::LAST_UPDATED => 2, ConceptPropertyPeer::CONCEPT_ID => 3, ConceptPropertyPeer::SKOS_PROPERTY_ID => 4, ConceptPropertyPeer::OBJECT => 5, ConceptPropertyPeer::SCHEME_ID => 6, ConceptPropertyPeer::RELATED_CONCEPT_ID => 7, ConceptPropertyPeer::LANGUAGE => 8, ConceptPropertyPeer::STATUS_ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'last_updated' => 2, 'concept_id' => 3, 'skos_property_id' => 4, 'object' => 5, 'scheme_id' => 6, 'related_concept_id' => 7, 'language' => 8, 'status_id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * @return MapBuilder the map builder for this peer
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'model/map/ConceptPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('model.map.ConceptPropertyMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return array The PHP to DB name map for this peer
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
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
	/**
	 * Translates a fieldname to another type
	 *
	 * @param string $name field name
	 * @param string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param string $toType   One of the class type constants
	 * @return string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param  string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param string $alias The alias for the current table.
	 * @param string $column The column name for current table. (i.e. ConceptPropertyPeer::COLUMN_NAME).
	 * @return string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ConceptPropertyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param criteria object containing the columns to add.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param Criteria $criteria
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param Criteria $criteria object used to create the SELECT statement.
	 * @param Connection $con
	 * @return ConceptProperty
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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
	/**
	 * Method to do selects.
	 *
	 * @param Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param Connection $con
	 * @return array Array of selected Objects
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptPropertyPeer::populateObjects(ConceptPropertyPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param Connection $con the connection to use
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return ResultSet The resultset object with numerically-indexed fields.
	 * @see BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConceptPropertyPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ConceptPropertyPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related SkosProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinSkosProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptRelatedByConceptId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Vocabulary table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Lookup table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinLookup(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptRelatedByRelatedConceptId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinConceptRelatedByRelatedConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their SkosProperty objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSkosProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Concept objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByConceptId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByConceptId();
				$obj2->addConceptPropertyRelatedByConceptId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Lookup objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinLookup(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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

			$omClass = LookupPeer::getOMClass($rs, $startcol);

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getLookup(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptProperty($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Concept objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConceptRelatedByRelatedConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByRelatedConceptId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByRelatedConceptId();
				$obj2->addConceptPropertyRelatedByRelatedConceptId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SkosPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + LookupPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

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

				
				// Add objects for joined SkosProperty rows
	
			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSkosProperty(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptProperty($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1);
			}

				
				// Add objects for joined Concept rows
	
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByConceptId($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertysRelatedByConceptId();
				$obj3->addConceptPropertyRelatedByConceptId($obj1);
			}

				
				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptProperty($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertys();
				$obj4->addConceptProperty($obj1);
			}

				
				// Add objects for joined Lookup rows
	
			$omClass = LookupPeer::getOMClass($rs, $startcol5);

	
			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getLookup(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
			}

				
				// Add objects for joined Concept rows
	
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyRelatedByRelatedConceptId($obj1); // CHECKME
					break;
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


	/**
	 * Returns the number of rows matching criteria, joining the related SkosProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSkosProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
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
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptRelatedByConceptId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConceptRelatedByConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
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
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Vocabulary table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptVocabulary(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Lookup table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLookup(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptRelatedByRelatedConceptId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConceptRelatedByRelatedConceptId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
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
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except SkosProperty.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSkosProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass($rs, $startcol4);

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except ConceptRelatedByConceptId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConceptRelatedByConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass($rs, $startcol4);

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except Vocabulary.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptVocabulary(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SkosPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		LookupPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LookupPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, LookupPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);


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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertysRelatedByConceptId();
				$obj3->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = LookupPeer::getOMClass($rs, $startcol4);

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except Lookup.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptLookup(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SkosPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);


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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertys();
				$obj2->addConceptProperty($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertysRelatedByConceptId();
				$obj3->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except ConceptRelatedByRelatedConceptId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConceptRelatedByRelatedConceptId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptProperty($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertys();
				$obj3->addConceptProperty($obj1);
			}

			$omClass = LookupPeer::getOMClass($rs, $startcol4);

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLookup(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return TableMap
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return ConceptPropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ConceptProperty or Criteria object.
	 *
	 * @param mixed $values Criteria or ConceptProperty object containing data that is used to create the INSERT statement.
	 * @param Connection $con the connection to use
	 * @return mixed The new primary key.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ConceptProperty object
		}

		$criteria->remove(ConceptPropertyPeer::ID); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ConceptProperty or Criteria object.
	 *
	 * @param mixed $values Criteria or ConceptProperty object containing data that is used to create the UPDATE statement.
	 * @param Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return int The number of affected rows (if supported by underlying database driver).
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ConceptPropertyPeer::ID);
			$selectCriteria->add(ConceptPropertyPeer::ID, $criteria->remove(ConceptPropertyPeer::ID), $comparison);

		} else { // $values is ConceptProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the reg_concept_property table.
	 *
	 * @return int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ConceptPropertyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ConceptProperty or Criteria object OR a primary key value.
	 *
	 * @param mixed $values Criteria or ConceptProperty object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param Connection $con the connection to use
	 * @return int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ConceptProperty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptPropertyPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given ConceptProperty object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param ConceptProperty $obj The object to validate.
	 * @param mixed $cols Column name or array of column names.
	 *
	 * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
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

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param mixed $pk the primary key.
	 * @param Connection $con the connection to use
	 * @return ConceptProperty
	 */
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

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param array $pks List of primary keys
	 * @param Connection $con the connection to use
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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

} // BaseConceptPropertyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseConceptPropertyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'model/map/ConceptPropertyMapBuilder.php';
	Propel::registerMapBuilder('model.map.ConceptPropertyMapBuilder');
}
