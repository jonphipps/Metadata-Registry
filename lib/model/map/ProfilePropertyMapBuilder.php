<?php


/**
 * This class adds structure of 'profile_property' table to 'propel' DatabaseMap object.
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
class ProfilePropertyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProfilePropertyMapBuilder';

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

		$tMap = $this->dbMap->addTable('profile_property');
		$tMap->setPhpName('ProfileProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SKOS_ID', 'SkosId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('UPDATED_BY', 'UpdatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('DELETED_BY', 'DeletedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('PROFILE_ID', 'ProfileId', 'int', CreoleTypes::INTEGER, 'profile', 'ID', true, null);

		$tMap->addColumn('SKOS_PARENT_ID', 'SkosParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DEFINITION', 'Definition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'reg_status', 'ID', true, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'string', CreoleTypes::VARCHAR, true, 6);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DISPLAY_ORDER', 'DisplayOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EXPORT_ORDER', 'ExportOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PICKLIST_ORDER', 'PicklistOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EXAMPLES', 'Examples', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_REQUIRED', 'IsRequired', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_RECIPROCAL', 'IsReciprocal', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_SINGLETON', 'IsSingleton', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_PICKLIST', 'IsInPicklist', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_EXPORT', 'IsInExport', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('INVERSE_PROFILE_PROPERTY_ID', 'InverseProfilePropertyId', 'int', CreoleTypes::INTEGER, 'profile_property', 'ID', false, null);

		$tMap->addColumn('IS_IN_CLASS_PICKLIST', 'IsInClassPicklist', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_PROPERTY_PICKLIST', 'IsInPropertyPicklist', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_RDF', 'IsInRdf', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_XSD', 'IsInXsd', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_ATTRIBUTE', 'IsAttribute', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('HAS_LANGUAGE', 'HasLanguage', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_OBJECT_PROP', 'IsObjectProp', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_FORM', 'IsInForm', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('NAMESPCE', 'Namespce', 'string', CreoleTypes::VARCHAR, false, 255);

	} // doBuild()

} // ProfilePropertyMapBuilder
