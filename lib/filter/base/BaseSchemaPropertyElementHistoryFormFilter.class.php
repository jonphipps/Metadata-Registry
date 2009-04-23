<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SchemaPropertyElementHistory filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyElementHistoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'action'                     => new sfWidgetFormFilterInput(),
      'schema_property_element_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaPropertyElement', 'add_empty' => true)),
      'schema_property_id'         => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'schema_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'profile_property_id'        => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => true)),
      'object'                     => new sfWidgetFormFilterInput(),
      'related_schema_property_id' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'language'                   => new sfWidgetFormFilterInput(),
      'status_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'change_note'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'action'                     => new sfValidatorPass(array('required' => false)),
      'schema_property_element_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaPropertyElement', 'column' => 'id')),
      'schema_property_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'schema_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schema', 'column' => 'id')),
      'profile_property_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProfileProperty', 'column' => 'id')),
      'object'                     => new sfValidatorPass(array('required' => false)),
      'related_schema_property_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'language'                   => new sfValidatorPass(array('required' => false)),
      'status_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'change_note'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_property_element_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaPropertyElementHistory';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'created_at'                 => 'Date',
      'created_user_id'            => 'ForeignKey',
      'action'                     => 'Text',
      'schema_property_element_id' => 'ForeignKey',
      'schema_property_id'         => 'ForeignKey',
      'schema_id'                  => 'ForeignKey',
      'profile_property_id'        => 'ForeignKey',
      'object'                     => 'Text',
      'related_schema_property_id' => 'ForeignKey',
      'language'                   => 'Text',
      'status_id'                  => 'ForeignKey',
      'change_note'                => 'Text',
    );
  }
}
