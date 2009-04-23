<?php


/**
 * This class adds structure of 'reg_vocabulary_has_user' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu Apr 23 17:03:56 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class VocabularyHasUserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.VocabularyHasUserMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(VocabularyHasUserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(VocabularyHasUserPeer::TABLE_NAME);
		$tMap->setPhpName('VocabularyHasUser');
		$tMap->setClassname('VocabularyHasUser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('VOCABULARY_ID', 'VocabularyId', 'INTEGER', 'reg_vocabulary', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'reg_user', 'ID', true, null);

		$tMap->addColumn('IS_MAINTAINER_FOR', 'IsMaintainerFor', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_REGISTRAR_FOR', 'IsRegistrarFor', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_ADMIN_FOR', 'IsAdminFor', 'BOOLEAN', false, null);

	} // doBuild()

} // VocabularyHasUserMapBuilder
