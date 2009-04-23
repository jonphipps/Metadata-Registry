<?php

/**
 * SchemaProperty form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'deleted_at'        => new sfWidgetFormDateTime(),
      'created_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_id'         => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => false)),
      'name'              => new sfWidgetFormInput(),
      'label'             => new sfWidgetFormInput(),
      'definition'        => new sfWidgetFormTextarea(),
      'comment'           => new sfWidgetFormTextarea(),
      'type'              => new sfWidgetFormInput(),
      'is_subproperty_of' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'parent_uri'        => new sfWidgetFormInput(),
      'uri'               => new sfWidgetFormInput(),
      'status_id'         => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'language'          => new sfWidgetFormInput(),
      'note'              => new sfWidgetFormTextarea(),
      'domain'            => new sfWidgetFormInput(),
      'range'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'created_user_id'   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_user_id'   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'schema_id'         => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id')),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'label'             => new sfValidatorString(array('max_length' => 255)),
      'definition'        => new sfValidatorString(array('required' => false)),
      'comment'           => new sfValidatorString(array('required' => false)),
      'type'              => new sfValidatorString(),
      'is_subproperty_of' => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'parent_uri'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'uri'               => new sfValidatorString(array('max_length' => 255)),
      'status_id'         => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id')),
      'language'          => new sfValidatorString(array('max_length' => 6)),
      'note'              => new sfValidatorString(array('required' => false)),
      'domain'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'range'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaProperty';
  }


}
