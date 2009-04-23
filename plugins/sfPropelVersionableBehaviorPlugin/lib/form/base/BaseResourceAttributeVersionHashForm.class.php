<?php

/**
 * ResourceAttributeVersionHash form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseResourceAttributeVersionHashForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'resource_attribute_version_id' => new sfWidgetFormInputHidden(),
      'resource_version_id'           => new sfWidgetFormInputHidden(),
      'is_modified'                   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'resource_attribute_version_id' => new sfValidatorPropelChoice(array('model' => 'ResourceAttributeVersion', 'column' => 'id', 'required' => false)),
      'resource_version_id'           => new sfValidatorPropelChoice(array('model' => 'ResourceVersion', 'column' => 'id', 'required' => false)),
      'is_modified'                   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_attribute_version_hash[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceAttributeVersionHash';
  }


}
