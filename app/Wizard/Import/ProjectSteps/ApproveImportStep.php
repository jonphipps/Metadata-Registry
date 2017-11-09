<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use App\Jobs\ImportVocabulary;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Smajti1\Laravel\Step;
use Smajti1\Laravel\Wizard;

class ApproveImportStep extends Step
{
    public static $label = 'Approve the changes...';
    public static $slug = 'approve';
    public static $view = 'frontend.import.project.steps.approve';

    public function fields(): array
    {
        return [
            [
                'name'  => 'approve',
                'label' => 'Select to approve',
                'type'  => 'jqxgrid_select',
            ],
        ];
    }

    public function preProcess(Request $request, Wizard $wizard)
    {
        $batch = $request->batch;
        if ($batch->total_count <= $batch->handled_count) {
            $batch->load('imports');
            $data = [];
            //load the stats from each import into an array
            foreach ($batch->imports as $import) {
                $stats                    = $import->preprocess;
                $datum['id']              = $import->id;
                $datum['worksheet']       = $import->worksheet;
                $datum['added']           = $stats['added'];
                $datum['updated']         = $stats['updated'];
                $datum['deleted']         = $stats['deleted'];
                $datum['errors']          = $stats['errors'];
                $datum['errors_detail'] = $import->errors;
                $data[]                   = $datum;
            }
            $wizardData         = $wizard->data();
            $wizardData[ 'approve' ] = $data;
            $wizard->data($wizardData);
        }
    }

    public function process(Request $request): void
    {
        $importIds = json_decode($request->selected_approve);
        foreach ($importIds as $importId) {
            dispatch(new ImportVocabulary($importId));
        }
        $this->saveProgress($request);
    }

    public function validate(Request $request): void
    {
        Validator::make([ 'selected_approve' => json_decode($request->selected_approve) ],
            [ 'selected_approve' => 'required' ],
            [ 'selected_approve.required' => 'You must select at least one set of changes before you can import the spreadsheet.' ])
            ->validate();
    }

    public function rules(Request $request = null): array
    {
        return [
            'selected_approve' => 'required',
        ];    }
}
