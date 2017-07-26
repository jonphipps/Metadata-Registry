<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

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

    }

    public function process(Request $request): void
    {
        // run the read each worksheet and get the changes
        // show the changes in a checkbox tree
        // activate the 'Finish and notify me when done' button
        // save progress to session
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
