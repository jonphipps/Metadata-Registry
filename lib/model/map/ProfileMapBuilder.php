<?php


/**
 * This class adds structure of 'profile' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Apr 22 15:10:09 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ProfileMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProfileMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(ProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ProfilePeer::TABLE_NAME);
		$tMap->setPhpName('Profile');
		$tMap->setClassname('Profile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('AGENT_ID', 'AgentId', 'INTEGER', 'reg_agent', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'reg_user', 'ID', false, null);

		$tMap->addForeignKey('UPDATED_BY', 'UpdatedBy', 'INTEGER', 'reg_user', 'ID', false, null);

		$tMap->addForeignKey('DELETED_BY', 'DeletedBy', 'INTEGER', 'reg_user', 'ID', false, null);

		$tMap->addColumn('CHILD_UPDATED_AT', 'ChildUpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('CHILD_UPDATED_BY', 'ChildUpdatedBy', 'INTEGER', 'reg_user', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('NOTE', 'Note', 'LONGVARCHAR', false, null);

		$tMap->addColumn('URI', 'Uri', 'VARCHAR', true, 255);

		$tMap->addColumn('URL', 'Url', 'VARCHAR', false, 255);

		$tMap->addColumn('BASE_DOMAIN', 'BaseDomain', 'VARCHAR', true, 255);

		$tMap->addColumn('TOKEN', 'Token', 'VARCHAR', true, 45);

		$tMap->addColumn('COMMUNITY', 'Community', 'VARCHAR', false, 45);

		$tMap->addColumn('LAST_URI_ID', 'LastUriId', 'INTEGER', false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'INTEGER', 'reg_status', 'ID', true, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'CHAR', true, 6);

	} // doBuild()

} // ProfileMapBuilder
