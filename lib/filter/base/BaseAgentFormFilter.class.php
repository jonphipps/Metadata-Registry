<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Agent filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAgentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_updated'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'org_email'       => new sfWidgetFormFilterInput(),
      'org_name'        => new sfWidgetFormFilterInput(),
      'ind_affiliation' => new sfWidgetFormFilterInput(),
      'ind_role'        => new sfWidgetFormFilterInput(),
      'address1'        => new sfWidgetFormFilterInput(),
      'address2'        => new sfWidgetFormFilterInput(),
      'city'            => new sfWidgetFormFilterInput(),
      'state'           => new sfWidgetFormFilterInput(),
      'postal_code'     => new sfWidgetFormFilterInput(),
      'country'         => new sfWidgetFormFilterInput(),
      'phone'           => new sfWidgetFormFilterInput(),
      'web_address'     => new sfWidgetFormFilterInput(),
      'type'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_updated'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'org_email'       => new sfValidatorPass(array('required' => false)),
      'org_name'        => new sfValidatorPass(array('required' => false)),
      'ind_affiliation' => new sfValidatorPass(array('required' => false)),
      'ind_role'        => new sfValidatorPass(array('required' => false)),
      'address1'        => new sfValidatorPass(array('required' => false)),
      'address2'        => new sfValidatorPass(array('required' => false)),
      'city'            => new sfValidatorPass(array('required' => false)),
      'state'           => new sfValidatorPass(array('required' => false)),
      'postal_code'     => new sfValidatorPass(array('required' => false)),
      'country'         => new sfValidatorPass(array('required' => false)),
      'phone'           => new sfValidatorPass(array('required' => false)),
      'web_address'     => new sfValidatorPass(array('required' => false)),
      'type'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('agent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Agent';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'created_at'      => 'Date',
      'last_updated'    => 'Date',
      'deleted_at'      => 'Date',
      'org_email'       => 'Text',
      'org_name'        => 'Text',
      'ind_affiliation' => 'Text',
      'ind_role'        => 'Text',
      'address1'        => 'Text',
      'address2'        => 'Text',
      'city'            => 'Text',
      'state'           => 'Text',
      'postal_code'     => 'Text',
      'country'         => 'Text',
      'phone'           => 'Text',
      'web_address'     => 'Text',
      'type'            => 'Text',
    );
  }
}
