<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfBreadNavApplication filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBreadNavApplicationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'application' => new sfWidgetFormFilterInput(),
      'css'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'        => new sfValidatorPass(array('required' => false)),
      'application' => new sfValidatorPass(array('required' => false)),
      'css'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_bread_nav_application_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBreadNavApplication';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'Number',
      'name'        => 'Text',
      'application' => 'Text',
      'css'         => 'Text',
    );
  }
}
