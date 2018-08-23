<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementAttributeHistory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class ReciprocalElementTest extends TestCase
{
    use DatabaseTransactions;
    use MatchesSnapshots;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test reciprocal */
    public function when_an_element_attribute_is_created_that_has_a_reciprocal_profile_property_then_a_reciprocal_is_generated_if_i_own_the_vocabulary()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_reciprocal')->create([
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount+2, ElementAttribute::count());
        $this->assertEquals($historyCount+2, ElementAttributeHistory::count());
        $this->assertEquals($statement->id, $reciprocal->reciprocal_property_element_id);
        $this->assertEquals($statement->schema_property_id, $reciprocal->related_schema_property_id);
        $this->assertEquals($statement->related_schema_property_id, $reciprocal->schema_property_id);
        $this->assertEquals($statement->profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
    }

    /** @test inverse */
    public function when_an_element_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_generated_if_i_own_the_vocabulary()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_inverse')->create([
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        $profileProperty = $statement->profile_property;
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ElementAttribute::count());
        $this->assertEquals($historyCount + 2, ElementAttributeHistory::count());
        $this->assertEquals($statement->id, $reciprocal->reciprocal_property_element_id);
        $this->assertEquals($statement->schema_property_id, $reciprocal->related_schema_property_id);
        $this->assertEquals($statement->related_schema_property_id, $reciprocal->schema_property_id);
        $this->assertEquals($profileProperty->inverse_profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
    }

    /** @test inverse */
    public function when_an_element_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_NOT_generated_if_i_DONT_OWN_the_vocabulary()
    {
        $this->actingAs($this->user);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement       = factory(ElementAttribute::class)->states('resource', 'has_inverse')->create([
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 1, ElementAttribute::count());
        $this->assertEquals($historyCount + 1, ElementAttributeHistory::count());
        $this->assertNull($reciprocal);
        $this->assertNull($statement->review_reciprocal);
    }

    /** @test inverse */
    public function when_an_element_attribute_is_created_that_has_an_inverse_profile_property_then_a_reciprocal_is_NOT_generated_if_the_resource_is_UNKNOWN()
    {
        $this->actingAs($this->user);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement       = factory(ElementAttribute::class)->states('resource', 'has_inverse')->create(['object'=> 'http://foobar.com', 'related_schema_property_id' => null]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 1, ElementAttribute::count());
        $this->assertEquals($historyCount + 1, ElementAttributeHistory::count());
        $this->assertNull($reciprocal);
        $this->assertTrue($statement->review_reciprocal);
    }


    /** @test reciprocal */
    public function when_a_statement_is_deleted_then_its_reciprocal_is_deleted_too()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_reciprocal')->create([
            'created_user_id' => $this->admin->id,
            'updated_user_id' => $this->admin->id,
        ]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = ElementAttribute::find($statement->reciprocal_property_element_id);
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ElementAttribute::count());
        $this->assertEquals($historyCount + 2, ElementAttributeHistory::count());
        $this->assertNotNull($reciprocal);
        $statement->delete();
        $reciprocal = ElementAttribute::find($reciprocal->id);
        $this->assertNull($reciprocal);
        $this->assertEquals($statementCount, ElementAttribute::count());
        $this->assertEquals($historyCount + 4, ElementAttributeHistory::count());
    }


    /** @test inverse */
    public function when_a_statement_object_value_is_changed_then_the_reciprocal_is_deleted_and_a_new_one_generated_unless_it_would_create_a_duplicate()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_inverse')->create([
            'object'                     => 'http://rdaregistry.info/Elements/c/C10001',
            'related_schema_property_id' => 14328,
            'created_user_id'            => $this->admin->id,
            'updated_user_id'            => $this->admin->id,
        ]);
        $profileProperty = $statement->profile_property;
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ElementAttribute::count());
        $this->assertEquals($historyCount + 2, ElementAttributeHistory::count());
        $this->assertNotNull($reciprocal);
        $this->assertEquals($statement->related_schema_property_id, $reciprocal->schema_property_id);
        //update the statement
        $statement->update(['object' => 'http://rdaregistry.info/Elements/c/C10002']);
        //ding dong the old reciprocal is dead
        $reciprocal = ElementAttribute::find($reciprocal->id);
        $this->assertNull($reciprocal);
        //get the new reciprocal
        $reciprocal = $statement->reciprocal;
        $this->assertEquals($statement->id, $reciprocal->reciprocal_property_element_id);
        $this->assertEquals($statement->schema_property_id, $reciprocal->related_schema_property_id);
        $this->assertEquals($statement->related_schema_property_id, $reciprocal->schema_property_id);
        $this->assertEquals($profileProperty->inverse_profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
        //statement count increase should be the same as before
        $this->assertEquals($statementCount + 2, ElementAttribute::count());
        //history count should increase by 2
        $this->assertEquals($historyCount + 4, ElementAttributeHistory::count());
    }

    /** @test inverse */
    public function when_an_element_attribute_is_created_that_has_an_reciprocal_profile_property_then_a_reciprocal_is_NOT_generated_if_the_project_does_not_allow_generation()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        $element = factory(Element::class)->create();

        //given a project with the generate_statements atrribute set to false
        $project                      = $element->elementset->project;
        $project->generate_statements = false;
        $project->save();

        //given a new statement with a reciprocal property (has broader)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_reciprocal')->create([
            'created_user_id'    => $this->admin->id,
            'updated_user_id'    => $this->admin->id,
            'schema_property_id' => $element->id,
        ]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 1 and only 1 attributes
        $this->assertEquals($statementCount + 1, ElementAttribute::count());
        $this->assertEquals($historyCount + 1, ElementAttributeHistory::count());
        $this->assertNull($reciprocal);
        $this->assertNull($statement->review_reciprocal);
    }

    /** @test reciprocal */
    public function when_an_element_attribute_is_created_that_has_a_reciprocal_profile_property_then_a_reciprocal_is_generated__if_the_project_allows_generation()
    {
        $this->actingAs($this->admin);
        $statementCount = ElementAttribute::count();
        $historyCount   = ElementAttributeHistory::count();
        $element        = factory(Element::class)->create();

        //given a project with the generate_statements atrribute set to false
        $project                      = $element->elementset->project;
        $project->generate_statements = true;
        $project->save();

        //given a new statement with a reciprocal property (owl:sameAs)
        /** @var ElementAttribute $statement */
        $statement = factory(ElementAttribute::class)->states('resource', 'has_reciprocal')->create([
            'created_user_id'    => $this->admin->id,
            'updated_user_id'    => $this->admin->id,
            'schema_property_id' => $element->id,
        ]);
        //then a new reciprocal is added to the database
        /** @var ElementAttribute $reciprocal */
        $reciprocal = $statement->reciprocal;
        //we should have created 2 and only 2 attributes
        $this->assertEquals($statementCount + 2, ElementAttribute::count());
        $this->assertEquals($historyCount + 2, ElementAttributeHistory::count());
        $this->assertEquals($statement->id, $reciprocal->reciprocal_property_element_id);
        $this->assertEquals($statement->schema_property_id, $reciprocal->related_schema_property_id);
        $this->assertEquals($statement->related_schema_property_id, $reciprocal->schema_property_id);
        $this->assertEquals($statement->profile_property_id, $reciprocal->profile_property_id);
        $this->assertTrue($reciprocal->is_generated);
    }
}
