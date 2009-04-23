<?php

/**
 * ResourceVersion form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseResourceVersionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                   => new sfWidgetFormInputHidden(),
      'resource_id'                          => new sfWidgetFormInput(),
      'resource_name'                        => new sfWidgetFormInput(),
      'number'                               => new sfWidgetFormInput(),
      'title'                                => new sfWidgetFormInput(),
      'comment'                              => new sfWidgetFormTextarea(),
      'created_by'                           => new sfWidgetFormInput(),
      'created_at'                           => new sfWidgetFormDateTime(),
      'resource_version_id'                  => new sfWidgetFormPropelChoice(array('model' => 'ResourceVersion', 'add_empty' => true)),
      'resource_attribute_version_hash_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'ResourceAttributeVersion')),
    ));

    $this->setValidators(array(
      'id'                                   => new sfValidatorPropelChoice(array('model' => 'ResourceVersion', 'column' => 'id', 'required' => false)),
      'resource_id'                          => new sfValidatorInteger(),
      'resource_name'                        => new sfValidatorString(array('max_length' => 255)),
      'number'                               => new sfValidatorInteger(array('required' => false)),
      'title'                                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comment'                              => new sfValidatorString(array('required' => false)),
      'created_by'                           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'                           => new sfValidatorDateTime(array('required' => false)),
      'resource_version_id'                  => new sfValidatorPropelChoice(array('model' => 'ResourceVersion', 'column' => 'id', 'required' => false)),
      'resource_attribute_version_hash_list' => new sfValidatorPropelChoiceMany(array('model' => 'ResourceAttributeVersion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceVersion';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['resource_attribute_version_hash_list']))
    {
      $values = array();
      foreach ($this->object->getResourceAttributeVersionHashs() as $obj)
      {
        $values[] = $obj->getResourceAttributeVersionId();
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
    $c->add(ResourceAttributeVersionHashPeer::RESOURCE_VERSION_ID, $this->object->getPrimaryKey());
    ResourceAttributeVersionHashPeer::doDelete($c, $con);

    $values = $this->getValue('resource_attribute_version_hash_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ResourceAttributeVersionHash();
        $obj->setResourceVersionId($this->object->getPrimaryKey());
        $obj->setResourceAttributeVersionId($value);
        $obj->save();
      }
    }
  }

}
