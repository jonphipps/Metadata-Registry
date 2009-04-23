<?php

/**
 * sfBlogTag form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_blog_post_id' => new sfWidgetFormInputHidden(),
      'tag'             => new sfWidgetFormInputHidden(),
      'created_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'sf_blog_post_id' => new sfValidatorPropelChoice(array('model' => 'sfBlogPost', 'column' => 'id', 'required' => false)),
      'tag'             => new sfValidatorPropelChoice(array('model' => 'sfBlogTag', 'column' => 'tag', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogTag';
  }


}
