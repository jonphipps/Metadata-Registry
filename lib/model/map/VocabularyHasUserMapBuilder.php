<?php


	
class VocabularyHasUserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.VocabularyHasUserMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('reg_vocabulary_has_user');
		$tMap->setPhpName('VocabularyHasUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('VOCABULARY_ID', 'VocabularyId', 'int' , CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', true, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'int' , CreoleTypes::INTEGER, 'reg_user', 'ID', true, null);

		$tMap->addColumn('IS_MAINTAINER_FOR', 'IsMaintainerFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_REGISTRAR_FOR', 'IsRegistrarFor', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADMIN_FOR', 'IsAdminFor', 'boolean', CreoleTypes::BOOLEAN, false, null);
				
    } 

} 
