<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Frontend\ImportCrudController;
use App\Http\Requests\Frontend\ImportRequest;
use App\Http\Traits\UsesPolicies;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectImportController extends ImportCrudController
{
    use UsesPolicies;

    /**
     * @param Request $request
     * @param Project $project
     * @param         $type
     * @param null    $step
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function importStep(Request $request, Project $project, $type, $step = null)
    {
        $this->policyAuthorize('importProject', $project, $project->id);
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

    /**
     * @param ImportRequest $request
     * @param Project       $project
     * @param               $type
     * @param null          $step
     */
    public function processImportStep(ImportRequest $request, Project $project, $type, $step = null)
    {
        $id = 1;

        if ($type === 'gsimport') {
            $id = 1;
        }
    }
}
