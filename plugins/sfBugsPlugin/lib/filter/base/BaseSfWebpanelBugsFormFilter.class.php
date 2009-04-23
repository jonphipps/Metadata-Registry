<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SfWebpanelBugs filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSfWebpanelBugsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'       => new sfWidgetFormFilterInput(),
      'module_name' => new sfWidgetFormFilterInput(),
      'action_name' => new sfWidgetFormFilterInput(),
      'app_name'    => new sfWidgetFormFilterInput(),
      'date_added'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'description' => new sfWidgetFormFilterInput(),
      'url'         => new sfWidgetFormFilterInput(),
      'solved'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'       => new sfValidatorPass(array('required' => false)),
      'module_name' => new sfValidatorPass(array('required' => false)),
      'action_name' => new sfValidatorPass(array('required' => false)),
      'app_name'    => new sfValidatorPass(array('required' => false)),
      'date_added'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'description' => new sfValidatorPass(array('required' => false)),
      'url'         => new sfValidatorPass(array('required' => false)),
      'solved'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sf_webpanel_bugs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SfWebpanelBugs';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title'       => 'Text',
      'module_name' => 'Text',
      'action_name' => 'Text',
      'app_name'    => 'Text',
      'date_added'  => 'Date',
      'description' => 'Text',
      'url'         => 'Text',
      'solved'      => 'Number',
    );
  }
}
