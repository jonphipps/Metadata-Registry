<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfBlogPost filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogPostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_blog_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfBlog', 'add_empty' => true)),
      'author_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'title'          => new sfWidgetFormFilterInput(),
      'stripped_title' => new sfWidgetFormFilterInput(),
      'extract'        => new sfWidgetFormFilterInput(),
      'content'        => new sfWidgetFormFilterInput(),
      'is_published'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'allow_comments' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'nb_comments'    => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'published_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'sf_blog_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfBlog', 'column' => 'id')),
      'author_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'title'          => new sfValidatorPass(array('required' => false)),
      'stripped_title' => new sfValidatorPass(array('required' => false)),
      'extract'        => new sfValidatorPass(array('required' => false)),
      'content'        => new sfValidatorPass(array('required' => false)),
      'is_published'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'allow_comments' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'nb_comments'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'published_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlogPost';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'sf_blog_id'     => 'ForeignKey',
      'author_id'      => 'ForeignKey',
      'title'          => 'Text',
      'stripped_title' => 'Text',
      'extract'        => 'Text',
      'content'        => 'Text',
      'is_published'   => 'Boolean',
      'allow_comments' => 'Boolean',
      'nb_comments'    => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'published_at'   => 'Date',
    );
  }
}
