<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ConceptPropertyHistory filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptPropertyHistoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'action'              => new sfWidgetFormFilterInput(),
      'concept_property_id' => new sfWidgetFormPropelChoice(array('model' => 'ConceptProperty', 'add_empty' => true)),
      'concept_id'          => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'vocabulary_id'       => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'skos_property_id'    => new sfWidgetFormPropelChoice(array('model' => 'SkosProperty', 'add_empty' => true)),
      'object'              => new sfWidgetFormFilterInput(),
      'scheme_id'           => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'related_concept_id'  => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'language'            => new sfWidgetFormFilterInput(),
      'status_id'           => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'created_user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'change_note'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'action'              => new sfValidatorPass(array('required' => false)),
      'concept_property_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ConceptProperty', 'column' => 'id')),
      'concept_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Concept', 'column' => 'id')),
      'vocabulary_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Vocabulary', 'column' => 'id')),
      'skos_property_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SkosProperty', 'column' => 'id')),
      'object'              => new sfValidatorPass(array('required' => false)),
      'scheme_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Vocabulary', 'column' => 'id')),
      'related_concept_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Concept', 'column' => 'id')),
      'language'            => new sfValidatorPass(array('required' => false)),
      'status_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'created_user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'change_note'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concept_property_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConceptPropertyHistory';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'created_at'          => 'Date',
      'action'              => 'Text',
      'concept_property_id' => 'ForeignKey',
      'concept_id'          => 'ForeignKey',
      'vocabulary_id'       => 'ForeignKey',
      'skos_property_id'    => 'ForeignKey',
      'object'              => 'Text',
      'scheme_id'           => 'ForeignKey',
      'related_concept_id'  => 'ForeignKey',
      'language'            => 'Text',
      'status_id'           => 'ForeignKey',
      'created_user_id'     => 'ForeignKey',
      'change_note'         => 'Text',
    );
  }
}
