<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfBlogComment filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_blog_post_id' => new sfWidgetFormPropelChoice(array('model' => 'sfBlogPost', 'add_empty' => true)),
      'author_name'     => new sfWidgetFormFilterInput(),
      'author_email'    => new sfWidgetFormFilterInput(),
      'author_url'      => new sfWidgetFormFilterInput(),
      'content'         => new sfWidgetFormFilterInput(),
      'status'          => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'sf_blog_post_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfBlogPost', 'column' => 'id')),
      'author_name'     => new sfValidatorPass(array('required' => false)),
      'author_email'    => new sfValidatorPass(array('required' => false)),
      'author_url'      => new sfValidatorPass(array('required' => false)),
      'content'         => new sfValidatorPass(array('required' => false)),
      'status'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogComment';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'sf_blog_post_id' => 'ForeignKey',
      'author_name'     => 'Text',
      'author_email'    => 'Text',
      'author_url'      => 'Text',
      'content'         => 'Text',
      'status'          => 'Number',
      'created_at'      => 'Date',
    );
  }
}
