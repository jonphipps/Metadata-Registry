<?php

namespace App\Http\Controllers\Frontend;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ImportRequest;
use App\Http\Requests\ImportRequest as StoreRequest;
use App\Http\Requests\ImportRequest as UpdateRequest;
use App\Http\Traits\UsesEnums;
use App\Http\Traits\UsesPolicies;
use App\Models\Import;
use App\Models\Project;
use App\Wizard\Import\ProjectSteps\ApproveImportStep;
use App\Wizard\Import\ProjectSteps\DisplayResultsStep;
use App\Wizard\Import\ProjectSteps\PerformImportStep;
use App\Wizard\Import\ProjectSteps\SelectWorksheetsStep;
use App\Wizard\Import\ProjectSteps\SetSpreadsheetStep;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Smajti1\Laravel\Exceptions\StepNotFoundException;
use Smajti1\Laravel\Wizard;
use const null;
use function method_exists;

class ImportCrudController extends CrudController
{
    use UsesPolicies, UsesEnums;
    public $steps = [
        'spreadsheet' => SetSpreadsheetStep::class,
        'worksheets' => SelectWorksheetsStep::class,
        'approve' => ApproveImportStep::class,
        'import' => PerformImportStep::class,
        'report' => DisplayResultsStep::class,
    ];
    protected $wizard;

    public function __construct() {
        parent::__construct();
        $this->wizard = new Wizard($this->steps, $sessionKeyName = 'project-import');

        view()->share([ 'wizard' => $this->wizard ]);

    }

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Import::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/import');
        $this->crud->setEntityNameStrings('import', 'imports');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->addCustomDoctrineColumnTypes();
        //$this->crud->setFromDb();

        // ------ CRUD FIELDS

        // $this->crud->addFields();
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        $this->crud->allowAccess([ 'list', 'show' ]);
        $this->crud->denyAccess([ 'create', 'update', 'delete', 'importProject' ]);

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

    public function importProject(Request $request, Project $project, $step = null)
    {
        $this->policyAuthorize('importProject', $project, $project->id);
        //if we get to here we're authorized to import a project, so we authorize create
        $this->crud->allowAccess([ 'create' ]);
        try {
            if (null === $step) {
                $step = $this->wizard->firstOrLastProcessed();
            } else {
                $step = $this->wizard->getBySlug($step);
            }
        }
        catch (StepNotFoundException $e) {
            abort(404);
        }
        //we've jumped into a middle step of the sequence (we should always have worksheets after step 1)
        if ($step->number > 1 && ! $this->wizard->dataHas('worksheets')) {
            $step = $this->wizard->first();
        }

        $this->crud->setCreateView('frontend.import.project.wizard');
        $this->crud->setRoute(config('backpack.base.route_prefix') . 'projects/' . $project->id );
        $this->crud->addFields($step->fields(),'create');
        $this->data['step']  = $step;
        $this->data['project'] = $project;
        $this->data['wizard_data'] = $this->wizard->data();

        return parent::create();
    }

    public function processImportProject(ImportRequest $request, Project $project, $step = null)
    {
        $this->policyAuthorize('importProject', $project, $project->id);
        //if we get to here we're authorized to import a project, so we authorize create
        $this->crud->allowAccess([ 'create' ]);
        try {
            $step = $this->wizard->getBySlug($step);
        }
        catch (StepNotFoundException $e) {
            abort(404);
        }

        //here we validate the input from the step

        if (method_exists($step, 'validate')) {
            $step->validate($request);
        } else {
            $this->validate($request, $step->rules($request));
        }
        //handle the next/last step
        $step->process($request);

        //and redirect to the next step if valid
        return redirect()->route('frontend.project.import',
            [ 'project' => $project->id, 'step' => $this->wizard->nextSlug() ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    /**
     * @param $step
     *
     * @return array
     */
    private static function getWizardStep($step): array
    {
        $steps = [
            [
                'name'         => 'spreadsheet',
                'step'         => 1,
                'title'        => 'Start with a Spreadsheet URL...',
                'instructions' => 'Some instructions',
            ],
            [
                'name'         => 'worksheets',
                'step'         => 2,
                'title'        => 'Choose the Worksheets...',
                'instructions' => 'Some instructions',
            ],
            [
                'name'         => 'approve',
                'step'         => 3,
                'title'        => 'Approve the changes..',
                'instructions' => 'Some instructions',
            ],
            [
                'name'         => 'import',
                'step'         => 4,
                'title'        => 'Start with a Spreadsheet URL',
                'instructions' => 'Some instructions',
            ],
        ];
        $key   = $step !== null ? array_search($step, array_column($steps, 'name')) : 0;
        if ($key === false) {
            abort(404, 'Invalid Step');
        }
        $steps[ $key ]['next'] = ($key < count($steps)) ? $steps[ $key + 1 ]['name'] : false;

        return $steps[ $key ];
    }
}