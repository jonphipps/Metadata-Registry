<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ArcS2val filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcS2valFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cid'  => new sfWidgetFormFilterInput(),
      'misc' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'val'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cid'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'misc' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'val'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('arc_s2val_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcS2val';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'cid'  => 'Number',
      'misc' => 'Boolean',
      'val'  => 'Text',
    );
  }
}
