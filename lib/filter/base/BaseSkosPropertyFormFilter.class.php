<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SkosProperty filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSkosPropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id'      => new sfWidgetFormFilterInput(),
      'inverse_id'     => new sfWidgetFormFilterInput(),
      'name'           => new sfWidgetFormFilterInput(),
      'uri'            => new sfWidgetFormFilterInput(),
      'object_type'    => new sfWidgetFormFilterInput(),
      'display_order'  => new sfWidgetFormFilterInput(),
      'picklist_order' => new sfWidgetFormFilterInput(),
      'label'          => new sfWidgetFormFilterInput(),
      'definition'     => new sfWidgetFormFilterInput(),
      'comment'        => new sfWidgetFormFilterInput(),
      'examples'       => new sfWidgetFormFilterInput(),
      'is_required'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_reciprocal'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_singleton'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_scheme'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_in_picklist' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'parent_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'inverse_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'           => new sfValidatorPass(array('required' => false)),
      'uri'            => new sfValidatorPass(array('required' => false)),
      'object_type'    => new sfValidatorPass(array('required' => false)),
      'display_order'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'picklist_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'label'          => new sfValidatorPass(array('required' => false)),
      'definition'     => new sfValidatorPass(array('required' => false)),
      'comment'        => new sfValidatorPass(array('required' => false)),
      'examples'       => new sfValidatorPass(array('required' => false)),
      'is_required'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_reciprocal'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_singleton'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_scheme'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_in_picklist' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('skos_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SkosProperty';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'parent_id'      => 'Number',
      'inverse_id'     => 'Number',
      'name'           => 'Text',
      'uri'            => 'Text',
      'object_type'    => 'Text',
      'display_order'  => 'Number',
      'picklist_order' => 'Number',
      'label'          => 'Text',
      'definition'     => 'Text',
      'comment'        => 'Text',
      'examples'       => 'Text',
      'is_required'    => 'Boolean',
      'is_reciprocal'  => 'Boolean',
      'is_singleton'   => 'Boolean',
      'is_scheme'      => 'Boolean',
      'is_in_picklist' => 'Boolean',
    );
  }
}
