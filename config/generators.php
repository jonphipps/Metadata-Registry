<?php


    return [

        'namespace'         => 'App',


        'files'             => [

            'model'                 => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Model.txt'),
                'path'                  => app_path('Models'),
                'name'                  => '##VALUE##.php'
            ],

            'controller'            => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Controller.txt'),
                'path'                  => app_path('Http/Controllers') .'/##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##Controller.php'
            ],

            'controllerTest'        => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ControllerTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Controllers') .'/##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##ControllerTest.php'
            ],

            'repository'            => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Repository.txt'),
                'path'                  => app_path('Repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##Repository.php'
            ],

            'repositoryTest'        => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/RepositoryTest.txt'),
                'path'                  => app_path('../tests/functional/Repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##RepositoryTest.php'
            ],

            'factory'               => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Factory.txt'),
                'path'                  => app_path('Services/Factories'),
                'name'                  => '##VALUE##Factory.php'
            ],

            'factoryTest'           => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FactoryTest.txt'),
                'path'                  => app_path('../tests/functional/Services/Factories'),
                'name'                  => '##VALUE##FactoryTest.php'
            ],

            'viewFactory'           => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactory.txt'),
                'path'                  => app_path('Services/Html') .'##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##ViewFactory.php'
            ],

            'viewFactoryTest'       => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactoryTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Html') .'/##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##ViewFactoryTest.php'
            ],

            'inputHelper'           => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/InputHelper.txt'),
                'path'                  => app_path('Services/Input'),
                'name'                  => '##VALUE##InputHelper.php'
            ],

            'inputHelperTest'       => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/InputHelperTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Input'),
                'name'                  => '##VALUE##InputHelperTest.php'
            ],

            'formHelper'            => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormHelper.txt'),
                'path'                  => app_path('Services/Form'),
                'name'                  => '##VALUE##FormHelper.php'
            ],

            'formHelperTest'        => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormHelperTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Form'),
                'name'                  => '##VALUE##FormHelperTest.php'
            ],

            'validationHelper'      => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ValidationHelper.txt'),
                'path'                  => app_path('Services/Validation'),
                'name'                  => '##VALUE##ValidationHelper.php'
            ],

            'validationHelperTest'  => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ValidationHelperTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Validation'),
                'name'                  => '##VALUE##ValidationHelperTest.php'
            ],

            'presenter'             => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Presenter.txt'),
                'path'                  => app_path('Presenters'),
                'name'                  => '##VALUE##Presenter.php'
            ],


            //- FormRequests ---

            'createFormRequest'     => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Create##VALUE##FormRequest.php'
            ],

            'createFormRequestTest' => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateFormRequestTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Create##VALUE##FormRequestTest.php'
            ],

            'updateFormRequest'     => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/UpdateFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Update##VALUE##FormRequest.php'
            ],

            'updateFormRequestTest' => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/UpdateFormRequestTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Update##VALUE##FormRequestTest.php'
            ],

            'filterFormRequest'     => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Filter##VALUE##FormRequest.php'
            ],

            'filterFormRequestTest' => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterFormRequestTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##',
                'name'                  => 'Filter##VALUE##FormRequestTest.php'
            ],


            //- views ---

            'indexView'             => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/IndexView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'index.blade.php'
            ],

            'listView'              => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ListView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'list.blade.php'
            ],

            'tableView'             => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/TableView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'table.blade.php'
            ],

            'showView'              => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ShowView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'show.blade.php'
            ],

            'createView'            => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'create.blade.php'
            ],

            'editView'              => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/EditView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'edit.blade.php'
            ],

            'formView'              => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'form.blade.php'
            ],

            'filterView'            => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##',
                'name'                  => 'filter.blade.php'
            ],


            // Flow

            'flowHandler'           => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FlowHandler.txt'),
                'path'                  => app_path('Flows') .'/##FLOW_CLASS##',
                'name'                  => 'FlowHandler.php'
            ],

            'baseFlowStep'          => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/BaseFlowStep.txt'),
                'path'                  => app_path('Flows') .'/##FLOW_CLASS##',
                'name'                  => 'FlowStep.php'
            ],

            'flowStep'              => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FlowStep.txt'),
                'path'                  => app_path('Flows') .'/##FLOW_CLASS##/Steps',
                'name'                  => '##FLOW_STEP_CLASS##Step.php'
            ],

            'flowStepView'          => [
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FlowStepView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap/flows/##FLOW_VARIABLE##/##FLOW_STEP_VARIABLE##',
                'name'                  => 'step.blade.php'
            ],

        ],

        'groups'            => [

            'resource'          => [
                'model',
                'controller',
                'controllerTest',
                'repository',
                'repositoryTest',
                'factory',
                'factoryTest',
                'viewFactory',
                'viewFactoryTest',
                'inputHelper',
                'inputHelperTest',
                'formHelper',
                'formHelperTest',
                'validationHelper',
                'validationHelperTest',
                'presenter',
                'createFormRequest',
                'createFormRequestTest',
                'updateFormRequest',
                'updateFormRequestTest',
                'filterFormRequest',
                'filterFormRequestTest',
                'indexView',
                'listView',
                'tableView',
                'showView',
                'createView',
                'editView',
                'formView',
                'filterView',
            ],

            'dataObject'        => [
                'model',
                'repository',
                'repositoryTest',
                'factory',
                'factoryTest',
                'inputHelper',
                'inputHelperTest',
                'formHelper',
                'formHelperTest',
                'validationHelper',
                'validationHelperTest',
                'presenter',
            ],

            'views'             => [
                'indexView',
                'listView',
                'tableView',
                'showView',
                'createView',
                'editView',
                'formView',
                'filterView',
            ],

            'flow'              => [
                'flowHandler',
                'baseFlowStep',
                'flowStep',
                'flowStepView',
            ],


            'flowStep'              => [
                'flowStep',
                'flowStepView',
            ],

        ],

    ];
