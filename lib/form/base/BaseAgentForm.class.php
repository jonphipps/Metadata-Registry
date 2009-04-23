<?php

/**
 * Agent form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAgentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'created_at'      => new sfWidgetFormDateTime(),
      'last_updated'    => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'org_email'       => new sfWidgetFormInput(),
      'org_name'        => new sfWidgetFormInput(),
      'ind_affiliation' => new sfWidgetFormInput(),
      'ind_role'        => new sfWidgetFormInput(),
      'address1'        => new sfWidgetFormInput(),
      'address2'        => new sfWidgetFormInput(),
      'city'            => new sfWidgetFormInput(),
      'state'           => new sfWidgetFormInput(),
      'postal_code'     => new sfWidgetFormInput(),
      'country'         => new sfWidgetFormInput(),
      'phone'           => new sfWidgetFormInput(),
      'web_address'     => new sfWidgetFormInput(),
      'type'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Agent', 'column' => 'id', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'last_updated'    => new sfValidatorDateTime(),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'org_email'       => new sfValidatorString(array('max_length' => 100)),
      'org_name'        => new sfValidatorString(array('max_length' => 255)),
      'ind_affiliation' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ind_role'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'address1'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address2'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'state'           => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'postal_code'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'country'         => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'phone'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'web_address'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('agent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Agent';
  }


}
