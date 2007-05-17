<?php



class ResourceMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ResourceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('reg_resource');
		$tMap->setPhpName('Resource');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TYPE', 'Type', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('AGENT_ID', 'AgentId', 'int', CreoleTypes::INTEGER, 'reg_agent', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATE_AT', 'UpdateAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('BASE_DOMAIN', 'BaseDomain', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, true, 45);

		$tMap->addColumn('COMMUNITY', 'Community', 'string', CreoleTypes::VARCHAR, false, 45);

		$tMap->addColumn('LAST_URI_ID', 'LastUriId', 'int', CreoleTypes::INTEGER, false, null);

	} 

} 
