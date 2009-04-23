<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Concept filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseConceptFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_updated'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'uri'             => new sfWidgetFormFilterInput(),
      'vocabulary_id'   => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'is_top_concept'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pref_label_id'   => new sfWidgetFormPropelChoice(array('model' => 'ConceptProperty', 'add_empty' => true)),
      'pref_label'      => new sfWidgetFormFilterInput(),
      'status_id'       => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'language'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_updated'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'uri'             => new sfValidatorPass(array('required' => false)),
      'vocabulary_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Vocabulary', 'column' => 'id')),
      'is_top_concept'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pref_label_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ConceptProperty', 'column' => 'id')),
      'pref_label'      => new sfValidatorPass(array('required' => false)),
      'status_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'language'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concept_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concept';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'deleted_at'      => 'Date',
      'last_updated'    => 'Date',
      'created_user_id' => 'ForeignKey',
      'updated_user_id' => 'ForeignKey',
      'uri'             => 'Text',
      'vocabulary_id'   => 'ForeignKey',
      'is_top_concept'  => 'Boolean',
      'pref_label_id'   => 'ForeignKey',
      'pref_label'      => 'Text',
      'status_id'       => 'ForeignKey',
      'language'        => 'Text',
    );
  }
}
