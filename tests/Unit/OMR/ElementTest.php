<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class ElementTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_can_update_an_element_from_existing_statements()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        //given a concept with updated statements
        $element = Element::first();
        $statements = $element->statements;
        /** @var ElementAttribute $label */
        $label =$statements->where('profile_property_id', 2)->where('language', 'English')->first();
        $label->object = 'foobar';
        $label->save();
        //when i update it from existing statements
        $element->updateFromStatements();
        //then the concept is updated
        $this->assertSame('foobar', $element->label);
    }
}
