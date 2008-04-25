<?php

/**
 * Base static class for performing query and update operations on the 'reg_concept_property_history' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseConceptPropertyHistoryPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_concept_property_history';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ConceptPropertyHistory';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_concept_property_history.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_concept_property_history.CREATED_AT';

	/** the column name for the ACTION field */
	const ACTION = 'reg_concept_property_history.ACTION';

	/** the column name for the CONCEPT_PROPERTY_ID field */
	const CONCEPT_PROPERTY_ID = 'reg_concept_property_history.CONCEPT_PROPERTY_ID';

	/** the column name for the CONCEPT_ID field */
	const CONCEPT_ID = 'reg_concept_property_history.CONCEPT_ID';

	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_concept_property_history.VOCABULARY_ID';

	/** the column name for the SKOS_PROPERTY_ID field */
	const SKOS_PROPERTY_ID = 'reg_concept_property_history.SKOS_PROPERTY_ID';

	/** the column name for the OBJECT field */
	const OBJECT = 'reg_concept_property_history.OBJECT';

	/** the column name for the SCHEME_ID field */
	const SCHEME_ID = 'reg_concept_property_history.SCHEME_ID';

	/** the column name for the RELATED_CONCEPT_ID field */
	const RELATED_CONCEPT_ID = 'reg_concept_property_history.RELATED_CONCEPT_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_concept_property_history.LANGUAGE';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_concept_property_history.STATUS_ID';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_concept_property_history.CREATED_USER_ID';

	/** the column name for the CHANGE_NOTE field */
	const CHANGE_NOTE = 'reg_concept_property_history.CHANGE_NOTE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'Action', 'ConceptPropertyId', 'ConceptId', 'VocabularyId', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', 'CreatedUserId', 'ChangeNote', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyHistoryPeer::ID, ConceptPropertyHistoryPeer::CREATED_AT, ConceptPropertyHistoryPeer::ACTION, ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPropertyHistoryPeer::VOCABULARY_ID, ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, ConceptPropertyHistoryPeer::OBJECT, ConceptPropertyHistoryPeer::SCHEME_ID, ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPropertyHistoryPeer::LANGUAGE, ConceptPropertyHistoryPeer::STATUS_ID, ConceptPropertyHistoryPeer::CREATED_USER_ID, ConceptPropertyHistoryPeer::CHANGE_NOTE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'action', 'concept_property_id', 'concept_id', 'vocabulary_id', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', 'created_user_id', 'change_note', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'Action' => 2, 'ConceptPropertyId' => 3, 'ConceptId' => 4, 'VocabularyId' => 5, 'SkosPropertyId' => 6, 'Object' => 7, 'SchemeId' => 8, 'RelatedConceptId' => 9, 'Language' => 10, 'StatusId' => 11, 'CreatedUserId' => 12, 'ChangeNote' => 13, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyHistoryPeer::ID => 0, ConceptPropertyHistoryPeer::CREATED_AT => 1, ConceptPropertyHistoryPeer::ACTION => 2, ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID => 3, ConceptPropertyHistoryPeer::CONCEPT_ID => 4, ConceptPropertyHistoryPeer::VOCABULARY_ID => 5, ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID => 6, ConceptPropertyHistoryPeer::OBJECT => 7, ConceptPropertyHistoryPeer::SCHEME_ID => 8, ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID => 9, ConceptPropertyHistoryPeer::LANGUAGE => 10, ConceptPropertyHistoryPeer::STATUS_ID => 11, ConceptPropertyHistoryPeer::CREATED_USER_ID => 12, ConceptPropertyHistoryPeer::CHANGE_NOTE => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'action' => 2, 'concept_property_id' => 3, 'concept_id' => 4, 'vocabulary_id' => 5, 'skos_property_id' => 6, 'object' => 7, 'scheme_id' => 8, 'related_concept_id' => 9, 'language' => 10, 'status_id' => 11, 'created_user_id' => 12, 'change_note' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptPropertyHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptPropertyHistoryMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
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
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
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
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
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
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ConceptPropertyHistoryPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ConceptPropertyHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CREATED_AT);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::ACTION);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::VOCABULARY_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::OBJECT);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::SCHEME_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::LANGUAGE);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::STATUS_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CREATED_USER_ID);

		$criteria->addSelectColumn(ConceptPropertyHistoryPeer::CHANGE_NOTE);

	}

	const COUNT = 'COUNT(reg_concept_property_history.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_property_history.ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     ConceptPropertyHistory
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConceptPropertyHistoryPeer::populateObjects(ConceptPropertyHistoryPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
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
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ConceptPropertyHistoryPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related ConceptProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related VocabularyRelatedByVocabularyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinVocabularyRelatedByVocabularyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related VocabularyRelatedBySchemeId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinVocabularyRelatedBySchemeId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Status table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinStatus(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related User table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their ConceptProperty objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their Concept objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistoryRelatedByConceptId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByConceptId();
				$obj2->addConceptPropertyHistoryRelatedByConceptId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinVocabularyRelatedByVocabularyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VocabularyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);
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
				$temp_obj2 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistoryRelatedByVocabularyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj2->addConceptPropertyHistoryRelatedByVocabularyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their SkosProperty objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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
				$temp_obj2 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their Vocabulary objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinVocabularyRelatedBySchemeId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistoryRelatedBySchemeId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedBySchemeId();
				$obj2->addConceptPropertyHistoryRelatedBySchemeId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their Concept objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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
				$temp_obj2 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj2->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their Status objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with their User objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
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
				$temp_obj2 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyHistory($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1); //CHECKME
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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

				
				// Add objects for joined ConceptProperty rows
	
			$omClass = ConceptPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptProperty(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
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
					$temp_obj3->addConceptPropertyHistoryRelatedByConceptId($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByConceptId();
				$obj3->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

				
				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVocabularyRelatedByVocabularyId(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

				
				// Add objects for joined SkosProperty rows
	
			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSkosProperty(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

				
				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabularyRelatedBySchemeId(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedBySchemeId();
				$obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

				
				// Add objects for joined Concept rows
	
			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptRelatedByRelatedConceptId(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

				
				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj8->initConceptPropertyHistorys();
				$obj8->addConceptPropertyHistory($obj1);
			}

				
				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUser(); // CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyHistory($obj1); // CHECKME
					break;
				}
			}
			
			if ($newObject) {
				$obj9->initConceptPropertyHistorys();
				$obj9->addConceptPropertyHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ConceptProperty table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConceptProperty(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related VocabularyRelatedByVocabularyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptVocabularyRelatedByVocabularyId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
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
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related VocabularyRelatedBySchemeId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptVocabularyRelatedBySchemeId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
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
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Status table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptStatus(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CREATED_USER_ID, UserPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related User table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;
		
		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyHistoryPeer::COUNT);
		}
		
		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyHistoryPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except ConceptProperty.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConceptProperty(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

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

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistoryRelatedByConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorysRelatedByConceptId();
				$obj2->addConceptPropertyHistoryRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedBySchemeId();
				$obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1);
					break;
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except ConceptRelatedByConceptId.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedBySchemeId();
				$obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except VocabularyRelatedByVocabularyId.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptVocabularyRelatedByVocabularyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
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
				$temp_obj4 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
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
				$temp_obj6 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except SkosProperty.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

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

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
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
				$temp_obj4 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedBySchemeId();
				$obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorys();
				$obj7->addConceptPropertyHistory($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1);
					break;
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except VocabularyRelatedBySchemeId.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptVocabularyRelatedBySchemeId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
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
				$temp_obj4 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
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
				$temp_obj6 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except ConceptRelatedByRelatedConceptId.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
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

		ConceptPropertyHistoryPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyHistoryPeer::NUM_COLUMNS - ConceptPropertyHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VocabularyPeer::NUM_COLUMNS;

		SkosPropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initConceptPropertyHistorys();
				$obj2->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj3->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj3->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
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
				$temp_obj5 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorysRelatedBySchemeId();
				$obj5->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
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
				$temp_obj7 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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

		SkosPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
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
				$temp_obj4 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedBySchemeId();
				$obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = UserPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUser(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1);
					break;
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


	/**
	 * Selects a collection of ConceptPropertyHistory objects pre-filled with all related objects except User.
	 *
	 * @return array Array of ConceptPropertyHistory objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
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

		SkosPropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + SkosPropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, ConceptPropertyPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyHistoryPeer::VOCABULARY_ID, VocabularyPeer::ID);

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
				$temp_obj2 = $temp_obj1->getConceptProperty(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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
				$temp_obj3 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
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
				$temp_obj4 = $temp_obj1->getVocabularyRelatedByVocabularyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj4->initConceptPropertyHistorysRelatedByVocabularyId();
				$obj4->addConceptPropertyHistoryRelatedByVocabularyId($obj1);
			}

			$omClass = SkosPropertyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getSkosProperty(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyHistory($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj5->initConceptPropertyHistorys();
				$obj5->addConceptPropertyHistory($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabularyRelatedBySchemeId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj6->initConceptPropertyHistorysRelatedBySchemeId();
				$obj6->addConceptPropertyHistoryRelatedBySchemeId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getConceptRelatedByRelatedConceptId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj7->initConceptPropertyHistorysRelatedByRelatedConceptId();
				$obj7->addConceptPropertyHistoryRelatedByRelatedConceptId($obj1);
			}

			$omClass = StatusPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyHistory($obj1);
					break;
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

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
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
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return ConceptPropertyHistoryPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ConceptPropertyHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or ConceptPropertyHistory object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ConceptPropertyHistory object
		}

		$criteria->remove(ConceptPropertyHistoryPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ConceptPropertyHistory or Criteria object.
	 *
	 * @param      mixed $values Criteria or ConceptPropertyHistory object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ConceptPropertyHistoryPeer::ID);
			$selectCriteria->add(ConceptPropertyHistoryPeer::ID, $criteria->remove(ConceptPropertyHistoryPeer::ID), $comparison);

		} else { // $values is ConceptPropertyHistory object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseConceptPropertyHistoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyHistoryPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_concept_property_history table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
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
			$affectedRows += BasePeer::doDeleteAll(ConceptPropertyHistoryPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ConceptPropertyHistory or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ConceptPropertyHistory object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ConceptPropertyHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof ConceptPropertyHistory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptPropertyHistoryPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given ConceptPropertyHistory object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ConceptPropertyHistory $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
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

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     ConceptPropertyHistory
	 */
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

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
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
			$criteria->add(ConceptPropertyHistoryPeer::ID, $pks, Criteria::IN);
			$objs = ConceptPropertyHistoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseConceptPropertyHistoryPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseConceptPropertyHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ConceptPropertyHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptPropertyHistoryMapBuilder');
}
