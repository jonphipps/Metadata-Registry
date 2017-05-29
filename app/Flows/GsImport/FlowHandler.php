<?php namespace App\Flows\GsImport;


use Ixudra\Wizard\Flows\BaseFlowHandler;

class FlowHandler extends BaseFlowHandler {

    public function isAllowed($input = array())
    {
        return true;
    }

    protected function getStepsForBreadcrumbs()
    {
        return array(
            'spreadsheet'                    => array(
                'title'                         => 'flows.gsimport.spreadsheet.breadcrumb',
                'params'                        => array()
            ),
            'second-step'                   => array(
                'title'                         => 'flows.gsimport.secondStep.breadcrumb',
                'params'                        => array()
            ),
        );
    }

}
