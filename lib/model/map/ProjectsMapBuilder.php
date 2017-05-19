<?php


/**
 * This class adds structure of 'projects' table to 'propel' DatabaseMap object.
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
class ProjectsMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProjectsMapBuilder';

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

		$tMap = $this->dbMap->addTable('projects');
		$tMap->setPhpName('Projects');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_PRIVATE', 'IsPrivate', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('REPO', 'Repo', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('LICENSE', 'License', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URI_STRATEGY', 'UriStrategy', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('URI_TYPE', 'UriType', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('URI_PREPEND', 'UriPrepend', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('URI_APPEND', 'UriAppend', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('UPDATED_BY', 'UpdatedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addForeignKey('DELETED_BY', 'DeletedBy', 'int', CreoleTypes::INTEGER, 'users', 'ID', false, null);

		$tMap->addColumn('STARTING_NUMBER', 'StartingNumber', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LICENSE_URI', 'LicenseUri', 'string', CreoleTypes::VARCHAR, false, 191);

		$tMap->addColumn('DEFAULT_LANGUAGE', 'DefaultLanguage', 'string', CreoleTypes::CHAR, false, 10);

		$tMap->addColumn('GOOGLE_SHEET_URL', 'GoogleSheetUrl', 'string', CreoleTypes::VARCHAR, false, 191);

	} // doBuild()

} // ProjectsMapBuilder
