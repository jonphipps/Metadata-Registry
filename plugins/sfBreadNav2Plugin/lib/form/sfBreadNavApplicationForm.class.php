<?php

/**
 * sfBreadNavApplication form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class sfBreadNavApplicationForm extends BasesfBreadNavApplicationForm
{
  
  
    public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputHidden(),
      'namess'        => new sfWidgetFormInput(),
      'application' => new sfWidgetFormInput(),
      'css'         => new sfWidgetFormTextarea(array(),array("wrap" => 'off',"cols" => '60',"rows"=>"8")),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'sfBreadNavApplication', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorInteger(array('required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'application' => new sfValidatorString(array('max_length' => 255)),
      'css'         => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_bread_nav_application[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }
  
}
