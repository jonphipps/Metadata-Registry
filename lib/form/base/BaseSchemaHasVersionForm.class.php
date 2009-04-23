<?php

/**
 * SchemaHasVersion form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaHasVersionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'created_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'timeslice'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'SchemaHasVersion', 'column' => 'id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
      'created_user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'schema_id'       => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id', 'required' => false)),
      'timeslice'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'SchemaHasVersion', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('schema_has_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaHasVersion';
  }


}
