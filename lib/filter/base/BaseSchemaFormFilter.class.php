<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Schema filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSchemaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'agent_id'              => new sfWidgetFormPropelChoice(array('model' => 'Agent', 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'deleted_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'child_updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'child_updated_user_id' => new sfWidgetFormFilterInput(),
      'name'                  => new sfWidgetFormFilterInput(),
      'note'                  => new sfWidgetFormFilterInput(),
      'uri'                   => new sfWidgetFormFilterInput(),
      'url'                   => new sfWidgetFormFilterInput(),
      'base_domain'           => new sfWidgetFormFilterInput(),
      'token'                 => new sfWidgetFormFilterInput(),
      'community'             => new sfWidgetFormFilterInput(),
      'last_uri_id'           => new sfWidgetFormFilterInput(),
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'language'              => new sfWidgetFormFilterInput(),
      'profile_id'            => new sfWidgetFormPropelChoice(array('model' => 'Profile', 'add_empty' => true)),
      'ns_type'               => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'agent_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Agent', 'column' => 'id')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'updated_user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'child_updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'child_updated_user_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'note'                  => new sfValidatorPass(array('required' => false)),
      'uri'                   => new sfValidatorPass(array('required' => false)),
      'url'                   => new sfValidatorPass(array('required' => false)),
      'base_domain'           => new sfValidatorPass(array('required' => false)),
      'token'                 => new sfValidatorPass(array('required' => false)),
      'community'             => new sfValidatorPass(array('required' => false)),
      'last_uri_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'language'              => new sfValidatorPass(array('required' => false)),
      'profile_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Profile', 'column' => 'id')),
      'ns_type'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('schema_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Schema';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'agent_id'              => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'deleted_at'            => 'Date',
      'created_user_id'       => 'ForeignKey',
      'updated_user_id'       => 'ForeignKey',
      'child_updated_at'      => 'Date',
      'child_updated_user_id' => 'Number',
      'name'                  => 'Text',
      'note'                  => 'Text',
      'uri'                   => 'Text',
      'url'                   => 'Text',
      'base_domain'           => 'Text',
      'token'                 => 'Text',
      'community'             => 'Text',
      'last_uri_id'           => 'Number',
      'status_id'             => 'ForeignKey',
      'language'              => 'Text',
      'profile_id'            => 'ForeignKey',
      'ns_type'               => 'Text',
    );
  }
}
