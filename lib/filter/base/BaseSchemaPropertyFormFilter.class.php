<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SchemaProperty filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaPropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'schema_id'         => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(),
      'label'             => new sfWidgetFormFilterInput(),
      'definition'        => new sfWidgetFormFilterInput(),
      'comment'           => new sfWidgetFormFilterInput(),
      'type'              => new sfWidgetFormFilterInput(),
      'is_subproperty_of' => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'parent_uri'        => new sfWidgetFormFilterInput(),
      'uri'               => new sfWidgetFormFilterInput(),
      'status_id'         => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'language'          => new sfWidgetFormFilterInput(),
      'note'              => new sfWidgetFormFilterInput(),
      'domain'            => new sfWidgetFormFilterInput(),
      'range'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'schema_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schema', 'column' => 'id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'label'             => new sfValidatorPass(array('required' => false)),
      'definition'        => new sfValidatorPass(array('required' => false)),
      'comment'           => new sfValidatorPass(array('required' => false)),
      'type'              => new sfValidatorPass(array('required' => false)),
      'is_subproperty_of' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'parent_uri'        => new sfValidatorPass(array('required' => false)),
      'uri'               => new sfValidatorPass(array('required' => false)),
      'status_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'language'          => new sfValidatorPass(array('required' => false)),
      'note'              => new sfValidatorPass(array('required' => false)),
      'domain'            => new sfValidatorPass(array('required' => false)),
      'range'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SchemaProperty';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'deleted_at'        => 'Date',
      'created_user_id'   => 'ForeignKey',
      'updated_user_id'   => 'ForeignKey',
      'schema_id'         => 'ForeignKey',
      'name'              => 'Text',
      'label'             => 'Text',
      'definition'        => 'Text',
      'comment'           => 'Text',
      'type'              => 'Text',
      'is_subproperty_of' => 'ForeignKey',
      'parent_uri'        => 'Text',
      'uri'               => 'Text',
      'status_id'         => 'ForeignKey',
      'language'          => 'Text',
      'note'              => 'Text',
      'domain'            => 'Text',
      'range'             => 'Text',
    );
  }
}
