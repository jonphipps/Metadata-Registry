<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'reg_agent' table to 'propel' DatabaseMap object.
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
class AgentMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.AgentMapBuilder';	

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
		
		$tMap = $this->dbMap->addTable('reg_agent');
		$tMap->setPhpName('Agent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ORG_EMAIL', 'OrgEmail', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('ORG_NAME', 'OrgName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IND_AFFILIATION', 'IndAffiliation', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IND_ROLE', 'IndRole', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('ADDRESS1', 'Address1', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ADDRESS2', 'Address2', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('STATE', 'State', 'string', CreoleTypes::CHAR, false, 2);

		$tMap->addColumn('POSTAL_CODE', 'PostalCode', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('COUNTRY', 'Country', 'string', CreoleTypes::CHAR, false, 3);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('WEB_ADDRESS', 'WebAddress', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::CHAR, false, 15);

		$tMap->addColumn('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, false, null);
				
    } // doBuild()

} // AgentMapBuilder
