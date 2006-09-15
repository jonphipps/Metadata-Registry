<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'reg_concept_history' table to 'propel' DatabaseMap object.
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
class ConceptHistoryMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.ConceptHistoryMapBuilder';	

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
		
		$tMap = $this->dbMap->addTable('reg_concept_history');
		$tMap->setPhpName('ConceptHistory');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('SID', 'Sid', 'string', CreoleTypes::CHAR, true, 32);

		$tMap->addForeignPrimaryKey('CONCEPT_PROPERTY_ID', 'ConceptPropertyId', 'int' , CreoleTypes::INTEGER, 'reg_concept_property', 'ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'reg_user', 'ID', true, null);

		$tMap->addColumn('CHANGED_AT', 'ChangedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('OLD_VALUES', 'OldValues', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('NEW_VALUES', 'NewValues', 'string', CreoleTypes::LONGVARCHAR, true, null);
				
    } // doBuild()

} // ConceptHistoryMapBuilder
