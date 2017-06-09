<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use Illuminate\Http\Request;
use Smajti1\Laravel\Step;

class DisplayResultsStep extends Step
{
    public static $label = 'Here are your results...';
    public static $slug = 'results';
    public static $view = 'frontend.import.project.steps.results';

    public function fields()
    {
        return [];
    }

    public function process(Request $request)
    {
        // This will be a generic report of all of the imports in this run
        // it should maybe be a normal report screen rather than a step
        // there should be  andOK/Finish button
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
