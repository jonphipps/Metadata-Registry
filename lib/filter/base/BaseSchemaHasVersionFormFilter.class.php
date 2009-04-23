<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SchemaHasVersion filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaHasVersionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'timeslice'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'schema_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schema', 'column' => 'id')),
      'timeslice'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('schema_has_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaHasVersion';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'created_at'      => 'Date',
      'deleted_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_user_id' => 'ForeignKey',
      'schema_id'       => 'ForeignKey',
      'timeslice'       => 'Date',
    );
  }
}
