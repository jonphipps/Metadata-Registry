<?php

/**
 * sfComment form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'commentable_model' => new sfWidgetFormInput(),
      'commentable_id'    => new sfWidgetFormInput(),
      'comment_namespace' => new sfWidgetFormInput(),
      'title'             => new sfWidgetFormInput(),
      'text'              => new sfWidgetFormTextarea(),
      'author_id'         => new sfWidgetFormInput(),
      'author_name'       => new sfWidgetFormInput(),
      'author_email'      => new sfWidgetFormInput(),
      'author_website'    => new sfWidgetFormInput(),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'sfComment', 'column' => 'id', 'required' => false)),
      'commentable_model' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'commentable_id'    => new sfValidatorInteger(array('required' => false)),
      'comment_namespace' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'text'              => new sfValidatorString(array('required' => false)),
      'author_id'         => new sfValidatorInteger(array('required' => false)),
      'author_name'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'author_email'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'author_website'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfComment';
  }


}
