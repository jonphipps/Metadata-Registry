<?php

/**
 * SchemaPropertyElementHistory form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyElementHistoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'created_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'action'                     => new sfWidgetFormInput(),
      'schema_property_element_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaPropertyElement', 'add_empty' => true)),
      'schema_property_id'         => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'schema_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'profile_property_id'        => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => true)),
      'object'                     => new sfWidgetFormTextarea(),
      'related_schema_property_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'language'                   => new sfWidgetFormInput(),
      'status_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'change_note'                => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorPropelChoice(array('model' => 'SchemaPropertyElementHistory', 'column' => 'id', 'required' => false)),
      'created_at'                 => new sfValidatorDateTime(),
      'created_user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'action'                     => new sfValidatorString(array('required' => false)),
      'schema_property_element_id' => new sfValidatorPropelChoice(array('model' => 'SchemaPropertyElement', 'column' => 'id', 'required' => false)),
      'schema_property_id'         => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'schema_id'                  => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id', 'required' => false)),
      'profile_property_id'        => new sfValidatorPropelChoice(array('model' => 'ProfileProperty', 'column' => 'id', 'required' => false)),
      'object'                     => new sfValidatorString(array('required' => false)),
      'related_schema_property_id' => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'language'                   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'status_id'                  => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'change_note'                => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_property_element_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaPropertyElementHistory';
  }


}
