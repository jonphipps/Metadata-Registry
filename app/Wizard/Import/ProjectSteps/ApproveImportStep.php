<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-31,  Time: 11:14 AM */

namespace App\Wizard\Import\ProjectSteps;

use Illuminate\Http\Request;
use Smajti1\Laravel\Step;

class ApproveImportStep extends Step
{
    public static $label = 'Approve the changes...';
    public static $slug = 'approve';
    public static $view = 'frontend.import.project.steps.approve';

    public function fields()
    {
        return [
            [
                'name'  => 'approve',
                'label' => 'Select to approve',
                'type'  => 'jqxtree_select',
            ],
        ];
    }

    public function process(Request $request)
    {
        // run the read each worksheet and get the changes
        // show the changes in a checkbox tree
        // activate the 'Finish and notify me when done' button
        // save progress to session
        $this->saveProgress($request);
    }

    public function validate(Request $request)
    {
    }

    public function rules(Request $request = null)
    {
        return [];
    }
}
