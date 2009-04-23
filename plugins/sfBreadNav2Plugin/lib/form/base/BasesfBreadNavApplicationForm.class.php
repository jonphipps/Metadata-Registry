<?php

/**
 * sfBreadNavApplication form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBreadNavApplicationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInput(),
      'name'        => new sfWidgetFormInput(),
      'application' => new sfWidgetFormInput(),
      'css'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'sfBreadNavApplication', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorInteger(array('required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'application' => new sfValidatorString(array('max_length' => 255)),
      'css'         => new sfValidatorString(array('max_length' => 2000)),
    ));

    $this->widgetSchema->setNameFormat('sf_bread_nav_application[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBreadNavApplication';
  }


}
