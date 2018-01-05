<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-30,  Time: 11:57 AM */

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait UsesPolicies
{
    use AuthorizesRequests;

    /** bulk authorize based on policies
     */
    public function authorizeAll(): void
    {
        if ( ! auth()->check()) {
            return;
        }

        $model     = $this->crud->getModel();
        $authArray = [
            'list'    => 'index',
            'create'  => 'create',
            'edit'    => 'update',
            'show'    => 'show',
            'destroy' => 'delete',
        ];
        foreach ($authArray as $key => $ability) {
            $this->crud->denyAccess([ $ability ]);

            //these are based on the model class not the entry
            if (\in_array($ability, [ 'index', 'create' ], true)) {
                if (auth()->user()->can($ability, \get_class($this->crud->getModel()))) {
                    $this->crud->allowAccess([ $ability ]);
                }
            } else {
                if (auth()->user()->can($ability, $this->crud->getModel())) {
                    $this->crud->allowAccess([ $ability ]);
                }
            }
        }
    }

    /**
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->policyAuthorize('create', \get_class($this->crud->getModel()));

        return parent::create();
    }

    /**
     * @param $id
     *
     * @return
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->policyAuthorize('delete', $this->crud->getModel(), $id);

        return parent::destroy($id);
    }

    /**
     * @param $id
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->policyAuthorize('update', $this->crud->getModel(), $id);

        return parent::edit($id);
    }

    /**
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->policyAuthorize('index', \get_class($this->crud->getModel()));

        return parent::index();
    }

    public function list()
    {
        $this->index();
    }

    /**
     * @param $id
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->policyAuthorize('show', $this->crud->getModel(), $id);

        return parent::show($id);
    }

    /**
     * Determines the access to allow based on policy
     *
     * @param string       $ability The ability to validate
     * @param string|Model $class   The instance of a Model class to check against
     * @param int|null     $id      The id of the individual to check against
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    protected function policyAuthorize($ability, $class, $id = null): void
    {
        //if the controller had pre-authorized access then bail
        if ($this->crud->hasAccess($ability)) {
            return;
        }

        //the 'model' will either be a valid instance or the class name
        $model = $id !== null ? $class->findOrFail($id) : $class;

        //deny access to the ability by default
        $this->crud->denyAccess([ $ability ]);
        //let the gate decide -- if there's a user and the user is authorized
        $this->authorize($ability, $model);
        //if we get this far, then the gate has allowed access and we pass the authorization on to backpack
        $this->crud->allowAccess([ $ability ]);
    }
}
