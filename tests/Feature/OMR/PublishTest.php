<?php

namespace Tests\Feature\OMR;

use App\Jobs\Publish;
use App\Models\Access\User\User;
use App\Models\Releasable;
use App\Models\Release;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishTest extends TestCase
{
    public function setUp(): void
    {
        $this->dontSetupDatabase();

        parent::setUp();
    }

    /** Things to test:
     * whole life cycle -- grab an empty repo, generate files, push to repo, pull from repo, generate files with changes, push to repo
     * before we have files -- can we access the repo?
     * after we have files... can we commit them? Can we tag them and push them to github? Can we make a release on github and associate it with the tag?
     * what if there's no github repo? We should have a way to zip up the files and download them
     */


    /** @test */
    public function publish_creates_multiple_files_for_a_project()
    {
        $this->seedTestData();
        /** @var Release $release */
        $release = factory(Release::class)->states('testing')->create([ 'agent_id' => 177 ]);
        $release->vocabularies()->attach(37);
        $release->elementsets()->attach(83);

        //start with an empty test directory
        storage::disk('test')->deleteDirectory('projects');
        DatabaseNotification::truncate();

        //when I pass the release to the publish function
        dispatch(new Publish($release, 'test'));

        //then I end up with a bunch of files
        Storage::disk('test')->assertExists('projects/177/xml/termList/RDAMediaType.xml');
        Storage::disk('test')->assertExists('projects/177/xml/Elements/c.xml');
        Storage::disk('test')->assertExists('projects/177/ttl/termList/RDAMediaType.ttl');
        Storage::disk('test')->assertExists('projects/177/ttl/Elements/c.ttl');
        Storage::disk('test')->assertExists('projects/177/rdfa/termList/RDAMediaType.rdfa');
        Storage::disk('test')->assertExists('projects/177/rdfa/Elements/c.rdfa');
        Storage::disk('test')->assertExists('projects/177/rdf-json/termList/RDAMediaType.rdf-json');
        Storage::disk('test')->assertExists('projects/177/rdf-json/Elements/c.rdf-json');
        Storage::disk('test')->assertExists('projects/177/nt/termList/RDAMediaType.nt');
        Storage::disk('test')->assertExists('projects/177/nt/Elements/c.nt');
        Storage::disk('test')->assertExists('projects/177/n3/termList/RDAMediaType.n3');
        Storage::disk('test')->assertExists('projects/177/n3/Elements/c.n3');
        Storage::disk('test')->assertExists('projects/177/microdata/termList/RDAMediaType.microdata');
        Storage::disk('test')->assertExists('projects/177/microdata/Elements/c.microdata');
        Storage::disk('test')->assertExists('projects/177/jsonld/termList/RDAMediaType.jsonld');
        Storage::disk('test')->assertExists('projects/177/jsonld/Elements/c.jsonld');

        $this->assertCount(1, $release->user->notifications);
    }

    /** @test */
    public function service_can_get_list_of_user_repos_from_github(): void
    {
        $this->markTestIncomplete();
        //given I have a github account)
        $user = User::findOrFail(36);
        $this->actingAs($user);
        //when I request a list of my repos
        //GitHub::getRepoList();
        //then I get the list
    }
}
