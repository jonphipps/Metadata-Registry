<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ArcTriple filter form base class.
 *
 * @package    registry
 * @subpackage filter
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcTripleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      't'         => new sfWidgetFormFilterInput(),
      's'         => new sfWidgetFormPropelChoice(array('model' => 'ArcS2val', 'add_empty' => true)),
      'p'         => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => true)),
      'o'         => new sfWidgetFormPropelChoice(array('model' => 'ArcO2val', 'add_empty' => true)),
      'o_lang_dt' => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => true)),
      'o_comp'    => new sfWidgetFormFilterInput(),
      's_type'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'o_type'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'misc'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      't'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      's'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcS2val', 'column' => 'id')),
      'p'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcId2val', 'column' => 'id')),
      'o'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcO2val', 'column' => 'id')),
      'o_lang_dt' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ArcId2val', 'column' => 'id')),
      'o_comp'    => new sfValidatorPass(array('required' => false)),
      's_type'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'o_type'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'misc'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('arc_triple_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcTriple';
  }

  public function getFields()
  {
    return array(
      't'         => 'Number',
      's'         => 'ForeignKey',
      'p'         => 'ForeignKey',
      'o'         => 'ForeignKey',
      'o_lang_dt' => 'ForeignKey',
      'o_comp'    => 'Text',
      's_type'    => 'Boolean',
      'o_type'    => 'Boolean',
      'misc'      => 'Boolean',
      'id'        => 'Number',
    );
  }
}
