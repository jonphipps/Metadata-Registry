<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SchemaPropertyElement filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyElementFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_property_id'         => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'profile_property_id'        => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => true)),
      'is_schema_property'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'object'                     => new sfWidgetFormFilterInput(),
      'related_schema_property_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'language'                   => new sfWidgetFormFilterInput(),
      'status_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'schema_property_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'profile_property_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProfileProperty', 'column' => 'id')),
      'is_schema_property'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'object'                     => new sfValidatorPass(array('required' => false)),
      'related_schema_property_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'language'                   => new sfValidatorPass(array('required' => false)),
      'status_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('schema_property_element_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaPropertyElement';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'created_at'                 => 'Date',
      'updated_at'                 => 'Date',
      'deleted_at'                 => 'Date',
      'created_user_id'            => 'ForeignKey',
      'updated_user_id'            => 'ForeignKey',
      'schema_property_id'         => 'ForeignKey',
      'profile_property_id'        => 'ForeignKey',
      'is_schema_property'         => 'Boolean',
      'object'                     => 'Text',
      'related_schema_property_id' => 'ForeignKey',
      'language'                   => 'Text',
      'status_id'                  => 'ForeignKey',
    );
  }
}
