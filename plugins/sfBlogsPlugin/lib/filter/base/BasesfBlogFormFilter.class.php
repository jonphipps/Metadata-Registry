<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfBlog filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasesfBlogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'           => new sfWidgetFormFilterInput(),
      'tagline'         => new sfWidgetFormFilterInput(),
      'copyright'       => new sfWidgetFormFilterInput(),
      'stripped_title'  => new sfWidgetFormFilterInput(),
      'is_published'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_finished'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'display_extract' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comment_policy'  => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'title'           => new sfValidatorPass(array('required' => false)),
      'tagline'         => new sfValidatorPass(array('required' => false)),
      'copyright'       => new sfValidatorPass(array('required' => false)),
      'stripped_title'  => new sfValidatorPass(array('required' => false)),
      'is_published'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_finished'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'display_extract' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comment_policy'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sf_blog_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfBlog';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'title'           => 'Text',
      'tagline'         => 'Text',
      'copyright'       => 'Text',
      'stripped_title'  => 'Text',
      'is_published'    => 'Boolean',
      'is_finished'     => 'Boolean',
      'display_extract' => 'Boolean',
      'comment_policy'  => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
