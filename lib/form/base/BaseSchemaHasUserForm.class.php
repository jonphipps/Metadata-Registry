<?php

/**
 * SchemaHasUser form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaHasUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'deleted_at'        => new sfWidgetFormDateTime(),
      'schema_id'         => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => false)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'is_maintainer_for' => new sfWidgetFormInputCheckbox(),
      'is_registrar_for'  => new sfWidgetFormInputCheckbox(),
      'is_admin_for'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'SchemaHasUser', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'schema_id'         => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'is_maintainer_for' => new sfValidatorBoolean(array('required' => false)),
      'is_registrar_for'  => new sfValidatorBoolean(array('required' => false)),
      'is_admin_for'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'SchemaHasUser', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('schema_has_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaHasUser';
  }


}
