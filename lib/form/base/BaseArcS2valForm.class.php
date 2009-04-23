<?php

/**
 * ArcS2val form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcS2valForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'   => new sfWidgetFormInputHidden(),
      'cid'  => new sfWidgetFormInput(),
      'misc' => new sfWidgetFormInputCheckbox(),
      'val'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'   => new sfValidatorPropelChoice(array('model' => 'ArcS2val', 'column' => 'id', 'required' => false)),
      'cid'  => new sfValidatorInteger(),
      'misc' => new sfValidatorBoolean(),
      'val'  => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('arc_s2val[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcS2val';
  }


}
