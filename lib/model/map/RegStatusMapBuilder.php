<?php


	
class RegStatusMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RegStatusMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('reg_status');
		$tMap->setPhpName('RegStatus');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DISPLAY_ORDER', 'DisplayOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DISPLAY_NAME', 'DisplayName', 'string', CreoleTypes::VARCHAR, false, 255);
				
    } 

} 
