<?php


	
class LookupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LookupMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('reg_lookup');
		$tMap->setPhpName('Lookup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('SHORT_VALUE', 'ShortValue', 'string', CreoleTypes::CHAR, false);

		$tMap->addColumn('LONG_VALUE', 'LongValue', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DISPLAY_ORDER', 'DisplayOrder', 'int', CreoleTypes::INTEGER, false);
				
    } 
} 