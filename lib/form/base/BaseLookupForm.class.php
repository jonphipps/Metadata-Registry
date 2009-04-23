<?php

/**
 * Lookup form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLookupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'type_id'       => new sfWidgetFormInput(),
      'short_value'   => new sfWidgetFormInput(),
      'long_value'    => new sfWidgetFormInput(),
      'display_order' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Lookup', 'column' => 'id', 'required' => false)),
      'type_id'       => new sfValidatorInteger(array('required' => false)),
      'short_value'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'long_value'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'display_order' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Lookup', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('lookup[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lookup';
  }


}
