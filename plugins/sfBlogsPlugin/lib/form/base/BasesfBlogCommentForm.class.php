<?php

/**
 * sfBlogComment form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'sf_blog_post_id' => new sfWidgetFormPropelChoice(array('model' => 'sfBlogPost', 'add_empty' => true)),
      'author_name'     => new sfWidgetFormInput(),
      'author_email'    => new sfWidgetFormInput(),
      'author_url'      => new sfWidgetFormInput(),
      'content'         => new sfWidgetFormTextarea(),
      'status'          => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'sfBlogComment', 'column' => 'id', 'required' => false)),
      'sf_blog_post_id' => new sfValidatorPropelChoice(array('model' => 'sfBlogPost', 'column' => 'id', 'required' => false)),
      'author_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_email'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_url'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'         => new sfValidatorString(array('required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogComment';
  }


}
