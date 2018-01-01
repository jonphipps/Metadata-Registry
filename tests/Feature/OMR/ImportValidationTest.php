<?php
/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature\OMR;

use App\Models\Batch;
use App\Models\Import;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\BrowserKitTestCase;
use Tests\Unit\Traits\UsesWorksheetData;

class ImportValidationTest extends BrowserKitTestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots, UsesWorksheetData;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function a_project_admin_can_import_any_language()
    {
        //given
        //a project admin
        /** @var Project $project */
        $project = Project::findOrFail(177);
        //a valid import batch
        $batch = $this->createBatch();
        $rdac = $this->createRdacImport($batch->id);
        $media = $this->createRDAMediaTypeImport($batch->id);
        //when the worksheet is displayed
        //then all of the worksheets can be imported
        $this->all_of_the_worksheets_can_be_imported_by_the_project_admin($project, $batch);
    }

    private function all_of_the_worksheets_can_be_imported_by_the_project_admin(Project $project, Batch $batch)
    {
        $user = $project->administrators()->first();
        $this->actingAs($user);
        $this->visit(url("/projects/177/imports/{$batch->id}/worksheets"));
        $this->see('RDAMediaType');

    }

    private function createRdacImport($batchId)
    {
        return Import::create(json_decode('{
            "id": 451,
            "created_at": "2017-12-28 13:15:42",
            "updated_at": "2017-12-28 13:15:43",
            "deleted_at": null,
            "source_file_name": "rdac_en-fr_20170511T182904_570_0",
            "source": "Google",
            "map": null,
            "user_id": 1,
            "file_name": null,
            "file_type": null,
            "preprocess": "{\"deleted\":0,\"updated\":13,\"added\":1,\"errors\":1}",
            "results": null,
            "imported_at": null,
            "total_processed_count": null,
            "error_count": null,
            "success_count": null,
            "added_count": null,
            "updated_count": null,
            "deleted_count": null,
            "batch_id":' . $batchId . ',
            "vocabulary_id": null,
            "schema_id": 83,
            "export_id": 570,
            "token": null,
            "instructions": "{\"update\":{\"14328\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14329\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14330\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14331\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14332\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14333\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14334\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"14335\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true}},\"22989\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true}},\"25151\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true}},\"25152\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true}},\"25153\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true}},\"25154\":{\"*name_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"[ERROR: Empty required attribute]\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true}}},\"delete\":[],\"add\":[{\"*name_en\":{\"new value\":\"EnglishName\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*name_fr\":{\"new value\":\"FrenchName\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"1\",\"updated_at\":null,\"required\":true},\"*label_en\":{\"new value\":\"English label\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true},\"*label_fr\":{\"new value\":\"French label\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"2\",\"updated_at\":null,\"required\":true},\"lexicalAlias_en\":{\"new value\":\"rdac:EnglishName.en\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"27\",\"updated_at\":null,\"required\":false},\"description[0]_en\":{\"new value\":\"English description\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"3\",\"updated_at\":null,\"required\":false},\"description[0]_fr\":{\"new value\":\"French description\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"3\",\"updated_at\":null,\"required\":false},\"note[0]_en\":{\"new value\":\"English Note\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"7\",\"updated_at\":null,\"required\":false},\"note[0]_fr\":{\"new value\":\"French Note\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"7\",\"updated_at\":null,\"required\":false},\"ToolkitLabel_en\":{\"new value\":\"English Toolkit label\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"32\",\"updated_at\":null,\"required\":false},\"ToolkitLabel_fr\":{\"new value\":\"French Toolkit label\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"32\",\"updated_at\":null,\"required\":false},\"ToolkitDefinition_en\":{\"new value\":\"English Toolkit Definition\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"33\",\"updated_at\":null,\"required\":false},\"ToolkitDefinition_fr\":{\"new value\":\"French Toolkit definition\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"33\",\"updated_at\":null,\"required\":false},\"*uri\":{\"new value\":\"http:\\/\\/rdaregistry.info\\/Elements\\/c\\/C10014\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"13\",\"updated_at\":null,\"required\":true},\"*type\":{\"new value\":\"class\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"4\",\"updated_at\":null,\"required\":true},\"subClassOf[0]\":{\"new value\":\"rdac:C10002\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"9\",\"updated_at\":null,\"required\":false},\"subClassOf[1]\":{\"new value\":\"rdac:C10013\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"9\",\"updated_at\":null,\"required\":false},\"*status\":{\"new value\":\"Published\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"14\",\"updated_at\":null,\"required\":true},\"instructionNumber\":{\"new value\":\"9.9.9\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"31\",\"updated_at\":null,\"required\":false}}]}",
            "errors": "{\"row\": [[\"reg_id: 14328\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14329\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14330\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14331\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14332\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14333\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14334\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 14335\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 22989\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 22989\", \"*label_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25151\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25151\", \"*label_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25152\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25152\", \"*label_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25153\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25153\", \"*label_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25154\", \"*name_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"], [\"reg_id: 25154\", \"*label_fr\", \"[ERROR: Empty required attribute]\", \"fatal\"]]}"
          }', true));
    }
    private function createRDAMediaTypeImport($batchId)
    {
        return Import::create(json_decode('{
            "id": 450,
            "created_at": "2017-12-28 13:15:40",
            "updated_at": "2017-12-28 13:15:42",
            "deleted_at": null,
            "source_file_name": "RDAMediaType_en-fr_20170511T172922_569_0",
            "source": "Google",
            "map": null,
            "user_id": 1,
            "file_name": null,
            "file_type": null,
            "preprocess": "{\"deleted\":0,\"updated\":8,\"added\":1,\"errors\":1}",
            "results": null,
            "imported_at": null,
            "total_processed_count": null,
            "error_count": null,
            "success_count": null,
            "added_count": null,
            "updated_count": null,
            "deleted_count": null,
            "batch_id":' . $batchId . ',
            "vocabulary_id": 37,
            "schema_id": null,
            "export_id": 569,
            "token": null,
            "instructions": "{\"update\":{\"479\":{\"alternative label[0]_en\":{\"new value\":\"project alt label\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"34\",\"updated_at\":null,\"required\":false}},\"481\":{\"ToolkitLabel_en\":{\"new value\":\"unmeditated\",\"old value\":\"unmediated\",\"statement_id\":24409,\"language\":\"en\",\"property_id\":\"61\",\"updated_at\":null,\"required\":false}}},\"delete\":[],\"add\":[{\"*preferred label[0]_en\":{\"new value\":\"foobar\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"45\",\"updated_at\":null,\"required\":true},\"*preferred label[0]_fr\":{\"new value\":\"fubaire\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"45\",\"updated_at\":null,\"required\":true},\"ToolkitLabel_en\":{\"new value\":\"foobar\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"61\",\"updated_at\":null,\"required\":false},\"ToolkitLabel_fr\":{\"new value\":\"fubaire\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"61\",\"updated_at\":null,\"required\":false},\"definition[0]_en\":{\"new value\":\"English definition\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"37\",\"updated_at\":null,\"required\":false},\"definition[0]_fr\":{\"new value\":\"French definition\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"37\",\"updated_at\":null,\"required\":false},\"ToolkitDefinition_en\":{\"new value\":\"English Toolkit Definition\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"60\",\"updated_at\":null,\"required\":false},\"ToolkitDefinition_fr\":{\"new value\":\"French Toolkit definition\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"60\",\"updated_at\":null,\"required\":false},\"scope note[0]_en\":{\"new value\":\"First English Scope Note\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"47\",\"updated_at\":null,\"required\":false},\"scope note[1]_en\":{\"new value\":\"Second English Scope Note\",\"old value\":null,\"statement_id\":null,\"language\":\"en\",\"property_id\":\"47\",\"updated_at\":null,\"required\":false},\"scope note[0]_fr\":{\"new value\":\"First French Scope Note\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"47\",\"updated_at\":null,\"required\":false},\"scope note[1]_fr\":{\"new value\":\"Second French Scope Note\",\"old value\":null,\"statement_id\":null,\"language\":\"fr\",\"property_id\":\"47\",\"updated_at\":null,\"required\":false},\"*uri\":{\"new value\":\"http:\\/\\/rdaregistry.info\\/termList\\/RDAMediaType\\/1009\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"62\",\"updated_at\":null,\"required\":true},\"*status\":{\"new value\":\"Published\",\"old value\":null,\"statement_id\":null,\"language\":\"\",\"property_id\":\"59\",\"updated_at\":null,\"required\":true}}]}",
            "errors": "{\"row\": []}"
           }', true));
    }

    private function createBatch()
    {
        $batch = Batch::create(json_decode('{
              "run_time": null,
              "run_description": "Registry tests",
              "object_type": null,
              "object_id": null,
              "event_time": null,
              "event_type": null,
              "event_description": null,
              "registry_uri": null,
              "created_at": "2017-12-26 19:31:07",
              "updated_at": "2017-12-26 19:31:07",
              "project_id": 177,
              "user_id": null,
              "next_step": "worksheets",
              "total_count": 0,
              "handled_count": 0}',
            true));
        $batch->step_data =
            json_decode("{\"lastProcessed\":0,\"batch_id\":null,\"project_id\":177,\"spreadsheet\":{\"source_file_select\":\"https:\\/\\/docs.google.com\\/spreadsheets\\/d\\/1WTxiOvHHUurz76NZ0WU_2GjjY4SG8Gzbg0vH8xwNz_I\\/edit#gid=0\",\"source_file_name\":\"https:\\/\\/docs.google.com\\/spreadsheets\\/d\\/1WTxiOvHHUurz76NZ0WU_2GjjY4SG8Gzbg0vH8xwNz_I\\/edit#gid=0\",\"import_type\":\"0\"},\"googlesheets\":{\"RDAMediaType_en-fr_20170511T172922_569_0\":{\"id\":569,\"created_at\":\"2017-05-11 17:29:21\",\"updated_at\":\"2017-05-11 17:29:22\",\"user_id\":null,\"vocabulary_id\":37,\"schema_id\":null,\"exclude_deprecated\":false,\"include_generated\":false,\"include_deleted\":null,\"include_not_accepted\":false,\"selected_columns\":[\"45\",\"34\",\"61\",\"37\",\"60\",\"47\",\"62\",\"59\"],\"selected_language\":\"fr\",\"published_english_version\":null,\"published_language_version\":null,\"last_vocab_update\":null,\"profile_id\":2,\"file\":\"RDAMediaType_en-fr_20170511T172922_569_0.csv\",\"map\":{\"0\":[{\"label\":\"reg_id\",\"id\":null,\"language\":\"\"},{\"label\":\"*preferred label[0]_en\",\"id\":\"45\",\"language\":\"en\"},{\"label\":\"*preferred label[0]_fr\",\"id\":\"45\",\"language\":\"fr\"},{\"label\":\"alternative label[0]_en\",\"id\":\"34\",\"language\":\"en\"},{\"label\":\"alternative label[0]_fr\",\"id\":\"34\",\"language\":\"fr\"},{\"label\":\"ToolkitLabel_en\",\"id\":\"61\",\"language\":\"en\"},{\"label\":\"ToolkitLabel_fr\",\"id\":\"61\",\"language\":\"fr\"},{\"label\":\"definition[0]_en\",\"id\":\"37\",\"language\":\"en\"},{\"label\":\"definition[0]_fr\",\"id\":\"37\",\"language\":\"fr\"},{\"label\":\"ToolkitDefinition_en\",\"id\":\"60\",\"language\":\"en\"},{\"label\":\"ToolkitDefinition_fr\",\"id\":\"60\",\"language\":\"fr\"},{\"label\":\"scope note[0]_en\",\"id\":\"47\",\"language\":\"en\"},{\"label\":\"scope note[1]_en\",\"id\":\"47\",\"language\":\"en\"},{\"label\":\"scope note[0]_fr\",\"id\":\"47\",\"language\":\"fr\"},{\"label\":\"scope note[1]_fr\",\"id\":\"47\",\"language\":\"fr\"},{\"label\":\"*uri\",\"id\":\"62\",\"language\":\"\"},{\"label\":\"*status\",\"id\":\"59\",\"language\":\"\"}],\"475\":{\"1\":1281,\"2\":21436,\"5\":24397,\"6\":24398,\"7\":1289,\"8\":21437,\"9\":25254,\"11\":1421,\"13\":21438,\"15\":0,\"16\":0},\"476\":{\"1\":1282,\"2\":21445,\"5\":24399,\"6\":24400,\"7\":1291,\"8\":21446,\"9\":25260,\"11\":1423,\"13\":21447,\"15\":0,\"16\":0},\"477\":{\"1\":1283,\"2\":21442,\"5\":24401,\"6\":24402,\"7\":1290,\"8\":21443,\"9\":25266,\"11\":1422,\"13\":21444,\"15\":0,\"16\":0},\"478\":{\"1\":1284,\"2\":21448,\"5\":24403,\"6\":24404,\"7\":1292,\"8\":21449,\"9\":25272,\"15\":0,\"16\":0},\"479\":{\"1\":1285,\"2\":21450,\"5\":24405,\"6\":24406,\"7\":1293,\"8\":21451,\"9\":25277,\"11\":1424,\"13\":21452,\"15\":0,\"16\":0},\"480\":{\"1\":1286,\"2\":21453,\"5\":24407,\"6\":24408,\"7\":1294,\"8\":21454,\"9\":25283,\"15\":0,\"16\":0},\"481\":{\"1\":1287,\"2\":21455,\"5\":24409,\"6\":24410,\"7\":1295,\"8\":21456,\"9\":25288,\"11\":1425,\"12\":1426,\"13\":21457,\"15\":0,\"16\":0},\"482\":{\"1\":1288,\"2\":21439,\"5\":24411,\"6\":24412,\"7\":1296,\"8\":21440,\"9\":25294,\"11\":1427,\"13\":21441,\"15\":0,\"16\":0}}},\"rdac_en-fr_20170511T182904_570_0\":{\"id\":570,\"created_at\":\"2017-05-11 18:29:04\",\"updated_at\":\"2017-05-11 18:29:04\",\"user_id\":null,\"vocabulary_id\":null,\"schema_id\":83,\"exclude_deprecated\":false,\"include_generated\":false,\"include_deleted\":null,\"include_not_accepted\":false,\"selected_columns\":[\"1\",\"2\",\"27\",\"3\",\"7\",\"32\",\"33\",\"13\",\"4\",\"9\",\"16\",\"14\",\"31\"],\"selected_language\":\"fr\",\"published_english_version\":null,\"published_language_version\":null,\"last_vocab_update\":null,\"profile_id\":1,\"file\":\"rdac_en-fr_20170511T182904_570_0.csv\",\"map\":{\"0\":[{\"label\":\"reg_id\",\"id\":null,\"language\":\"\"},{\"label\":\"*name_en\",\"id\":\"1\",\"language\":\"en\"},{\"label\":\"*name_fr\",\"id\":\"1\",\"language\":\"fr\"},{\"label\":\"*label_en\",\"id\":\"2\",\"language\":\"en\"},{\"label\":\"*label_fr\",\"id\":\"2\",\"language\":\"fr\"},{\"label\":\"lexicalAlias_en\",\"id\":\"27\",\"language\":\"en\"},{\"label\":\"lexicalAlias_fr\",\"id\":\"27\",\"language\":\"fr\"},{\"label\":\"description[0]_en\",\"id\":\"3\",\"language\":\"en\"},{\"label\":\"description[0]_fr\",\"id\":\"3\",\"language\":\"fr\"},{\"label\":\"note[0]_en\",\"id\":\"7\",\"language\":\"en\"},{\"label\":\"note[0]_fr\",\"id\":\"7\",\"language\":\"fr\"},{\"label\":\"ToolkitLabel_en\",\"id\":\"32\",\"language\":\"en\"},{\"label\":\"ToolkitLabel_fr\",\"id\":\"32\",\"language\":\"fr\"},{\"label\":\"ToolkitDefinition_en\",\"id\":\"33\",\"language\":\"en\"},{\"label\":\"ToolkitDefinition_fr\",\"id\":\"33\",\"language\":\"fr\"},{\"label\":\"*uri\",\"id\":\"13\",\"language\":\"\"},{\"label\":\"*type\",\"id\":\"4\",\"language\":\"\"},{\"label\":\"subClassOf[0]\",\"id\":\"9\",\"language\":\"\"},{\"label\":\"subClassOf[1]\",\"id\":\"9\",\"language\":\"\"},{\"label\":\"sameAs[0]\",\"id\":\"16\",\"language\":\"\"},{\"label\":\"*status\",\"id\":\"14\",\"language\":\"\"},{\"label\":\"instructionNumber\",\"id\":\"31\",\"language\":\"\"}],\"14328\":{\"1\":213450,\"3\":107698,\"4\":180568,\"5\":128168,\"7\":107699,\"8\":180569,\"11\":139429,\"12\":180570,\"13\":139430,\"14\":180571,\"15\":107701,\"16\":107700,\"17\":213512,\"20\":107702,\"21\":190279},\"14329\":{\"1\":107704,\"3\":107705,\"4\":180572,\"5\":128169,\"7\":107706,\"8\":180573,\"11\":139431,\"12\":180574,\"13\":139432,\"14\":180575,\"15\":107708,\"16\":107707,\"17\":213513,\"20\":107709},\"14330\":{\"1\":213452,\"3\":107712,\"4\":180576,\"5\":128170,\"7\":107713,\"8\":180577,\"11\":139433,\"12\":180578,\"13\":139434,\"14\":180579,\"15\":107715,\"16\":107714,\"17\":213451,\"20\":107716,\"21\":190280},\"14331\":{\"1\":213453,\"3\":107719,\"4\":180580,\"5\":128171,\"7\":107720,\"8\":180581,\"11\":139435,\"12\":180582,\"13\":139436,\"14\":180583,\"15\":107722,\"16\":107721,\"17\":107724,\"20\":107723,\"21\":190281},\"14332\":{\"1\":213454,\"3\":107727,\"4\":180584,\"5\":128172,\"7\":107728,\"8\":180585,\"11\":139437,\"12\":180586,\"13\":139438,\"14\":180587,\"15\":107730,\"16\":107729,\"17\":107732,\"20\":107731,\"21\":190282},\"14333\":{\"1\":213456,\"3\":107735,\"4\":180588,\"5\":128173,\"7\":107736,\"8\":180589,\"11\":139439,\"12\":180590,\"13\":139440,\"14\":180591,\"15\":107738,\"16\":107737,\"17\":213455,\"20\":107739,\"21\":190283},\"14334\":{\"1\":213458,\"3\":107742,\"4\":180592,\"5\":128174,\"7\":107743,\"8\":180593,\"11\":139441,\"12\":180594,\"13\":139442,\"14\":180595,\"15\":107745,\"16\":107744,\"17\":213457,\"20\":107746,\"21\":190284},\"14335\":{\"1\":107748,\"3\":107749,\"4\":180596,\"5\":128175,\"7\":107750,\"8\":180597,\"11\":139443,\"12\":180598,\"13\":139444,\"14\":180599,\"15\":107752,\"16\":107751,\"17\":107754,\"20\":107753,\"21\":190285},\"22989\":{\"1\":187496,\"3\":187497,\"5\":187498,\"7\":187499,\"11\":187501,\"13\":187502,\"15\":187494,\"16\":187495,\"17\":213459,\"20\":187500},\"25151\":{\"1\":213463,\"3\":213464,\"5\":213465,\"7\":213466,\"11\":213468,\"13\":288390,\"15\":213461,\"16\":213462,\"17\":213514,\"20\":213515},\"25152\":{\"1\":213472,\"3\":213473,\"5\":213474,\"7\":213475,\"9\":213476,\"11\":213478,\"13\":213479,\"15\":213470,\"16\":213471,\"17\":213469,\"18\":213510,\"20\":213511},\"25153\":{\"1\":213483,\"3\":213484,\"5\":213485,\"7\":213486,\"9\":213487,\"11\":213489,\"13\":213490,\"15\":213481,\"16\":213482,\"17\":213516,\"20\":213517},\"25154\":{\"1\":213493,\"3\":213494,\"5\":213495,\"7\":213496,\"9\":213509,\"11\":213499,\"13\":213500,\"15\":213491,\"16\":213492,\"20\":213508}}}},\"title\":\"Registry tests\"}",
                true);
        $batch->save();

        return $batch;
    }
}
