<?php

/**
 * ArcG2t form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcG2tForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'g'  => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => false)),
      't'  => new sfWidgetFormPropelChoice(array('model' => 'ArcTriple', 'add_empty' => false, 'key_method' => 'getT')),
      'id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'g'  => new sfValidatorPropelChoice(array('model' => 'ArcId2val', 'column' => 'id')),
      't'  => new sfValidatorPropelChoice(array('model' => 'ArcTriple', 'column' => 't')),
      'id' => new sfValidatorPropelChoice(array('model' => 'ArcG2t', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ArcG2t', 'column' => array('g', 't')))
    );

    $this->widgetSchema->setNameFormat('arc_g2t[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcG2t';
  }


}
