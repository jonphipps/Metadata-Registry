<?php

/**
 * SkosProperty form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSkosPropertyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'parent_id'      => new sfWidgetFormInput(),
      'inverse_id'     => new sfWidgetFormInput(),
      'name'           => new sfWidgetFormInput(),
      'uri'            => new sfWidgetFormInput(),
      'object_type'    => new sfWidgetFormInput(),
      'display_order'  => new sfWidgetFormInput(),
      'picklist_order' => new sfWidgetFormInput(),
      'label'          => new sfWidgetFormInput(),
      'definition'     => new sfWidgetFormTextarea(),
      'comment'        => new sfWidgetFormTextarea(),
      'examples'       => new sfWidgetFormInput(),
      'is_required'    => new sfWidgetFormInputCheckbox(),
      'is_reciprocal'  => new sfWidgetFormInputCheckbox(),
      'is_singleton'   => new sfWidgetFormInputCheckbox(),
      'is_scheme'      => new sfWidgetFormInputCheckbox(),
      'is_in_picklist' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'SkosProperty', 'column' => 'id', 'required' => false)),
      'parent_id'      => new sfValidatorInteger(array('required' => false)),
      'inverse_id'     => new sfValidatorInteger(array('required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255)),
      'uri'            => new sfValidatorString(array('max_length' => 255)),
      'object_type'    => new sfValidatorString(),
      'display_order'  => new sfValidatorInteger(array('required' => false)),
      'picklist_order' => new sfValidatorInteger(array('required' => false)),
      'label'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'definition'     => new sfValidatorString(array('required' => false)),
      'comment'        => new sfValidatorString(array('required' => false)),
      'examples'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_required'    => new sfValidatorBoolean(),
      'is_reciprocal'  => new sfValidatorBoolean(),
      'is_singleton'   => new sfValidatorBoolean(),
      'is_scheme'      => new sfValidatorBoolean(),
      'is_in_picklist' => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'SkosProperty', 'column' => array('id'))),
        new sfValidatorPropelUnique(array('model' => 'SkosProperty', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'SkosProperty', 'column' => array('uri'))),
      ))
    );

    $this->widgetSchema->setNameFormat('skos_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SkosProperty';
  }


}
