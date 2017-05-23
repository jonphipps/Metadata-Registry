<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-06,  Time: 5:21 PM */

namespace Tests\Unit\OMR;

use App\Models\Export;
use App\Services\Import\DataImporter;
use function base_path;
use function db2_conn_error;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;
use function collect;
use function factory;
use function unserialize;

class DataImporterTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp()
    {
        //$this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function if_the_dataset_and_the_export_map_are_the_same_then_there_are_no_updates()
    {
        $this->artisan('db:seed',['--class'=> 'RDAMediaTypeSeeder']);
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0.csv');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get back a list of fields that will change, none in this case
        $this->assertEquals(0, $changeSet->count());
    }

    /** @test */
    public function if_the_the_import_is_an_elementset_and_the_dataset_and_the_export_map_are_the_same_then_there_are_no_updates()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        //given a data set pulled from a worksheet
        $data   = collect($this->getElementSetWorksheetData());
        $export = Export::findByExportFileName('rdac_en-fr_20170511T182904_570_0.csv');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get back a list of fields that will change, none in this case
        $this->assertEquals(0, $changeSet->count());
    }

    /** @test */
    public function it_builds_an_array_of_updates_to_the_dataset_from_a_worksheet_and_export_map()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        $row    = $data->pull(8);
        $row[4] = 'bingo';
        $row[5] = 'foobar';
        $row[6] = '';
        $data->put(8, $row);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0.csv');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get back a list of fields that will change, one in this case
        $this->assertEquals(1, $changeSet->count());
        $this->assertMatchesSnapshot($changeSet->toArray());
    }

    /** @test */
    public function it_builds_an_array_of_elementset_updates_to_the_dataset_from_a_worksheet_and_export_map()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        //given a data set pulled from a worksheet
        $data   = collect($this->getElementSetWorksheetData());
        $row    = $data->pull(8);
        $row[2] = 'bingo';
        $row[4] = 'foobar';
        $row[5] = '';
        $data->put(8, $row);
        $export = Export::findByExportFileName('rdac_en-fr_20170511T182904_570_0.csv');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get back a list of fields that will change, none in this case
        $this->assertEquals(1, $changeSet->count());
        $this->assertMatchesSnapshot($changeSet->toArray());
    }

    /** @test */
    public function it_builds_an_array_of_additions_to_the_dataset_froma_worksheet_and_export_map()
    {
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        //add a new row that has no reg_id
        $newRow = $data[8];
        $newRow[0]='';
        $newRow[1] = 'New Video Row';
        $newRow[15] = 'RDAMediaType:1009';
        $data[]=$newRow;
        $map    = $this->getMap()->toArray();
        $export = factory(Export::class)->make([
            'map'              => $map,
            'selected_columns' => $this->getColumns(),
        ]);
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $newRows = $importer->getAddRows();
        $updatedRows = $importer->getUpdateRows();
        //then i get back a list of fields that will be added
        $this->assertMatchesSnapshot($newRows->toArray());
        //and i get back a list of fields that will be updated
        $this->assertMatchesSnapshot($updatedRows->toArray());
    }

    /** @test */
    public function it_builds_an_array_of_deleted_rows_missing_froma_worksheet_but_present_in_export_map()
    {
        //given a data set pulled from a worksheet
        $data = collect($this->getVocabularyWorksheetData());
        //add a new row that has no reg_id
        $deletedRow = $data->pop();
        $map        = $this->getMap()->toArray();
        $export     = factory(Export::class)->make([
            'map'              => $map,
            'selected_columns' => $this->getColumns(),
        ]);
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $deletedRows = $importer->getDeleteRows();
        $updatedRows = $importer->getUpdateRows();
        //then i get back a list of fields that will be deleted
        $this->assertMatchesSnapshot($deletedRows->toArray());
        //and i get back a list of fields that will be updated
        $this->assertMatchesSnapshot($updatedRows->toArray());
    }

    /** @test */
    public function it_gets_an_export_data_map_from_an_export_map()
    {
        //given a deserialized export map
        $map = $this->getMap();
        //when i pass it to the datafromMap function
        $data = DataImporter::getRowMap($map)->toArray();
        //then it returns a proper set of exported statements
        $this->assertMatchesSnapshot($data);
    }

    /** @test */
    public function it_gets_an_export_data_profile_from_an_export_map()
    {
        //given a deserialized export map
        $map = $this->getMap();
        //when i pass it to the MapHeader function
        $header = DataImporter::getHeaderFromMap($map);
        //then it returns a proper header/profile
        $this->assertMatchesSnapshot($this->getMap()->toArray()[0]);
    }

    /** @test */
    public function it_retrieves_an_associative_array_of_data_for_a_dataset_that_has_no_regsitry_ids()
    {
        //given a set of normal raw csv-style data
        $data     = collect([
            [
                'reg_id',
                'header B1',
            ],
            [
                "",
                "data B2",
            ],
        ]);
        $importer = new DataImporter($data);
        //when I request the data for a worksheet
        $importData = $importer->getDataForImport()->toArray();
        //then i get the data back
        $expected = [
            '1' => [
                'reg_id'    => '',
                'header B1' => 'data B2',
            ],
        ];
        //ddd($data, $expected);
        $this->assertSame($expected, $importData);
    }

    /** @test */
    public function it_retrieves_an_associative_array_of_data_from_a_dataset_collection()
    {
        //given a set of normal raw csv-style data
        $data     = collect([
            [
                'reg_id',
                'header B1',
            ],
            [
                "data A2",
                "data B2",
            ],
        ]);
        $importer = new DataImporter($data);
        //when I request the data for a worksheet
        $importData = $importer->getDataForImport()->toArray();
        //then i get the data back
        $expected = [
            '1' => [
                'reg_id'    => 'data A2',
                'header B1' => 'data B2',
            ],
        ];
        //ddd($data, $expected);
        $this->assertSame($expected, $importData);
    }

    /** @test */
    public function it_retrieves_an_export_history_record_by_name()
    {
        $this->markTestIncomplete();
        //given we have a valid export history record
        //factory(ExportHistory::class);
        //when we ask for it from the database
        //then we get one
    }

    private function getColumns()
    {
        return unserialize('a:8:{i:0;s:2:"45";i:1;s:2:"34";i:2;s:2:"61";i:3;s:2:"37";i:4;s:2:"60";i:5;s:2:"47";i:6;s:2:"62";i:7;s:2:"59";}',[true]);
    }

    private function getData()
    {
        return collect([
            [
                'reg_id',
                'header B1',
            ],
            [
                "",
                "data B2",
            ],
        ]);

    }
    // row 0 is a representation of the profile map for the export
    // rows 534-538 are an actual partial export map
    // rows are keyed to the thing_id of the thing being described
    // 'columns' in each row are keyed to the column number in the profile map
    // each cell contains the id of the statement that was exported

    private function getMap()
    {
        return collect(unserialize('a:9:{i:0;a:17:{i:0;a:3:{s:5:"label";s:6:"reg_id";s:2:"id";N;s:8:"language";s:0:"";}i:1;a:3:{s:5:"label";s:22:"*preferred label[0]_en";s:2:"id";s:2:"45";s:8:"language";s:2:"en";}i:2;a:3:{s:5:"label";s:22:"*preferred label[0]_fr";s:2:"id";s:2:"45";s:8:"language";s:2:"fr";}i:3;a:3:{s:5:"label";s:23:"alternative label[0]_en";s:2:"id";s:2:"34";s:8:"language";s:2:"en";}i:4;a:3:{s:5:"label";s:23:"alternative label[0]_fr";s:2:"id";s:2:"34";s:8:"language";s:2:"fr";}i:5;a:3:{s:5:"label";s:15:"ToolkitLabel_en";s:2:"id";s:2:"61";s:8:"language";s:2:"en";}i:6;a:3:{s:5:"label";s:15:"ToolkitLabel_fr";s:2:"id";s:2:"61";s:8:"language";s:2:"fr";}i:7;a:3:{s:5:"label";s:16:"definition[0]_en";s:2:"id";s:2:"37";s:8:"language";s:2:"en";}i:8;a:3:{s:5:"label";s:16:"definition[0]_fr";s:2:"id";s:2:"37";s:8:"language";s:2:"fr";}i:9;a:3:{s:5:"label";s:20:"ToolkitDefinition_en";s:2:"id";s:2:"60";s:8:"language";s:2:"en";}i:10;a:3:{s:5:"label";s:20:"ToolkitDefinition_fr";s:2:"id";s:2:"60";s:8:"language";s:2:"fr";}i:11;a:3:{s:5:"label";s:16:"scope note[0]_en";s:2:"id";s:2:"47";s:8:"language";s:2:"en";}i:12;a:3:{s:5:"label";s:16:"scope note[1]_en";s:2:"id";s:2:"47";s:8:"language";s:2:"en";}i:13;a:3:{s:5:"label";s:16:"scope note[0]_fr";s:2:"id";s:2:"47";s:8:"language";s:2:"fr";}i:14;a:3:{s:5:"label";s:16:"scope note[1]_fr";s:2:"id";s:2:"47";s:8:"language";s:2:"fr";}i:15;a:3:{s:5:"label";s:4:"*uri";s:2:"id";s:2:"62";s:8:"language";s:0:"";}i:16;a:3:{s:5:"label";s:7:"*status";s:2:"id";s:2:"59";s:8:"language";s:0:"";}}i:475;a:11:{i:1;i:1281;i:2;i:21436;i:5;i:24397;i:6;i:24398;i:7;i:1289;i:8;i:21437;i:9;i:25254;i:11;i:1421;i:13;i:21438;i:15;i:0;i:16;i:0;}i:476;a:11:{i:1;i:1282;i:2;i:21445;i:5;i:24399;i:6;i:24400;i:7;i:1291;i:8;i:21446;i:9;i:25260;i:11;i:1423;i:13;i:21447;i:15;i:0;i:16;i:0;}i:477;a:11:{i:1;i:1283;i:2;i:21442;i:5;i:24401;i:6;i:24402;i:7;i:1290;i:8;i:21443;i:9;i:25266;i:11;i:1422;i:13;i:21444;i:15;i:0;i:16;i:0;}i:478;a:9:{i:1;i:1284;i:2;i:21448;i:5;i:24403;i:6;i:24404;i:7;i:1292;i:8;i:21449;i:9;i:25272;i:15;i:0;i:16;i:0;}i:479;a:11:{i:1;i:1285;i:2;i:21450;i:5;i:24405;i:6;i:24406;i:7;i:1293;i:8;i:21451;i:9;i:25277;i:11;i:1424;i:13;i:21452;i:15;i:0;i:16;i:0;}i:480;a:9:{i:1;i:1286;i:2;i:21453;i:5;i:24407;i:6;i:24408;i:7;i:1294;i:8;i:21454;i:9;i:25283;i:15;i:0;i:16;i:0;}i:481;a:12:{i:1;i:1287;i:2;i:21455;i:5;i:24409;i:6;i:24410;i:7;i:1295;i:8;i:21456;i:9;i:25288;i:11;i:1425;i:12;i:1426;i:13;i:21457;i:15;i:0;i:16;i:0;}i:482;a:11:{i:1;i:1288;i:2;i:21439;i:5;i:24411;i:6;i:24412;i:7;i:1296;i:8;i:21440;i:9;i:25294;i:11;i:1427;i:13;i:21441;i:15;i:0;i:16;i:0;}}',[true]));

        //this is a map from an actual export
        /** @noinspection PhpUnreachableStatementInspection */
        /** @noinspection PhpExpressionResultUnusedInspection */
        <<<'SQL'
INSERT INTO `reg_export_history` (`id`, `created_at`, `updated_at`, `user_id`, `vocabulary_id`, `schema_id`, `exclude_deprecated`, `include_generated`, `include_deleted`, `include_not_accepted`, `selected_columns`, `selected_language`, `published_english_version`, `published_language_version`, `last_vocab_update`, `profile_id`, `file`, `map`) VALUES 
	(547,
	'2017-05-08 20:52:40',
	'2017-05-08 20:52:40',
	NULL,
	37,
	NULL,
	0,
	0,
	NULL,
	0,
	'a:8:{i:0;s:2:"45";i:1;s:2:"34";i:2;s:2:"61";i:3;s:2:"37";i:4;s:2:"60";i:5;s:2:"47";i:6;s:2:"62";i:7;s:2:"59";}',
	'fr',
	NULL,
	NULL,
	NULL,
	2,
	'RDAMediaType_en-fr_20170508T205240_547_0.csv',
	'a:9:{i:0;a:17:{i:0;a:3:{s:5:"label";s:6:"reg_id";s:2:"id";N;s:8:"language";s:0:"";}i:1;a:3:{s:5:"label";s:22:"*preferred label[0]_en";s:2:"id";s:2:"45";s:8:"language";s:2:"en";}i:2;a:3:{s:5:"label";s:22:"*preferred label[0]_fr";s:2:"id";s:2:"45";s:8:"language";s:2:"fr";}i:3;a:3:{s:5:"label";s:23:"alternative label[0]_en";s:2:"id";s:2:"34";s:8:"language";s:2:"en";}i:4;a:3:{s:5:"label";s:23:"alternative label[0]_fr";s:2:"id";s:2:"34";s:8:"language";s:2:"fr";}i:5;a:3:{s:5:"label";s:15:"ToolkitLabel_en";s:2:"id";s:2:"61";s:8:"language";s:2:"en";}i:6;a:3:{s:5:"label";s:15:"ToolkitLabel_fr";s:2:"id";s:2:"61";s:8:"language";s:2:"fr";}i:7;a:3:{s:5:"label";s:16:"definition[0]_en";s:2:"id";s:2:"37";s:8:"language";s:2:"en";}i:8;a:3:{s:5:"label";s:16:"definition[0]_fr";s:2:"id";s:2:"37";s:8:"language";s:2:"fr";}i:9;a:3:{s:5:"label";s:20:"ToolkitDefinition_en";s:2:"id";s:2:"60";s:8:"language";s:2:"en";}i:10;a:3:{s:5:"label";s:20:"ToolkitDefinition_fr";s:2:"id";s:2:"60";s:8:"language";s:2:"fr";}i:11;a:3:{s:5:"label";s:16:"scope note[0]_en";s:2:"id";s:2:"47";s:8:"language";s:2:"en";}i:12;a:3:{s:5:"label";s:16:"scope note[1]_en";s:2:"id";s:2:"47";s:8:"language";s:2:"en";}i:13;a:3:{s:5:"label";s:16:"scope note[0]_fr";s:2:"id";s:2:"47";s:8:"language";s:2:"fr";}i:14;a:3:{s:5:"label";s:16:"scope note[1]_fr";s:2:"id";s:2:"47";s:8:"language";s:2:"fr";}i:15;a:3:{s:5:"label";s:4:"*uri";s:2:"id";s:2:"62";s:8:"language";s:0:"";}i:16;a:3:{s:5:"label";s:7:"*status";s:2:"id";s:2:"59";s:8:"language";s:0:"";}}i:475;a:11:{i:1;i:1281;i:2;i:21436;i:5;i:24397;i:6;i:24398;i:7;i:1289;i:8;i:21437;i:9;i:25254;i:11;i:1421;i:13;i:21438;i:15;i:0;i:16;i:0;}i:476;a:11:{i:1;i:1282;i:2;i:21445;i:5;i:24399;i:6;i:24400;i:7;i:1291;i:8;i:21446;i:9;i:25260;i:11;i:1423;i:13;i:21447;i:15;i:0;i:16;i:0;}i:477;a:11:{i:1;i:1283;i:2;i:21442;i:5;i:24401;i:6;i:24402;i:7;i:1290;i:8;i:21443;i:9;i:25266;i:11;i:1422;i:13;i:21444;i:15;i:0;i:16;i:0;}i:478;a:9:{i:1;i:1284;i:2;i:21448;i:5;i:24403;i:6;i:24404;i:7;i:1292;i:8;i:21449;i:9;i:25272;i:15;i:0;i:16;i:0;}i:479;a:11:{i:1;i:1285;i:2;i:21450;i:5;i:24405;i:6;i:24406;i:7;i:1293;i:8;i:21451;i:9;i:25277;i:11;i:1424;i:13;i:21452;i:15;i:0;i:16;i:0;}i:480;a:9:{i:1;i:1286;i:2;i:21453;i:5;i:24407;i:6;i:24408;i:7;i:1294;i:8;i:21454;i:9;i:25283;i:15;i:0;i:16;i:0;}i:481;a:12:{i:1;i:1287;i:2;i:21455;i:5;i:24409;i:6;i:24410;i:7;i:1295;i:8;i:21456;i:9;i:25288;i:11;i:1425;i:12;i:1426;i:13;i:21457;i:15;i:0;i:16;i:0;}i:482;a:11:{i:1;i:1288;i:2;i:21439;i:5;i:24411;i:6;i:24412;i:7;i:1296;i:8;i:21440;i:9;i:25294;i:11;i:1427;i:13;i:21441;i:15;i:0;i:16;i:0;}}');

SQL;

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getVocabularyWorksheetData()
    {
        return include __DIR__ . '/__snapshots__/GoogleSpreadsheetTest__it_retrieves_the_data_for_a_worksheet__1.php';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getElementSetWorksheetData()
    {
        return include __DIR__ . '/__snapshots__/GoogleSpreadsheetTest__it_retrieves_the_data_for_an_elementset_worksheet__1.php';
    }

}
