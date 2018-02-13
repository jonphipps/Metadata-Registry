<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Requests\ReleaseRequest as StoreRequest;
use App\Http\Requests\ReleaseRequest as UpdateRequest;
use App\Http\Traits\UsesPolicies;
use App\Jobs\Publish;
use App\Models\Access\User\User;
use App\Models\Elementset;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Models\Project;
use App\Models\Release;
use App\Models\Vocabulary;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class ProjectReleaseCrudController extends CrudController
{
    //use UsesPolicies;

    /**
     * @throws \Exception
     */
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $project_id = Route::current()->parameter('project_id') ?? Route::current()->parameter('project');

        $this->crud->setModel(Release::class);
        $this->crud->setEntityNameStrings('Release', 'Releases');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/projects/' . $project_id . '/releases');

        if ($project_id) {
            $project = Project::findOrFail($project_id);
            $this->crud->addClause('where', 'agent_id', $project_id);
            Vocabulary::addGlobalScope('project_id', function (Builder $builder) use ($project_id) {
                $builder->where('agent_id', $project_id);
            });
            Elementset::addGlobalScope('project_id', function (Builder $builder) use ($project_id) {
                $builder->where('agent_id', $project_id);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        $this->crud->removeFields(['user_id', 'agent_id', 'name', 'body', 'github_response', 'tag_name', 'target_commitish', 'is_draft', 'is_prerelease']);
        $this->crud->addFields([
            [
                'name'    => 'user_id',
                'type'    => 'hidden',
                'default' => request()->user() ? request()->user()->id : null,
            ],
            [
                'name'    => 'agent_id',
                'type'    => 'hidden',
                'default' => $project_id,
            ],
            [
                'name'       => 'name',
                'label'      => 'Release Title',
                'type'       => 'text',
                'attributes' => [
                    'placeholder' => 'The descriptive title of this release',
                ],
            ],
            [
                'name'       => 'body',
                'label'      => 'Release Notes',
                'type'       => 'textarea',
                'attributes' => [
                    'placeholder' => 'Add some description of the changes in this release',
                    'rows'        => 10,
                ],
            ],
            [
                'name'       => 'tag_name',
                'label'      => 'Tag Name',
                'type'       => 'text',
                'attributes' => [
                    'placeholder' => 'The name of the GIT tag to assign to this release',
                ],
            ],
            [
                'name'  => 'is_prerelease',
                'label' => 'Pre-Release',
                'type'  => 'checkbox',
                'hint'  => 'Notify consuming systems that this release is not final',

            ],
            [
                'label'       => 'Value Vocabularies to publish...',
                'type'        => 'select_multiple',
                'name'        => 'vocabularies', // the method that defines the relationship in your Model
                'entity'      => 'vocabularies', // the method that defines the relationship in your Model
                'attribute'   => 'name', // foreign key attribute that is shown to user
                'model'       => Vocabulary::class, // foreign key model
                'pivot'       => true, // on create&update, do you need to add/delete pivot table entries?
                'pivotFields' => [], // an array of pivot table fields
                'morph'       => true,
                'allows_null' => false,
                'hint'        => 'Use shift- or ctrl-click (Windows) or cmd-click (mac) to select.',
            ],
            [
                'label'       => 'Element Sets to publish...',
                'type'        => 'select_multiple',
                'name'        => 'elementsets', // the method that defines the relationship in your Model
                'entity'      => 'elementsets', // the method that defines the relationship in your Model
                'attribute'   => 'name', // foreign key attribute that is shown to user
                'model'       => Elementset::class, // foreign key model
                'pivot'       => true, // on create&update, do you need to add/delete pivot table entries?
                'pivotFields' => [], // an array of pivot table fields
                'morph'       => true,
                'allows_null' => false,
                'hint'        => 'Use shift- or ctrl-click (Windows) or cmd-click (mac) to select.',
            ],
        ]);

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        //$this->crud->removeColumn('github_response'); // remove a column from the stack
        $this->crud->removeColumns(['user_id', 'agent_id', 'github_response', 'target_commitish', 'is_draft', 'deleted_at']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        $this->crud->addColumns([
            [
                // n-n relationship (with pivot table)
                'label'     => 'Vocabularies', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'vocabularies', // the method that defines the relationship in your Model
                'entity'    => 'vocabularies', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => Vocabulary::class, // foreign key model

            ],
            [
                // n-n relationship (with pivot table)
                'label'     => 'Element Sets', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'elementsets', // the method that defines the relationship in your Model
                'entity'    => 'elementsets', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => Elementset::class, // foreign key model

            ],
            [
                'label'     => 'Released by', // Table column heading
                'type'      => 'select',
                'name'      => 'user', // the method that defines the relationship in your Model
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => User::class, // foreign key model

            ],
        ]);

        $this->crud->setColumnDetails(
            'is_prerelease',
            [
                'type'  => 'boolean',
                'label' => 'Pre-release?',

            ]
        );
        $this->crud->setColumnDetails(
            'body',
            [
                'type'  => 'markdown',
            ]
        );

        $this->crud->setColumnsDetails(
            ['body', 'tag_name'],
            [
                'list'    => false,
            ]
        );

        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        $this->crud->addButton('line', 'publish', 'view', 'backpack::crud.buttons.publish', 'end'); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        $this->crud->denyAccess(['create', 'update', 'delete', 'import', 'publish']);
        if ($project->is_private) {
            if (Gate::allows('index', $project)) {
                $this->crud->allowAccess(['index']);
            }
            if (Gate::allows('view', $project)) {
                $this->crud->allowAccess(['show']);
            }
        } else {
            $this->crud->allowAccess(['index']);
            $this->crud->allowAccess(['show']);
        }
        if (Gate::allows('create', $project)) {
            $this->crud->allowAccess(['create']);
        }
        if (Gate::allows('update', $project)) {
            $this->crud->allowAccess(['update']);
        }
        if (Gate::allows('delete', $project)) {
            $this->crud->allowAccess(['delete']);
        }
        if (Gate::allows('publish', $project)) {
            $this->crud->allowAccess(['publish']);
        }
        // ------ CRUD ACCESS
        // $this->crud->allowAccess([ 'index', 'show' ]);

        //$this->authorizeAll();

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function show($id)
    {
        return parent::show($this->request->release);
    }

    public function listRevisions($id)
    {
        return parent::listRevisions($this->request->release);
    }

    public function restoreRevision($id)
    {
        return parent::restoreRevision($this->request->release);
    }

    public function showDetailsRow($id)
    {
        return parent::showDetailsRow($this->request->release);
    }

    public function edit($id)
    {
        return parent::edit($this->request->release);
    }

    public function destroy($id)
    {
        return parent::destroy($this->request->release);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
