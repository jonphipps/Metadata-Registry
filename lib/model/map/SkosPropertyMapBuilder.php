<?php



class SkosPropertyMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SkosPropertyMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('reg_skos_property');
		$tMap->setPhpName('SkosProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INVERSE_ID', 'InverseId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('DISPLAY_ORDER', 'DisplayOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PICKLIST_ORDER', 'PicklistOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DEFINITION', 'Definition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('EXAMPLES', 'Examples', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_REQUIRED', 'IsRequired', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_RECIPROCAL', 'IsReciprocal', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_SINGLETON', 'IsSingleton', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_SCHEME', 'IsScheme', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_IN_PICKLIST', 'IsInPicklist', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} 

} 
