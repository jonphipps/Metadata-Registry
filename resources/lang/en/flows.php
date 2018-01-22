<?php


    return [

        'next'                              => 'next step',
        'finish'                            => 'finish',
        'back'                              => 'back',

        'exampleFlow' => [
            'title'      => 'Example flow',
            'firstStep'  => [
                'breadcrumb' => 'Step 1',
                'title'      => 'First step',
            ],
            'secondStep' => [
                'breadcrumb' => 'Step 2',
                'title'      => 'Second step',
            ],
        ],
        'gsimport' => [
            'title'        => 'Example flow',
            'spreadsheet'  => [
                'breadcrumb' => 'Step 1',
                'title'      => 'Supply a Google Spreadsheet URL',
            ],
            'secondStep' => [
                'breadcrumb' => 'Step 2',
                'title'      => 'Second step',
            ],
        ],

        'errors'                            => [
            'general'                           => 'Something has gone wrong while processing the flow step',
            'notAllowed'                        => 'You are not allowed to access this flow step',
        ],

    ];
