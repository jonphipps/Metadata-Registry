<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-17,  Time: 6:23 PM */

namespace App\Http\Controllers;

use App\CRUD\CustomCrudPanel as CrudPanel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CustomCrudController extends CrudController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @noinspection PhpMissingParentConstructorInspection */
    /** @noinspection MagicMethodsValidityInspection */
    public function __construct()
    {
        if ( ! $this->crud ) {
            $this->crud = new CrudPanel();

            // call the setup function inside this closure to also have the request there
            // this way, developers can use things stored in session (auth variables, etc)
            $this->middleware( function( $request, $next ) {
                $this->request       = $request;
                $this->crud->request = $request;
                $this->setup();

                return $next( $request );
            } );
        }
    }

    public function index()
    {
        $this->policyAuthorize( 'index', $this->crud->getModel() );

        return parent::index();
    }

    public function create()
    {
        $this->policyAuthorize( 'create', $this->crud->getModel() );

        return parent::create();
    }

    public function edit( $id )
    {
        $this->policyAuthorize( 'update', $id );

        return parent::edit( $id );
    }

    public function show( $id )
    {
        $this->policyAuthorize( 'show', $id );

        return parent::show( $id );
    }

    public function destroy( $id )
    {
        $this->policyAuthorize( 'delete', $id );

        return parent::destroy( $id );
    }

    /**
     * Determines the access to allow based on policy
     *
     * @param string    $ability   The ability to validate
     * @param int|Model $idOrModel If instance of a Model then the ability is class based
     */
    protected function policyAuthorize( $ability, $idOrModel ): void
    {
        if ( $idOrModel instanceof Model ) {
            $model = $idOrModel;
        } else {
            $model = $this->crud->getModel()::findOrFail( $idOrModel );
        }
        if ( Auth::check() && auth::user()->can( $ability, $model ) ) {
            $this->crud->allowAccess( [ $ability ] );
        }
    }
}
