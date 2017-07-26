<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

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
        return [];
    }

    public function preProcess(Request $request, Wizard $wizard = null)
    {
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
