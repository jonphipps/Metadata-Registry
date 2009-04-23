<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ResourceAttributeVersion filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseResourceAttributeVersionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'attribute_name'                       => new sfWidgetFormFilterInput(),
      'attribute_value'                      => new sfWidgetFormFilterInput(),
      'resource_attribute_version_hash_list' => new sfWidgetFormPropelChoice(array('model' => 'ResourceVersion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'attribute_name'                       => new sfValidatorPass(array('required' => false)),
      'attribute_value'                      => new sfValidatorPass(array('required' => false)),
      'resource_attribute_version_hash_list' => new sfValidatorPropelChoice(array('model' => 'ResourceVersion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_attribute_version_filters[%s]');

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

    $criteria->addJoin(ResourceAttributeVersionHashPeer::RESOURCE_ATTRIBUTE_VERSION_ID, ResourceAttributeVersionPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ResourceAttributeVersionHashPeer::RESOURCE_VERSION_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ResourceAttributeVersionHashPeer::RESOURCE_VERSION_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'ResourceAttributeVersion';
  }

  public function getFields()
  {
    return array(
      'id'                                   => 'Number',
      'attribute_name'                       => 'Text',
      'attribute_value'                      => 'Text',
      'resource_attribute_version_hash_list' => 'ManyKey',
    );
  }
}
