<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest
 */
class AuthTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    //
    //A logged in user will have permission to view and edit their account, but not delete it

    //A project admin will have all permissions for a project and its children and all languages
    //A project language admin will have all permissions for a project and its children for that language
    //A project language admin will NOT have permission to publish the project
    //A non-subscriber can view index and show only public projects and their children

    /**
     * @test
     */
    public function any_subscriber_will_have_permission_to_create_a_project()
    {
        //given I am NOT logged in
        Auth::logout();
        $this->assertTrue($this->user->cannot('create', \App\Models\Project::class));

        //acting as a user
        $this->actingAs($this->user);
        //I can create a project
        $this->assertTrue($this->user->can('create', \App\Models\Project::class));
        $this->visit('projects/create')->seeStatusCode(200);

        //but I can't create other things
        $this->assertTrue($this->user->cannot('create', \App\Models\Vocabulary::class));
        $this->assertTrue($this->user->cannot('create', \App\Models\ElementSet::class));
        $this->assertTrue($this->user->cannot('create', \App\Models\Access\User\User::class));
    }
    //A project admin will have all permissions for a project and its children and all languages

    /**
     * @test
     */
    public function the_creator_of_a_project_is_the_project_admin()
    {
        $project = factory(\App\Models\Project::class)->create();
        $this->user->projects()->attach($project,
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
            ]);

        $this->seeInDatabase(\App\Models\ProjectHasUser::TABLE,
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
                'agent_id'         => $project->id,
                'user_id'          => $this->user->id,
            ]);

        $this->visit("projects/$project->id")->seeStatusCode(200);

        $this->actingAs($this->user);
        $this->visit("projects/$project->id/edit")->seeStatusCode(200);
        //can't edit a project I don't own
        $project2 = factory(\App\Models\Project::class)->create();
        $response = $this->get("projects/$project2->id/edit")->seeStatusCode(403);

        //I can create a project
        $this->assertTrue($this->user->can('update', $project));
        //but I can also create other things
        $this->assertTrue($this->user->can('create', [\App\Models\Vocabulary::class, $project]));
        $this->assertTrue($this->user->can('create', [\App\Models\ElementSet::class, $project]));
    }

  /**
   * @test
   */
  public function a_project_admin_can_edit_create_delete_a_project_vocabulary()
  {
    //given a user is a project admin
    /** @var \App\Models\Project $project */
    $project = factory(\App\Models\Project::class)->create();
    $this->user->projects()
               ->attach($project,
                   [
                       'is_registrar_for' => true,
                       'is_admin_for'     => true,
                   ]);
    $vocabulary = factory(\App\Models\Vocabulary::class)->make();
    $this->user->vocabularies()
               ->attach($vocabulary,
                   [
                       'is_registrar_for' => true,
                       'is_admin_for'     => true,
                   ]);
    $project->vocabularies()->save($vocabulary);
    //when
    //then she has permission to edit/create/delete a vocabulary
    $this->assertTrue($this->user->can('create', [ \App\Models\Vocabulary::class, $project ]));
    $this->assertTrue($this->user->can('update', [ \App\Models\Vocabulary::class, $vocabulary ]));
    $this->assertTrue($this->user->can('delete', [ \App\Models\Vocabulary::class, $vocabulary ]));

  }

  /**
   * @test
   */
  public function a_vocabulary_admin_can_edit_create_delete_a_vocabulary()
  {
    //given a user is a vocab admin
    $project    = factory(\App\Models\Project::class)->create();
    $vocabulary = factory(\App\Models\Vocabulary::class)->make();
    $project->vocabularies()
            ->save($vocabulary);
    $this->user->vocabularies()
               ->attach($vocabulary->id,
                   [
                       'is_registrar_for' => true,
                       'is_admin_for'     => true,
                   ]);
    //then she has permission to edit/create/delete a vocabulary
    $this->assertTrue($this->user->cannot('create', [ \App\Models\Vocabulary::class, $project ]));
    $this->assertTrue($this->user->can('update', [ \App\Models\Vocabulary::class, $vocabulary ]));
    $this->assertTrue($this->user->can('delete', [ \App\Models\Vocabulary::class, $vocabulary ]));

  }

  /**
   * @test
   */
  public function a_vocabulary_maintainer_can_edit_create_delete_vocabulary_concepts()
  {
    //given a user is a vocab maintainer
    /** @var \App\Models\Project $project */
    $project    = factory(\App\Models\Project::class)->create();
    /** @var \App\Models\Vocabulary $vocabulary */
    $vocabulary = factory(\App\Models\Vocabulary::class)->create(['agent_id' => $project->id]);
    /** @var \App\Models\Concept $concept */
    $concept = factory(\App\Models\Concept::class)->create(['vocabulary_id' => $vocabulary->id]);

    $this->user->vocabularies()
               ->attach($vocabulary->id,
                   [
                       'is_registrar_for' => true,
                       'is_maintainer_for'     => true,
                   ]);
    //then she has permission to edit/create/delete a vocabulary
    $this->assertTrue($this->user->can('create', [ \App\Models\Concept::class, $vocabulary ]));
    $this->assertTrue($this->user->can('update', [ \App\Models\Concept::class, $concept ]));
    $this->assertTrue($this->user->can('delete', [ \App\Models\Concept::class, $concept ]));

  }

  /**
   * @test
   */
  public function a_vocabulary_maintainer_can_edit_create_delete_vocabulary_concept_properties()
  {
    //given a user is a vocab maintainer
    /** @var \App\Models\Project $project */
    $project = factory(\App\Models\Project::class)->create();
    /** @var \App\Models\Vocabulary $vocabulary */
    $vocabulary = factory(\App\Models\Vocabulary::class)->create([ 'agent_id' => $project->id ]);
    /** @var \App\Models\Concept $concept */
    $concept = factory(\App\Models\Concept::class)->create([ 'vocabulary_id' => $vocabulary->id ]);
    $conceptAttribute = factory(\App\Models\ConceptAttribute::class)->create([ 'concept_id' => $concept->id ]);
    $this->user->vocabularies()
               ->attach($vocabulary->id,
                   [
                       'is_registrar_for'  => true,
                       'is_maintainer_for' => true,
                   ]);
    //then she has permission to edit/create/delete a vocabulary
    $this->assertTrue($this->user->can('create', [ \App\Models\ConceptAttribute::class, $vocabulary ]));
    $this->assertTrue($this->user->can('update', [ \App\Models\ConceptAttribute::class, $conceptAttribute ]));
    $this->assertTrue($this->user->can('delete', [ \App\Models\ConceptAttribute::class, $conceptAttribute ]));

    $this->assertTrue($this->executive->cannot('create', [ \App\Models\ConceptAttribute::class, $vocabulary ]));
    $this->assertTrue($this->executive->cannot('update', [ \App\Models\ConceptAttribute::class, $conceptAttribute ]));
    $this->assertTrue($this->executive->cannot('delete', [ \App\Models\ConceptAttribute::class, $conceptAttribute ]));
  }

}
