<?php

namespace Tests\Browser;

use App\Models\Project;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ProjectList;
use Tests\Browser\Pages\ProjectPage;
use Tests\Traits\TestData;
use Tests\DuskTestCase;

class GuestTest extends DuskTestCase
{
    use TestData;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testHappyPath()
    {
        /** @var Project $project */
        //$project = factory( Project::class )->create(['is_private' => false]);
        $testData = self::getTestData();

        $this->browse( function( Browser $browser ) use ( $testData ) {
            $browser->visit( new ProjectList() )->assertSee( 'Projects' )
                ->type( '#crudTable_filter > label > input', 'ala')
                ->assertSee( $testData['project']['title'] )
                ->clickLink( $testData['project']['title'])
                ->assertPathIs( "/projects/{$testData['project']['id']}")
                ->assertSeeIn( 'h1', $testData['project']['title'])

                //vocabulary
                ->assertSee( $testData['vocabulary']['title'] )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]')
                ->clickLink( $testData['vocabulary']['title'] )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/concepts" )
                ->assertSeeIn( 'h1', $testData['vocabulary']['title'] )

                //vocabulary tabs
                ->clickLink( 'Details' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/history" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Versions' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/versions" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Maintainers' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/maintainers" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Exports' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/exports" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Imports' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/imports" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

                //vocabulary pages
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/imports/{$testData['vocabulary']['importId']}" )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/imports/{$testData['vocabulary']['importId']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History' )
                ->assertPathIs( "/imports/{$testData['vocabulary']['importId']}/history" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/exports/{$testData['vocabulary']['exportId']}" )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/exports/{$testData['vocabulary']['exportId']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/exports" )
                ->clickLink( 'Create New Export' )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/exports/create" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/maintainers/{$testData['vocabulary']['maintainerId']}" )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/maintainers/{$testData['vocabulary']['maintainerId']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

                //concepts
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/concepts/{$testData['concept']['id']}" )
                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}/concepts/{$testData['concept']['id']}" )
                ->assertSee( $testData['concept']['title'] )
                ->clickLink( 'Properties' )
                ->assertPathIs( "/concepts/{$testData['concept']['id']}/properties" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History' )
                ->assertPathIs( "/concepts/{$testData['concept']['id']}/history" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

                //concept pages
                ->visit( "/concepts/{$testData['concept']['id']}/properties" )
                ->clickLink( 'preferred label' )
                ->assertPathIs( "/concepts/{$testData['concept']['id']}/properties/{$testData['concept']['preferredLabelId']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History' )
                ->assertPathIs( "/properties/{$testData['concept']['preferredLabelId']}/history" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

                //rdf
                ->visit( "/vocabularies/{$testData['vocabulary']['id']}/concepts/{$testData['concept']['id']}" )
                ->clickLink( 'Get RDF' )
                ->assertPathIs( "/concept/show/id/{$testData['concept']['id']}.rdf" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->visit( "/concept/show/id/{$testData['concept']['id']}.xsd" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

//                ->visit( "/vocabularies/{$testData['vocabulary']['id']}" )
//                ->clickLink( 'Get RDF'
// this downloads a file and returns to the detail page and isn't easily testable in dusk
// need to mock the file system
//                ->assertPathIs( "/vocabularies/{$testData['vocabulary']['id']}" )
//                ->assertDontSee( '[sfException]' )

                //elementset
                ->visit( "/projects/{$testData['project']['id']}" )
                ->assertPathIs( "/projects/{$testData['project']['id']}" )
                ->assertSee( $testData['elementSet']['title'] )
                ->clickLink( $testData['elementSet']['title'] )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/elements" )
                ->assertSeeIn( 'h1', $testData['elementSet']['title'] )

                //elementsettabs
                ->clickLink( 'Details' )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History' )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/history" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Maintainers' )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/maintainers" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Exports' )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/exports" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'Imports' )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/imports" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )

                //pages
                ->visit( "/elementsets/{$testData['elementSet']['id']}/imports/{$testData['elementSet']['importId']}" )
                ->assertPathIs( "/elementsets/{$testData['elementSet']['id']}/imports/{$testData['elementSet']['importId']}" )
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' )
                ->clickLink( 'History')
                ->assertPathIs( "/schemaimports/{$testData['elementSet']['importId']}/history")
                ->assertDontSee( 'The server returned a 404 response.' )
                ->assertDontSee( '[sfException]' );

        } );
    }
}
