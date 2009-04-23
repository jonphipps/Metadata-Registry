<?php

/**
 * sfBreadNav form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBreadNavForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'page'        => new sfWidgetFormInput(),
      'title'       => new sfWidgetFormInput(),
      'module'      => new sfWidgetFormInput(),
      'action'      => new sfWidgetFormInput(),
      'credential'  => new sfWidgetFormInput(),
      'catchall'    => new sfWidgetFormInputCheckbox(),
      'tree_left'   => new sfWidgetFormInput(),
      'tree_right'  => new sfWidgetFormInput(),
      'tree_parent' => new sfWidgetFormInput(),
      'scope'       => new sfWidgetFormPropelChoice(array('model' => 'sfBreadNavApplication', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'sfBreadNav', 'column' => 'id', 'required' => false)),
      'page'        => new sfValidatorString(array('max_length' => 255)),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'module'      => new sfValidatorString(array('max_length' => 128)),
      'action'      => new sfValidatorString(array('max_length' => 128)),
      'credential'  => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'catchall'    => new sfValidatorBoolean(array('required' => false)),
      'tree_left'   => new sfValidatorInteger(),
      'tree_right'  => new sfValidatorInteger(),
      'tree_parent' => new sfValidatorInteger(),
      'scope'       => new sfValidatorPropelChoice(array('model' => 'sfBreadNavApplication', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sf_bread_nav[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBreadNav';
  }


}
