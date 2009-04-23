<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ProfileProperty filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProfilePropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'deleted_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'profile_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Profile', 'add_empty' => true)),
      'schema_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'schema_property_id'          => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'name'                        => new sfWidgetFormFilterInput(),
      'label'                       => new sfWidgetFormFilterInput(),
      'definition'                  => new sfWidgetFormFilterInput(),
      'comment'                     => new sfWidgetFormFilterInput(),
      'type'                        => new sfWidgetFormFilterInput(),
      'uri'                         => new sfWidgetFormFilterInput(),
      'status_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'language'                    => new sfWidgetFormFilterInput(),
      'note'                        => new sfWidgetFormFilterInput(),
      'display_order'               => new sfWidgetFormFilterInput(),
      'picklist_order'              => new sfWidgetFormFilterInput(),
      'examples'                    => new sfWidgetFormFilterInput(),
      'is_required'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_reciprocal'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_singleton'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_in_picklist'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'inverse_profile_property_id' => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_by'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'deleted_by'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'profile_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Profile', 'column' => 'id')),
      'schema_id'                   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schema', 'column' => 'id')),
      'schema_property_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SchemaProperty', 'column' => 'id')),
      'name'                        => new sfValidatorPass(array('required' => false)),
      'label'                       => new sfValidatorPass(array('required' => false)),
      'definition'                  => new sfValidatorPass(array('required' => false)),
      'comment'                     => new sfValidatorPass(array('required' => false)),
      'type'                        => new sfValidatorPass(array('required' => false)),
      'uri'                         => new sfValidatorPass(array('required' => false)),
      'status_id'                   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'language'                    => new sfValidatorPass(array('required' => false)),
      'note'                        => new sfValidatorPass(array('required' => false)),
      'display_order'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'picklist_order'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'examples'                    => new sfValidatorPass(array('required' => false)),
      'is_required'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_reciprocal'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_singleton'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_in_picklist'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'inverse_profile_property_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ProfileProperty', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profile_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfileProperty';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
      'deleted_at'                  => 'Date',
      'created_by'                  => 'ForeignKey',
      'updated_by'                  => 'ForeignKey',
      'deleted_by'                  => 'ForeignKey',
      'profile_id'                  => 'ForeignKey',
      'schema_id'                   => 'ForeignKey',
      'schema_property_id'          => 'ForeignKey',
      'name'                        => 'Text',
      'label'                       => 'Text',
      'definition'                  => 'Text',
      'comment'                     => 'Text',
      'type'                        => 'Text',
      'uri'                         => 'Text',
      'status_id'                   => 'ForeignKey',
      'language'                    => 'Text',
      'note'                        => 'Text',
      'display_order'               => 'Number',
      'picklist_order'              => 'Number',
      'examples'                    => 'Text',
      'is_required'                 => 'Boolean',
      'is_reciprocal'               => 'Boolean',
      'is_singleton'                => 'Boolean',
      'is_in_picklist'              => 'Boolean',
      'inverse_profile_property_id' => 'ForeignKey',
    );
  }
}
