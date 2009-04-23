<?php

/**
 * sfBlogLog form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'subject_class'    => new sfWidgetFormInput(),
      'subject_id'       => new sfWidgetFormInput(),
      'subject_name'     => new sfWidgetFormInput(),
      'subject_link'     => new sfWidgetFormInput(),
      'verb'             => new sfWidgetFormInput(),
      'object_class'     => new sfWidgetFormInput(),
      'object_id'        => new sfWidgetFormInput(),
      'object_name'      => new sfWidgetFormInput(),
      'object_link'      => new sfWidgetFormInput(),
      'complement_class' => new sfWidgetFormInput(),
      'complement_id'    => new sfWidgetFormInput(),
      'complement_name'  => new sfWidgetFormInput(),
      'complement_link'  => new sfWidgetFormInput(),
      'message'          => new sfWidgetFormInput(),
      'created_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'sfBlogLog', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'subject_class'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'subject_id'       => new sfValidatorInteger(array('required' => false)),
      'subject_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'subject_link'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'verb'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'object_class'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'object_id'        => new sfValidatorInteger(array('required' => false)),
      'object_name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'object_link'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'complement_class' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'complement_id'    => new sfValidatorInteger(array('required' => false)),
      'complement_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'complement_link'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'message'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogLog';
  }


}
