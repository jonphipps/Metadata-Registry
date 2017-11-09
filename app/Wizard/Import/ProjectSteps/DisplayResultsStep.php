<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use App\Models\Import;
use Illuminate\Http\Request;
use Smajti1\Laravel\Step;
use Smajti1\Laravel\Wizard;

class DisplayResultsStep extends Step
{
    public static $label = 'Here are your results...';
    public static $slug = 'results';
    public static $view = 'frontend.import.project.steps.results';

    public function fields(): array
    {
        return [
            [
                'name'  => 'results',
                'label' => '',
                'type'  => 'jqxgrid_select',
            ],
        ];
    }

    public function preProcess(Request $request, Wizard $wizard)
    {
        /** @var Import[] $imports */
        $imports = $request->batch->imports;
        $data = [];
        foreach ($imports as $import) {
            $results['results']       = $import->results;
            $results['worksheet']     = $import->source_file_name;
            $results['processed']     = $import->total_processed_count;
            $results['updated']       = $import->updated_count;
            $results['added']         = $import->added_count;
            $results['deleted']       = $import->deleted_count;
            $results['errors']        = $import->error_count;
            $data[]                   = $results;
        }
        $wizardData =   $wizard->data();
        $wizardData['results'] = $data;
        $wizard->data($wizardData);
    }

    public function process(Request $request): void
    {
        // This will be a generic report of all of the imports in this run
        // it should maybe be a normal report screen rather than a step
        // there should be  andOK/Finish button
        //$this->saveProgress($request);
    }

    public function validate(Request $request): void
    {
    }

    public function rules(Request $request = null): array
    {
        return [];
    }
}
