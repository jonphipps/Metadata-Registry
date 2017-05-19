<?php

/**
 * Base static class for performing query and update operations on the 'reg_concept_property' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseConceptPropertyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_concept_property';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ConceptProperty';

	/** The total number of columns. */
	const NUM_COLUMNS = 21;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_concept_property.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_concept_property.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_concept_property.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_concept_property.DELETED_AT';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'reg_concept_property.LAST_UPDATED';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_concept_property.CREATED_USER_ID';

	/** the column name for the UPDATED_USER_ID field */
	const UPDATED_USER_ID = 'reg_concept_property.UPDATED_USER_ID';

	/** the column name for the CONCEPT_ID field */
	const CONCEPT_ID = 'reg_concept_property.CONCEPT_ID';

	/** the column name for the PRIMARY_PREF_LABEL field */
	const PRIMARY_PREF_LABEL = 'reg_concept_property.PRIMARY_PREF_LABEL';

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

	/** the column name for the IS_CONCEPT_PROPERTY field */
	const IS_CONCEPT_PROPERTY = 'reg_concept_property.IS_CONCEPT_PROPERTY';

	/** the column name for the PROFILE_PROPERTY_ID field */
	const PROFILE_PROPERTY_ID = 'reg_concept_property.PROFILE_PROPERTY_ID';

	/** the column name for the IS_GENERATED field */
	const IS_GENERATED = 'reg_concept_property.IS_GENERATED';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'reg_concept_property.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'reg_concept_property.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'reg_concept_property.DELETED_BY';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'LastUpdated', 'CreatedUserId', 'UpdatedUserId', 'ConceptId', 'PrimaryPrefLabel', 'SkosPropertyId', 'Object', 'SchemeId', 'RelatedConceptId', 'Language', 'StatusId', 'IsConceptProperty', 'ProfilePropertyId', 'IsGenerated', 'CreatedBy', 'UpdatedBy', 'DeletedBy', ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID, ConceptPropertyPeer::CREATED_AT, ConceptPropertyPeer::UPDATED_AT, ConceptPropertyPeer::DELETED_AT, ConceptPropertyPeer::LAST_UPDATED, ConceptPropertyPeer::CREATED_USER_ID, ConceptPropertyPeer::UPDATED_USER_ID, ConceptPropertyPeer::CONCEPT_ID, ConceptPropertyPeer::PRIMARY_PREF_LABEL, ConceptPropertyPeer::SKOS_PROPERTY_ID, ConceptPropertyPeer::OBJECT, ConceptPropertyPeer::SCHEME_ID, ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPropertyPeer::LANGUAGE, ConceptPropertyPeer::STATUS_ID, ConceptPropertyPeer::IS_CONCEPT_PROPERTY, ConceptPropertyPeer::PROFILE_PROPERTY_ID, ConceptPropertyPeer::IS_GENERATED, ConceptPropertyPeer::CREATED_BY, ConceptPropertyPeer::UPDATED_BY, ConceptPropertyPeer::DELETED_BY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'last_updated', 'created_user_id', 'updated_user_id', 'concept_id', 'primary_pref_label', 'skos_property_id', 'object', 'scheme_id', 'related_concept_id', 'language', 'status_id', 'is_concept_property', 'profile_property_id', 'is_generated', 'created_by', 'updated_by', 'deleted_by', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'LastUpdated' => 4, 'CreatedUserId' => 5, 'UpdatedUserId' => 6, 'ConceptId' => 7, 'PrimaryPrefLabel' => 8, 'SkosPropertyId' => 9, 'Object' => 10, 'SchemeId' => 11, 'RelatedConceptId' => 12, 'Language' => 13, 'StatusId' => 14, 'IsConceptProperty' => 15, 'ProfilePropertyId' => 16, 'IsGenerated' => 17, 'CreatedBy' => 18, 'UpdatedBy' => 19, 'DeletedBy' => 20, ),
		BasePeer::TYPE_COLNAME => array (ConceptPropertyPeer::ID => 0, ConceptPropertyPeer::CREATED_AT => 1, ConceptPropertyPeer::UPDATED_AT => 2, ConceptPropertyPeer::DELETED_AT => 3, ConceptPropertyPeer::LAST_UPDATED => 4, ConceptPropertyPeer::CREATED_USER_ID => 5, ConceptPropertyPeer::UPDATED_USER_ID => 6, ConceptPropertyPeer::CONCEPT_ID => 7, ConceptPropertyPeer::PRIMARY_PREF_LABEL => 8, ConceptPropertyPeer::SKOS_PROPERTY_ID => 9, ConceptPropertyPeer::OBJECT => 10, ConceptPropertyPeer::SCHEME_ID => 11, ConceptPropertyPeer::RELATED_CONCEPT_ID => 12, ConceptPropertyPeer::LANGUAGE => 13, ConceptPropertyPeer::STATUS_ID => 14, ConceptPropertyPeer::IS_CONCEPT_PROPERTY => 15, ConceptPropertyPeer::PROFILE_PROPERTY_ID => 16, ConceptPropertyPeer::IS_GENERATED => 17, ConceptPropertyPeer::CREATED_BY => 18, ConceptPropertyPeer::UPDATED_BY => 19, ConceptPropertyPeer::DELETED_BY => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'last_updated' => 4, 'created_user_id' => 5, 'updated_user_id' => 6, 'concept_id' => 7, 'primary_pref_label' => 8, 'skos_property_id' => 9, 'object' => 10, 'scheme_id' => 11, 'related_concept_id' => 12, 'language' => 13, 'status_id' => 14, 'is_concept_property' => 15, 'profile_property_id' => 16, 'is_generated' => 17, 'created_by' => 18, 'updated_by' => 19, 'deleted_by' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConceptPropertyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConceptPropertyMapBuilder');
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
	 * @param      string $column The column name for current table. (i.e. ConceptPropertyPeer::COLUMN_NAME).
	 * @return     string
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
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $tableAlias = null)
	{

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::ID) : ConceptPropertyPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::CREATED_AT) : ConceptPropertyPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::UPDATED_AT) : ConceptPropertyPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::DELETED_AT) : ConceptPropertyPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::LAST_UPDATED) : ConceptPropertyPeer::LAST_UPDATED);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::CREATED_USER_ID) : ConceptPropertyPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::UPDATED_USER_ID) : ConceptPropertyPeer::UPDATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::CONCEPT_ID) : ConceptPropertyPeer::CONCEPT_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::PRIMARY_PREF_LABEL) : ConceptPropertyPeer::PRIMARY_PREF_LABEL);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::SKOS_PROPERTY_ID) : ConceptPropertyPeer::SKOS_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::OBJECT) : ConceptPropertyPeer::OBJECT);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::SCHEME_ID) : ConceptPropertyPeer::SCHEME_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::RELATED_CONCEPT_ID) : ConceptPropertyPeer::RELATED_CONCEPT_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::LANGUAGE) : ConceptPropertyPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::STATUS_ID) : ConceptPropertyPeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::IS_CONCEPT_PROPERTY) : ConceptPropertyPeer::IS_CONCEPT_PROPERTY);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::PROFILE_PROPERTY_ID) : ConceptPropertyPeer::PROFILE_PROPERTY_ID);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::IS_GENERATED) : ConceptPropertyPeer::IS_GENERATED);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::CREATED_BY) : ConceptPropertyPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::UPDATED_BY) : ConceptPropertyPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ConceptPropertyPeer::alias($tableAlias, ConceptPropertyPeer::DELETED_BY) : ConceptPropertyPeer::DELETED_BY);

	}

	const COUNT = 'COUNT(reg_concept_property.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_concept_property.ID)';

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
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     ConceptProperty
	 * @throws     PropelException Any exceptions caught during processing will be
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
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
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
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
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
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

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
	 * Returns the number of rows matching criteria, joining the related ProfilePropertyRelatedBySkosPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProfilePropertyRelatedBySkosPropertyId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfilePropertyRelatedByProfilePropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProfilePropertyRelatedByProfilePropertyId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Users objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByCreatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Users objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByUpdatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByUpdatedUserId();
				$obj2->addConceptPropertyRelatedByUpdatedUserId($obj1); //CHECKME
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
	 * Selects a collection of ConceptProperty objects pre-filled with their ProfileProperty objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProfilePropertyRelatedBySkosPropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedBySkosPropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedBySkosPropertyId();
				$obj2->addConceptPropertyRelatedBySkosPropertyId($obj1); //CHECKME
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
	 * Selects a collection of ConceptProperty objects pre-filled with their Status objects.
	 *
	 * @return array Array of ConceptProperty objects.
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
				$temp_obj2 = $temp_obj1->getStatus(); //CHECKME
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
	 * Selects a collection of ConceptProperty objects pre-filled with their ProfileProperty objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProfilePropertyRelatedByProfilePropertyId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePropertyPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByProfilePropertyId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByProfilePropertyId();
				$obj2->addConceptPropertyRelatedByProfilePropertyId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Users objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedBy();
				$obj2->addConceptPropertyRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Users objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByUpdatedBy();
				$obj2->addConceptPropertyRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with their Users objects.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addConceptPropertyRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initConceptPropertysRelatedByDeletedBy();
				$obj2->addConceptPropertyRelatedByDeletedBy($obj1); //CHECKME
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

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

		UsersPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::alias('a1', UsersPeer::ID));
        $c->addAlias('a1', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::alias('a2', UsersPeer::ID));
        $c->addAlias('a2', UsersPeer::TABLE_NAME);

		ConceptPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::alias('a3', ConceptPeer::ID));
        $c->addAlias('a3', ConceptPeer::TABLE_NAME);

		ProfilePropertyPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::alias('a4', ProfilePropertyPeer::SKOS_ID));
        $c->addAlias('a4', ProfilePropertyPeer::TABLE_NAME);

		VocabularyPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::alias('a5', VocabularyPeer::ID));
        $c->addAlias('a5', VocabularyPeer::TABLE_NAME);

		ConceptPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::alias('a6', ConceptPeer::ID));
        $c->addAlias('a6', ConceptPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a7');
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::alias('a7', StatusPeer::ID));
        $c->addAlias('a7', StatusPeer::TABLE_NAME);

		ProfilePropertyPeer::addSelectColumns($c, 'a8');
		$startcol10 = $startcol9 + ProfilePropertyPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::alias('a8', ProfilePropertyPeer::ID));
        $c->addAlias('a8', ProfilePropertyPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a9');
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::alias('a9', UsersPeer::ID));
        $c->addAlias('a9', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a10');
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::alias('a10', UsersPeer::ID));
        $c->addAlias('a10', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a11');
		$startcol13 = $startcol12 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::alias('a11', UsersPeer::ID));
        $c->addAlias('a11', UsersPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}


				// Add objects for joined Concept rows
	
			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByConceptId(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByConceptId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedByConceptId();
				$obj4->addConceptPropertyRelatedByConceptId($obj1);
			}


				// Add objects for joined ProfileProperty rows
	
			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedBySkosPropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertysRelatedBySkosPropertyId();
				$obj5->addConceptPropertyRelatedBySkosPropertyId($obj1);
			}


				// Add objects for joined Vocabulary rows
	
			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabulary(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
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
					$temp_obj7->addConceptPropertyRelatedByRelatedConceptId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByRelatedConceptId();
				$obj7->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj8->addConceptProperty($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertys();
				$obj8->addConceptProperty($obj1);
			}


				// Add objects for joined ProfileProperty rows
	
			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); // CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByProfilePropertyId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByProfilePropertyId();
				$obj9->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10 = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByCreatedBy(); // CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByCreatedBy();
				$obj10->addConceptPropertyRelatedByCreatedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11 = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByUpdatedBy(); // CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addConceptPropertyRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj11->initConceptPropertysRelatedByUpdatedBy();
				$obj11->addConceptPropertyRelatedByUpdatedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj12 = new $cls();
			$obj12->hydrate($rs, $startcol12);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj12 = $temp_obj1->getUsersRelatedByDeletedBy(); // CHECKME
				if ($temp_obj12->getPrimaryKey() === $obj12->getPrimaryKey()) {
					$newObject = false;
					$temp_obj12->addConceptPropertyRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj12->initConceptPropertysRelatedByDeletedBy();
				$obj12->addConceptPropertyRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByCreatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfilePropertyRelatedBySkosPropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfilePropertyRelatedBySkosPropertyId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConceptPropertyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProfilePropertyRelatedByProfilePropertyId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfilePropertyRelatedByProfilePropertyId(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$criteria->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$rs = ConceptPropertyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except UsersRelatedByCreatedUserId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByCreatedUserId(Criteria $c, $con = null)
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

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);


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

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedBySkosPropertyId();
				$obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except UsersRelatedByUpdatedUserId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByUpdatedUserId(Criteria $c, $con = null)
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

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);


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

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedBySkosPropertyId();
				$obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
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

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedBySkosPropertyId();
				$obj4->addConceptPropertyRelatedBySkosPropertyId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByCreatedBy();
				$obj8->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByUpdatedBy();
				$obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByDeletedBy();
				$obj10->addConceptPropertyRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except ProfilePropertyRelatedBySkosPropertyId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfilePropertyRelatedBySkosPropertyId(Criteria $c, $con = null)
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

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedByConceptId();
				$obj4->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
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
					$temp_obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj7->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertys();
				$obj7->addConceptProperty($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByCreatedBy();
				$obj8->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByUpdatedBy();
				$obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByDeletedBy();
				$obj10->addConceptPropertyRelatedByDeletedBy($obj1);
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

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ProfilePropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedByConceptId();
				$obj4->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertysRelatedBySkosPropertyId();
				$obj5->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj7->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertys();
				$obj7->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByProfilePropertyId();
				$obj8->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByCreatedBy();
				$obj9->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByUpdatedBy();
				$obj10->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initConceptPropertysRelatedByDeletedBy();
				$obj11->addConceptPropertyRelatedByDeletedBy($obj1);
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

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedBySkosPropertyId();
				$obj4->addConceptPropertyRelatedBySkosPropertyId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByCreatedBy();
				$obj8->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByUpdatedBy();
				$obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByDeletedBy();
				$obj10->addConceptPropertyRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of ConceptProperty objects.
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

		ConceptPropertyPeer::addSelectColumns($c);
		$startcol2 = (ConceptPropertyPeer::NUM_COLUMNS - ConceptPropertyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ConceptPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ProfilePropertyPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedByConceptId();
				$obj4->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertysRelatedBySkosPropertyId();
				$obj5->addConceptPropertyRelatedBySkosPropertyId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
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
					$temp_obj7->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByRelatedConceptId();
				$obj7->addConceptPropertyRelatedByRelatedConceptId($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByProfilePropertyId();
				$obj8->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByCreatedBy();
				$obj9->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByUpdatedBy();
				$obj10->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initConceptPropertysRelatedByDeletedBy();
				$obj11->addConceptPropertyRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except ProfilePropertyRelatedByProfilePropertyId.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfilePropertyRelatedByProfilePropertyId(Criteria $c, $con = null)
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

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ConceptPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(ConceptPropertyPeer::DELETED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ConceptPropertyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initConceptPropertysRelatedByCreatedUserId();
				$obj2->addConceptPropertyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedByUpdatedUserId();
				$obj3->addConceptPropertyRelatedByUpdatedUserId($obj1);
			}

			$omClass = ConceptPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getConceptRelatedByConceptId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addConceptPropertyRelatedByConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initConceptPropertysRelatedByConceptId();
				$obj4->addConceptPropertyRelatedByConceptId($obj1);
			}

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVocabulary(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initConceptPropertys();
				$obj5->addConceptProperty($obj1);
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
					$temp_obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertysRelatedByRelatedConceptId();
				$obj6->addConceptPropertyRelatedByRelatedConceptId($obj1);
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
					$temp_obj7->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertys();
				$obj7->addConceptProperty($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getUsersRelatedByCreatedBy(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addConceptPropertyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initConceptPropertysRelatedByCreatedBy();
				$obj8->addConceptPropertyRelatedByCreatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9  = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getUsersRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initConceptPropertysRelatedByUpdatedBy();
				$obj9->addConceptPropertyRelatedByUpdatedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj10  = new $cls();
			$obj10->hydrate($rs, $startcol10);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj10 = $temp_obj1->getUsersRelatedByDeletedBy(); //CHECKME
				if ($temp_obj10->getPrimaryKey() === $obj10->getPrimaryKey()) {
					$newObject = false;
					$temp_obj10->addConceptPropertyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initConceptPropertysRelatedByDeletedBy();
				$obj10->addConceptPropertyRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except UsersRelatedByCreatedBy.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByCreatedBy(Criteria $c, $con = null)
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

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);


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

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedBySkosPropertyId();
				$obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except UsersRelatedByUpdatedBy.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByUpdatedBy(Criteria $c, $con = null)
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

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);


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

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedBySkosPropertyId();
				$obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of ConceptProperty objects pre-filled with all related objects except UsersRelatedByDeletedBy.
	 *
	 * @return array Array of ConceptProperty objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByDeletedBy(Criteria $c, $con = null)
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

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProfilePropertyPeer::NUM_COLUMNS;

		VocabularyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VocabularyPeer::NUM_COLUMNS;

		ConceptPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ConceptPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePropertyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePropertyPeer::NUM_COLUMNS;

		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, ProfilePropertyPeer::SKOS_ID);

		$c->addJoin(ConceptPropertyPeer::SCHEME_ID, VocabularyPeer::ID);

		$c->addJoin(ConceptPropertyPeer::RELATED_CONCEPT_ID, ConceptPeer::ID);

		$c->addJoin(ConceptPropertyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(ConceptPropertyPeer::PROFILE_PROPERTY_ID, ProfilePropertyPeer::ID);


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

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProfilePropertyRelatedBySkosPropertyId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initConceptPropertysRelatedBySkosPropertyId();
				$obj3->addConceptPropertyRelatedBySkosPropertyId($obj1);
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
					$temp_obj6->addConceptProperty($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initConceptPropertys();
				$obj6->addConceptProperty($obj1);
			}

			$omClass = ProfilePropertyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfilePropertyRelatedByProfilePropertyId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initConceptPropertysRelatedByProfilePropertyId();
				$obj7->addConceptPropertyRelatedByProfilePropertyId($obj1);
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
		return ConceptPropertyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a ConceptProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or ConceptProperty object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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

		
    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a ConceptProperty or Criteria object.
	 *
	 * @param      mixed $values Criteria or ConceptProperty object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
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
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ConceptPropertyPeer::ID);
			$selectCriteria->add(ConceptPropertyPeer::ID, $criteria->remove(ConceptPropertyPeer::ID), $comparison);

		} else { // $values is ConceptProperty object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseConceptPropertyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptPropertyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_concept_property table.
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
	 * @param      mixed $values Criteria or ConceptProperty object or primary key or array of primary keys
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
	 * @param      ConceptProperty $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
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
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     ConceptProperty
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
	require_once 'lib/model/map/ConceptPropertyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConceptPropertyMapBuilder');
}
