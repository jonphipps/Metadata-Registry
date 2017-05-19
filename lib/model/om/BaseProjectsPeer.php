<?php

/**
 * Base static class for performing query and update operations on the 'projects' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProjectsPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'projects';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Projects';

	/** The total number of columns. */
	const NUM_COLUMNS = 22;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'projects.ID';

	/** the column name for the NAME field */
	const NAME = 'projects.NAME';

	/** the column name for the LABEL field */
	const LABEL = 'projects.LABEL';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'projects.DESCRIPTION';

	/** the column name for the IS_PRIVATE field */
	const IS_PRIVATE = 'projects.IS_PRIVATE';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'projects.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'projects.UPDATED_AT';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'projects.DELETED_AT';

	/** the column name for the REPO field */
	const REPO = 'projects.REPO';

	/** the column name for the URL field */
	const URL = 'projects.URL';

	/** the column name for the LICENSE field */
	const LICENSE = 'projects.LICENSE';

	/** the column name for the URI_STRATEGY field */
	const URI_STRATEGY = 'projects.URI_STRATEGY';

	/** the column name for the URI_TYPE field */
	const URI_TYPE = 'projects.URI_TYPE';

	/** the column name for the URI_PREPEND field */
	const URI_PREPEND = 'projects.URI_PREPEND';

	/** the column name for the URI_APPEND field */
	const URI_APPEND = 'projects.URI_APPEND';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'projects.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'projects.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'projects.DELETED_BY';

	/** the column name for the STARTING_NUMBER field */
	const STARTING_NUMBER = 'projects.STARTING_NUMBER';

	/** the column name for the LICENSE_URI field */
	const LICENSE_URI = 'projects.LICENSE_URI';

	/** the column name for the DEFAULT_LANGUAGE field */
	const DEFAULT_LANGUAGE = 'projects.DEFAULT_LANGUAGE';

	/** the column name for the GOOGLE_SHEET_URL field */
	const GOOGLE_SHEET_URL = 'projects.GOOGLE_SHEET_URL';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Label', 'Description', 'IsPrivate', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'Repo', 'Url', 'License', 'UriStrategy', 'UriType', 'UriPrepend', 'UriAppend', 'CreatedBy', 'UpdatedBy', 'DeletedBy', 'StartingNumber', 'LicenseUri', 'DefaultLanguage', 'GoogleSheetUrl', ),
		BasePeer::TYPE_COLNAME => array (ProjectsPeer::ID, ProjectsPeer::NAME, ProjectsPeer::LABEL, ProjectsPeer::DESCRIPTION, ProjectsPeer::IS_PRIVATE, ProjectsPeer::CREATED_AT, ProjectsPeer::UPDATED_AT, ProjectsPeer::DELETED_AT, ProjectsPeer::REPO, ProjectsPeer::URL, ProjectsPeer::LICENSE, ProjectsPeer::URI_STRATEGY, ProjectsPeer::URI_TYPE, ProjectsPeer::URI_PREPEND, ProjectsPeer::URI_APPEND, ProjectsPeer::CREATED_BY, ProjectsPeer::UPDATED_BY, ProjectsPeer::DELETED_BY, ProjectsPeer::STARTING_NUMBER, ProjectsPeer::LICENSE_URI, ProjectsPeer::DEFAULT_LANGUAGE, ProjectsPeer::GOOGLE_SHEET_URL, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'label', 'description', 'is_private', 'created_at', 'updated_at', 'deleted_at', 'repo', 'url', 'license', 'uri_strategy', 'uri_type', 'uri_prepend', 'uri_append', 'created_by', 'updated_by', 'deleted_by', 'starting_number', 'license_uri', 'default_language', 'google_sheet_url', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Label' => 2, 'Description' => 3, 'IsPrivate' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'DeletedAt' => 7, 'Repo' => 8, 'Url' => 9, 'License' => 10, 'UriStrategy' => 11, 'UriType' => 12, 'UriPrepend' => 13, 'UriAppend' => 14, 'CreatedBy' => 15, 'UpdatedBy' => 16, 'DeletedBy' => 17, 'StartingNumber' => 18, 'LicenseUri' => 19, 'DefaultLanguage' => 20, 'GoogleSheetUrl' => 21, ),
		BasePeer::TYPE_COLNAME => array (ProjectsPeer::ID => 0, ProjectsPeer::NAME => 1, ProjectsPeer::LABEL => 2, ProjectsPeer::DESCRIPTION => 3, ProjectsPeer::IS_PRIVATE => 4, ProjectsPeer::CREATED_AT => 5, ProjectsPeer::UPDATED_AT => 6, ProjectsPeer::DELETED_AT => 7, ProjectsPeer::REPO => 8, ProjectsPeer::URL => 9, ProjectsPeer::LICENSE => 10, ProjectsPeer::URI_STRATEGY => 11, ProjectsPeer::URI_TYPE => 12, ProjectsPeer::URI_PREPEND => 13, ProjectsPeer::URI_APPEND => 14, ProjectsPeer::CREATED_BY => 15, ProjectsPeer::UPDATED_BY => 16, ProjectsPeer::DELETED_BY => 17, ProjectsPeer::STARTING_NUMBER => 18, ProjectsPeer::LICENSE_URI => 19, ProjectsPeer::DEFAULT_LANGUAGE => 20, ProjectsPeer::GOOGLE_SHEET_URL => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'label' => 2, 'description' => 3, 'is_private' => 4, 'created_at' => 5, 'updated_at' => 6, 'deleted_at' => 7, 'repo' => 8, 'url' => 9, 'license' => 10, 'uri_strategy' => 11, 'uri_type' => 12, 'uri_prepend' => 13, 'uri_append' => 14, 'created_by' => 15, 'updated_by' => 16, 'deleted_by' => 17, 'starting_number' => 18, 'license_uri' => 19, 'default_language' => 20, 'google_sheet_url' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProjectsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProjectsMapBuilder');
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
			$map = ProjectsPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ProjectsPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ProjectsPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::ID) : ProjectsPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::NAME) : ProjectsPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::LABEL) : ProjectsPeer::LABEL);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::DESCRIPTION) : ProjectsPeer::DESCRIPTION);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::IS_PRIVATE) : ProjectsPeer::IS_PRIVATE);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::CREATED_AT) : ProjectsPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::UPDATED_AT) : ProjectsPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::DELETED_AT) : ProjectsPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::REPO) : ProjectsPeer::REPO);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::URL) : ProjectsPeer::URL);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::LICENSE) : ProjectsPeer::LICENSE);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::URI_STRATEGY) : ProjectsPeer::URI_STRATEGY);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::URI_TYPE) : ProjectsPeer::URI_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::URI_PREPEND) : ProjectsPeer::URI_PREPEND);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::URI_APPEND) : ProjectsPeer::URI_APPEND);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::CREATED_BY) : ProjectsPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::UPDATED_BY) : ProjectsPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::DELETED_BY) : ProjectsPeer::DELETED_BY);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::STARTING_NUMBER) : ProjectsPeer::STARTING_NUMBER);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::LICENSE_URI) : ProjectsPeer::LICENSE_URI);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::DEFAULT_LANGUAGE) : ProjectsPeer::DEFAULT_LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? ProjectsPeer::alias($tableAlias, ProjectsPeer::GOOGLE_SHEET_URL) : ProjectsPeer::GOOGLE_SHEET_URL);

	}

	const COUNT = 'COUNT(projects.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT projects.ID)';

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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
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
	 * @return     Projects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ProjectsPeer::doSelect($critcopy, $con);
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
		return ProjectsPeer::populateObjects(ProjectsPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseProjectsPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseProjectsPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProjectsPeer::addSelectColumns($criteria);
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
		$cls = ProjectsPeer::getOMClass();
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectsPeer::CREATED_BY, UsersPeer::ID);

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectsPeer::UPDATED_BY, UsersPeer::ID);

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectsPeer::DELETED_BY, UsersPeer::ID);

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Projects objects pre-filled with their Users objects.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ProjectsPeer::CREATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

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
					$temp_obj2->addProjectsRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectssRelatedByCreatedBy();
				$obj2->addProjectsRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Projects objects pre-filled with their Users objects.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ProjectsPeer::UPDATED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

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
					$temp_obj2->addProjectsRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectssRelatedByUpdatedBy();
				$obj2->addProjectsRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Projects objects pre-filled with their Users objects.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsersPeer::addSelectColumns($c);

		$c->addJoin(ProjectsPeer::DELETED_BY, UsersPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

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
					$temp_obj2->addProjectsRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initProjectssRelatedByDeletedBy();
				$obj2->addProjectsRelatedByDeletedBy($obj1); //CHECKME
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProjectsPeer::CREATED_BY, UsersPeer::ID);

		$criteria->addJoin(ProjectsPeer::UPDATED_BY, UsersPeer::ID);

		$criteria->addJoin(ProjectsPeer::DELETED_BY, UsersPeer::ID);

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Projects objects pre-filled with all related objects.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol2 = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsersPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ProjectsPeer::CREATED_BY, UsersPeer::alias('a1', UsersPeer::ID));
        $c->addAlias('a1', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ProjectsPeer::UPDATED_BY, UsersPeer::alias('a2', UsersPeer::ID));
        $c->addAlias('a2', UsersPeer::TABLE_NAME);

		UsersPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UsersPeer::NUM_COLUMNS;

        $c->addJoin(ProjectsPeer::DELETED_BY, UsersPeer::alias('a3', UsersPeer::ID));
        $c->addAlias('a3', UsersPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUsersRelatedByCreatedBy(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProjectsRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initProjectssRelatedByCreatedBy();
				$obj2->addProjectsRelatedByCreatedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsersRelatedByUpdatedBy(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProjectsRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initProjectssRelatedByUpdatedBy();
				$obj3->addProjectsRelatedByUpdatedBy($obj1);
			}


				// Add objects for joined Users rows
	
			$omClass = UsersPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUsersRelatedByDeletedBy(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProjectsRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initProjectssRelatedByDeletedBy();
				$obj4->addProjectsRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ProjectsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProjectsPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProjectsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Projects objects pre-filled with all related objects except UsersRelatedByCreatedBy.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol2 = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Projects objects pre-filled with all related objects except UsersRelatedByUpdatedBy.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol2 = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Projects objects pre-filled with all related objects except UsersRelatedByDeletedBy.
	 *
	 * @return array Array of Projects objects.
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

		ProjectsPeer::addSelectColumns($c);
		$startcol2 = (ProjectsPeer::NUM_COLUMNS - ProjectsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProjectsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return ProjectsPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Projects or Criteria object.
	 *
	 * @param      mixed $values Criteria or Projects object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProjectsPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProjectsPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Projects object
		}

		$criteria->remove(ProjectsPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseProjectsPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseProjectsPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Projects or Criteria object.
	 *
	 * @param      mixed $values Criteria or Projects object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseProjectsPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseProjectsPeer', $values, $con);
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

			$comparison = $criteria->getComparison(ProjectsPeer::ID);
			$selectCriteria->add(ProjectsPeer::ID, $criteria->remove(ProjectsPeer::ID), $comparison);

		} else { // $values is Projects object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseProjectsPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseProjectsPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the projects table.
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
			$affectedRows += BasePeer::doDeleteAll(ProjectsPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Projects or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Projects object or primary key or array of primary keys
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
			$con = Propel::getConnection(ProjectsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Projects) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProjectsPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Projects object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Projects $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Projects $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProjectsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProjectsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProjectsPeer::DATABASE_NAME, ProjectsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProjectsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Projects
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ProjectsPeer::DATABASE_NAME);

		$criteria->add(ProjectsPeer::ID, $pk);


		$v = ProjectsPeer::doSelect($criteria, $con);

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
			$criteria->add(ProjectsPeer::ID, $pks, Criteria::IN);
			$objs = ProjectsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseProjectsPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseProjectsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/ProjectsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProjectsMapBuilder');
}
