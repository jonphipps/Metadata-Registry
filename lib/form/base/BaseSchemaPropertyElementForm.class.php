<?php

/**
 * SchemaPropertyElement form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyElementForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'deleted_at'                 => new sfWidgetFormDateTime(),
      'created_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_property_id'         => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => false)),
      'profile_property_id'        => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => false)),
      'is_schema_property'         => new sfWidgetFormInputCheckbox(),
      'object'                     => new sfWidgetFormTextarea(),
      'related_schema_property_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'language'                   => new sfWidgetFormInput(),
      'status_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorPropelChoice(array('model' => 'SchemaPropertyElement', 'column' => 'id', 'required' => false)),
      'created_at'                 => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                 => new sfValidatorDateTime(),
      'deleted_at'                 => new sfValidatorDateTime(array('required' => false)),
      'created_user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'schema_property_id'         => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id')),
      'profile_property_id'        => new sfValidatorPropelChoice(array('model' => 'ProfileProperty', 'column' => 'id')),
      'is_schema_property'         => new sfValidatorBoolean(array('required' => false)),
      'object'                     => new sfValidatorString(),
      'related_schema_property_id' => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'language'                   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'status_id'                  => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_property_element[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaPropertyElement';
  }


}
