<?php


/**
 * This class adds structure of 'reg_discuss' table to 'propel' DatabaseMap object.
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
class DiscussMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.DiscussMapBuilder';

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

		$tMap = $this->dbMap->addTable('reg_discuss');
		$tMap->setPhpName('Discuss');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('CREATED_USER_ID', 'CreatedUserId', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('DELETED_USER_ID', 'DeletedUserId', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::CHAR, false, 191);

		$tMap->addForeignKey('SCHEMA_ID', 'SchemaId', 'int', CreoleTypes::INTEGER, 'reg_schema', 'ID', false, null);

		$tMap->addForeignKey('SCHEMA_PROPERTY_ID', 'SchemaPropertyId', 'int', CreoleTypes::INTEGER, 'reg_schema_property', 'ID', false, null);

		$tMap->addForeignKey('SCHEMA_PROPERTY_ELEMENT_ID', 'SchemaPropertyElementId', 'int', CreoleTypes::INTEGER, 'reg_schema_property_element', 'ID', false, null);

		$tMap->addForeignKey('VOCABULARY_ID', 'VocabularyId', 'int', CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', false, null);

		$tMap->addForeignKey('CONCEPT_ID', 'ConceptId', 'int', CreoleTypes::INTEGER, 'reg_concept', 'ID', false, null);

		$tMap->addForeignKey('CONCEPT_PROPERTY_ID', 'ConceptPropertyId', 'int', CreoleTypes::INTEGER, 'reg_concept_property', 'ID', false, null);

		$tMap->addForeignKey('ROOT_ID', 'RootId', 'int', CreoleTypes::INTEGER, 'reg_discuss', 'ID', false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'reg_discuss', 'ID', false, null);

		$tMap->addColumn('SUBJECT', 'Subject', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('UPDATED_BY', 'UpdatedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('DELETED_BY', 'DeletedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

	} // doBuild()

} // DiscussMapBuilder
