<?php

/**
 * VocabularyHasUser form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseVocabularyHasUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'deleted_at'        => new sfWidgetFormDateTime(),
      'vocabulary_id'     => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => false)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'is_maintainer_for' => new sfWidgetFormInputCheckbox(),
      'is_registrar_for'  => new sfWidgetFormInputCheckbox(),
      'is_admin_for'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'VocabularyHasUser', 'column' => 'id', 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'vocabulary_id'     => new sfValidatorPropelChoice(array('model' => 'Vocabulary', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'is_maintainer_for' => new sfValidatorBoolean(array('required' => false)),
      'is_registrar_for'  => new sfValidatorBoolean(array('required' => false)),
      'is_admin_for'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'VocabularyHasUser', 'column' => array('vocabulary_id', 'user_id'))),
        new sfValidatorPropelUnique(array('model' => 'VocabularyHasUser', 'column' => array('user_id', 'vocabulary_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('vocabulary_has_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'VocabularyHasUser';
  }


}
