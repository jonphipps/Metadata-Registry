<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ArcSetting filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcSettingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'k'   => new sfWidgetFormFilterInput(),
      'val' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'k'   => new sfValidatorPass(array('required' => false)),
      'val' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('arc_setting_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcSetting';
  }

  public function getFields()
  {
    return array(
      'k'   => 'Text',
      'val' => 'Text',
      'id'  => 'Number',
    );
  }
}
