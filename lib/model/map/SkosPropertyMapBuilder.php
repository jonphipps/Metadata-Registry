<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'reg_skos_property' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an 
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive 
 * (i.e. if it's a text column type).
 *
 * @package model.map
 */	
class SkosPropertyMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.SkosPropertyMapBuilder';	

    /**
     * The database map.
     */
    private $dbMap;

	/**
     * Tells us if this DatabaseMapBuilder is built so that we
     * don't have to re-build it every time.
     *
     * @return boolean true if this DatabaseMapBuilder is built, false otherwise.
     */
    public function isBuilt()
    {
        return ($this->dbMap !== null);
    }

	/**
     * Gets the databasemap this map builder built.
     *
     * @return the databasemap
     */
    public function getDatabaseMap()
    {
        return $this->dbMap;
    }

    /**
     * The doBuild() method builds the DatabaseMap
     *
	 * @return void
     * @throws PropelException
     */
    public function doBuild()
    {
		$this->dbMap = Propel::getDatabaseMap('propel');
		
		$tMap = $this->dbMap->addTable('reg_skos_property');
		$tMap->setPhpName('SkosProperty');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('INVERSE_ID', 'InverseId', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true);

		$tMap->addColumn('URI', 'Uri', 'string', CreoleTypes::VARCHAR, true);

		$tMap->addColumn('OBJECT_TYPE', 'ObjectType', 'string', CreoleTypes::CHAR, true);

		$tMap->addColumn('DISPLAY_ORDER', 'DisplayOrder', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('PICKLIST_ORDER', 'PicklistOrder', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, false);

		$tMap->addColumn('DEFINITION', 'Definition', 'string', CreoleTypes::LONGVARCHAR, false);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false);

		$tMap->addColumn('EXAMPLES', 'Examples', 'string', CreoleTypes::VARCHAR, false);

		$tMap->addColumn('IS_REQUIRED', 'IsRequired', 'boolean', CreoleTypes::BOOLEAN, true);

		$tMap->addColumn('IS_RECIPROCAL', 'IsReciprocal', 'boolean', CreoleTypes::BOOLEAN, true);

		$tMap->addColumn('IS_SINGLETON', 'IsSingleton', 'boolean', CreoleTypes::BOOLEAN, true);

		$tMap->addColumn('IS_SCHEME', 'IsScheme', 'boolean', CreoleTypes::BOOLEAN, true);

		$tMap->addColumn('IS_IN_PICKLIST', 'IsInPicklist', 'boolean', CreoleTypes::BOOLEAN, true);
				
    } // doBuild()

} // SkosPropertyMapBuilder
