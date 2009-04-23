<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * User filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_updated'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'nickname'             => new sfWidgetFormFilterInput(),
      'salutation'           => new sfWidgetFormFilterInput(),
      'first_name'           => new sfWidgetFormFilterInput(),
      'last_name'            => new sfWidgetFormFilterInput(),
      'email'                => new sfWidgetFormFilterInput(),
      'sha1_password'        => new sfWidgetFormFilterInput(),
      'salt'                 => new sfWidgetFormFilterInput(),
      'want_to_be_moderator' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_moderator'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_administrator'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'deletions'            => new sfWidgetFormFilterInput(),
      'password'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_updated'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'nickname'             => new sfValidatorPass(array('required' => false)),
      'salutation'           => new sfValidatorPass(array('required' => false)),
      'first_name'           => new sfValidatorPass(array('required' => false)),
      'last_name'            => new sfValidatorPass(array('required' => false)),
      'email'                => new sfValidatorPass(array('required' => false)),
      'sha1_password'        => new sfValidatorPass(array('required' => false)),
      'salt'                 => new sfValidatorPass(array('required' => false)),
      'want_to_be_moderator' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_moderator'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_administrator'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'deletions'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'password'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'created_at'           => 'Date',
      'last_updated'         => 'Date',
      'deleted_at'           => 'Date',
      'nickname'             => 'Text',
      'salutation'           => 'Text',
      'first_name'           => 'Text',
      'last_name'            => 'Text',
      'email'                => 'Text',
      'sha1_password'        => 'Text',
      'salt'                 => 'Text',
      'want_to_be_moderator' => 'Boolean',
      'is_moderator'         => 'Boolean',
      'is_administrator'     => 'Boolean',
      'deletions'            => 'Number',
      'password'             => 'Text',
    );
  }
}
