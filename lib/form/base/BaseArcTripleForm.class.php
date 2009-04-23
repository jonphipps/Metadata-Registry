<?php

/**
 * ArcTriple form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseArcTripleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      't'         => new sfWidgetFormInput(),
      's'         => new sfWidgetFormPropelChoice(array('model' => 'ArcS2val', 'add_empty' => false)),
      'p'         => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => false)),
      'o'         => new sfWidgetFormPropelChoice(array('model' => 'ArcO2val', 'add_empty' => false)),
      'o_lang_dt' => new sfWidgetFormPropelChoice(array('model' => 'ArcId2val', 'add_empty' => false)),
      'o_comp'    => new sfWidgetFormInput(),
      's_type'    => new sfWidgetFormInputCheckbox(),
      'o_type'    => new sfWidgetFormInputCheckbox(),
      'misc'      => new sfWidgetFormInputCheckbox(),
      'id'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      't'         => new sfValidatorInteger(),
      's'         => new sfValidatorPropelChoice(array('model' => 'ArcS2val', 'column' => 'id')),
      'p'         => new sfValidatorPropelChoice(array('model' => 'ArcId2val', 'column' => 'id')),
      'o'         => new sfValidatorPropelChoice(array('model' => 'ArcO2val', 'column' => 'id')),
      'o_lang_dt' => new sfValidatorPropelChoice(array('model' => 'ArcId2val', 'column' => 'id')),
      'o_comp'    => new sfValidatorString(array('max_length' => 35)),
      's_type'    => new sfValidatorBoolean(),
      'o_type'    => new sfValidatorBoolean(),
      'misc'      => new sfValidatorBoolean(),
      'id'        => new sfValidatorPropelChoice(array('model' => 'ArcTriple', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ArcTriple', 'column' => array('t')))
    );

    $this->widgetSchema->setNameFormat('arc_triple[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArcTriple';
  }


}
