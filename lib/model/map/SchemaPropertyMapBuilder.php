<?php


/**
 * This class adds structure of 'reg_schema_property' table to 'propel' DatabaseMap object.
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
class SchemaPropertyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SchemaPropertyMapBuilder';

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

		$tMap = $this->dbMap->addTable('reg_schema_property');
		$tMap->setPhpName('SchemaProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_USER_ID', 'CreatedUserId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UPDATED_USER_ID', 'UpdatedUserId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCHEMA_ID', 'SchemaId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DEFINITION', 'Definition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('IS_SUBPROPERTY_ID', 'IsSubpropertyId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_SUBPROPERTY', 'IsSubproperty', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('HAS_SUBPROPERTY_ID', 'HasSubpropertyId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HAS_SUBPROPERTY', 'HasSubproperty', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, false, 255);

	} // doBuild()

} // SchemaPropertyMapBuilder
