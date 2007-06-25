<?php



class ConceptPropertyHistoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConceptPropertyHistoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('reg_concept_property_history');
		$tMap->setPhpName('ConceptPropertyHistory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ACTION', 'Action', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addForeignKey('CONCEPT_PROPERTY_ID', 'ConceptPropertyId', 'int', CreoleTypes::INTEGER, 'reg_concept_property', 'ID', false, null);

		$tMap->addForeignKey('CONCEPT_ID', 'ConceptId', 'int', CreoleTypes::INTEGER, 'reg_concept', 'ID', false, null);

		$tMap->addForeignKey('SKOS_PROPERTY_ID', 'SkosPropertyId', 'int', CreoleTypes::INTEGER, 'reg_skos_property', 'ID', false, null);

		$tMap->addColumn('OBJECT', 'Object', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('SCHEME_ID', 'SchemeId', 'int', CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', false, null);

		$tMap->addForeignKey('RELATED_CONCEPT_ID', 'RelatedConceptId', 'int', CreoleTypes::INTEGER, 'reg_concept', 'ID', false, null);

		$tMap->addColumn('LANGUAGE', 'Language', 'string', CreoleTypes::CHAR, false, 6);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'reg_status', 'ID', false, null);

		$tMap->addForeignKey('CREATED_USER_ID', 'CreatedUserId', 'int', CreoleTypes::INTEGER, 'reg_user', 'ID', false, null);

	} 

} 
