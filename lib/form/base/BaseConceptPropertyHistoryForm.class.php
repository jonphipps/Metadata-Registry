<?php

/**
 * ConceptPropertyHistory form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptPropertyHistoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'created_at'          => new sfWidgetFormDateTime(),
      'action'              => new sfWidgetFormInput(),
      'concept_property_id' => new sfWidgetFormPropelChoice(array('model' => 'ConceptProperty', 'add_empty' => true)),
      'concept_id'          => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'vocabulary_id'       => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'skos_property_id'    => new sfWidgetFormPropelChoice(array('model' => 'SkosProperty', 'add_empty' => true)),
      'object'              => new sfWidgetFormTextarea(),
      'scheme_id'           => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'related_concept_id'  => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'language'            => new sfWidgetFormInput(),
      'status_id'           => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'created_user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'change_note'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'ConceptPropertyHistory', 'column' => 'id', 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'action'              => new sfValidatorString(array('required' => false)),
      'concept_property_id' => new sfValidatorPropelChoice(array('model' => 'ConceptProperty', 'column' => 'id', 'required' => false)),
      'concept_id'          => new sfValidatorPropelChoice(array('model' => 'Concept', 'column' => 'id', 'required' => false)),
      'vocabulary_id'       => new sfValidatorPropelChoice(array('model' => 'Vocabulary', 'column' => 'id', 'required' => false)),
      'skos_property_id'    => new sfValidatorPropelChoice(array('model' => 'SkosProperty', 'column' => 'id', 'required' => false)),
      'object'              => new sfValidatorString(array('required' => false)),
      'scheme_id'           => new sfValidatorPropelChoice(array('model' => 'Vocabulary', 'column' => 'id', 'required' => false)),
      'related_concept_id'  => new sfValidatorPropelChoice(array('model' => 'Concept', 'column' => 'id', 'required' => false)),
      'language'            => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'status_id'           => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'created_user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'change_note'         => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ConceptPropertyHistory', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('concept_property_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConceptPropertyHistory';
  }


}
