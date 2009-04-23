<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ResourceVersion filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseResourceVersionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'resource_id'                          => new sfWidgetFormFilterInput(),
      'resource_name'                        => new sfWidgetFormFilterInput(),
      'number'                               => new sfWidgetFormFilterInput(),
      'title'                                => new sfWidgetFormFilterInput(),
      'comment'                              => new sfWidgetFormFilterInput(),
      'created_by'                           => new sfWidgetFormFilterInput(),
      'created_at'                           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'resource_version_id'                  => new sfWidgetFormPropelChoice(array('model' => 'ResourceVersion', 'add_empty' => true)),
      'resource_attribute_version_hash_list' => new sfWidgetFormPropelChoice(array('model' => 'ResourceAttributeVersion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'resource_id'                          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_name'                        => new sfValidatorPass(array('required' => false)),
      'number'                               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'                                => new sfValidatorPass(array('required' => false)),
      'comment'                              => new sfValidatorPass(array('required' => false)),
      'created_by'                           => new sfValidatorPass(array('required' => false)),
      'created_at'                           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'resource_version_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ResourceVersion', 'column' => 'id')),
      'resource_attribute_version_hash_list' => new sfValidatorPropelChoice(array('model' => 'ResourceAttributeVersion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addResourceAttributeVersionHashListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(ResourceAttributeVersionHashPeer::RESOURCE_VERSION_ID, ResourceVersionPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ResourceAttributeVersionHashPeer::RESOURCE_ATTRIBUTE_VERSION_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ResourceAttributeVersionHashPeer::RESOURCE_ATTRIBUTE_VERSION_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'ResourceVersion';
  }

  public function getFields()
  {
    return array(
      'id'                                   => 'Number',
      'resource_id'                          => 'Number',
      'resource_name'                        => 'Text',
      'number'                               => 'Number',
      'title'                                => 'Text',
      'comment'                              => 'Text',
      'created_by'                           => 'Text',
      'created_at'                           => 'Date',
      'resource_version_id'                  => 'ForeignKey',
      'resource_attribute_version_hash_list' => 'ManyKey',
    );
  }
}
