<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Exceptions\DuplicateAttributesException;
use App\Exceptions\DuplicatePrefLabelException;
use App\Exceptions\MissingRequiredAttributeException;
use App\Exceptions\UnknownAttributeException;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use App\Models\Export;
use App\Models\ProfileProperty;
use App\Models\Vocabulary;
use App\Services\Import\DataImporter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;
use Tests\Unit\Traits\UsesWorksheetData;

class ImportErrorsTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots, UsesWorksheetData;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test duplicate prefLabel */
    public function a_concept_cannot_have_the_same_preflabel_language_combination_as_another_concept()
    {
        $this->markTestIncomplete('this needs to be reimplemented');
        $this->expectException(DuplicatePrefLabelException::class);
        $this->actingAs($this->admin);
        $concept1 = factory(Concept::class)->create([ 'vocabulary_id' => 37]);
        $concept2 = factory(Concept::class)->create([ 'vocabulary_id' => 37]);
        /** @var ConceptAttribute $statement */
        $statement =
            factory(ConceptAttribute::class)->states('prefLabel')->create([
                'object'             => 'foobar',
                'language'           => 'en',
                'related_concept_id' => null,
                'concept_id'      => $concept1->id,
            ]);
        //then a duplicate preflabel is added to the database
        $statement2 =
            factory(ConceptAttribute::class)->states('prefLabel')->create([
                'object'             => 'foobar',
                'language'           => 'en',
                'related_concept_id' => null,
                'concept_id' => $concept2->id,
            ]);
        //we should see an exception thrown
    }
    /** @test not duplicate prefLabel */
    public function a_concept_can_have_the_same_preflabel_language_combination_as_another_concept_if_vocabs_are_different()
    {
        $this->actingAs($this->admin);
        $vocabulary = factory(Vocabulary::class)->create();
        $concept1 = factory(Concept::class)->create([ 'vocabulary_id' => 37]);
        $concept2 = factory(Concept::class)->create([ 'vocabulary_id' => $vocabulary->id]);
        /** @var ConceptAttribute $statement */
        $statement =
            factory(ConceptAttribute::class)->states('prefLabel')->create([
                'object'             => 'forbar',
                'language'           => 'en',
                'related_concept_id' => null,
                'concept_id'      => $concept1->id,
            ]);
        //then a duplicate preflabel is added to the database
        $statement2 =
            factory(ConceptAttribute::class)->states('prefLabel')->create([
                'object'             => 'forbar',
                'language'           => 'en',
                'related_concept_id' => null,
                'concept_id' => $concept2->id,
            ]);
        //we should not see an exception thrown
        $this->assertNotNull($statement2->id);
    }

    /** @test */
    public function it_returns_an_error_if_required_attribute_columns_are_missing()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //change the profile
        $prop = ProfileProperty::find(59);
        /** @var ProfileProperty */
        $prop->is_required = 1;
        $prop->save();
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        //remove the URI and status columns
        $data = $data->map(function($item, $key){
            unset($item[15], $item[16]);
            return $item;
        });
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get an error
        $this->assertSame('The required attribute columns: "*uri", "*status" ...are missing',
            $importer->getErrors()['fatal']);
        $this->assertSame($changeSet->count(), 0);
    }

    /** @test */
    public function it_returns_an_error_if_individual_required_attribute_values_are_missing()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //change the profile
        $prop = ProfileProperty::find(59);
        /** @var ProfileProperty */
        $prop->is_required = 1;
        $prop->save();
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        //remove the status value from the last row
        $foo = $data->pop();
        $foo[16] = '';
        $data->push($foo);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        $this->assertNull($changeSet->get('add')->first()->get('*status')['new value']);
        $errors = collect([ 'new row: 0','*status','[ERROR: Empty required attribute]','Row Fatal']);
        $this->assertEquals($errors, $importer->getErrors()['row'][0]);
    }

    /** @test */
    public function it_does_NOT_return_an_error_if_required_attribute_columns_are_missing_and_the_profile_was_changed_after_the_export(): void
    {
        $this->artisan('db:seed', ['--class' => 'RDAMediaTypeSeeder']);
        //change the profile
        $prop = ProfileProperty::find(59);
        /** @var ProfileProperty */
        $prop->is_required = 0;
        $prop->save();
        //given a data set pulled from a worksheet
        $data = collect($this->getVocabularyWorksheetData());
        //remove the URI and status columns
        $data   = $data->map(function ($item, $key) {
            unset($item[15], $item[16]);

            return $item;
        });
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get an error
        $this->assertSame('The required attribute column: "*uri" ...is missing',
            $importer->getErrors()['fatal']);
        $this->assertSame($changeSet->count(), 0);
    }

    /** @test */
    public function it_DOES_NOT_return_an_error_if_individual_required_attribute_values_are_missing_and_the_profile_was_changed_after_the_export()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);

        //change the profile to make status not required
        $prop = ProfileProperty::find(59);
        /** @var ProfileProperty */
        $prop->is_required = 0;
        $prop->save();

        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        //remove the status value from the last row
        $foo = $data->pop();
        $foo[16] = '';
        $data->push($foo);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        $this->assertNotSame($changeSet->get('add')->first()->get('*status')['new value'],
            '[ERROR: Empty required attribute]');
        $this->assertCount(0, $importer->getErrors());
    }

    /** @test */
    public function it_returns_an_error_if_individual_attribute_values_contain_an_unknown_prefix()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a data set pulled from a worksheet
        $data   = collect($this->getVocabularyWorksheetData());
        //remove the status value from the last row
        $foo = $data->pop();
        $foo[15] = 'foo:1009';
        $data->push($foo);
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        $errors = collect([ 'new row: 0','*uri','[ERROR: \'foo\' is an unregistered prefix and cannot be expanded to form a full URI]','warning']);
        $this->assertEquals($errors, $importer->getErrors()['row'][0]);
    }

    /** @test */
    public function it_returns_an_error_if_there_are_unknown_attributes()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a data set pulled from a worksheet
        $data = collect($this->getVocabularyWorksheetData());
        //add a foobar column
        $data   = $data->map(function($item, $key) {
            $item[17]='foobar';
            return $item;
        });
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get an error
        $this->assertSame('The column: "foobar" ...is unknown and need to be registered with the Profile',
            $importer->getErrors()['fatal']);
        $this->assertSame($changeSet->count(), 0);
    }

    /** @test */
    public function it_returns_an_error_if_there_are_duplicate_attributes()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a data set pulled from a worksheet
        $data = collect($this->getVocabularyWorksheetData());
        //duplicate the reg_id column
        $data   = $data->map(function($item, $key) {
            $item[17]='reg_id';
            return $item;
        });
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get an error
        $this->assertSame('"reg_id" is a duplicate attribute column. Columns cannot be duplicated',
            $importer->getErrors()['fatal']);
        $this->assertSame($changeSet->count(), 0);
    }
}
