<?php namespace App\Flows\GsImport\Steps;


use Ixudra\Wizard\Models\Flow;
use Ixudra\Wizard\Services\Html\FlowViewFactory;
use App\Flows\GsImport\FlowStep;

class Spreadsheet extends FlowStep {

    public function __construct(FlowViewFactory $flowViewFactory)
    {
        parent::__construct( $flowViewFactory );
    }


    protected function getViewParameters(Flow $flow, array $input = array())
    {
        return array(
            'input'         => $input,
        );
    }

    public function handle(Flow $flow, $input = array())
    {
        return $this->next( $flow, 'next-step' );
    }


    protected function getView()
    {
        return 'bootstrap.flows.gsimport.spreadsheet.step';
    }

    protected function getTranslationPrefix()
    {
        return 'flows.gsimport.spreadsheet';
    }

    protected function getBreadcrumbKey()
    {
        return 'spreadsheet';
    }

}
