<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Frontend\Elementset\ElementsetCrudController;
use App\Http\Controllers\Frontend\ImportCrudController;
use App\Http\Controllers\Frontend\Vocabulary\VocabularyCrudController;
use App\Http\Requests\Frontend\Project\ProjectRequest as StoreRequest;
use App\Http\Requests\Frontend\Project\ProjectRequest as UpdateRequest;
use App\Http\Traits\UsesEnums;
use App\Http\Traits\UsesPolicies;
use Auth;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;

// VALIDATION: change the requests to match your own file names if you need form validation
class ProjectCrudController extends CrudController
{
    use UsesEnums, UsesPolicies;

    /**
     * @throws \Exception
     */
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Project::class);
        $this->crud->setRoute( config( 'backpack.base.route_prefix' ) . '/projects' );
        $this->crud->setEntityNameStrings( 'Project', 'Projects' );
        $this->crud->setShowView('frontend.project.dashboard');
        if (!auth()->check() || !auth()->user()->is_administrator) {
            $this->crud->addClause('public');
        }

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->addCustomDoctrineColumnTypes();
        $this->crud->setFromDb(false);
        $languages = getLanguageListFromSymfony('en');

        // ------ CRUD ACCESS
        $this->crud->allowAccess([ 'index', 'show' ]);
        $this->crud->denyAccess([ 'create', 'update', 'delete', 'import' ]);

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        $this->crud->autoFocusOnFirstField;
        $this->crud->removeFields( array_keys( $this->crud->create_fields ), 'both');
        //$this->crud->addFields( array_keys( $this->crud->columns ), 'create');
        $this->crud->addFields( [
            [
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
                'hint'  => "This will help identify your project in public lists and to project members that you may invite to join the project. <br />If you're editing this project for the first time since the OMR upgrade, this will initially be the name you chose for your 'Agent'",
                'tab' => 'Details',
            ],
        ],
            'edit' );
        $this->crud->addFields( [
            [
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
                'hint'  => 'This will help identify your project in public lists and to project members that you may invite to join the project. ',
                'tab' => 'Details',
            ],
        ],
            'create' );

        $this->crud->addFields([
            [
                'name'  => 'is_private',
                'label' => 'Private Project?',
                'type'  => 'checkbox',
                'hint'  => "Make this project and all of it's related resources private. Private project vocabularies and resources won't appear in browse or search results.",
                'tab'   => 'Details',
            ],
            [
                'name'       => 'license_uri',
                'label'      => 'License URL',
                'type'       => 'url',
                'hint'       => 'The URL of the license',
                'attributes' => [
                    'placeholder' => 'This will eventually be a drop-down list of GitHub Open Source licenses',
                ],
                'tab'        => 'Details',
            ],
            [
                'name'  => 'license',
                'label' => 'License',
                'type'  => 'textarea',
                'hint'  => 'This is the text of your license. This is not necessary if you use a license URL.',
                'tab'   => 'Details',
            ],
            [
                'name'  => 'url',
                'label' => 'Documentation URL',
                'type'  => 'url',
                'hint'  => 'Provide a link to any external resources related to the project, like a project home page.',
                'tab'   => 'Details',
            ],
            [
                'name'  => 'google_sheet_url',
                'label' => 'Google Sheet URL',
                'type'  => 'url',
                'hint'  => "If you import the resources for this project from a Google Sheet, this is the URL that we'll use to acquire the worksheet for each set of resources. <br />This can be overridden for any individual import, and can be set for each individual resource as well.",
                'tab'   => 'Project Defaults',
            ],
            [
                'name'  => 'repo',
                'label' => 'GitHub Repository',
                'type'  => 'url',
                'hint'  => "If you publish your resources using the 'OMR->GitHub->Vocabulary Server' publishing path, this is the GitHub repository to which we'll publish your resources. <br />This can be set for each individual resource as well.",
                'tab'   => 'Project Defaults',
            ],
            [
                'name'            => 'languages',
                'label'           => 'Languages in use',
                'type'            => 'select2_from_array',
                'allows_null'     => false,
                'allows_multiple' => true,
                'options'         => $languages,
                'hint'            => 'All of the languages in which you wish to make your resources available.<br />This can be set for each individual resource as well.',
                'tab'             => 'Project Defaults',
                'attributes'      => [
                    'placeholder' => 'Select one or more language codes',
                ],
            ],
            [
                'name'        => 'default_language',
                'label'       => 'Default Language',
                'type'        => 'select2_from_array',
                'allows_null' => true,
                'default'     => 'en',
                'options'     => $languages,
                'hint'        => 'The default language for all of your resources.<br />This can be set for each individual resource as well.',
                'tab'         => 'Project Defaults',
                'attributes'  => [
                    'placeholder' => 'Select a language code. ',
                ],
            ],
            [   // URL
                'name'  => 'base_domain',
                'label' => 'Base Domain',
                'type'  => 'url',
                'hint'  => 'Here you can set the base domain for the URI template use to generate URIs for your resources. If you always supply the URIs, then this is unnecessary',
                'tab'   => 'URI Generation (optional)',
            ],
            [   // Enum
                'name'  => 'namespace_type',
                'label' => 'Namespace Type',
                'type'  => 'enum',
                'hint'  => "'Hash' or 'Slash'. We recommend Slash in most cases",
                'tab'   => 'URI Generation (optional)',
            ],
            [   // Enum
                'name'  => 'uri_strategy',
                'label' => 'Generator Strategy',
                'type'  => 'enum',
                'hint'  => "Choose how you wish the unique portion of the uri to be generated. Most of these choices generate a 'readable slug' from the label in the default language. We recommend Numeric.",
                'tab'   => 'URI Generation (optional)',
            ],
            [
                'name'  => 'uri_prepend',
                'label' => 'Prepend to theURI',
                'type'  => 'text',
                'hint'  => 'A string that will always be added to the beginning of the unique portion of the uri to be generated.',
                'tab'   => 'URI Generation (optional)',
            ],
            [
                'name'  => 'uri_append',
                'label' => 'Append to the URI',
                'type'  => 'text',
                'hint'  => 'A string that will always be added to the end of the unique portion of the uri to be generated.',
                'tab'   => 'URI Generation (optional)',
            ],
            [
                'name'  => 'starting_number',
                'label' => 'Starting Number',
                'type'  => 'number',
                'hint'  => "If the generator strategy is 'Numeric', the unique portion of the generated URI will be incremented starting from this number ",
                'tab'   => 'URI Generation (optional)',
            ],
        ],
            'both' );

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack

        if ( ! ( Auth::check() && Auth::user()->is_administrator ) ) {
            $this->crud->removeColumn( 'is_private' ); // remove a column from the stack
        } else{
            $this->crud->setColumnDetails( 'is_private',
                [
                    'type'    => 'check',
                    'label'   => 'Private?',
                ] ); // adjusts the properties of the passed in column (by name)
        }
        //$this->crud->removeColumns( [column1, column2] ); // remove an array of columns from the stack
        $this->crud->setColumnDetails( 'org_name',
            [
                'label'         => 'Title',
                'type'          => 'model_function',
                'function_name' => 'getTitleLink',
                'searchLogic' => function($query, $column, $searchTerm) {
                    $query->orWhere('org_name', 'like', '%' . $searchTerm . '%');
                },
                'show' => false,
            ] ); // adjusts the properties of the passed in column (by name)
        $this->crud->addColumn([
            'name'          =>'vocabularies',
            'label'         => "Vocabularies",
            'type'          => "model_function",
            'function_name' => 'getVocabColumn',
            'show'          => false,
        ] );
        $this->crud->addColumn(  [
            'name'          => 'elementsets',
            'label'         => "Element Sets",
            'type'          => "model_function",
            'function_name' => 'getElementColumn',
            'show' => false,
        ] );
        $this->crud->addColumn([
            'name' => 'created_at',
            'label'=>'Date Created',
            'type' => 'datetime',
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'label'=>'Last Updated',
            'type' => 'datetime',
        ]);
        $this->crud->setColumnsDetails(['repo_is_valid', 'prefixes', ],[
            'show' => false,
        ]);
        $this->crud->setColumnsDetails([ 'languages' ],
            [
                'type'          => 'model_function',
                'function_name' => 'showLanguagesCommaDelimited'
            ]);
        $this->crud->setColumnsDetails([ 'default_language' ],
            [
                'type'          => 'model_function',
                'function_name' => 'showLanguage'
            ]);
        $this->crud->setColumnsDetails([
            'base_domain',
            'created_by',
            'default_language_id',
            'default_language',
            'deleted_at',
            'deleted_by',
            'description',
            'google_sheet_url',
            'label',
            'languages',
            'license_uri',
            'license',
            'name',
            'namespace_type',
            'prefixes',
            'repo',
            'repo_is_valid',
            'starting_number',
            'updated_by',
            'uri_append',
            'uri_prepend',
            'uri_strategy',
            'uri_type',
            'url',], ['list' => false]);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // if ( Auth::guest() ) {
            $this->crud->removeAllButtonsFromStack( 'line' );
        // }

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

    /**
     * @param int $id
     *
     * @return \Backpack\CRUD\app\Http\Controllers\Response
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        //todo: All private project checks should be implemented in middleware
        if ( ! Auth::check()) {
            //we abort if the project is private
            $project = Project::findOrFail($id);
            if ($project->is_private) {
                abort(404);
            }
        }
        $this->policyAuthorize('show', $this->crud->getModel(), $id);

        $this->data['project'] = $this->crud->getEntry($id);
        $classArray = [
            'elementset' => ElementsetCrudController::class,
            'vocabulary' => VocabularyCrudController::class,
            'import'     => ImportCrudController::class,
            'release'    => ProjectReleaseCrudController::class,
            'member'     => ProjectUserCrudController::class,
            'prefix'     => ProjectPrefixCrudController::class,
        ];
        foreach ($classArray as $thing => $className) {
            $thingController = new $className;
            /** @var CrudController $thingController */
            $thingController->setup();
            $this->data[$thing] = $thingController;
        }
        return parent::show($id);
    }

    /**
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store( StoreRequest $request )
    {
        $this->policyAuthorize('create', $this->crud->getModel());

        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        Auth::user()->projects()->attach( $this->crud->entry,
            [ 'is_registrar_for' => true, 'is_admin_for' => true, ] );
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return Redirect::to(config('backpack.base.route_prefix') . "/projects/{$this->crud->entry->id}");
    }

    /**
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update( UpdateRequest $request )
    {
        if ( $request && $request->id ) {
            $this->policyAuthorize('update', $this->crud->getModel(), $request->id);
        }
        $this->crud->setRoute(config('backpack.base.route_prefix') . "/projects/{$request->id}");

        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

}
