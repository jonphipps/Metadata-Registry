<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Status filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseStatusFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'display_order' => new sfWidgetFormFilterInput(),
      'display_name'  => new sfWidgetFormFilterInput(),
      'uri'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'display_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'display_name'  => new sfValidatorPass(array('required' => false)),
      'uri'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('status_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'display_order' => 'Number',
      'display_name'  => 'Text',
      'uri'           => 'Text',
    );
  }
}
