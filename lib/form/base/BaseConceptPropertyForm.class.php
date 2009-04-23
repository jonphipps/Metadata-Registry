<?php

/**
 * ConceptProperty form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptPropertyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'deleted_at'         => new sfWidgetFormDateTime(),
      'last_updated'       => new sfWidgetFormDateTime(),
      'created_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'concept_id'         => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => false)),
      'primary_pref_label' => new sfWidgetFormInputCheckbox(),
      'skos_property_id'   => new sfWidgetFormPropelChoice(array('model' => 'SkosProperty', 'add_empty' => false)),
      'object'             => new sfWidgetFormTextarea(),
      'scheme_id'          => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'related_concept_id' => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'language'           => new sfWidgetFormInput(),
      'status_id'          => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'ConceptProperty', 'column' => 'id', 'required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(),
      'deleted_at'         => new sfValidatorDateTime(array('required' => false)),
      'last_updated'       => new sfValidatorDateTime(array('required' => false)),
      'created_user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'concept_id'         => new sfValidatorPropelChoice(array('model' => 'Concept', 'column' => 'id')),
      'primary_pref_label' => new sfValidatorBoolean(array('required' => false)),
      'skos_property_id'   => new sfValidatorPropelChoice(array('model' => 'SkosProperty', 'column' => 'id')),
      'object'             => new sfValidatorString(),
      'scheme_id'          => new sfValidatorPropelChoice(array('model' => 'Vocabulary', 'column' => 'id', 'required' => false)),
      'related_concept_id' => new sfValidatorPropelChoice(array('model' => 'Concept', 'column' => 'id', 'required' => false)),
      'language'           => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'status_id'          => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ConceptProperty', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('concept_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConceptProperty';
  }


}
