<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-30,  Time: 11:57 AM */

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait UsesPolicies
{
    use AuthorizesRequests;

    public function create()
    {
        $this->policyAuthorize('create', $this->crud->getModel());

        return parent::create();
    }

    public function destroy($id)
    {
        $this->policyAuthorize('delete', $this->crud->getModel(), $id);

        return parent::destroy($id);
    }

    public function edit($id)
    {
        $this->policyAuthorize('update', $this->crud->getModel(), $id);

        return parent::edit($id);
    }

    public function index()
    {
        $this->policyAuthorize('index', $this->crud->getModel());

        return parent::index();
    }

    public function list()
    {
        $this->policyAuthorize('index', $this->crud->getModel());

        return parent::index();
    }

    public function show($id)
    {
        $this->policyAuthorize('show', $this->crud->getModel(), $id);

        return parent::show($id);
    }

    /**
     * Determines the access to allow based on policy
     *
     * @param string   $ability The ability to validate
     * @param Model    $class   The instance of a Model class to check against
     * @param int|null $id      The id of the individual to check against
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function policyAuthorize($ability, $class, $id = null)
    {
        //if the controller had pre-authorized access then bail
        if ($this->crud->hasAccess($ability)) {
            return;
        }

        //the 'model' will either be a valid instance or the class
        $model = $id !== null ? $class::findOrFail($id) : $class;

        //deny access to the ability by default
        $this->crud->denyAccess([ $ability ]);
        //let the gate decide -- if there's a user and the user is authorized
        $this->authorize($ability, $model);
        //if we get this far, then the gate has allowed access and we pass the authorization on to backpack
        $this->crud->allowAccess([ $ability ]);
    }
}
