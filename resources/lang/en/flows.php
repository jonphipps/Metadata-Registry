<?php


    return array(

        'next'                              => 'next step',
        'finish'                            => 'finish',
        'back'                              => 'back',

        'exampleFlow'                       => array(
            'title'                             => 'Example flow',
            'firstStep'                         => array(
                'breadcrumb'                        => 'Step 1',
                'title'                             => 'First step',
            ),
            'secondStep'                        => array(
                'breadcrumb'                        => 'Step 2',
                'title'                             => 'Second step',
            ),
        ),

        'errors'                            => array(
            'general'                           => 'Something has gone wrong while processing the flow step',
            'notAllowed'                        => 'You are not allowed to access this flow step',
        ),

    );
