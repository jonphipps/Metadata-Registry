<?php


/**
 * This class adds structure of 'reg_vocabulary_has_user' table to 'propel' DatabaseMap object.
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
class VocabularyHasUserMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('reg_vocabulary_has_user');
		$tMap->setPhpName('VocabularyHasUser');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('VOCABULARY_ID', 'VocabularyId', 'int', CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'users', 'ID', true, null);

		$tMap->addColumn('IS_MAINTAINER_FOR', 'IsMaintainerFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_REGISTRAR_FOR', 'IsRegistrarFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADMIN_FOR', 'IsAdminFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LANGUAGES', 'Languages', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DEFAULT_LANGUAGE', 'DefaultLanguage', 'string', CreoleTypes::CHAR, false, 6);

		$tMap->addColumn('CURRENT_LANGUAGE', 'CurrentLanguage', 'string', CreoleTypes::CHAR, false, 6);

	} // doBuild()

} // VocabularyHasUserMapBuilder
