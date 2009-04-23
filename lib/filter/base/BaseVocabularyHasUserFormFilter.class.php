<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * VocabularyHasUser filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseVocabularyHasUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'vocabulary_id'     => new sfWidgetFormPropelChoice(array('model' => 'Vocabulary', 'add_empty' => true)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'is_maintainer_for' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_registrar_for'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_admin_for'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'vocabulary_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Vocabulary', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'is_maintainer_for' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_registrar_for'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_admin_for'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('vocabulary_has_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'VocabularyHasUser';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'deleted_at'        => 'Date',
      'vocabulary_id'     => 'ForeignKey',
      'user_id'           => 'ForeignKey',
      'is_maintainer_for' => 'Boolean',
      'is_registrar_for'  => 'Boolean',
      'is_admin_for'      => 'Boolean',
    );
  }
}
