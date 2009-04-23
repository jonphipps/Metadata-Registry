<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Namespace filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseNamespaceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'schema_id'       => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'created_user_id' => new sfWidgetFormFilterInput(),
      'updated_user_id' => new sfWidgetFormFilterInput(),
      'token'           => new sfWidgetFormFilterInput(),
      'note'            => new sfWidgetFormFilterInput(),
      'uri'             => new sfWidgetFormFilterInput(),
      'schema_location' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'schema_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Schema', 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_user_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_user_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'token'           => new sfValidatorPass(array('required' => false)),
      'note'            => new sfValidatorPass(array('required' => false)),
      'uri'             => new sfValidatorPass(array('required' => false)),
      'schema_location' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('namespace_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Namespace';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'schema_id'       => 'ForeignKey',
      'created_at'      => 'Date',
      'deleted_at'      => 'Date',
      'created_user_id' => 'Number',
      'updated_user_id' => 'Number',
      'token'           => 'Text',
      'note'            => 'Text',
      'uri'             => 'Text',
      'schema_location' => 'Text',
    );
  }
}
