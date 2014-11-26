<?php


/**
 * This class adds structure of 'reg_user' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UserMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('reg_user');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('SALUTATION', 'Salutation', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('WANT_TO_BE_MODERATOR', 'WantToBeModerator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_MODERATOR', 'IsModerator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADMINISTRATOR', 'IsAdministrator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETIONS', 'Deletions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, 40);

	} // doBuild()

} // UserMapBuilder
