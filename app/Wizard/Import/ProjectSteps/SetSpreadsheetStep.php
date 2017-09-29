<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use App\Models\Batch;
use App\Models\Export;
use App\Models\Project;
use App\Services\Import\GoogleSpreadsheet;
use Google_Service_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Smajti1\Laravel\Step;
use Smajti1\Laravel\Wizard;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class SetSpreadsheetStep extends Step
{
    public static $label = 'Start with a Spreadsheet URL...';
    public static $slug = 'spreadsheet';
    public static $view = 'frontend.import.project.steps.spreadsheet';
    private $sheet;
    private $worksheets;
    private $title;

    public function fields(): array
    {
        $id                = $this->wizard->data()['project_id'];
        $batches           = Project::find($id)->importBatches;
        $field_fileName    = [
            'name'  => 'source_file_name',
            'label' => 'OR... <br>Link to New Google Spreadsheet',
            'type'  => 'url',
        ];
        $field_type        = [
            'name'    => 'import_type',
            'label'   => 'Type of Import',
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                           0 => 'Full -- (Default) Empty cells will be deleted. Empty rows will be deleted, or deprecated if published.',
                           1 => 'Sparse -- Non-destructive. Empty rows and cells will be ignored.',
                           2 => 'Partial -- Empty Cells will be deleted. Missing rows will be ignored.',
            ],
        ];

        if ($batches) {
            $batches           = $batches->pluck('step_data', 'run_description')->mapWithKeys(function($item, $key) {
                return [ $item['spreadsheet']['source_file_name'] => $key ];
            })->sort()->toArray();
            $field_sheetSelect = [
                'name'        => 'source_file_select',
                'label'       => 'Select a previous Google Spreadsheet',
                'type'        => 'select2_from_array',
                'options'     => $batches,
                'allows_null' => true,
            ];

            return [ $field_sheetSelect, $field_fileName, $field_type ];
        }

        return [ $field_fileName, $field_type ];
    }

    public function process(Request $request): void
    {
        //check to see if we have a batch
        //if no batch, create one and save the id to the session
        // save progress to session
        $this->saveProgress($request, [ 'googlesheets' => $this->worksheets, 'title' => $this->title ]);
    }

    public function rules(Request $request = null): array
    {
        return [
            'source_file_name' => 'required|googleUrl',
        ];
    }

    public function validate(Request $request): void
    {
        //here we validate the input from the step
        Validator::make($request->all(), $this->rules($request))->validate();
        if ( ! is_readable(base_path('client_secret.json'))) {
            throw new InvalidConfigurationException('The Google Spreadsheet Reader Service is not configured correctly');
        }
        $spread_worksheets = [];
        $selectedSheet = $request->source_file_select ?? $request->source_file_name;
        $spread_sheet      = new GoogleSpreadsheet($selectedSheet);
        try {
            $spread_worksheets = $spread_sheet->getWorksheets()->toArray();
        }
        catch (Google_Service_Exception $e) {
            //we know this is a 403 already, but we're doing this to take advantage of the validate() method's instant redirect
            Validator::make([ 'code' => $e->getCode() ],
                [ 'code' => 'not_in:403' ],
                [ 'code.not_in' => 'The import service has not been authorized to read data from this spreadsheet' ])
                ->validate();
        }
        $this->sheet = $spread_sheet;
        $this->title = $spread_sheet->getSpreadsheetTitle();

        $worksheets = [];
        foreach ($spread_worksheets as $worksheet) {
            $sheet = Export::findByExportFileName($worksheet);
            if ($sheet) {
                $worksheets[ $worksheet] = $sheet;
            }
        }

        // run the worksheet reader
        // compare with known exports and generate a report
        Validator::make([ 'worksheets' => $worksheets ],
            [ 'worksheets' => 'required' ],
            [ 'worksheets.required' => 'The supplied spreadsheet has no valid worksheets' ])->validate();

        $this->worksheets = $worksheets;
    }
}
