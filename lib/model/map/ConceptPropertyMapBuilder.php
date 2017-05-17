<?php


/**
 * This class adds structure of 'reg_concept_property' table to 'propel' DatabaseMap object.
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
class ConceptPropertyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ConceptPropertyMapBuilder';

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

		$tMap = $this->dbMap->addTable('reg_concept_property');
		$tMap->setPhpName('ConceptProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('CREATED_USER_ID', 'CreatedUserId', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('UPDATED_USER_ID', 'UpdatedUserId', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('CONCEPT_ID', 'ConceptId', 'int', CreoleTypes::INTEGER, 'reg_concept', 'ID', true, null);

		$tMap->addColumn('PRIMARY_PREF_LABEL', 'PrimaryPrefLabel', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('SKOS_PROPERTY_ID', 'SkosPropertyId', 'int', CreoleTypes::INTEGER, 'profile_property', 'SKOS_ID', false, null);

		$tMap->addColumn('OBJECT', 'Object', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addForeignKey('SCHEME_ID', 'SchemeId', 'int', CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', false, null);

		$tMap->addForeignKey('RELATED_CONCEPT_ID', 'RelatedConceptId', 'int', CreoleTypes::INTEGER, 'reg_concept', 'ID', false, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'string', CreoleTypes::CHAR, false, 6);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'reg_status', 'ID', false, null);

		$tMap->addColumn('IS_CONCEPT_PROPERTY', 'IsConceptProperty', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('PROFILE_PROPERTY_ID', 'ProfilePropertyId', 'int', CreoleTypes::INTEGER, 'profile_property', 'ID', false, null);

		$tMap->addColumn('IS_GENERATED', 'IsGenerated', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} // doBuild()

} // ConceptPropertyMapBuilder
