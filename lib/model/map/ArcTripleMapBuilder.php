<?php


/**
 * This class adds structure of 'arc_triple' table to 'propel' DatabaseMap object.
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
class ArcTripleMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ArcTripleMapBuilder';

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

		$tMap = $this->dbMap->addTable('arc_triple');
		$tMap->setPhpName('ArcTriple');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('T', 'T', 'int', CreoleTypes::SMALLINT, true, null);

		$tMap->addForeignKey('S', 'S', 'int', CreoleTypes::SMALLINT, 'arc_s2val', 'ID', true, null);

		$tMap->addForeignKey('P', 'P', 'int', CreoleTypes::SMALLINT, 'arc_id2val', 'ID', true, null);

		$tMap->addForeignKey('O', 'O', 'int', CreoleTypes::SMALLINT, 'arc_o2val', 'ID', true, null);

		$tMap->addForeignKey('O_LANG_DT', 'OLangDt', 'int', CreoleTypes::SMALLINT, 'arc_id2val', 'ID', true, null);

		$tMap->addColumn('O_COMP', 'OComp', 'string', CreoleTypes::CHAR, true, 35);

		$tMap->addColumn('S_TYPE', 'SType', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('O_TYPE', 'OType', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('MISC', 'Misc', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // ArcTripleMapBuilder
