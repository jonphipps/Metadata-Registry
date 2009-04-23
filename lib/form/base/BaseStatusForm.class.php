<?php

/**
 * Status form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseStatusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'display_order' => new sfWidgetFormInput(),
      'display_name'  => new sfWidgetFormInput(),
      'uri'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'display_order' => new sfValidatorInteger(array('required' => false)),
      'display_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'uri'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Status', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }


}
