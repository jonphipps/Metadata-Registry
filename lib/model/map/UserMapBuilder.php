<?php


/**
 * This class adds structure of 'reg_user' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Apr 22 15:10:12 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserPeer::TABLE_NAME);
		$tMap->setPhpName('User');
		$tMap->setClassname('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'TIMESTAMP', true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('NICKNAME', 'Nickname', 'VARCHAR', false, 50);

		$tMap->addColumn('SALUTATION', 'Salutation', 'VARCHAR', false, 5);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 100);

		$tMap->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', false, 100);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'VARCHAR', false, 40);

		$tMap->addColumn('SALT', 'Salt', 'VARCHAR', false, 32);

		$tMap->addColumn('WANT_TO_BE_MODERATOR', 'WantToBeModerator', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_MODERATOR', 'IsModerator', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_ADMINISTRATOR', 'IsAdministrator', 'BOOLEAN', false, null);

		$tMap->addColumn('DELETIONS', 'Deletions', 'INTEGER', false, null);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 40);

	} // doBuild()

} // UserMapBuilder
