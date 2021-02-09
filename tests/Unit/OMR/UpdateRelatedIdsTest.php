<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Jobs\UpdateRelatedIds;
use App\Models\Batch;
use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementAttributeHistory;
use App\Models\Import;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class UpdateRelatedIdsTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_can_update_the_related_concept_ids_for_an_import_batch()
    {
        $this->actingAs($this->admin);
        //create a batch
        $batch = factory(Batch::class)->create();
        //create an import for the batch
        /** @var Import $import */
        $import = factory(Import::class)->create([ 'batch_id' => $batch->id ]);
        //create a statement for the import that has a related URI, but no related id
        /** @var Concept $concept */
        $concept = Concept::first();
        /** @var Element $element */
        $element = Element::first();
        /** @var ConceptAttribute $statement */
        $statement =
            factory(ConceptAttribute::class)
                ->states('resource', 'has_reciprocal')
                ->create([ 'last_import_id' => $import->id, 'related_concept_id' => null, 'object' => $concept->uri ]);
        $history = $statement->history()->first();
        /** @var ElementAttribute $statement2 */
        $statement2 =
            factory(ElementAttribute::class)
                ->states('resource', 'has_reciprocal')
                ->create([ 'last_import_id' => $import->id, 'related_schema_property_id' => null, 'object' => $element->uri ]);
        $history2 = $statement2->history()->first();
        //pass the batch to the updateRelatedIds job
        $elementHistoryCount = ElementAttributeHistory::count();
        $conceptHistoryCount = ConceptAttributeHistory::count();
        dispatch(new UpdateRelatedIds($batch));
        //see the statement now has a uri
        self::assertEquals($concept->id, $statement->fresh()->related_concept_id);
        self::assertEquals($element->id, $statement2->fresh()->related_schema_property_id);
        //it shouldn't make a new history entry
        self::assertEquals($conceptHistoryCount, ConceptAttributeHistory::count());
        self::assertEquals($elementHistoryCount, ElementAttributeHistory::count());
        //the history should be updated
        self::assertEquals($concept->id, $history->fresh()->related_concept_id);
        self::assertEquals($element->id, $history2->fresh()->related_schema_property_id);
    }

    /** @test */
    public function it_can_ignore_the_related_concept_ids_for_an_import_batch_when_not_a_registry_resource()
    {
        //create a batch
        $batch = factory(Batch::class)->create();
        //create an import for the batch
        /** @var Import $import */
        $import = factory(Import::class)->create([ 'batch_id' => $batch->id ]);
        //create a statement for the import that has a related URI, but no related id
        /** @var ConceptAttribute $statement */
        $statement =
            factory(ConceptAttribute::class)
                ->states('resource', 'has_reciprocal')
                ->create([ 'last_import_id'     => $import->id,
                           'related_concept_id' => null,
                           'object'             => 'http://example.com/foobar'
                ]);
        /** @var ElementAttribute $statement2 */
        $statement2 =
            factory(ElementAttribute::class)
                ->states('resource', 'has_reciprocal')
                ->create([ 'last_import_id'             => $import->id,
                           'related_schema_property_id' => null,
                           'object'                     => 'http://example.com/foobar'
                ]);
        //pass the batch to the updateRelatedIds job
        dispatch(new UpdateRelatedIds($batch));
        //see the statement relationship is still null
        self::assertEquals(null, $statement->fresh()->related_concept_id);
        self::assertEquals(null, $statement2->fresh()->related_schema_property_id);
    }
}
