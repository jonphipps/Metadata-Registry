<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ConceptProperty filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptPropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_updated'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'concept_id'         => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'primary_pref_label' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'skos_property_id'   => new sfWidgetFormPropelChoice(array('model' => 'SkosProperty', 'add_empty' => true)),
      'object'             => new sfWidgetFormFilterInput(),
      'scheme_id'          => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'related_concept_id' => new sfWidgetFormPropelChoice(array('model' => 'Concept', 'add_empty' => true)),
      'language'           => new sfWidgetFormFilterInput(),
      'status_id'          => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_updated'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'concept_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Concept', 'column' => 'id')),
      'primary_pref_label' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'skos_property_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SkosProperty', 'column' => 'id')),
      'object'             => new sfValidatorPass(array('required' => false)),
      'scheme_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Vocabulary', 'column' => 'id')),
      'related_concept_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Concept', 'column' => 'id')),
      'language'           => new sfValidatorPass(array('required' => false)),
      'status_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('concept_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConceptProperty';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'deleted_at'         => 'Date',
      'last_updated'       => 'Date',
      'created_user_id'    => 'ForeignKey',
      'updated_user_id'    => 'ForeignKey',
      'concept_id'         => 'ForeignKey',
      'primary_pref_label' => 'Boolean',
      'skos_property_id'   => 'ForeignKey',
      'object'             => 'Text',
      'scheme_id'          => 'ForeignKey',
      'related_concept_id' => 'ForeignKey',
      'language'           => 'Text',
      'status_id'          => 'ForeignKey',
    );
  }
}
