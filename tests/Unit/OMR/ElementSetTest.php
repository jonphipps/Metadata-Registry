<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\ElementAttribute;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class ElementSetTest extends TestCase
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
        $this->seed('RDAClassesSeeder');
        $date = ElementAttribute::getLatestDateForElementSet(83);
        $this->assertSame((string) $date, '2017-02-10 11:58:57');
    }

    /** @test */
    public function it_updates_the_history_table_when_a_statement_is_added()
    {
        //given a new statement
        /** @var ElementAttribute $concept */
        $element = factory(ElementAttribute::class)->create([ 'last_import_id' => 29, ]);
        //when it's added to the database
        //then a history table entry is added
        $element->fresh('history');
        $this->assertEquals(1, $element->history()->count());
        $this->assertEquals(29, $element->history()->first()->import_id);
    }

    /** @test */
    public function it_updates_the_history_table_when_a_statement_is_changed()
    {
        $this->actingAs($this->admin);
        //given a new statement
        /** @var ElementAttribute $concept */
        $element = ElementAttribute::first();
        $element->update([ 'last_import_id' => 29, 'object' => 'angobango' ]);
        //when it's added to the database
        //then a history table entry is added
        $element->fresh('history');
        $this->assertEquals(3, $element->history()->count());
        $history             = $element->history()->latest()->first();
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
        /** @var ElementAttribute $concept */
        $element = ElementAttribute::first();
        $element->delete();
        //when it's added to the database
        //then a history table entry is added
        $element->fresh('history');
        $this->assertEquals(3, $element->history()->count());
        $history             = $element->history()->latest()->first();
        $history->created_at = null;
        $history->updated_at = null;
        $history->id         = null;

        $this->assertMatchesSnapshot($history->toArray());
    }
}
