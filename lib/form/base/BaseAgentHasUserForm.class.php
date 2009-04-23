<?php

/**
 * AgentHasUser form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAgentHasUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'deleted_at'       => new sfWidgetFormDateTime(),
      'created_at'       => new sfWidgetFormDateTime(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'agent_id'         => new sfWidgetFormPropelChoice(array('model' => 'Agent', 'add_empty' => false)),
      'is_registrar_for' => new sfWidgetFormInputCheckbox(),
      'is_admin_for'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'AgentHasUser', 'column' => 'id', 'required' => false)),
      'updated_at'       => new sfValidatorDateTime(),
      'deleted_at'       => new sfValidatorDateTime(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'agent_id'         => new sfValidatorPropelChoice(array('model' => 'Agent', 'column' => 'id')),
      'is_registrar_for' => new sfValidatorBoolean(array('required' => false)),
      'is_admin_for'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'AgentHasUser', 'column' => array('user_id', 'agent_id'))),
        new sfValidatorPropelUnique(array('model' => 'AgentHasUser', 'column' => array('agent_id', 'user_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('agent_has_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AgentHasUser';
  }


}
