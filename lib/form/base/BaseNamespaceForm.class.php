<?php

/**
 * Namespace form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseNamespaceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'schema_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => false)),
      'created_at'      => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'created_user_id' => new sfWidgetFormInput(),
      'updated_user_id' => new sfWidgetFormInput(),
      'token'           => new sfWidgetFormInput(),
      'note'            => new sfWidgetFormTextarea(),
      'uri'             => new sfWidgetFormInput(),
      'schema_location' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Namespace', 'column' => 'id', 'required' => false)),
      'schema_id'       => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id')),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'created_user_id' => new sfValidatorInteger(array('required' => false)),
      'updated_user_id' => new sfValidatorInteger(array('required' => false)),
      'token'           => new sfValidatorString(array('max_length' => 255)),
      'note'            => new sfValidatorString(array('required' => false)),
      'uri'             => new sfValidatorString(array('max_length' => 255)),
      'schema_location' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('namespace[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Namespace';
  }


}
