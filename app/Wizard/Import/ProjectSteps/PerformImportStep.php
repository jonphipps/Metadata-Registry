<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use Illuminate\Http\Request;
use Smajti1\Laravel\Step;

class PerformImportStep extends Step
{
    public static $label = 'Performing Import...';
    public static $slug = 'import';
    public static $view = 'frontend.import.project.steps.import';

    public function fields()
    {
        return [];
    }

    public function process(Request $request)
    {
        // run the import for each worksheet
        // deactivate the next button while processing, but keep the 'Finish in the background button'
        // display a progress bar for each one
        //$this->saveProgress($request);
    }

    public function validate(Request $request)
    {
    }

    public function rules(Request $request = null)
    {
        return [];
    }
}
