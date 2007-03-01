<?php


	
class ConceptHistoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConceptHistoryMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('reg_concept_history');
		$tMap->setPhpName('ConceptHistory');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('SID', 'Sid', 'string', CreoleTypes::CHAR, true, 32);

		$tMap->addForeignPrimaryKey('CONCEPT_PROPERTY_ID', 'ConceptPropertyId', 'int' , CreoleTypes::INTEGER, 'reg_concept_property', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'reg_user', 'ID', true, null);

		$tMap->addColumn('CHANGED_AT', 'ChangedAt', 'int', CreoleTypes::TIMESTAMP, false);

		$tMap->addColumn('OLD_VALUES', 'OldValues', 'string', CreoleTypes::LONGVARCHAR, true);

		$tMap->addColumn('NEW_VALUES', 'NewValues', 'string', CreoleTypes::LONGVARCHAR, true);
				
    } 
} 