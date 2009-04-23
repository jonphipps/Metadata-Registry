<?php

/**
 * sfBlog form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormInput(),
      'tagline'         => new sfWidgetFormTextarea(),
      'copyright'       => new sfWidgetFormTextarea(),
      'stripped_title'  => new sfWidgetFormInput(),
      'is_published'    => new sfWidgetFormInputCheckbox(),
      'is_finished'     => new sfWidgetFormInputCheckbox(),
      'display_extract' => new sfWidgetFormInputCheckbox(),
      'comment_policy'  => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'sfBlog', 'column' => 'id', 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tagline'         => new sfValidatorString(array('required' => false)),
      'copyright'       => new sfValidatorString(array('required' => false)),
      'stripped_title'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_published'    => new sfValidatorBoolean(array('required' => false)),
      'is_finished'     => new sfValidatorBoolean(array('required' => false)),
      'display_extract' => new sfValidatorBoolean(array('required' => false)),
      'comment_policy'  => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'sfBlog', 'column' => array('stripped_title')))
    );

    $this->widgetSchema->setNameFormat('sf_blog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlog';
  }


}
