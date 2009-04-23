<?php


/**
 * This class adds structure of 'arc_triple' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Apr 22 19:56:25 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ArcTripleMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(ArcTriplePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ArcTriplePeer::TABLE_NAME);
		$tMap->setPhpName('ArcTriple');
		$tMap->setClassname('ArcTriple');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('T', 'T', 'SMALLINT', true, null);

		$tMap->addForeignKey('S', 'S', 'SMALLINT', 'arc_s2val', 'ID', true, null);

		$tMap->addForeignKey('P', 'P', 'SMALLINT', 'arc_id2val', 'ID', true, null);

		$tMap->addForeignKey('O', 'O', 'SMALLINT', 'arc_o2val', 'ID', true, null);

		$tMap->addForeignKey('O_LANG_DT', 'OLangDt', 'SMALLINT', 'arc_id2val', 'ID', true, null);

		$tMap->addColumn('O_COMP', 'OComp', 'CHAR', true, 35);

		$tMap->addColumn('S_TYPE', 'SType', 'BOOLEAN', true, null);

		$tMap->addColumn('O_TYPE', 'OType', 'BOOLEAN', true, null);

		$tMap->addColumn('MISC', 'Misc', 'BOOLEAN', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

	} // doBuild()

} // ArcTripleMapBuilder
