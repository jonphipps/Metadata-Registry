<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfBlogLog filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogLogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'subject_class'    => new sfWidgetFormFilterInput(),
      'subject_id'       => new sfWidgetFormFilterInput(),
      'subject_name'     => new sfWidgetFormFilterInput(),
      'subject_link'     => new sfWidgetFormFilterInput(),
      'verb'             => new sfWidgetFormFilterInput(),
      'object_class'     => new sfWidgetFormFilterInput(),
      'object_id'        => new sfWidgetFormFilterInput(),
      'object_name'      => new sfWidgetFormFilterInput(),
      'object_link'      => new sfWidgetFormFilterInput(),
      'complement_class' => new sfWidgetFormFilterInput(),
      'complement_id'    => new sfWidgetFormFilterInput(),
      'complement_name'  => new sfWidgetFormFilterInput(),
      'complement_link'  => new sfWidgetFormFilterInput(),
      'message'          => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'subject_class'    => new sfValidatorPass(array('required' => false)),
      'subject_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subject_name'     => new sfValidatorPass(array('required' => false)),
      'subject_link'     => new sfValidatorPass(array('required' => false)),
      'verb'             => new sfValidatorPass(array('required' => false)),
      'object_class'     => new sfValidatorPass(array('required' => false)),
      'object_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'object_name'      => new sfValidatorPass(array('required' => false)),
      'object_link'      => new sfValidatorPass(array('required' => false)),
      'complement_class' => new sfValidatorPass(array('required' => false)),
      'complement_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'complement_name'  => new sfValidatorPass(array('required' => false)),
      'complement_link'  => new sfValidatorPass(array('required' => false)),
      'message'          => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogLog';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'subject_class'    => 'Text',
      'subject_id'       => 'Number',
      'subject_name'     => 'Text',
      'subject_link'     => 'Text',
      'verb'             => 'Text',
      'object_class'     => 'Text',
      'object_id'        => 'Number',
      'object_name'      => 'Text',
      'object_link'      => 'Text',
      'complement_class' => 'Text',
      'complement_id'    => 'Number',
      'complement_name'  => 'Text',
      'complement_link'  => 'Text',
      'message'          => 'Text',
      'created_at'       => 'Date',
    );
  }
}
