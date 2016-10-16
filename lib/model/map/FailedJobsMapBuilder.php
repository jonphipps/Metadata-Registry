<?php


/**
 * This class adds structure of 'failed_jobs' table to 'propel' DatabaseMap object.
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
class FailedJobsMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FailedJobsMapBuilder';

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

		$tMap = $this->dbMap->addTable('failed_jobs');
		$tMap->setPhpName('FailedJobs');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CONNECTION', 'Connection', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('QUEUE', 'Queue', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('PAYLOAD', 'Payload', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('EXCEPTION', 'Exception', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('FAILED_AT', 'FailedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} // doBuild()

} // FailedJobsMapBuilder
