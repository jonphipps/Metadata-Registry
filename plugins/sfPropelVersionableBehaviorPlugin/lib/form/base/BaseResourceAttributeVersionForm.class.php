<?php

/**
 * ResourceAttributeVersion form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseResourceAttributeVersionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                   => new sfWidgetFormInputHidden(),
      'attribute_name'                       => new sfWidgetFormInput(),
      'attribute_value'                      => new sfWidgetFormTextarea(),
      'resource_attribute_version_hash_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'ResourceVersion')),
    ));

    $this->setValidators(array(
      'id'                                   => new sfValidatorPropelChoice(array('model' => 'ResourceAttributeVersion', 'column' => 'id', 'required' => false)),
      'attribute_name'                       => new sfValidatorString(array('max_length' => 255)),
      'attribute_value'                      => new sfValidatorString(array('required' => false)),
      'resource_attribute_version_hash_list' => new sfValidatorPropelChoiceMany(array('model' => 'ResourceVersion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_attribute_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceAttributeVersion';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['resource_attribute_version_hash_list']))
    {
      $values = array();
      foreach ($this->object->getResourceAttributeVersionHashs() as $obj)
      {
        $values[] = $obj->getResourceVersionId();
      }

      $this->setDefault('resource_attribute_version_hash_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveResourceAttributeVersionHashList($con);
  }

  public function saveResourceAttributeVersionHashList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['resource_attribute_version_hash_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ResourceAttributeVersionHashPeer::RESOURCE_ATTRIBUTE_VERSION_ID, $this->object->getPrimaryKey());
    ResourceAttributeVersionHashPeer::doDelete($c, $con);

    $values = $this->getValue('resource_attribute_version_hash_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ResourceAttributeVersionHash();
        $obj->setResourceAttributeVersionId($this->object->getPrimaryKey());
        $obj->setResourceVersionId($value);
        $obj->save();
      }
    }
  }

}
