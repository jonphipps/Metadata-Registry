<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Traits\UsesPolicies;
use App\Models\Access\User\User;
use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\Frontend\Project\ProjectUserRequest as StoreRequest;
use App\Http\Requests\Frontend\Project\ProjectUserRequest as UpdateRequest;
use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Class ProjectUserCrudController
 *
 * @package App\Http\Controllers\Frontend\Project
 */
class ProjectUserCrudController extends CrudController
{
    use UsesPolicies;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $project_id = Route::current()->parameter('project_id') ?? Route::current()->parameter('project');
        $id = Route::current()->parameter('member') ?? Route::current()->parameter('member');
        $this->crud->setEntityNameStrings('Project Member', 'Project Members');

        if ($project_id) {
            $project = Project::findOrFail($project_id);
            //     $this->crud->addClause('where', 'agent_id', '==', $project_id);
            // }
            if (request()->route()->getActionMethod() === 'search') {
                ProjectUser::addGlobalScope('project_id',
                    function(Builder $builder) use ($project_id) {
                        $builder->where('agent_id', $project_id);
                    });
            }
            $this->data['parent'] = $project->title . ' Project';
            $this->crud->setEntityNameStrings('Member', 'Members');
        }

        $this->crud->setModel(ProjectUser::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/projects/' . $project_id . '/members');
        if ($id) {
            $this->crud->getEntry($id);
        }

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->removeFields(array_keys($this->crud->create_fields), 'both');

        $this->crud->addField([
            'name' => 'user_id',
            'type' => 'hidden',
        ],
            'update');
        $this->crud->addField([
            'name' => 'agent_id',
            'type' => 'hidden',
            'default' => $project_id,
        ]);
        $userName    = '';
        if (isset($this->request->member) && $this->request->isMethod('GET')) {
            $user = collect(ProjectUser::with('user')->find($this->request->member)->user);
            if ($user) {
                $userName = User::getCombinedName($user);
            }
        };
        $this->crud->addField([  //plain
                                 'type'  => 'custom_html',
                                 'name'  => 'member_name',
                                 'value' => '<label>Member</label> <div>' . $userName . '</div>',
        ], 'update');

        $projectUsers = isset($project_id) ? ProjectUser::whereAgentId($project_id)->get([ 'user_id' ])->keyBy('user_id') : [];

        $this->crud->addField([  // Select2
                                 'label'     => 'Member',
                                 'type'      => 'select2_from_array',
                                 'name'      => 'user_id',
                                 'options'  => User::GetUsersForSelect($projectUsers),
                                 'allows_null' => true,
        ], 'create');

        $this->crud->addField([
            'name'    => 'authorized_as',
            'label'   => 'Authorized as', // the input label
            'default' => ProjectUser::AUTH_VIEWER,
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                           ProjectUser::AUTH_VIEWER => 'Viewer ...canʼt maintain any of the projectʼs resources.',
                           ProjectUser::AUTH_LANGUAGE_MAINTAINER => 'Language Maintainer ...can only maintain the projectʼs languages listed below',
                           ProjectUser::AUTH_MAINTAINER => 'Project Maintainer ...can maintain any of this projectʼs languages',
                           ProjectUser::AUTH_ADMIN => 'Project Administrator ...can do anything related to this project',
            ],
        ]);
        $this->crud->addField([
                'name'            => 'languages',
                'label'           => 'Languages',
                'type'            => 'select2_from_array',
                'allows_null'     => false,
                'default'         => [ config('app.locale') ],
                'allows_multiple' => true,
                'options'         => $project->listLanguagesForSelect(),
                'hint'            => 'All of the languages that this member is authorized to maintain<br />This can be set for each individual resource as well.',
                'attributes'      => [
                    'placeholder' => 'Select one or more language codes',
                ],
            ]);
        $this->crud->addField([
                'name'        => 'default_language',
                'label'       => 'Default Language',
                'type'        => 'select2_from_array',
                'allows_null' => false,
                'default'     => config('app.locale'),
                'options'     => $project->listLanguagesForSelect(),
                'hint'        => 'When creating new resources, this will be default language for this maintainer',
                'attributes'  => [
                    'placeholder' => 'Select a language code. ',
                ],
            ]);
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        $this->crud->removeFields(['is_admin_for', 'is_maintainer_for'], 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'label'     => 'Member Name',
            'type'      => 'select',
            'name'      => 'name',
            'entity'    => 'user',
            'attribute' => 'name',
        ])->afterColumn('user_id');
        $this->crud->addColumn([
            'label'     => 'Member Nickname',
            'type'      => 'select',
            'name'      => 'nickname',
            'entity'    => 'user',
            'attribute' => 'nickname',
        ])->afterColumn('user_id');
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        $this->crud->removeColumns(['is_admin_for', 'is_maintainer_for', 'current_language', 'id', 'created_at', 'deleted_at', 'updated_at']); // remove an array of columns from the stack
        $this->crud->setColumnDetails('authorized_as',
            [   // radio
                'label'   => 'Authorized as', // the input label
                'type'    => 'radio',
                'options' => [ // the key will be stored in the db, the value will be shown as label;
                               0 => 'Project Administrator',
                               1 => 'Project Maintainer',
                               2 => 'Language Maintainer',
                ],
            ]);
        $this->crud->setColumnDetails('languages',
            [
                'label' => 'Languages', // Table column heading
                'type'  => 'model_function',
                'function_name' => 'showLanguagesCommaDelimited',
            ]);
        $this->crud->setColumnDetails('is_registrar_for',
            [
                'label' => 'Registrar',
                'type'  => 'boolean',
            ]);
        $this->crud->setColumnsDetails(['agent_id','default_language'], ['list' => false]);
        $this->crud->setColumnsDetails(['agent_id'], ['show' => false]);

        // ------ CRUD BUTTONS
        $this->crud->initButtons();
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        $this->authorizeAll();
        //this authorizes access for not-logged-in users
        $this->crud->allowAccess([ 'list', 'show' ]);

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
        //$this->crud->addClause('where', 'agent_id', '==', $project_id);
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        $this->crud->with('user'); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    /**
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    /**
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
