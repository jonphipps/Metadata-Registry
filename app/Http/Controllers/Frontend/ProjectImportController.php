<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use Illuminate\Http\Request;
use Ixudra\Wizard\Http\Controllers\FlowController;
use Ixudra\Wizard\Http\Requests\ProcessFlowStepFormRequest;

/** @noinspection LongInheritanceChainInspection */
class ProjectImportController extends FlowController
{

    public function importStep(Request $request, Project $project, $type, $step = null)
    {
        $id = 1;

        if ($type === 'gsimport') {
            $id = 1;
            $request->id = 1;
        }

        return parent::step($request, $id, $step); // TODO: Change the autogenerated stub
    }

    public function processImportStep(ProcessFlowStepFormRequest $request, Project $project, $type, $step = null)
    {

        $id = 1;

        if ($type === 'gsimport') {
            $id = 1;

        }

        return parent::processStep($request, $id, $step); // TODO: Change the autogenerated stub
    }
}
