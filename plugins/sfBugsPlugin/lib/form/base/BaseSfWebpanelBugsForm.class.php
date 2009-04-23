<?php

/**
 * SfWebpanelBugs form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSfWebpanelBugsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'module_name' => new sfWidgetFormInput(),
      'action_name' => new sfWidgetFormInput(),
      'app_name'    => new sfWidgetFormInput(),
      'date_added'  => new sfWidgetFormDateTime(),
      'description' => new sfWidgetFormTextarea(),
      'url'         => new sfWidgetFormInput(),
      'solved'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'SfWebpanelBugs', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'module_name' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'action_name' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'app_name'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'date_added'  => new sfValidatorDateTime(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'solved'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('sf_webpanel_bugs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SfWebpanelBugs';
  }


}
