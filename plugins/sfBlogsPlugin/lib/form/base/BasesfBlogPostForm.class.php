<?php

/**
 * sfBlogPost form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogPostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'sf_blog_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfBlog', 'add_empty' => true)),
      'author_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'          => new sfWidgetFormInput(),
      'stripped_title' => new sfWidgetFormInput(),
      'extract'        => new sfWidgetFormTextarea(),
      'content'        => new sfWidgetFormTextarea(),
      'is_published'   => new sfWidgetFormInputCheckbox(),
      'allow_comments' => new sfWidgetFormInputCheckbox(),
      'nb_comments'    => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'published_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'sfBlogPost', 'column' => 'id', 'required' => false)),
      'sf_blog_id'     => new sfValidatorPropelChoice(array('model' => 'sfBlog', 'column' => 'id', 'required' => false)),
      'author_id'      => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'stripped_title' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'extract'        => new sfValidatorString(array('required' => false)),
      'content'        => new sfValidatorString(array('required' => false)),
      'is_published'   => new sfValidatorBoolean(array('required' => false)),
      'allow_comments' => new sfValidatorBoolean(array('required' => false)),
      'nb_comments'    => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'published_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'sfBlogPost', 'column' => array('stripped_title', 'published_at')))
    );

    $this->widgetSchema->setNameFormat('sf_blog_post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogPost';
  }


}
