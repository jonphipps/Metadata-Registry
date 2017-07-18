<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\ConceptAttribute;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class VocabularyTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function can_get_the_last_updated_statement()
    {
        $this->seed('RDAMediaTypeSeeder');
        $date = ConceptAttribute::getLatestDateForVocabulary(37);
        $this->assertSame((string) $date, '2015-10-29 11:09:17');
    }

    /** @test */
    public function it_updates_the_history_table_when_a_statement_is_added()
    {
        //given a new statement
        /** @var ConceptAttribute $concept */
        $concept = factory(ConceptAttribute::class)->create([ 'last_import_id' => 29, ]);
        //when it's added to the database
        //then a history table entry is added
        $concept->fresh('history');
        $this->assertEquals(1, $concept->history()->count());
        $this->assertEquals(29, $concept->history()->first()->import_id);
    }

    /** @test */
    public function it_updates_the_history_table_when_a_statement_is_changed()
    {
        $this->actingAs($this->admin);
        //given a new statement
        /** @var ConceptAttribute $concept */
        $concept = ConceptAttribute::first();
        $concept->update([ 'last_import_id' => 29, 'object' => 'angobango' ]);
        //when it's added to the database
        //then a history table entry is added
        $concept->fresh('history');
        $history             = $concept->history()->latest()->first();
        $history->created_at = null;
        $history->updated_at = null;
        $history->id         = null;

        $this->assertMatchesSnapshot($history->toArray());
    }

    /** @test */
    public function it_updates_the_history_table_when_a_statement_is_deleted()
    {
        $this->actingAs($this->admin);
        //given a new statement
        /** @var ConceptAttribute $concept */
        $concept = ConceptAttribute::first();
        $concept->delete();
        //when it's added to the database
        //then a history table entry is added
        $concept->fresh('history');
        $history             = $concept->history()->latest()->first();
        $history->created_at = null;
        $history->updated_at = null;
        $history->id         = null;

        $this->assertMatchesSnapshot($history->toArray());
    }
}
