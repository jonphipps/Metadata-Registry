<?php
		
require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'reg_vocabulary_has_user' table to 'propel' DatabaseMap object.
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
class VocabularyHasUserMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'model.map.VocabularyHasUserMapBuilder';	

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
		
		$tMap = $this->dbMap->addTable('reg_vocabulary_has_user');
		$tMap->setPhpName('VocabularyHasUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('VOCABULARY_ID', 'VocabularyId', 'int' , CreoleTypes::INTEGER, 'reg_vocabulary', 'ID', true, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'int' , CreoleTypes::INTEGER, 'reg_user', 'ID', true, null);

		$tMap->addColumn('IS_MAINTAINER_FOR', 'IsMaintainerFor', 'boolean', CreoleTypes::BOOLEAN, false);

		$tMap->addColumn('IS_REGISTRAR_FOR', 'IsRegistrarFor', 'boolean', CreoleTypes::BOOLEAN, false);
				
    } // doBuild()

} // VocabularyHasUserMapBuilder
