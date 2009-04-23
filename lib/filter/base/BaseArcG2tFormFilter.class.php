<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ArcG2t filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcG2tFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'g'  => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => true)),
      't'  => new sfWidgetFormPropelChoice(array('model' => 'ArcTriple', 'add_empty' => true, 'key_method' => 'getT')),
    ));

    $this->setValidators(array(
      'g'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcId2val', 'column' => 'id')),
      't'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcTriple', 'column' => 't')),
    ));

    $this->widgetSchema->setNameFormat('arc_g2t_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcG2t';
  }

  public function getFields()
  {
    return array(
      'g'  => 'ForeignKey',
      't'  => 'ForeignKey',
      'id' => 'Number',
    );
  }
}
