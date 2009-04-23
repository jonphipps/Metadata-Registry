<?php

/**
 * ArcSetting form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcSettingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'k'   => new sfWidgetFormInput(),
      'val' => new sfWidgetFormTextarea(),
      'id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'k'   => new sfValidatorString(array('max_length' => 32)),
      'val' => new sfValidatorString(),
      'id'  => new sfValidatorPropelChoice(array('model' => 'ArcSetting', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ArcSetting', 'column' => array('k')))
    );

    $this->widgetSchema->setNameFormat('arc_setting[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcSetting';
  }


}
