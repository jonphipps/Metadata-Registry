<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfComment filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'commentable_model' => new sfWidgetFormFilterInput(),
      'commentable_id'    => new sfWidgetFormFilterInput(),
      'comment_namespace' => new sfWidgetFormFilterInput(),
      'title'             => new sfWidgetFormFilterInput(),
      'text'              => new sfWidgetFormFilterInput(),
      'author_id'         => new sfWidgetFormFilterInput(),
      'author_name'       => new sfWidgetFormFilterInput(),
      'author_email'      => new sfWidgetFormFilterInput(),
      'author_website'    => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'commentable_model' => new sfValidatorPass(array('required' => false)),
      'commentable_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment_namespace' => new sfValidatorPass(array('required' => false)),
      'title'             => new sfValidatorPass(array('required' => false)),
      'text'              => new sfValidatorPass(array('required' => false)),
      'author_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author_name'       => new sfValidatorPass(array('required' => false)),
      'author_email'      => new sfValidatorPass(array('required' => false)),
      'author_website'    => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfComment';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'commentable_model' => 'Text',
      'commentable_id'    => 'Number',
      'comment_namespace' => 'Text',
      'title'             => 'Text',
      'text'              => 'Text',
      'author_id'         => 'Number',
      'author_name'       => 'Text',
      'author_email'      => 'Text',
      'author_website'    => 'Text',
      'created_at'        => 'Date',
    );
  }
}
