<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ImportRequest;
use App\Http\Traits\UsesEnums;
use App\Http\Traits\UsesPolicies;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** @noinspection LongInheritanceChainInspection */
class ProjectImportController extends ImportCrudController
{
    use UsesPolicies;
    public function importStep(Request $request, Project $project, $type, $step = null)
    {
        $this->policyAuthorize('importProject', $project, $project->id );
        $this->crud->setCreateView('frontend.import.project.step-1');

        // prepare the fields you need to show
        $this->data['crud']       = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields']     = $this->crud->getCreateFields();
        $this->data['title']      = trans('backpack::crud.add') . ' ' . $this->crud->entity_name;
        $this->data['project']    = $project;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getCreateView(), $this->data);
    }

    public function processImportStep(ImportRequest $request, Project $project, $type, $step = null)
    {
        $id = 1;

        if ($type === 'gsimport') {
            $id = 1;
        }
    }
}
