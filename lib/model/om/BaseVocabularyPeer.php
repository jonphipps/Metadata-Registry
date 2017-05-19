<?php

/**
 * Base static class for performing query and update operations on the 'reg_vocabulary' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVocabularyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_vocabulary';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Vocabulary';

	/** The total number of columns. */
	const NUM_COLUMNS = 32;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_vocabulary.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_vocabulary.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_vocabulary.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_vocabulary.DELETED_AT';

	/** the column name for the PROJECT_ID field */
	const PROJECT_ID = 'reg_vocabulary.PROJECT_ID';

	/** the column name for the AGENT_ID field */
	const AGENT_ID = 'reg_vocabulary.AGENT_ID';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'reg_vocabulary.LAST_UPDATED';

	/** the column name for the CREATED_USER_ID field */
	const CREATED_USER_ID = 'reg_vocabulary.CREATED_USER_ID';

	/** the column name for the UPDATED_USER_ID field */
	const UPDATED_USER_ID = 'reg_vocabulary.UPDATED_USER_ID';

	/** the column name for the DELETED_USER_ID field */
	const DELETED_USER_ID = 'reg_vocabulary.DELETED_USER_ID';

	/** the column name for the CHILD_UPDATED_AT field */
	const CHILD_UPDATED_AT = 'reg_vocabulary.CHILD_UPDATED_AT';

	/** the column name for the CHILD_UPDATED_USER_ID field */
	const CHILD_UPDATED_USER_ID = 'reg_vocabulary.CHILD_UPDATED_USER_ID';

	/** the column name for the NAME field */
	const NAME = 'reg_vocabulary.NAME';

	/** the column name for the NOTE field */
	const NOTE = 'reg_vocabulary.NOTE';

	/** the column name for the URI field */
	const URI = 'reg_vocabulary.URI';

	/** the column name for the URL field */
	const URL = 'reg_vocabulary.URL';

	/** the column name for the BASE_DOMAIN field */
	const BASE_DOMAIN = 'reg_vocabulary.BASE_DOMAIN';

	/** the column name for the TOKEN field */
	const TOKEN = 'reg_vocabulary.TOKEN';

	/** the column name for the COMMUNITY field */
	const COMMUNITY = 'reg_vocabulary.COMMUNITY';

	/** the column name for the LAST_URI_ID field */
	const LAST_URI_ID = 'reg_vocabulary.LAST_URI_ID';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'reg_vocabulary.STATUS_ID';

	/** the column name for the LANGUAGE field */
	const LANGUAGE = 'reg_vocabulary.LANGUAGE';

	/** the column name for the LANGUAGES field */
	const LANGUAGES = 'reg_vocabulary.LANGUAGES';

	/** the column name for the PROFILE_ID field */
	const PROFILE_ID = 'reg_vocabulary.PROFILE_ID';

	/** the column name for the NS_TYPE field */
	const NS_TYPE = 'reg_vocabulary.NS_TYPE';

	/** the column name for the PREFIXES field */
	const PREFIXES = 'reg_vocabulary.PREFIXES';

	/** the column name for the REPO field */
	const REPO = 'reg_vocabulary.REPO';

	/** the column name for the PREFIX field */
	const PREFIX = 'reg_vocabulary.PREFIX';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'reg_vocabulary.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'reg_vocabulary.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'reg_vocabulary.DELETED_BY';

	/** the column name for the CHILD_UPDATED_BY field */
	const CHILD_UPDATED_BY = 'reg_vocabulary.CHILD_UPDATED_BY';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'ProjectId', 'AgentId', 'LastUpdated', 'CreatedUserId', 'UpdatedUserId', 'DeletedUserId', 'ChildUpdatedAt', 'ChildUpdatedUserId', 'Name', 'Note', 'Uri', 'Url', 'BaseDomain', 'Token', 'Community', 'LastUriId', 'StatusId', 'Language', 'Languages', 'ProfileId', 'NsType', 'Prefixes', 'Repo', 'Prefix', 'CreatedBy', 'UpdatedBy', 'DeletedBy', 'ChildUpdatedBy', ),
		BasePeer::TYPE_COLNAME => array (VocabularyPeer::ID, VocabularyPeer::CREATED_AT, VocabularyPeer::UPDATED_AT, VocabularyPeer::DELETED_AT, VocabularyPeer::PROJECT_ID, VocabularyPeer::AGENT_ID, VocabularyPeer::LAST_UPDATED, VocabularyPeer::CREATED_USER_ID, VocabularyPeer::UPDATED_USER_ID, VocabularyPeer::DELETED_USER_ID, VocabularyPeer::CHILD_UPDATED_AT, VocabularyPeer::CHILD_UPDATED_USER_ID, VocabularyPeer::NAME, VocabularyPeer::NOTE, VocabularyPeer::URI, VocabularyPeer::URL, VocabularyPeer::BASE_DOMAIN, VocabularyPeer::TOKEN, VocabularyPeer::COMMUNITY, VocabularyPeer::LAST_URI_ID, VocabularyPeer::STATUS_ID, VocabularyPeer::LANGUAGE, VocabularyPeer::LANGUAGES, VocabularyPeer::PROFILE_ID, VocabularyPeer::NS_TYPE, VocabularyPeer::PREFIXES, VocabularyPeer::REPO, VocabularyPeer::PREFIX, VocabularyPeer::CREATED_BY, VocabularyPeer::UPDATED_BY, VocabularyPeer::DELETED_BY, VocabularyPeer::CHILD_UPDATED_BY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'deleted_at', 'project_id', 'agent_id', 'last_updated', 'created_user_id', 'updated_user_id', 'deleted_user_id', 'child_updated_at', 'child_updated_user_id', 'name', 'note', 'uri', 'url', 'base_domain', 'token', 'community', 'last_uri_id', 'status_id', 'language', 'languages', 'profile_id', 'ns_type', 'prefixes', 'repo', 'prefix', 'created_by', 'updated_by', 'deleted_by', 'child_updated_by', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'DeletedAt' => 3, 'ProjectId' => 4, 'AgentId' => 5, 'LastUpdated' => 6, 'CreatedUserId' => 7, 'UpdatedUserId' => 8, 'DeletedUserId' => 9, 'ChildUpdatedAt' => 10, 'ChildUpdatedUserId' => 11, 'Name' => 12, 'Note' => 13, 'Uri' => 14, 'Url' => 15, 'BaseDomain' => 16, 'Token' => 17, 'Community' => 18, 'LastUriId' => 19, 'StatusId' => 20, 'Language' => 21, 'Languages' => 22, 'ProfileId' => 23, 'NsType' => 24, 'Prefixes' => 25, 'Repo' => 26, 'Prefix' => 27, 'CreatedBy' => 28, 'UpdatedBy' => 29, 'DeletedBy' => 30, 'ChildUpdatedBy' => 31, ),
		BasePeer::TYPE_COLNAME => array (VocabularyPeer::ID => 0, VocabularyPeer::CREATED_AT => 1, VocabularyPeer::UPDATED_AT => 2, VocabularyPeer::DELETED_AT => 3, VocabularyPeer::PROJECT_ID => 4, VocabularyPeer::AGENT_ID => 5, VocabularyPeer::LAST_UPDATED => 6, VocabularyPeer::CREATED_USER_ID => 7, VocabularyPeer::UPDATED_USER_ID => 8, VocabularyPeer::DELETED_USER_ID => 9, VocabularyPeer::CHILD_UPDATED_AT => 10, VocabularyPeer::CHILD_UPDATED_USER_ID => 11, VocabularyPeer::NAME => 12, VocabularyPeer::NOTE => 13, VocabularyPeer::URI => 14, VocabularyPeer::URL => 15, VocabularyPeer::BASE_DOMAIN => 16, VocabularyPeer::TOKEN => 17, VocabularyPeer::COMMUNITY => 18, VocabularyPeer::LAST_URI_ID => 19, VocabularyPeer::STATUS_ID => 20, VocabularyPeer::LANGUAGE => 21, VocabularyPeer::LANGUAGES => 22, VocabularyPeer::PROFILE_ID => 23, VocabularyPeer::NS_TYPE => 24, VocabularyPeer::PREFIXES => 25, VocabularyPeer::REPO => 26, VocabularyPeer::PREFIX => 27, VocabularyPeer::CREATED_BY => 28, VocabularyPeer::UPDATED_BY => 29, VocabularyPeer::DELETED_BY => 30, VocabularyPeer::CHILD_UPDATED_BY => 31, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3, 'project_id' => 4, 'agent_id' => 5, 'last_updated' => 6, 'created_user_id' => 7, 'updated_user_id' => 8, 'deleted_user_id' => 9, 'child_updated_at' => 10, 'child_updated_user_id' => 11, 'name' => 12, 'note' => 13, 'uri' => 14, 'url' => 15, 'base_domain' => 16, 'token' => 17, 'community' => 18, 'last_uri_id' => 19, 'status_id' => 20, 'language' => 21, 'languages' => 22, 'profile_id' => 23, 'ns_type' => 24, 'prefixes' => 25, 'repo' => 26, 'prefix' => 27, 'created_by' => 28, 'updated_by' => 29, 'deleted_by' => 30, 'child_updated_by' => 31, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VocabularyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VocabularyMapBuilder');
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
			$map = VocabularyPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. VocabularyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VocabularyPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::ID) : VocabularyPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CREATED_AT) : VocabularyPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::UPDATED_AT) : VocabularyPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::DELETED_AT) : VocabularyPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::PROJECT_ID) : VocabularyPeer::PROJECT_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::AGENT_ID) : VocabularyPeer::AGENT_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::LAST_UPDATED) : VocabularyPeer::LAST_UPDATED);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CREATED_USER_ID) : VocabularyPeer::CREATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::UPDATED_USER_ID) : VocabularyPeer::UPDATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::DELETED_USER_ID) : VocabularyPeer::DELETED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CHILD_UPDATED_AT) : VocabularyPeer::CHILD_UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CHILD_UPDATED_USER_ID) : VocabularyPeer::CHILD_UPDATED_USER_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::NAME) : VocabularyPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::NOTE) : VocabularyPeer::NOTE);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::URI) : VocabularyPeer::URI);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::URL) : VocabularyPeer::URL);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::BASE_DOMAIN) : VocabularyPeer::BASE_DOMAIN);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::TOKEN) : VocabularyPeer::TOKEN);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::COMMUNITY) : VocabularyPeer::COMMUNITY);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::LAST_URI_ID) : VocabularyPeer::LAST_URI_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::STATUS_ID) : VocabularyPeer::STATUS_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::LANGUAGE) : VocabularyPeer::LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::LANGUAGES) : VocabularyPeer::LANGUAGES);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::PROFILE_ID) : VocabularyPeer::PROFILE_ID);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::NS_TYPE) : VocabularyPeer::NS_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::PREFIXES) : VocabularyPeer::PREFIXES);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::REPO) : VocabularyPeer::REPO);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::PREFIX) : VocabularyPeer::PREFIX);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CREATED_BY) : VocabularyPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::UPDATED_BY) : VocabularyPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::DELETED_BY) : VocabularyPeer::DELETED_BY);

        $criteria->addSelectColumn(($tableAlias) ? VocabularyPeer::alias($tableAlias, VocabularyPeer::CHILD_UPDATED_BY) : VocabularyPeer::CHILD_UPDATED_BY);

	}

	const COUNT = 'COUNT(reg_vocabulary.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_vocabulary.ID)';

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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
	 * @return     Vocabulary
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VocabularyPeer::doSelect($critcopy, $con);
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
		return VocabularyPeer::populateObjects(VocabularyPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseVocabularyPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VocabularyPeer::addSelectColumns($criteria);
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
		$cls = VocabularyPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related ProjectsRelatedByProjectId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProjectsRelatedByProjectId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProjectsRelatedByAgentId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProjectsRelatedByAgentId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByDeletedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByChildUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByChildUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Profile table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinProfile(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByChildUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinUsersRelatedByChildUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Projects objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProjectsRelatedByProjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectsPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabularyRelatedByProjectId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Projects objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProjectsRelatedByAgentId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProjectsPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabularyRelatedByAgentId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByAgentId();
				$obj2->addVocabularyRelatedByAgentId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByCreatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByCreatedUserId();
				$obj2->addVocabularyRelatedByCreatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByUpdatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByUpdatedUserId();
				$obj2->addVocabularyRelatedByUpdatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByDeletedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabularyRelatedByDeletedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByDeletedUserId();
				$obj2->addVocabularyRelatedByDeletedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByChildUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabularyRelatedByChildUpdatedUserId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByChildUpdatedUserId();
				$obj2->addVocabularyRelatedByChildUpdatedUserId($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Status objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		StatusPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabulary($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Profile objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProfilePeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabulary($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularys();
				$obj2->addVocabulary($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByCreatedBy();
				$obj2->addVocabularyRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByUpdatedBy();
				$obj2->addVocabularyRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByDeletedBy();
				$obj2->addVocabularyRelatedByDeletedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with their Users objects.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsersRelatedByChildUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsersPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVocabularyRelatedByChildUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVocabularysRelatedByChildUpdatedBy();
				$obj2->addVocabularyRelatedByChildUpdatedBy($obj1); //CHECKME
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::alias('a1', ProjectsPeer::ID));
        $c->addAlias('a1', ProjectsPeer::TABLE_NAME);

		ProjectsPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::alias('a2', ProjectsPeer::ID));
        $c->addAlias('a2', ProjectsPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::alias('a3', UsersPeer::ID));
        $c->addAlias('a3', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a4');
		$startcol6 = $startcol5 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::alias('a4', UsersPeer::ID));
        $c->addAlias('a4', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a5');
		$startcol7 = $startcol6 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::alias('a5', UsersPeer::ID));
        $c->addAlias('a5', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a6');
		$startcol8 = $startcol7 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::alias('a6', UsersPeer::ID));
        $c->addAlias('a6', UsersPeer::TABLE_NAME);

		StatusPeer::addSelectColumns($c, 'a7');
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::alias('a7', StatusPeer::ID));
        $c->addAlias('a7', StatusPeer::TABLE_NAME);

		ProfilePeer::addSelectColumns($c, 'a8');
		$startcol10 = $startcol9 + ProfilePeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::alias('a8', ProfilePeer::ID));
        $c->addAlias('a8', ProfilePeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a9');
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::alias('a9', UsersPeer::ID));
        $c->addAlias('a9', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a10');
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::alias('a10', UsersPeer::ID));
        $c->addAlias('a10', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a11');
		$startcol13 = $startcol12 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::alias('a11', UsersPeer::ID));
        $c->addAlias('a11', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a12');
		$startcol14 = $startcol13 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::alias('a12', UsersPeer::ID));
        $c->addAlias('a12', UsersPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Projects rows
	
			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}


				// Add objects for joined Projects rows
	
			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByCreatedUserId(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabularyRelatedByCreatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularysRelatedByCreatedUserId();
				$obj4->addVocabularyRelatedByCreatedUserId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUsersRelatedByUpdatedUserId(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabularyRelatedByUpdatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularysRelatedByUpdatedUserId();
				$obj5->addVocabularyRelatedByUpdatedUserId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUsersRelatedByDeletedUserId(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addVocabularyRelatedByDeletedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initVocabularysRelatedByDeletedUserId();
				$obj6->addVocabularyRelatedByDeletedUserId($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addVocabularyRelatedByChildUpdatedUserId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initVocabularysRelatedByChildUpdatedUserId();
				$obj7->addVocabularyRelatedByChildUpdatedUserId($obj1);
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
					$temp_obj8->addVocabulary($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj8->initVocabularys();
				$obj8->addVocabulary($obj1);
			}


				// Add objects for joined Profile rows
	
			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getProfile(); // CHECKME
				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addVocabulary($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj9->initVocabularys();
				$obj9->addVocabulary($obj1);
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
					$temp_obj10->addVocabularyRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj10->initVocabularysRelatedByCreatedBy();
				$obj10->addVocabularyRelatedByCreatedBy($obj1);
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
					$temp_obj11->addVocabularyRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj11->initVocabularysRelatedByUpdatedBy();
				$obj11->addVocabularyRelatedByUpdatedBy($obj1);
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
					$temp_obj12->addVocabularyRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj12->initVocabularysRelatedByDeletedBy();
				$obj12->addVocabularyRelatedByDeletedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj13 = new $cls();
			$obj13->hydrate($rs, $startcol13);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj13 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); // CHECKME
				if ($temp_obj13->getPrimaryKey() === $obj13->getPrimaryKey()) {
					$newObject = false;
					$temp_obj13->addVocabularyRelatedByChildUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj13->initVocabularysRelatedByChildUpdatedBy();
				$obj13->addVocabularyRelatedByChildUpdatedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProjectsRelatedByProjectId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProjectsRelatedByProjectId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ProjectsRelatedByAgentId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProjectsRelatedByAgentId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByDeletedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByDeletedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByChildUpdatedUserId table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByChildUpdatedUserId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Profile table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptProfile(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$criteria->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related UsersRelatedByChildUpdatedBy table
	 *
	 * @param Criteria $c
	 * @param boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param Connection $con
	 * @return int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsersRelatedByChildUpdatedBy(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VocabularyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VocabularyPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$criteria->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$criteria->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$rs = VocabularyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except ProjectsRelatedByProjectId.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProjectsRelatedByProjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UsersPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByCreatedUserId();
				$obj2->addVocabularyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addVocabularyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByUpdatedUserId();
				$obj3->addVocabularyRelatedByUpdatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabularyRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularysRelatedByDeletedUserId();
				$obj4->addVocabularyRelatedByDeletedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabularyRelatedByChildUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularysRelatedByChildUpdatedUserId();
				$obj5->addVocabularyRelatedByChildUpdatedUserId($obj1);
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
					$temp_obj6->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initVocabularys();
				$obj6->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initVocabularys();
				$obj7->addVocabulary($obj1);
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
					$temp_obj8->addVocabularyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initVocabularysRelatedByCreatedBy();
				$obj8->addVocabularyRelatedByCreatedBy($obj1);
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
					$temp_obj9->addVocabularyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initVocabularysRelatedByUpdatedBy();
				$obj9->addVocabularyRelatedByUpdatedBy($obj1);
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
					$temp_obj10->addVocabularyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initVocabularysRelatedByDeletedBy();
				$obj10->addVocabularyRelatedByDeletedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addVocabularyRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initVocabularysRelatedByChildUpdatedBy();
				$obj11->addVocabularyRelatedByChildUpdatedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except ProjectsRelatedByAgentId.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProjectsRelatedByAgentId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UsersPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ProfilePeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

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
					$temp_obj2->addVocabularyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByCreatedUserId();
				$obj2->addVocabularyRelatedByCreatedUserId($obj1);
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
					$temp_obj3->addVocabularyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByUpdatedUserId();
				$obj3->addVocabularyRelatedByUpdatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabularyRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularysRelatedByDeletedUserId();
				$obj4->addVocabularyRelatedByDeletedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabularyRelatedByChildUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularysRelatedByChildUpdatedUserId();
				$obj5->addVocabularyRelatedByChildUpdatedUserId($obj1);
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
					$temp_obj6->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initVocabularys();
				$obj6->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initVocabularys();
				$obj7->addVocabulary($obj1);
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
					$temp_obj8->addVocabularyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initVocabularysRelatedByCreatedBy();
				$obj8->addVocabularyRelatedByCreatedBy($obj1);
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
					$temp_obj9->addVocabularyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initVocabularysRelatedByUpdatedBy();
				$obj9->addVocabularyRelatedByUpdatedBy($obj1);
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
					$temp_obj10->addVocabularyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initVocabularysRelatedByDeletedBy();
				$obj10->addVocabularyRelatedByDeletedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj11  = new $cls();
			$obj11->hydrate($rs, $startcol11);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj11 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj11->getPrimaryKey() === $obj11->getPrimaryKey()) {
					$newObject = false;
					$temp_obj11->addVocabularyRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initVocabularysRelatedByChildUpdatedBy();
				$obj11->addVocabularyRelatedByChildUpdatedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByCreatedUserId.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByUpdatedUserId.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByDeletedUserId.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByDeletedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByChildUpdatedUserId.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByChildUpdatedUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except Status.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UsersPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ProfilePeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol13 = $startcol12 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabularyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularysRelatedByCreatedUserId();
				$obj4->addVocabularyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabularyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularysRelatedByUpdatedUserId();
				$obj5->addVocabularyRelatedByUpdatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addVocabularyRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initVocabularysRelatedByDeletedUserId();
				$obj6->addVocabularyRelatedByDeletedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addVocabularyRelatedByChildUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initVocabularysRelatedByChildUpdatedUserId();
				$obj7->addVocabularyRelatedByChildUpdatedUserId($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initVocabularys();
				$obj8->addVocabulary($obj1);
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
					$temp_obj9->addVocabularyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initVocabularysRelatedByCreatedBy();
				$obj9->addVocabularyRelatedByCreatedBy($obj1);
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
					$temp_obj10->addVocabularyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initVocabularysRelatedByUpdatedBy();
				$obj10->addVocabularyRelatedByUpdatedBy($obj1);
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
					$temp_obj11->addVocabularyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initVocabularysRelatedByDeletedBy();
				$obj11->addVocabularyRelatedByDeletedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj12  = new $cls();
			$obj12->hydrate($rs, $startcol12);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj12 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj12->getPrimaryKey() === $obj12->getPrimaryKey()) {
					$newObject = false;
					$temp_obj12->addVocabularyRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj12->initVocabularysRelatedByChildUpdatedBy();
				$obj12->addVocabularyRelatedByChildUpdatedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except Profile.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UsersPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + StatusPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol11 = $startcol10 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol12 = $startcol11 + UsersPeer::NUM_COLUMNS;

		UsersPeer::addSelectColumns($c);
		$startcol13 = $startcol12 + UsersPeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_USER_ID, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::CREATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::UPDATED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::DELETED_BY, UsersPeer::ID);

		$c->addJoin(VocabularyPeer::CHILD_UPDATED_BY, UsersPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByCreatedUserId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabularyRelatedByCreatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularysRelatedByCreatedUserId();
				$obj4->addVocabularyRelatedByCreatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getUsersRelatedByUpdatedUserId(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabularyRelatedByUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularysRelatedByUpdatedUserId();
				$obj5->addVocabularyRelatedByUpdatedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUsersRelatedByDeletedUserId(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addVocabularyRelatedByDeletedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initVocabularysRelatedByDeletedUserId();
				$obj6->addVocabularyRelatedByDeletedUserId($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUsersRelatedByChildUpdatedUserId(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addVocabularyRelatedByChildUpdatedUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initVocabularysRelatedByChildUpdatedUserId();
				$obj7->addVocabularyRelatedByChildUpdatedUserId($obj1);
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
					$temp_obj8->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initVocabularys();
				$obj8->addVocabulary($obj1);
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
					$temp_obj9->addVocabularyRelatedByCreatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj9->initVocabularysRelatedByCreatedBy();
				$obj9->addVocabularyRelatedByCreatedBy($obj1);
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
					$temp_obj10->addVocabularyRelatedByUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj10->initVocabularysRelatedByUpdatedBy();
				$obj10->addVocabularyRelatedByUpdatedBy($obj1);
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
					$temp_obj11->addVocabularyRelatedByDeletedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj11->initVocabularysRelatedByDeletedBy();
				$obj11->addVocabularyRelatedByDeletedBy($obj1);
			}

			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj12  = new $cls();
			$obj12->hydrate($rs, $startcol12);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj12 = $temp_obj1->getUsersRelatedByChildUpdatedBy(); //CHECKME
				if ($temp_obj12->getPrimaryKey() === $obj12->getPrimaryKey()) {
					$newObject = false;
					$temp_obj12->addVocabularyRelatedByChildUpdatedBy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj12->initVocabularysRelatedByChildUpdatedBy();
				$obj12->addVocabularyRelatedByChildUpdatedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByCreatedBy.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByUpdatedBy.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByDeletedBy.
	 *
	 * @return array Array of Vocabulary objects.
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

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Vocabulary objects pre-filled with all related objects except UsersRelatedByChildUpdatedBy.
	 *
	 * @return array Array of Vocabulary objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsersRelatedByChildUpdatedBy(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VocabularyPeer::addSelectColumns($c);
		$startcol2 = (VocabularyPeer::NUM_COLUMNS - VocabularyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProjectsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProjectsPeer::NUM_COLUMNS;

		ProjectsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProjectsPeer::NUM_COLUMNS;

		StatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + StatusPeer::NUM_COLUMNS;

		ProfilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ProfilePeer::NUM_COLUMNS;

		$c->addJoin(VocabularyPeer::PROJECT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::AGENT_ID, ProjectsPeer::ID);

		$c->addJoin(VocabularyPeer::STATUS_ID, StatusPeer::ID);

		$c->addJoin(VocabularyPeer::PROFILE_ID, ProfilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VocabularyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProjectsRelatedByProjectId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVocabularyRelatedByProjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initVocabularysRelatedByProjectId();
				$obj2->addVocabularyRelatedByProjectId($obj1);
			}

			$omClass = ProjectsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProjectsRelatedByAgentId(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addVocabularyRelatedByAgentId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initVocabularysRelatedByAgentId();
				$obj3->addVocabularyRelatedByAgentId($obj1);
			}

			$omClass = StatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getStatus(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initVocabularys();
				$obj4->addVocabulary($obj1);
			}

			$omClass = ProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getProfile(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addVocabulary($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initVocabularys();
				$obj5->addVocabulary($obj1);
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
		return VocabularyPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Vocabulary or Criteria object.
	 *
	 * @param      mixed $values Criteria or Vocabulary object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Vocabulary object
		}

		$criteria->remove(VocabularyPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseVocabularyPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Vocabulary or Criteria object.
	 *
	 * @param      mixed $values Criteria or Vocabulary object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVocabularyPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVocabularyPeer', $values, $con);
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

			$comparison = $criteria->getComparison(VocabularyPeer::ID);
			$selectCriteria->add(VocabularyPeer::ID, $criteria->remove(VocabularyPeer::ID), $comparison);

		} else { // $values is Vocabulary object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseVocabularyPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseVocabularyPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_vocabulary table.
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
			$affectedRows += BasePeer::doDeleteAll(VocabularyPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Vocabulary or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Vocabulary object or primary key or array of primary keys
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
			$con = Propel::getConnection(VocabularyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Vocabulary) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VocabularyPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Vocabulary object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Vocabulary $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Vocabulary $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VocabularyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VocabularyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(VocabularyPeer::DATABASE_NAME, VocabularyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = VocabularyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Vocabulary
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);

		$criteria->add(VocabularyPeer::ID, $pk);


		$v = VocabularyPeer::doSelect($criteria, $con);

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
			$criteria->add(VocabularyPeer::ID, $pks, Criteria::IN);
			$objs = VocabularyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseVocabularyPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseVocabularyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/VocabularyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VocabularyMapBuilder');
}
