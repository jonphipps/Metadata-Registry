<?php



class UserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('reg_user');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_UPDATED', 'LastUpdated', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('SALUTATION', 'Salutation', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('WANT_TO_BE_MODERATOR', 'WantToBeModerator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_MODERATOR', 'IsModerator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADMINISTRATOR', 'IsAdministrator', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETIONS', 'Deletions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, 40);

	} 

} 
