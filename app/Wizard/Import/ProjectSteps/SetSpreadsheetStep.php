<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use App\Models\ConceptAttribute;
use App\Models\ElementAttribute;
use App\Models\Export;
use App\Services\Import\GoogleSpreadsheet;
use function explode;
use Google_Service_Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        return [
            [
                'name'  => 'source_file_name',
                'label' => 'Link to Google Spreadsheet',
                'type'  => 'url',
            ],
            [
                'name'    => 'import_type',
                'label'   => 'Type of Import',
                'type'    => 'radio',
                'options' => [ // the key will be stored in the db, the value will be shown as label;
                               0 => 'Full -- (Default) Empty cells will be deleted. Empty rows will be deleted, or deprecated if published.',
                               1 => 'Sparse -- Non-destructive. Empty rows and cells will be ignored.',
                               2 => 'Partial -- Empty Cells will be deleted. Missing rows will be ignored.',
                ],
            ],
        ];
    }

    public function preProcess(Request $request, Wizard $wizard = null)
    {

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
        $spread_sheet      = new GoogleSpreadsheet($request->source_file_name);
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

        $worksheets  = [];
        foreach ($spread_worksheets as $worksheet) {
            try {
                $export = Export::findByExportFileName($worksheet . '.csv');
                if ($export) {
                    $arr = explode('_', $worksheet);
                    $sheet['worksheet'] = $arr[0];
                    $sheet['languages'] = $arr[1];
                    $sheet['exported_at'] = $export->created_at->toDayDateTimeString();
                    if ($export->elementset) {
                        $id = $export->elementset->id;
                        $sheet['last_edit'] = ElementAttribute::getLatestDateForElementSet($id);
                        $sheet['elementset_id'] = $id;
                    }
                    if ($export->vocabulary) {
                        $id                = $export->vocabulary->id;
                        $sheet['last_edit'] = ConceptAttribute::getLatestDateForVocabulary($id);
                        $sheet['vocabulary_id'] = $id;
                    }
                    $sheet['last_edit']    =
                        $sheet['last_edit']?  $sheet['last_edit']->toDayDateTimeString(): 'Never Edited';
                    $sheet['id']       = $export->id.'::'.$worksheet;
                    $lastImport               = $export->getLatestImport();
                    $sheet['last_import']     =
                        $lastImport? $lastImport->created_at->toDayDateTimeString(): 'Never Imported';
                    $worksheets[] = $sheet;
                }
            }
            catch (ModelNotFoundException $e) {
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
