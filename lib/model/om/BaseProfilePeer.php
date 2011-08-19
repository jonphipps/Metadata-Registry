<?php

/**
 * Base static class for performing query and update operations on the 'profile' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProfilePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'profile';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Profile';

	/** The total number of columns. */
	const NUM_COLUMNS = 20;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'profile.ID';

	/** the column name for the AGENT_ID field */
	const AGENT_ID = 'profile.AGENT_ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'profile.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'profile.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'profile.DELETED_AT';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'profile.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'profile.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'profile.DELETED_BY';

	/** the column name for the CHILD_UPDATED_AT field */
	const CHILD_UPDATED_AT = 'profile.CHILD_UPDATED_AT';

	/** the column name for the CHILD_UPDATED_BY field */
	const CHILD_UPDATED_BY = 'profile.CHILD_UPDATED_BY';

	/** the column name for the NAME field */
	const NAME = 'profile.NAME';

	/** the column name for the NOTE field */
	const NOTE = 'profile.NOTE';

	/** the column name for the URI field */
	const URI = 'profile.URI';

	/** the column name for the URL field */
	const URL = 'profile.URL';

	/** the column name for the BASE_DOMAIN field */
	const BASE_DOMAIN = 'profile.BASE_DOMAIN';

	/** the column name for the TOKEN field */
	const TOKEN = 'profile.TOKEN';

	/** the column name for the COMMUNITY field */
	const COMMUNITY = 'profile.COMMUNITY';

	/** the column name for the LAST_URI_ID field */
	const LAST_URI_ID = 'profile.LAST_URI_ID';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'profile.STATUS_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'profile.LANGUAGE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AgentId', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedBy', 'UpdatedBy', 'DeletedBy', 'ChildUpdatedAt', 'ChildUpdatedBy', 'Name', 'Note', 'Uri', 'Url', 'BaseDomain', 'Token', 'Community', 'LastUriId', 'StatusId', 'Language', ),
		BasePeer::TYPE_COLNAME => array (ProfilePeer::ID, ProfilePeer::AGENT_ID, ProfilePeer::CREATED_AT, ProfilePeer::UPDATED_AT, ProfilePeer::DELETED_AT, ProfilePeer::CREATED_BY, ProfilePeer::UPDATED_BY, ProfilePeer::DELETED_BY, ProfilePeer::CHILD_UPDATED_AT, ProfilePeer::CHILD_UPDATED_BY, ProfilePeer::NAME, ProfilePeer::NOTE, ProfilePeer::URI, ProfilePeer::URL, ProfilePeer::BASE_DOMAIN, ProfilePeer::TOKEN, ProfilePeer::COMMUNITY, ProfilePeer::LAST_URI_ID, ProfilePeer::STATUS_ID, ProfilePeer::LANGUAGE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'agent_id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'child_updated_at', 'child_updated_by', 'name', 'note', 'uri', 'url', 'base_domain', 'token', 'community', 'last_uri_id', 'status_id', 'language', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AgentId' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, 'DeletedAt' => 4, 'CreatedBy' => 5, 'UpdatedBy' => 6, 'DeletedBy' => 7, 'ChildUpdatedAt' => 8, 'ChildUpdatedBy' => 9, 'Name' => 10, 'Note' => 11, 'Uri' => 12, 'Url' => 13, 'BaseDomain' => 14, 'Token' => 15, 'Community' => 16, 'LastUriId' => 17, 'StatusId' => 18, 'Language' => 19, ),
		BasePeer::TYPE_COLNAME => array (ProfilePeer::ID => 0, ProfilePeer::AGENT_ID => 1, ProfilePeer::CREATED_AT => 2, ProfilePeer::UPDATED_AT => 3, ProfilePeer::DELETED_AT => 4, ProfilePeer::CREATED_BY => 5, ProfilePeer::UPDATED_BY => 6, ProfilePeer::DELETED_BY => 7, ProfilePeer::CHILD_UPDATED_AT => 8, ProfilePeer::CHILD_UPDATED_BY => 9, ProfilePeer::NAME => 10, ProfilePeer::NOTE => 11, ProfilePeer::URI => 12, ProfilePeer::URL => 13, ProfilePeer::BASE_DOMAIN => 14, ProfilePeer::TOKEN => 15, ProfilePeer::COMMUNITY => 16, ProfilePeer::LAST_URI_ID => 17, ProfilePeer::STATUS_ID => 18, ProfilePeer::LANGUAGE => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'agent_id' => 1, 'created_at' => 2, 'updated_at' => 3, 'deleted_at' => 4, 'created_by' => 5, 'updated_by' => 6, 'deleted_by' => 7, 'child_updated_at' => 8, 'child_updated_by' => 9, 'name' => 10, 'note' => 11, 'uri' => 12, 'url' => 13, 'base_domain' => 14, 'token' => 15, 'community' => 16, 'last_uri_id' => 17, 'status_id' => 18, 'language' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProfileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProfileMapBuilder');
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
			$map = ProfilePeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ProfilePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ProfilePeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::ID) : ProfilePeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::AGENT_ID) : ProfilePeer::AGENT_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::CREATED_AT) : ProfilePeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::UPDATED_AT) : ProfilePeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::DELETED_AT) : ProfilePeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::CREATED_BY) : ProfilePeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::UPDATED_BY) : ProfilePeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::DELETED_BY) : ProfilePeer::DELETED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::CHILD_UPDATED_AT) : ProfilePeer::CHILD_UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::CHILD_UPDATED_BY) : ProfilePeer::CHILD_UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::NAME) : ProfilePeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::NOTE) : ProfilePeer::NOTE);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::URI) : ProfilePeer::URI);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::URL) : ProfilePeer::URL);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::BASE_DOMAIN) : ProfilePeer::BASE_DOMAIN);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::TOKEN) : ProfilePeer::TOKEN);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::COMMUNITY) : ProfilePeer::COMMUNITY);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::LAST_URI_ID) : ProfilePeer::LAST_URI_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::STATUS_ID) : ProfilePeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? ProfilePeer::alias($tableAlias, ProfilePeer::LANGUAGE) : ProfilePeer::LANGUAGE);

	}

	const COUNT = 'COUNT(profile.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT profile.ID)';

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
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProfilePeer::doSelectRS($criteria, $con);
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
	 * @return     Profile
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ProfilePeer::doSelect($critcopy, $con);
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
		return ProfilePeer::populateObjects(ProfilePeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseProfilePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseProfilePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProfilePeer::addSelectColumns($criteria);
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
		$cls = ProfilePeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Agent table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAgent(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByChildUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUserRelatedByChildUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their Agent objects.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAgent(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AgentPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their User objects.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilesRelatedByCreatedBy();
				$obj2->addProfileRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their User objects.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilesRelatedByUpdatedBy();
				$obj2->addProfileRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their User objects.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilesRelatedByDeletedBy();
				$obj2->addProfileRelatedByDeletedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their User objects.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUserRelatedByChildUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addProfileRelatedByChildUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfilesRelatedByChildUpdatedBy();
				$obj2->addProfileRelatedByChildUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with their Status objects.
	 *
	 * @return array Array of Profile objects.
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

		ProfilePeer::addSelectColumns($c);
		$startcol = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

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
					$temp_obj2->addProfile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1); //CHECKME
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
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects.
	 *
	 * @return array Array of Profile objects.
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

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::alias('a1', AgentPeer::ID));
        $c->addAlias('a1', AgentPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::CREATED_BY, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::UPDATED_BY, UserPeer::alias('a3', UserPeer::ID));
        $c->addAlias('a3', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::DELETED_BY, UserPeer::alias('a4', UserPeer::ID));
        $c->addAlias('a4', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::alias('a5', UserPeer::ID));
        $c->addAlias('a5', UserPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::alias('a6', StatusPeer::ID));
        $c->addAlias('a6', StatusPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Agent rows
	
			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByCreatedBy(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilesRelatedByCreatedBy();
				$obj3->addProfileRelatedByCreatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByUpdatedBy(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfileRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilesRelatedByUpdatedBy();
				$obj4->addProfileRelatedByUpdatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUserRelatedByDeletedBy(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilesRelatedByDeletedBy();
				$obj5->addProfileRelatedByDeletedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByChildUpdatedBy(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addProfileRelatedByChildUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initProfilesRelatedByChildUpdatedBy();
				$obj6->addProfileRelatedByChildUpdatedBy($obj1);
			}


				// Add objects for joined Status rows
	
			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getStatus(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addProfile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initProfiles();
				$obj7->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Agent table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAgent(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByCreatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByCreatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByDeletedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByDeletedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UserRelatedByChildUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUserRelatedByChildUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProfilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProfilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$criteria->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$criteria->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);

		$rs = ProfilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except Agent.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAgent(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UserPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfileRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfilesRelatedByCreatedBy();
				$obj2->addProfileRelatedByCreatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilesRelatedByUpdatedBy();
				$obj3->addProfileRelatedByUpdatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfileRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilesRelatedByDeletedBy();
				$obj4->addProfileRelatedByDeletedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUserRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilesRelatedByChildUpdatedBy();
				$obj5->addProfileRelatedByChildUpdatedBy($obj1);
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
					$temp_obj6->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initProfiles();
				$obj6->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except UserRelatedByCreatedBy.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByCreatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfiles();
				$obj3->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except UserRelatedByUpdatedBy.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfiles();
				$obj3->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except UserRelatedByDeletedBy.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByDeletedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfiles();
				$obj3->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except UserRelatedByChildUpdatedBy.
	 *
	 * @return array Array of Profile objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUserRelatedByChildUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + StatusPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(ProfilePeer::STATUS_ID, StatusPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfiles();
				$obj3->addProfile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Profile objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of Profile objects.
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

		ProfilePeer::addSelectColumns($c);
		$startcol2 = (ProfilePeer::NUM_COLUMNS - ProfilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UserPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(ProfilePeer::AGENT_ID, AgentPeer::ID);

		$c->addJoin(ProfilePeer::CREATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::UPDATED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::DELETED_BY, UserPeer::ID);

		$c->addJoin(ProfilePeer::CHILD_UPDATED_BY, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProfile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProfiles();
				$obj2->addProfile($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByCreatedBy(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProfileRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProfilesRelatedByCreatedBy();
				$obj3->addProfileRelatedByCreatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByUpdatedBy(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProfileRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initProfilesRelatedByUpdatedBy();
				$obj4->addProfileRelatedByUpdatedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUserRelatedByDeletedBy(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addProfileRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initProfilesRelatedByDeletedBy();
				$obj5->addProfileRelatedByDeletedBy($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUserRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addProfileRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initProfilesRelatedByChildUpdatedBy();
				$obj6->addProfileRelatedByChildUpdatedBy($obj1);
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
		return ProfilePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Profile or Criteria object.
	 *
	 * @param      mixed $values Criteria or Profile object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProfilePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProfilePeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Profile object
		}

		$criteria->remove(ProfilePeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseProfilePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseProfilePeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Profile or Criteria object.
	 *
	 * @param      mixed $values Criteria or Profile object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProfilePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProfilePeer', $values, $con);
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

			$comparison = $criteria->getComparison(ProfilePeer::ID);
			$selectCriteria->add(ProfilePeer::ID, $criteria->remove(ProfilePeer::ID), $comparison);

		} else { // $values is Profile object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseProfilePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseProfilePeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the profile table.
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
			$affectedRows += BasePeer::doDeleteAll(ProfilePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Profile or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Profile object or primary key or array of primary keys
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
			$con = Propel::getConnection(ProfilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Profile) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProfilePeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Profile object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Profile $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Profile $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProfilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProfilePeer::TABLE_NAME);

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

		return BasePeer::doValidate(ProfilePeer::DATABASE_NAME, ProfilePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     Profile
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ProfilePeer::DATABASE_NAME);

		$criteria->add(ProfilePeer::ID, $pk);


		$v = ProfilePeer::doSelect($criteria, $con);

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
			$criteria->add(ProfilePeer::ID, $pks, Criteria::IN);
			$objs = ProfilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseProfilePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseProfilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ProfileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProfileMapBuilder');
}
