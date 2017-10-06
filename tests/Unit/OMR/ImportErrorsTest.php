<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Exceptions\DuplicatePrefLabelException;
use App\Exceptions\MissingRequiredAttributeException;
use App\Exceptions\UnknownAttributeException;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use App\Models\Export;
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
        //then then a duplicate preflabel is added to the database
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
    public function it_returns_an_error_if_required_attributes_are_missing()
    {
        $this->expectException(MissingRequiredAttributeException::class);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
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
        //then i get an exception
    }

    /** @test */
    public function it_returns_an_error_if_there_are_unknown_attributes()
    {
        $this->expectException(UnknownAttributeException::class);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a data set pulled from a worksheet
        $data = collect($this->getVocabularyWorksheetData());
        //remove the URI and status columns
        $data   = $data->map(function($item, $key) {
            $item[17]='foobar';
            return $item;
        });
        $export = Export::findByExportFileName('RDAMediaType_en-fr_20170511T172922_569_0');
        //and an export map
        $importer = new DataImporter($data, $export);
        //when i pass them to the importer
        $changeSet = $importer->getChangeset();
        //then i get an exception
    }
}
