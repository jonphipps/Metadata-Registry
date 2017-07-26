<?php
/** @noinspection ReturnTypeCanBeDeclaredInspection */
namespace Tests\Feature\OMR;

use App\Jobs\ImportVocabulary;
use App\Models\Batch;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\Export;
use App\Models\Import;
use App\Models\Project;
use Carbon\Carbon;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;
use function factory;

class ImportTest extends TestCase
{
    //use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
      $this->dontSetupDatabase();
      parent::setUp();
    }

    /** @test */
    public function a_spreadsheet_import_can_import_multiple_exports_at_the_project_level()
    {
        //given there are multiple exports for a project
        $import  = factory(Import::class)->create([ 'created_at' => Carbon::now()->subDay(2) ]);
        $import2 = factory(Import::class)->create([ 'created_at' => Carbon::now() ]);
        $project = Project::findOrFail(177);
        /** @var Batch $batch */
        $batch  = factory(Batch::class)->create(['project_id' => 177]);
        $batch->addImports([ $import, $import2 ]);
        $export = Export::first();
        $export->addImports([ $import, $import2 ]);

        //when I ask for a list of all of the imports related to an export
        $AllImports     = $export->imports;
        $projectImports = $project->imports;
        //then I can see that there are multiple imports
        $this->assertCount(2, $projectImports);
        $this->assertCount(2, $AllImports);
    }

    /** @test */
    public function I_can_get_the_latest_import_for_an_export()
    {
        //there are no imports yet
        /** @var Export $export */
        $export       = create(Export::class);
        $latestImport = $export->getLatestImport();
        $this->assertNull($latestImport);

        //given there are multiple imports fro an export
        $import  = create(Import::class, [ 'created_at' => Carbon::now()->subDay(2) ]);
        $import2 = create(Import::class, [ 'created_at' => Carbon::now() ]);
        $export->addImports([ $import, $import2 ]);

        //and I can get the latest one
        $latestImport = $export->getLatestImport();
        $this->assertSame($latestImport->id, $import2->id);
    }

    /** @test */
    public function a_changeset_should_have_update_delete_and_addition_sections()
    {
        //given an import with a changeset
        //when
        //then the changeset should have all of the instructions
    }
    /** @test */
    public function a_changeset_can_update_and_add_an_elementset_resource()
    {
        $this->actingAs($this->admin);
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        $export = Export::findByExportFileName('rdac_en-fr_20170511T182904_570_0.csv');
        //given an import with a changeset
        $import = factory(Import::class)->create([
            'vocabulary_id' => null,
            'schema_id'     => 83,
            'source'        => 'Google',
            'instructions'  => $this->getChangeSet(),
        ]);
        //when I run the import job
        dispatch(new ImportVocabulary($import->id));
        //then I should see the changes in the database
        $lexical = ElementAttribute::withTrashed()->find(128175);
        $this->assertNotNull($lexical->deleted_at);
        $this->assertEquals($lexical->deleted_user_id, 1);
        $this->assertDatabaseHas(ElementAttribute::TABLE,
            [
                'id'              => 180596,
                'object'          => 'foobar',
                'updated_user_id' => 1,
                'last_import_id'  => $import->id,
            ]);
        //assert that the value of name, language french, is bingo
        $this->assertDatabaseHas(ElementAttribute::TABLE,
            [
                'object'              => 'bingo',
                'language'            => 'fr',
                'schema_property_id'  => 14335,
                'profile_property_id' => 1,
                'created_user_id'     => 1,
                'updated_user_id'     => 1,
                'last_import_id' => $import->id,
            ]);
        //this is the add part
        $element = Element::with('statements')->where('name', 'EnglishName')->first();
        $element->created_at = null;
        $element->updated_at = null;
        $element->statements->map(function($values){
            $values['created_at'] = null;
            $values['updated_at'] = null;
            $values['last_import_id'] = null;
            return $values;
        });
        $this->assertMatchesSnapshot($element->toArray());
    }

     /** @test */
    public function a_changeset_can_update_vocabulary_statements()
    {
        $this->actingAs($this->admin);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0.csv');
        //given an import with a changeset
        $import = factory(Import::class)->create([
            'vocabulary_id' => 37,
            'schema_id'     => null,
            'source'        => 'Google',
            'instructions'  => $this->getVocabChangeSet(),
        ]);
        //when I run the import job
        dispatch(new ImportVocabulary($import->id));
        //then I should see the changes in the database
        $lexical = ConceptAttribute::withTrashed()->find(24412);
        $this->assertNotNull($lexical->deleted_at);
        $this->assertEquals(1, $lexical->deleted_by);
        $this->assertDatabaseHas(ConceptAttribute::TABLE,
            [
                'id'              => 24411,
                'object'          => 'foobar',
                'updated_user_id' => 1,
            ]);
        //assert that the value of name, language french, is bingo
        $this->assertDatabaseHas(ConceptAttribute::TABLE,
            [
                'object'              => 'bingo',
                'language'            => 'fr',
                'concept_id'          => 482,
                'profile_property_id' => 34,
                'created_user_id'     => 1,
                'updated_user_id'     => 1,
            ]);
    }

    /** @test */
    public function a_changeset_can_update_and_add_a_vocabulary_resource()
    {
        $this->actingAs($this->admin);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0.csv');
        //given an import with a changeset
        $changeset = $this->getVocabChangeSet();
        $changeset['update'][482]['*preferred label[0]_en'] = [
            'language'     => 'en',
            'new value'    => 'fubar',
            'old value'    => 'video',
            'property_id'  => '45',
            'statement_id' => 1288,
            'updated_at'   => null,
        ];
        $changeset['update'][482]['*preferred label[0]_fr'] = [
            'language'     => 'fr',
            'new value'    => 'foobar',
            'old value'    => 'vidéo',
            'property_id'  => '45',
            'statement_id' => 21439,
            'updated_at'   => null,
        ];
        $changeset['update'][482]['*uri'] = [
            'language'     => '',
            'new value'    => 'http://rdaregistry.info/termList/RDAMediaType/9999',
            'old value'    => 'http://rdaregistry.info/termList/RDAMediaType/1008',
            'property_id'  => '62',
            'statement_id' => null,
            'updated_at'   => null,
        ];
        $changeset['update'][482]['*status'] = [
            'language'     => '',
            'new value'    => 'Deprecated',
            'old value'    => 'Published',
            'property_id'  => '59',
            'statement_id' => null,
            'updated_at'   => null,
        ];
        $import = factory(Import::class)->create([
            'vocabulary_id' => 37,
            'schema_id'     => null,
            'source'        => 'Google',
            'instructions'  => $changeset,
        ]);
        //when I run the import job
        dispatch(new ImportVocabulary($import->id));
        //then I should see the changes in the database
        $concept = Concept::find(482);
        $this->assertSame('fubar', $concept->pref_label);
        $this->assertSame(1288, $concept->pref_label_id);
        $this->assertSame('http://rdaregistry.info/termList/RDAMediaType/9999', $concept->uri);
        $this->assertSame(8, $concept->status_id);
        $this->assertSame(1, $concept->updated_user_id);
        //this is the add part
        $element             = Concept::with('statements')->where('pref_label', 'foobar')->first();
        $element->created_at = null;
        $element->updated_at = null;
        $element->statements->map(function($values) {
            $values['created_at'] = null;
            $values['updated_at'] = null;
            $values['last_import_id'] = null;
            return $values;
        });
        $this->assertMatchesSnapshot($element->toArray());
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getChangeSet()
    {
        return include __DIR__ .
            '/../../Unit/OMR/__snapshots__/DataImporterTest__it_builds_a_changeset_for_an_elementset_that_includes_update_and_add_and_delete__1.php';
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    private function getVocabChangeSet()
    {
        return include __DIR__ .
            '/../../Unit/OMR/__snapshots__/DataImporterTest__it_builds_a_changeset_for_a_vocabulary_that_includes_update_and_add_and_delete__1.php';
    }
}
