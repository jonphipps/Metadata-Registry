<?php



class AgentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AgentMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('reg_agent');
		$tMap->setPhpName('Agent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ORG_EMAIL', 'OrgEmail', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('ORG_NAME', 'OrgName', 'string', CreoleTypes::VARCHAR, true, 255);

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

	} 

} 
