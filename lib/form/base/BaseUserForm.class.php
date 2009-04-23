<?php

/**
 * User form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'created_at'           => new sfWidgetFormDateTime(),
      'last_updated'         => new sfWidgetFormDateTime(),
      'deleted_at'           => new sfWidgetFormDateTime(),
      'nickname'             => new sfWidgetFormInput(),
      'salutation'           => new sfWidgetFormInput(),
      'first_name'           => new sfWidgetFormInput(),
      'last_name'            => new sfWidgetFormInput(),
      'email'                => new sfWidgetFormInput(),
      'sha1_password'        => new sfWidgetFormInput(),
      'salt'                 => new sfWidgetFormInput(),
      'want_to_be_moderator' => new sfWidgetFormInputCheckbox(),
      'is_moderator'         => new sfWidgetFormInputCheckbox(),
      'is_administrator'     => new sfWidgetFormInputCheckbox(),
      'deletions'            => new sfWidgetFormInput(),
      'password'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'last_updated'         => new sfValidatorDateTime(),
      'deleted_at'           => new sfValidatorDateTime(array('required' => false)),
      'nickname'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'salutation'           => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'first_name'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'sha1_password'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'salt'                 => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'want_to_be_moderator' => new sfValidatorBoolean(array('required' => false)),
      'is_moderator'         => new sfValidatorBoolean(array('required' => false)),
      'is_administrator'     => new sfValidatorBoolean(array('required' => false)),
      'deletions'            => new sfValidatorInteger(array('required' => false)),
      'password'             => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
