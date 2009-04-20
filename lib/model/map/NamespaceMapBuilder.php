<?php


/**
 * This class adds structure of 'reg_namespace' table to 'propel' DatabaseMap object.
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
class NamespaceMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.NamespaceMapBuilder';

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

		$tMap = $this->dbMap->addTable('reg_namespace');
		$tMap->setPhpName('Namespace');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('SCHEMA_ID', 'SchemaId', 'int', CreoleTypes::INTEGER, 'reg_schema', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_USER_ID', 'CreatedUserId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UPDATED_USER_ID', 'UpdatedUserId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('SCHEMA_LOCATION', 'SchemaLocation', 'string', CreoleTypes::VARCHAR, false, 255);

	} // doBuild()

} // NamespaceMapBuilder
