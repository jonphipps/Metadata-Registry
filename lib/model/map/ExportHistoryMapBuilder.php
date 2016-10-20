<?php


/**
 * This class adds structure of 'reg_export_history' table to 'propel' DatabaseMap object.
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
class ExportHistoryMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ExportHistoryMapBuilder';

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

		$tMap = $this->dbMap->addTable('reg_export_history');
		$tMap->setPhpName('ExportHistory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'reg_user', 'ID', false, null);

		$tMap->addForeignKey('VOCABULARY_ID', 'VocabularyId', 'int', CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', false, null);

		$tMap->addForeignKey('SCHEMA_ID', 'SchemaId', 'int', CreoleTypes::INTEGER, 'reg_schema', 'ID', false, null);

		$tMap->addColumn('EXCLUDE_DEPRECATED', 'ExcludeDeprecated', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INCLUDE_GENERATED', 'IncludeGenerated', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INCLUDE_DELETED', 'IncludeDeleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INCLUDE_NOT_ACCEPTED', 'IncludeNotAccepted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SELECTED_COLUMNS', 'SelectedColumns', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SELECTED_LANGUAGE', 'SelectedLanguage', 'string', CreoleTypes::VARCHAR, false, 10);

		$tMap->addColumn('PUBLISHED_ENGLISH_VERSION', 'PublishedEnglishVersion', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PUBLISHED_LANGUAGE_VERSION', 'PublishedLanguageVersion', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LAST_VOCAB_UPDATE', 'LastVocabUpdate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('PROFILE_ID', 'ProfileId', 'int', CreoleTypes::INTEGER, 'profile', 'ID', false, null);

		$tMap->addColumn('FILE', 'File', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('MAP', 'Map', 'string', CreoleTypes::LONGVARCHAR, true, null);

	} // doBuild()

} // ExportHistoryMapBuilder
