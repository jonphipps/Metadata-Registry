<?php

/**
 * Schema form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'agent_id'              => new sfWidgetFormPropelChoice(array('model' => 'Agent', 'add_empty' => false)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'deleted_at'            => new sfWidgetFormDateTime(),
      'created_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'child_updated_at'      => new sfWidgetFormDateTime(),
      'child_updated_user_id' => new sfWidgetFormInput(),
      'name'                  => new sfWidgetFormInput(),
      'note'                  => new sfWidgetFormTextarea(),
      'uri'                   => new sfWidgetFormInput(),
      'url'                   => new sfWidgetFormInput(),
      'base_domain'           => new sfWidgetFormInput(),
      'token'                 => new sfWidgetFormInput(),
      'community'             => new sfWidgetFormInput(),
      'last_uri_id'           => new sfWidgetFormInput(),
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'language'              => new sfWidgetFormInput(),
      'profile_id'            => new sfWidgetFormPropelChoice(array('model' => 'Profile', 'add_empty' => true)),
      'ns_type'               => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id', 'required' => false)),
      'agent_id'              => new sfValidatorPropelChoice(array('model' => 'Agent', 'column' => 'id')),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
      'deleted_at'            => new sfValidatorDateTime(array('required' => false)),
      'created_user_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_user_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'child_updated_at'      => new sfValidatorDateTime(array('required' => false)),
      'child_updated_user_id' => new sfValidatorInteger(array('required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 255)),
      'note'                  => new sfValidatorString(array('required' => false)),
      'uri'                   => new sfValidatorString(array('max_length' => 255)),
      'url'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'base_domain'           => new sfValidatorString(array('max_length' => 255)),
      'token'                 => new sfValidatorString(array('max_length' => 45)),
      'community'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'last_uri_id'           => new sfValidatorInteger(array('required' => false)),
      'status_id'             => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id')),
      'language'              => new sfValidatorString(array('max_length' => 6)),
      'profile_id'            => new sfValidatorPropelChoice(array('model' => 'Profile', 'column' => 'id', 'required' => false)),
      'ns_type'               => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('schema[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schema';
  }


}
