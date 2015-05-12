<?php
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;

require_once("_bootstrap.php");

class importUpdateTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ImportVocab
     */
    protected $import;

    protected function _before()
    {
        $this->import = new ImportVocab("schema", "updatedata.csv", 81);
        $this->import->importFolder = Fixtures::get("importFolder");
    }

    protected function _after()
    {
    }

    // tests

    // These tests determine if a changed csv properly updates the db and records the correct history
    // It won't delete any data
    public function testSparseUpdate()
    {
        $I=$this->tester;
        $I->wantToTest("if a changed cell in the main table gets changed");
        //$I->seeRecordCountInDatabaseTable("SchemaPropertyElement", 140);
        $I->seeRecordCountInDatabaseTable("SchemaProperty", 1);
        //$I->seeRecordCountInDatabaseTable("SchemaPropertyElementHistory", 146);
        //$I->canSeeInDatabase('reg_schema_property', ['id' => 81, "definition" => "This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E30 Right, which applies to all exemplars of that publication, as long as they are recognised as exemplars of that publication."]);
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $prolog    = $this->import->prolog;
        $this->assertEquals(16, count($prolog['columns']), "There are the correct number of columns");
        $this->assertEquals(6, count($prolog['prefix']), "There are the correct number of prefix entries");
        $this->assertEquals(10, count($prolog['meta']), "There are the correct number of meta entries");
        $this->import->getDataColumnIds();
        $this->import->processData();
        $results = $this->import->results['success'];
        verify("There were 12 rows processed",
          count($results['rows']))->equals(12);
        $this->import->processParents();
        $I->canSeeInDatabase('reg_schema_property', ['id' => 1, "definition" => "fubar, baby"]);

        //test if a changed cell in the main table gets changed in the statement table
        $I->canSeeInDatabase('reg_schema_property_element', ['id' => 3, "object" => "fubar, baby"]);
        //test if the history is updated
        $I->canSeeInDatabase('reg_schema_property_element_history', ['schema_property_element_id' => 3, 'schema_property_id' => 1, "object" => "fubar, baby"]);
        $historyDate = $I->grabFromDatabase('reg_schema_property_element_history', 'created_at', ['schema_property_element_id' => 3, 'schema_property_id' => 1, "object" => "fubar, baby"]);
        //the other rows haven't been updated
        $updateDate = $I->grabFromDatabase('reg_schema_property', 'updated_at', ['id' => 3]);
        verify("another property row hasn't been updated",
          $historyDate)->greaterThan($updateDate);
        $elementUpdateDate = $I->grabFromDatabase('reg_schema_property_element', 'updated_at', ['id' => 3]);
        verify("the element row has been updated",
          $historyDate)->equals($elementUpdateDate);
        $otherPropertyUpdateDate = $I->grabFromDatabase('reg_schema_property_element', 'updated_at', ['id' => 12]);
        verify("the inverse property statement has not been updated",
          $historyDate)->greaterThan($otherPropertyUpdateDate);
        $I->canSeeInDatabase('reg_schema_property_element', ['id' => 3, "object" => "fubar, baby"]);
        //test if a NEW cell in the main table gets sdded
        $I->canSeeInDatabase('reg_schema_property_element', ["object" => "New definition"]);
        //test if a NEW cell in the main table gets changed in the statement table
        $I->canSeeInDatabase('reg_schema_property', ['id' => 2, "definition" => "New definition"]);
        //test if the history is updated
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 3, 'schema_property_id' => 2, "object" => "New definition", "action" => "added"]);
        //test if a changed cell that exists only in the statement table gets changed in the statement table
        $I->canSeeInDatabase('reg_schema_property_element', ["object" => "http://iflastandards.info/ns/fr/frbr/frbroo/CLP105TestMe"]);
        //test if the history is updated
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 15, 'schema_property_id' => 4, "object" => "http://iflastandards.info/ns/fr/frbr/frbroo/CLP105TestMe", "action" => "added"]);
        //test if the parent update date matches the update of a statement when the statement is the only thing changed
        $updateDate = $I->grabFromDatabase('reg_schema_property', 'updated_at', ['id' => 4]);
        $elementUpdateDate = $I->grabFromDatabase('reg_schema_property_element', 'updated_at', ['id' => 141]);
        verify("the element row has been updated",
          $updateDate)->equals($elementUpdateDate);
        $I->wantTo('see if a deleted cell is removed from the schema_property record');
        $I->dontSeeInDatabase('reg_schema_property', ['id' => 2, "comment" => "Inverse of CLP104_subject_to."]);
        $I->wantTo('see if a deleted cell that was removed from the schema_property record, was also marked as deleted in the schema_property_element table');
        $I->dontSeeInDatabase('reg_schema_property_element', ['schema_property_id' => 2, "object" => "Inverse of CLP104_subject_to.", "deleted_at" => null]);
        $I->wantTo('see if a deleted cell, marked as deleted in the schema_property_element table, is also marked as deleted in the history table');
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 5, 'schema_property_id' => 2, "object" => "Inverse of CLP104_subject_to.", "action" => "deleted"]);

        $I->wantTo('see if a deleted cell, not in the main property record, deletes the schema_property_element record');

        $I->dontSeeInDatabase('reg_schema_property_element', ['schema_property_id' => 2, "object" => "http://iflastandards.info/ns/fr/frbr/frbroo/CLP104", "deleted_at" => null]);
        $I->wantTo('see if a deleted cell, marked as deleted in the schema_property_element table, is also marked as deleted in the history table');
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 15, 'schema_property_id' => 2, "object" => "http://iflastandards.info/ns/fr/frbr/frbroo/CLP104", "action" => "deleted"]);

        $I->wantTo('see if a subproperty was inappropriately deleted');
        $I->canSeeInDatabase('reg_schema_property_element', ['schema_property_id' => 7, "object" => "http://www.cidoc-crm.org/cidoc-crm/P130_shows_features_of", "deleted_at" => null]);

        //row 9 is converted to property from subproperty
        $I->wantTo('see if a subproperty was appropriately deleted');
        $I->canSeeInDatabase('reg_schema_property_element_history', ['object' => 'http://iflastandards.info/ns/fr/frbr/frbroo/R3', "action" => "deleted"]);

        //row 12 is converted to subproperty from property
        $I->canSeeInDatabase('reg_schema_property', ['id' => 12, 'type' => 'subproperty', 'parent_uri' => 'http://iflastandards.info/ns/fr/frbr/frbroo/R3i']);
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 6, 'schema_property_id' => 12, 'object' => 'http://iflastandards.info/ns/fr/frbr/frbroo/R3i', "action" => "added"]);

        //row 5 removes one subclass, but keeps the parent_class and the second subclass
        $I->canSeeInDatabase('reg_schema_property', ['id' => 5, 'parent_uri' => 'http://iflastandards.info/ns/fr/frbr/frbroo/F2']);
        $I->canSeeInDatabase('reg_schema_property_element_history', ['profile_property_id' => 9, 'schema_property_id' => 5, 'object' => 'http://www.cidoc-crm.org/cidoc-crm/E32_Authority_Document', "action" => "deleted"]);
    }
}
