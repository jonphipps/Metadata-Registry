<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-17,  Time: 6:23 PM */

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\CRUD\CustomCrudPanel as CrudPanel;

class CustomCrudController extends CrudController
{

    public function __construct()
    {
        if ( ! $this->crud) {
            $this->crud = new CrudPanel();

            // call the setup function inside this closure to also have the request there
            // this way, developers can use things stored in session (auth variables, etc)
            $this->middleware(function($request, $next) {
                $this->request       = $request;
                $this->crud->request = $request;
                $this->setup();

                return $next($request);
            });
        }
    }
}
