<?php


/**
 * This class adds structure of 'sessions' table to 'propel' DatabaseMap object.
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
class SessionsMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SessionsMapBuilder';

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

		$tMap = $this->dbMap->addTable('sessions');
		$tMap->setPhpName('Sessions');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('USER_AGENT', 'UserAgent', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PAYLOAD', 'Payload', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('LAST_ACTIVITY', 'LastActivity', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // SessionsMapBuilder
