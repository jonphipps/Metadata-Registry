<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'reg_vocabulary' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an 
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive 
 * (i.e. if it's a text column type).
 *
 * @package model.map
 */	
class VocabularyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.VocabularyMapBuilder';	

    /**
     * The database map.
     */
    private $dbMap;

	/**
     * Tells us if this DatabaseMapBuilder is built so that we
     * don't have to re-build it every time.
     *
     * @return boolean true if this DatabaseMapBuilder is built, false otherwise.
     */
    public function isBuilt()
    {
        return ($this->dbMap !== null);
    }

	/**
     * Gets the databasemap this map builder built.
     *
     * @return the databasemap
     */
    public function getDatabaseMap()
    {
        return $this->dbMap;
    }

    /**
     * The doBuild() method builds the DatabaseMap
     *
	 * @return void
     * @throws PropelException
     */
    public function doBuild()
    {
		$this->dbMap = Propel::getDatabaseMap('propel');
		
		$tMap = $this->dbMap->addTable('reg_vocabulary');
		$tMap->setPhpName('Vocabulary');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('AGENT_ID', 'AgentId', 'int', CreoleTypes::INTEGER, 'reg_agent', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BASE_DOMAIN', 'BaseDomain', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('COMMUNITY', 'Community', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('LAST_URI_ID', 'LastUriId', 'int', CreoleTypes::INTEGER, false, null);
				
    } // doBuild()

} // VocabularyMapBuilder
