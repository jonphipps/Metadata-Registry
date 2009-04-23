<?php

/**
 * ArcId2val form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcId2valForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'misc'     => new sfWidgetFormInputCheckbox(),
      'val'      => new sfWidgetFormTextarea(),
      'val_type' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'ArcId2val', 'column' => 'id', 'required' => false)),
      'misc'     => new sfValidatorBoolean(),
      'val'      => new sfValidatorString(),
      'val_type' => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ArcId2val', 'column' => array('id', 'val_type')))
    );

    $this->widgetSchema->setNameFormat('arc_id2val[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcId2val';
  }


}
