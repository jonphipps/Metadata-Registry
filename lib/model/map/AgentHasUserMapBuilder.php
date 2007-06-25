<?php



class AgentHasUserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AgentHasUserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('reg_agent_has_user');
		$tMap->setPhpName('AgentHasUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'int' , CreoleTypes::INTEGER, 'reg_user', 'ID', true, null);

		$tMap->addForeignPrimaryKey('AGENT_ID', 'AgentId', 'int' , CreoleTypes::INTEGER, 'reg_agent', 'ID', true, null);

		$tMap->addColumn('IS_REGISTRAR_FOR', 'IsRegistrarFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADMIN_FOR', 'IsAdminFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 

} 
