<?php

/**
 * Concept form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'last_updated'    => new sfWidgetFormDateTime(),
      'created_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'uri'             => new sfWidgetFormInput(),
      'vocabulary_id'   => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'is_top_concept'  => new sfWidgetFormInputCheckbox(),
      'pref_label_id'   => new sfWidgetFormPropelChoice(array('model' => 'ConceptProperty', 'add_empty' => true)),
      'pref_label'      => new sfWidgetFormInput(),
      'status_id'       => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'language'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Concept', 'column' => 'id', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'last_updated'    => new sfValidatorDateTime(array('required' => false)),
      'created_user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'uri'             => new sfValidatorString(array('max_length' => 255)),
      'vocabulary_id'   => new sfValidatorPropelChoice(array('model' => 'Vocabulary', 'column' => 'id', 'required' => false)),
      'is_top_concept'  => new sfValidatorBoolean(array('required' => false)),
      'pref_label_id'   => new sfValidatorPropelChoice(array('model' => 'ConceptProperty', 'column' => 'id', 'required' => false)),
      'pref_label'      => new sfValidatorString(array('max_length' => 255)),
      'status_id'       => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id')),
      'language'        => new sfValidatorString(array('max_length' => 6)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Concept', 'column' => array('vocabulary_id', 'pref_label')))
    );

    $this->widgetSchema->setNameFormat('concept[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concept';
  }


}
