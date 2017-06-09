<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use App\Jobs\importVocabulary;
use App\Models\Export;
use function dispatch;
use function explode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Smajti1\Laravel\Step;

class SelectWorksheetsStep extends Step
{
    public static $label = 'Choose the Worksheets...';
    public static $slug = 'worksheets';
    public static $view = 'frontend.import.project.steps.worksheets';

    public function fields()
    {
        return [
            [
                'name'  => 'worksheets',
                'label' => 'Select the worksheets to import',
                'type'  => 'jqxgrid_select',
            ],
        ];
    }

    public function process(Request $request)
    {
        $worksheets[] = json_decode($request->selected_worksheets);
        $spreadsheet = $this->wizard->dataGet('spreadsheet');
        // setup a job for each worksheet
        foreach ($worksheets[0] as $worksheet) {
            [$export_id, $worksheet_id] = explode('::', $worksheet);
            $export = Export::find($export_id);
            // setup a job to run the worksheet processor to get the change instructions for each vocab
            dispatch(new importVocabulary($export, $worksheet_id, $spreadsheet));
            // each worksheet being processed will have its own checkbox table, hidden as a master->detail
            //it should look as if each of the worksheet selection rows had simply expanded to show the instructions
            // the row itself should have the master of the master-detail row just below with a summary of the changes
            $foo = 'bar';
        }

        // save progress to session
        $this->saveProgress($request);
    }

    public function validate(Request $request)
    {
        Validator::make([ 'selected_worksheets' => json_decode($request->selected_worksheets) ],
            [ 'selected_worksheets' => 'required' ],
            [ 'selected_worksheets.required' => 'You must select at least one worksheet before you can move to the next step.' ])->validate();
    }

    public function rules(Request $request = null)
    {
        return [
            'selected_worksheets' => 'required',
        ];
    }
}
