<?php

/**
 * Base static class for performing query and update operations on the 'reg_agent' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAgentPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'reg_agent';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Agent';

	/** The total number of columns. */
	const NUM_COLUMNS = 39;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'reg_agent.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'reg_agent.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'reg_agent.UPDATED_AT';

	/** the column name for the LAST_UPDATED field */
	const LAST_UPDATED = 'reg_agent.LAST_UPDATED';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'reg_agent.DELETED_AT';

	/** the column name for the ORG_EMAIL field */
	const ORG_EMAIL = 'reg_agent.ORG_EMAIL';

	/** the column name for the ORG_NAME field */
	const ORG_NAME = 'reg_agent.ORG_NAME';

	/** the column name for the IND_AFFILIATION field */
	const IND_AFFILIATION = 'reg_agent.IND_AFFILIATION';

	/** the column name for the IND_ROLE field */
	const IND_ROLE = 'reg_agent.IND_ROLE';

	/** the column name for the ADDRESS1 field */
	const ADDRESS1 = 'reg_agent.ADDRESS1';

	/** the column name for the ADDRESS2 field */
	const ADDRESS2 = 'reg_agent.ADDRESS2';

	/** the column name for the CITY field */
	const CITY = 'reg_agent.CITY';

	/** the column name for the STATE field */
	const STATE = 'reg_agent.STATE';

	/** the column name for the POSTAL_CODE field */
	const POSTAL_CODE = 'reg_agent.POSTAL_CODE';

	/** the column name for the COUNTRY field */
	const COUNTRY = 'reg_agent.COUNTRY';

	/** the column name for the PHONE field */
	const PHONE = 'reg_agent.PHONE';

	/** the column name for the WEB_ADDRESS field */
	const WEB_ADDRESS = 'reg_agent.WEB_ADDRESS';

	/** the column name for the TYPE field */
	const TYPE = 'reg_agent.TYPE';

	/** the column name for the REPO field */
	const REPO = 'reg_agent.REPO';

	/** the column name for the IS_PRIVATE field */
	const IS_PRIVATE = 'reg_agent.IS_PRIVATE';

	/** the column name for the LICENSE field */
	const LICENSE = 'reg_agent.LICENSE';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'reg_agent.DESCRIPTION';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'reg_agent.CREATED_BY';

	/** the column name for the UPDATED_BY field */
	const UPDATED_BY = 'reg_agent.UPDATED_BY';

	/** the column name for the DELETED_BY field */
	const DELETED_BY = 'reg_agent.DELETED_BY';

	/** the column name for the NAME field */
	const NAME = 'reg_agent.NAME';

	/** the column name for the LABEL field */
	const LABEL = 'reg_agent.LABEL';

	/** the column name for the URL field */
	const URL = 'reg_agent.URL';

	/** the column name for the LICENSE_URI field */
	const LICENSE_URI = 'reg_agent.LICENSE_URI';

	/** the column name for the BASE_DOMAIN field */
	const BASE_DOMAIN = 'reg_agent.BASE_DOMAIN';

	/** the column name for the NAMESPACE_TYPE field */
	const NAMESPACE_TYPE = 'reg_agent.NAMESPACE_TYPE';

	/** the column name for the URI_STRATEGY field */
	const URI_STRATEGY = 'reg_agent.URI_STRATEGY';

	/** the column name for the URI_PREPEND field */
	const URI_PREPEND = 'reg_agent.URI_PREPEND';

	/** the column name for the URI_APPEND field */
	const URI_APPEND = 'reg_agent.URI_APPEND';

	/** the column name for the STARTING_NUMBER field */
	const STARTING_NUMBER = 'reg_agent.STARTING_NUMBER';

	/** the column name for the DEFAULT_LANGUAGE field */
	const DEFAULT_LANGUAGE = 'reg_agent.DEFAULT_LANGUAGE';

	/** the column name for the LANGUAGES field */
	const LANGUAGES = 'reg_agent.LANGUAGES';

	/** the column name for the PREFIXES field */
	const PREFIXES = 'reg_agent.PREFIXES';

	/** the column name for the GOOGLE_SHEET_URL field */
	const GOOGLE_SHEET_URL = 'reg_agent.GOOGLE_SHEET_URL';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'CreatedAt', 'UpdatedAt', 'LastUpdated', 'DeletedAt', 'OrgEmail', 'OrgName', 'IndAffiliation', 'IndRole', 'Address1', 'Address2', 'City', 'State', 'PostalCode', 'Country', 'Phone', 'WebAddress', 'Type', 'Repo', 'IsPrivate', 'License', 'Description', 'CreatedBy', 'UpdatedBy', 'DeletedBy', 'Name', 'Label', 'Url', 'LicenseUri', 'BaseDomain', 'NamespaceType', 'UriStrategy', 'UriPrepend', 'UriAppend', 'StartingNumber', 'DefaultLanguage', 'Languages', 'Prefixes', 'GoogleSheetUrl', ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID, AgentPeer::CREATED_AT, AgentPeer::UPDATED_AT, AgentPeer::LAST_UPDATED, AgentPeer::DELETED_AT, AgentPeer::ORG_EMAIL, AgentPeer::ORG_NAME, AgentPeer::IND_AFFILIATION, AgentPeer::IND_ROLE, AgentPeer::ADDRESS1, AgentPeer::ADDRESS2, AgentPeer::CITY, AgentPeer::STATE, AgentPeer::POSTAL_CODE, AgentPeer::COUNTRY, AgentPeer::PHONE, AgentPeer::WEB_ADDRESS, AgentPeer::TYPE, AgentPeer::REPO, AgentPeer::IS_PRIVATE, AgentPeer::LICENSE, AgentPeer::DESCRIPTION, AgentPeer::CREATED_BY, AgentPeer::UPDATED_BY, AgentPeer::DELETED_BY, AgentPeer::NAME, AgentPeer::LABEL, AgentPeer::URL, AgentPeer::LICENSE_URI, AgentPeer::BASE_DOMAIN, AgentPeer::NAMESPACE_TYPE, AgentPeer::URI_STRATEGY, AgentPeer::URI_PREPEND, AgentPeer::URI_APPEND, AgentPeer::STARTING_NUMBER, AgentPeer::DEFAULT_LANGUAGE, AgentPeer::LANGUAGES, AgentPeer::PREFIXES, AgentPeer::GOOGLE_SHEET_URL, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'created_at', 'updated_at', 'last_updated', 'deleted_at', 'org_email', 'org_name', 'ind_affiliation', 'ind_role', 'address1', 'address2', 'city', 'state', 'postal_code', 'country', 'phone', 'web_address', 'type', 'repo', 'is_private', 'license', 'description', 'created_by', 'updated_by', 'deleted_by', 'name', 'label', 'url', 'license_uri', 'base_domain', 'namespace_type', 'uri_strategy', 'uri_prepend', 'uri_append', 'starting_number', 'default_language', 'languages', 'prefixes', 'google_sheet_url', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'LastUpdated' => 3, 'DeletedAt' => 4, 'OrgEmail' => 5, 'OrgName' => 6, 'IndAffiliation' => 7, 'IndRole' => 8, 'Address1' => 9, 'Address2' => 10, 'City' => 11, 'State' => 12, 'PostalCode' => 13, 'Country' => 14, 'Phone' => 15, 'WebAddress' => 16, 'Type' => 17, 'Repo' => 18, 'IsPrivate' => 19, 'License' => 20, 'Description' => 21, 'CreatedBy' => 22, 'UpdatedBy' => 23, 'DeletedBy' => 24, 'Name' => 25, 'Label' => 26, 'Url' => 27, 'LicenseUri' => 28, 'BaseDomain' => 29, 'NamespaceType' => 30, 'UriStrategy' => 31, 'UriPrepend' => 32, 'UriAppend' => 33, 'StartingNumber' => 34, 'DefaultLanguage' => 35, 'Languages' => 36, 'Prefixes' => 37, 'GoogleSheetUrl' => 38, ),
		BasePeer::TYPE_COLNAME => array (AgentPeer::ID => 0, AgentPeer::CREATED_AT => 1, AgentPeer::UPDATED_AT => 2, AgentPeer::LAST_UPDATED => 3, AgentPeer::DELETED_AT => 4, AgentPeer::ORG_EMAIL => 5, AgentPeer::ORG_NAME => 6, AgentPeer::IND_AFFILIATION => 7, AgentPeer::IND_ROLE => 8, AgentPeer::ADDRESS1 => 9, AgentPeer::ADDRESS2 => 10, AgentPeer::CITY => 11, AgentPeer::STATE => 12, AgentPeer::POSTAL_CODE => 13, AgentPeer::COUNTRY => 14, AgentPeer::PHONE => 15, AgentPeer::WEB_ADDRESS => 16, AgentPeer::TYPE => 17, AgentPeer::REPO => 18, AgentPeer::IS_PRIVATE => 19, AgentPeer::LICENSE => 20, AgentPeer::DESCRIPTION => 21, AgentPeer::CREATED_BY => 22, AgentPeer::UPDATED_BY => 23, AgentPeer::DELETED_BY => 24, AgentPeer::NAME => 25, AgentPeer::LABEL => 26, AgentPeer::URL => 27, AgentPeer::LICENSE_URI => 28, AgentPeer::BASE_DOMAIN => 29, AgentPeer::NAMESPACE_TYPE => 30, AgentPeer::URI_STRATEGY => 31, AgentPeer::URI_PREPEND => 32, AgentPeer::URI_APPEND => 33, AgentPeer::STARTING_NUMBER => 34, AgentPeer::DEFAULT_LANGUAGE => 35, AgentPeer::LANGUAGES => 36, AgentPeer::PREFIXES => 37, AgentPeer::GOOGLE_SHEET_URL => 38, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'created_at' => 1, 'updated_at' => 2, 'last_updated' => 3, 'deleted_at' => 4, 'org_email' => 5, 'org_name' => 6, 'ind_affiliation' => 7, 'ind_role' => 8, 'address1' => 9, 'address2' => 10, 'city' => 11, 'state' => 12, 'postal_code' => 13, 'country' => 14, 'phone' => 15, 'web_address' => 16, 'type' => 17, 'repo' => 18, 'is_private' => 19, 'license' => 20, 'description' => 21, 'created_by' => 22, 'updated_by' => 23, 'deleted_by' => 24, 'name' => 25, 'label' => 26, 'url' => 27, 'license_uri' => 28, 'base_domain' => 29, 'namespace_type' => 30, 'uri_strategy' => 31, 'uri_prepend' => 32, 'uri_append' => 33, 'starting_number' => 34, 'default_language' => 35, 'languages' => 36, 'prefixes' => 37, 'google_sheet_url' => 38, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AgentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AgentMapBuilder');
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
			$map = AgentPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. AgentPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AgentPeer::TABLE_NAME.'.', $alias.'.', $column);
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

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::ID) : AgentPeer::ID);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::CREATED_AT) : AgentPeer::CREATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::UPDATED_AT) : AgentPeer::UPDATED_AT);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::LAST_UPDATED) : AgentPeer::LAST_UPDATED);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::DELETED_AT) : AgentPeer::DELETED_AT);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::ORG_EMAIL) : AgentPeer::ORG_EMAIL);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::ORG_NAME) : AgentPeer::ORG_NAME);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::IND_AFFILIATION) : AgentPeer::IND_AFFILIATION);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::IND_ROLE) : AgentPeer::IND_ROLE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::ADDRESS1) : AgentPeer::ADDRESS1);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::ADDRESS2) : AgentPeer::ADDRESS2);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::CITY) : AgentPeer::CITY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::STATE) : AgentPeer::STATE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::POSTAL_CODE) : AgentPeer::POSTAL_CODE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::COUNTRY) : AgentPeer::COUNTRY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::PHONE) : AgentPeer::PHONE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::WEB_ADDRESS) : AgentPeer::WEB_ADDRESS);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::TYPE) : AgentPeer::TYPE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::REPO) : AgentPeer::REPO);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::IS_PRIVATE) : AgentPeer::IS_PRIVATE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::LICENSE) : AgentPeer::LICENSE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::DESCRIPTION) : AgentPeer::DESCRIPTION);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::CREATED_BY) : AgentPeer::CREATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::UPDATED_BY) : AgentPeer::UPDATED_BY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::DELETED_BY) : AgentPeer::DELETED_BY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::NAME) : AgentPeer::NAME);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::LABEL) : AgentPeer::LABEL);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::URL) : AgentPeer::URL);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::LICENSE_URI) : AgentPeer::LICENSE_URI);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::BASE_DOMAIN) : AgentPeer::BASE_DOMAIN);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::NAMESPACE_TYPE) : AgentPeer::NAMESPACE_TYPE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::URI_STRATEGY) : AgentPeer::URI_STRATEGY);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::URI_PREPEND) : AgentPeer::URI_PREPEND);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::URI_APPEND) : AgentPeer::URI_APPEND);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::STARTING_NUMBER) : AgentPeer::STARTING_NUMBER);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::DEFAULT_LANGUAGE) : AgentPeer::DEFAULT_LANGUAGE);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::LANGUAGES) : AgentPeer::LANGUAGES);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::PREFIXES) : AgentPeer::PREFIXES);

        $criteria->addSelectColumn(($tableAlias) ? AgentPeer::alias($tableAlias, AgentPeer::GOOGLE_SHEET_URL) : AgentPeer::GOOGLE_SHEET_URL);

	}

	const COUNT = 'COUNT(reg_agent.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT reg_agent.ID)';

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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
	 * @return     Agent
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AgentPeer::doSelect($critcopy, $con);
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
		return AgentPeer::populateObjects(AgentPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseAgentPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AgentPeer::addSelectColumns($criteria);
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
		$cls = AgentPeer::getOMClass();
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AgentPeer::CREATED_BY, UserPeer::ID);

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AgentPeer::UPDATED_BY, UserPeer::ID);

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AgentPeer::DELETED_BY, UserPeer::ID);

		$rs = AgentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Agent objects pre-filled with their User objects.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(AgentPeer::CREATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

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
					$temp_obj2->addAgentRelatedByCreatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initAgentsRelatedByCreatedBy();
				$obj2->addAgentRelatedByCreatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Agent objects pre-filled with their User objects.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(AgentPeer::UPDATED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

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
					$temp_obj2->addAgentRelatedByUpdatedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initAgentsRelatedByUpdatedBy();
				$obj2->addAgentRelatedByUpdatedBy($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Agent objects pre-filled with their User objects.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(AgentPeer::DELETED_BY, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

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
					$temp_obj2->addAgentRelatedByDeletedBy($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initAgentsRelatedByDeletedBy();
				$obj2->addAgentRelatedByDeletedBy($obj1); //CHECKME
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AgentPeer::CREATED_BY, UserPeer::ID);

		$criteria->addJoin(AgentPeer::UPDATED_BY, UserPeer::ID);

		$criteria->addJoin(AgentPeer::DELETED_BY, UserPeer::ID);

		$rs = AgentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Agent objects pre-filled with all related objects.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol2 = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c, 'a1');
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

        $c->addJoin(AgentPeer::CREATED_BY, UserPeer::alias('a1', UserPeer::ID));
        $c->addAlias('a1', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a2');
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

        $c->addJoin(AgentPeer::UPDATED_BY, UserPeer::alias('a2', UserPeer::ID));
        $c->addAlias('a2', UserPeer::TABLE_NAME);

		UserPeer::addSelectColumns($c, 'a3');
		$startcol5 = $startcol4 + UserPeer::NUM_COLUMNS;

        $c->addJoin(AgentPeer::DELETED_BY, UserPeer::alias('a3', UserPeer::ID));
        $c->addAlias('a3', UserPeer::TABLE_NAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserRelatedByCreatedBy(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAgentRelatedByCreatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initAgentsRelatedByCreatedBy();
				$obj2->addAgentRelatedByCreatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserRelatedByUpdatedBy(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAgentRelatedByUpdatedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initAgentsRelatedByUpdatedBy();
				$obj3->addAgentRelatedByUpdatedBy($obj1);
			}


				// Add objects for joined User rows
	
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserRelatedByDeletedBy(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addAgentRelatedByDeletedBy($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initAgentsRelatedByDeletedBy();
				$obj4->addAgentRelatedByDeletedBy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(AgentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AgentPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AgentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Agent objects pre-filled with all related objects except UserRelatedByCreatedBy.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol2 = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Agent objects pre-filled with all related objects except UserRelatedByUpdatedBy.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol2 = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Agent objects pre-filled with all related objects except UserRelatedByDeletedBy.
	 *
	 * @return array Array of Agent objects.
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

		AgentPeer::addSelectColumns($c);
		$startcol2 = (AgentPeer::NUM_COLUMNS - AgentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AgentPeer::getOMClass();

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
		return AgentPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Agent or Criteria object.
	 *
	 * @param      mixed $values Criteria or Agent object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Agent object
		}

		$criteria->remove(AgentPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseAgentPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Agent or Criteria object.
	 *
	 * @param      mixed $values Criteria or Agent object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentPeer', $values, $con);
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

			$comparison = $criteria->getComparison(AgentPeer::ID);
			$selectCriteria->add(AgentPeer::ID, $criteria->remove(AgentPeer::ID), $comparison);

		} else { // $values is Agent object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAgentPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the reg_agent table.
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
			$affectedRows += BasePeer::doDeleteAll(AgentPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Agent or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Agent object or primary key or array of primary keys
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
			$con = Propel::getConnection(AgentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Agent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AgentPeer::ID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Agent object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Agent $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Agent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AgentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AgentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AgentPeer::DATABASE_NAME, AgentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AgentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Agent
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AgentPeer::DATABASE_NAME);

		$criteria->add(AgentPeer::ID, $pk);


		$v = AgentPeer::doSelect($criteria, $con);

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
			$criteria->add(AgentPeer::ID, $pks, Criteria::IN);
			$objs = AgentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseAgentPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseAgentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/AgentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AgentMapBuilder');
}
