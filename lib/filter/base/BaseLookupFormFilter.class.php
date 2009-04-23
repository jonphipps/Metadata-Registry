<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Lookup filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLookupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type_id'       => new sfWidgetFormFilterInput(),
      'short_value'   => new sfWidgetFormFilterInput(),
      'long_value'    => new sfWidgetFormFilterInput(),
      'display_order' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'type_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'short_value'   => new sfValidatorPass(array('required' => false)),
      'long_value'    => new sfValidatorPass(array('required' => false)),
      'display_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lookup_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lookup';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'type_id'       => 'Number',
      'short_value'   => 'Text',
      'long_value'    => 'Text',
      'display_order' => 'Number',
    );
  }
}
