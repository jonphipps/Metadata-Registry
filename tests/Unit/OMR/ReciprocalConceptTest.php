<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class ReciprocalConceptTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test reciprocal */
    public function when_a_concept_attribute_is_created_that_has_a_reciprocal_profile_property_then_a_reciprocal_is_generated_if_i_own_the_vocabulary()
    {
        $this->actingAs($this->admin);
        $statementCount = ConceptAttribute::count();
        $historyCount = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement = factory(ConceptAttribute::class)->states('resource', 'has_reciprocal')->create([
                'created_user_id' => $this->admin->id,
                'updated_user_id' => $this->admin->id,
            ]);
        //then then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount+2, ConceptAttribute::count());
        $this->assertEquals($historyCount+2, ConceptAttributeHistory::count());
        $this->assertEquals($statement->id, $reciprocal->reciprocal_concept_property_id);
        $this->assertEquals($statement->concept_id, $reciprocal->related_concept_id);
        $this->assertEquals($statement->related_concept_id, $reciprocal->concept_id);
        $this->assertEquals($statement->profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
    }

    /** @test inverse */
    public function when_a_concept_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_generated_if_i_own_the_vocabulary()
    {
        $this->actingAs($this->admin);
        $statementCount = ConceptAttribute::count();
        $historyCount   = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement = factory(ConceptAttribute::class)->states('resource', 'has_inverse')->create([
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        $profileProperty = $statement->profile_property;
        //then then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ConceptAttribute::count());
        $this->assertEquals($historyCount + 2, ConceptAttributeHistory::count());
        $this->assertEquals($statement->id, $reciprocal->reciprocal_concept_property_id);
        $this->assertEquals($statement->concept_id, $reciprocal->related_concept_id);
        $this->assertEquals($statement->related_concept_id, $reciprocal->concept_id);
        $this->assertEquals($profileProperty->inverse_profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
    }

    /** @test inverse */
    public function when_a_concept_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_NOT_generated_if_i_DONT_OWN_the_vocabulary()
    {
        $this->actingAs($this->user);
        $statementCount = ConceptAttribute::count();
        $historyCount   = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement       = factory(ConceptAttribute::class)->states('resource', 'has_inverse')->create([
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);
        //then then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 1, ConceptAttribute::count());
        $this->assertEquals($historyCount + 1, ConceptAttributeHistory::count());
        $this->assertNull($reciprocal);
        $this->assertNull($statement->review_reciprocal);
    }

    /** @test inverse */
    public function when_a_concept_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_NOT_generated_if_the_resource_is_UNKNOWN()
    {
        $this->actingAs($this->user);
        $statementCount = ConceptAttribute::count();
        $historyCount   = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement       = factory(ConceptAttribute::class)->states('resource', 'has_inverse')->create(['object'=> 'http://foobar.com', 'related_concept_id' => null]);
        //then then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 1, ConceptAttribute::count());
        $this->assertEquals($historyCount + 1, ConceptAttributeHistory::count());
        $this->assertNull($reciprocal);
        $this->assertTrue($statement->review_reciprocal);
    }


    /** @test reciprocal */
    public function when_a_statement_is_deleted_then_its_reciprocal_is_deleted_too()
    {
        $this->actingAs($this->admin);
        $statementCount = ConceptAttribute::count();
        $historyCount   = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement = factory(ConceptAttribute::class)->states('resource', 'has_reciprocal')->create([
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        //then then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = ConceptAttribute::find($statement->reciprocal_concept_property_id);
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ConceptAttribute::count());
        $this->assertEquals($historyCount + 2, ConceptAttributeHistory::count());
        $this->assertNotNull($reciprocal);
        $statement->delete();
        $reciprocal = ConceptAttribute::find($reciprocal->id);
        $this->assertNull($reciprocal);
        $this->assertEquals($statementCount, ConceptAttribute::count());
        $this->assertEquals($historyCount + 4, ConceptAttributeHistory::count());
    }


    /** @test inverse */
    public function when_a_statement_object_value_is_changed_then_the_reciprocal_is_deleted_and_a_new_one_generated_unless_it_would_create_a_duplicate()
    {
        $this->actingAs($this->admin);
        $statementCount = ConceptAttribute::count();
        $historyCount   = ConceptAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ConceptAttribute $statement */
        $statement = factory(ConceptAttribute::class)->states('resource', 'has_inverse')->create([
            'object'             => 'http://rdaregistry.info/termList/RDAMediaType/1004',
            'related_concept_id' => 478,
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        $profileProperty = $statement->profile_property;
        //then a new reciprocal is added to the database
        /** @var ConceptAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ConceptAttribute::count());
        $this->assertEquals($historyCount + 2, ConceptAttributeHistory::count());
        $this->assertNotNull($reciprocal);
        $this->assertEquals($statement->related_concept_id, $reciprocal->concept_id);
        //update the statement
        $statement->update(['object' => 'http://rdaregistry.info/termList/RDAMediaType/1001']);
        //ding dong the old reciprocal is dead
        $reciprocal = ConceptAttribute::find($reciprocal->id);
        $this->assertNull($reciprocal);
        //get the new reciprocal
        $reciprocal = $statement->reciprocal;
        $this->assertEquals($statement->id, $reciprocal->reciprocal_concept_property_id);
        $this->assertEquals($statement->concept_id, $reciprocal->related_concept_id);
        $this->assertEquals($statement->related_concept_id, $reciprocal->concept_id);
        $this->assertEquals($profileProperty->inverse_profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
        //statement count increase should be the same as before
        $this->assertEquals($statementCount + 2, ConceptAttribute::count());
        //history count should increase by 2
        $this->assertEquals($historyCount + 4, ConceptAttributeHistory::count());
    }

}
