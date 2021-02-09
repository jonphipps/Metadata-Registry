<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class ConceptTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_can_update_a_concept_from_existing_statements()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);
        //given a concept with updated statements
        $concept = Concept::first();
        $concept->pref_label_id = null;
        $statements = $concept->statements;
        /** @var ConceptAttribute $prefLabel */
        $prefLabel =$statements->where('profile_property_id', 45)->where('language', 'en')->first();
        $prefLabel->object = 'foobar';
        $prefLabel->save();
        //when i update it from existing statements
        $concept->updateFromStatements();
        //then the concept is updated
        $this->assertSame('foobar', $concept->pref_label);
        $this->assertSame($prefLabel->id, $concept->pref_label_id);
    }

    /** @test */
    public function a_related_statement_can_be_referenced()
    {
        $this->actingAs($this->admin);
        //given a new statement with a reciprocal property (has broader)
        $statement = factory(ConceptAttribute::class)->states('resource', 'has_reciprocal')->create();
        //when it is added
        //then a new related is added to the database
        $related = $statement->related_concept;
        self::assertEquals($related->id, $statement->related_concept_id);
    }

}
