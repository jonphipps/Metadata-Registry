<?php

/**
 * ProfileProperty form base class.
 *
 * @package    registry
 * @subpackage form
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProfilePropertyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
      'deleted_at'                  => new sfWidgetFormDateTime(),
      'created_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'updated_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'deleted_by'                  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'profile_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Profile', 'add_empty' => false)),
      'schema_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Schema', 'add_empty' => true)),
      'schema_property_id'          => new sfWidgetFormPropelChoice(array('model' => 'SchemaProperty', 'add_empty' => true)),
      'name'                        => new sfWidgetFormInput(),
      'label'                       => new sfWidgetFormInput(),
      'definition'                  => new sfWidgetFormTextarea(),
      'comment'                     => new sfWidgetFormTextarea(),
      'type'                        => new sfWidgetFormInput(),
      'uri'                         => new sfWidgetFormInput(),
      'status_id'                   => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'language'                    => new sfWidgetFormInput(),
      'note'                        => new sfWidgetFormTextarea(),
      'display_order'               => new sfWidgetFormInput(),
      'picklist_order'              => new sfWidgetFormInput(),
      'examples'                    => new sfWidgetFormInput(),
      'is_required'                 => new sfWidgetFormInputCheckbox(),
      'is_reciprocal'               => new sfWidgetFormInputCheckbox(),
      'is_singleton'                => new sfWidgetFormInputCheckbox(),
      'is_in_picklist'              => new sfWidgetFormInputCheckbox(),
      'inverse_profile_property_id' => new sfWidgetFormPropelChoice(array('model' => 'ProfileProperty', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorPropelChoice(array('model' => 'ProfileProperty', 'column' => 'id', 'required' => false)),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(),
      'deleted_at'                  => new sfValidatorDateTime(array('required' => false)),
      'created_by'                  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'updated_by'                  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'deleted_by'                  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'profile_id'                  => new sfValidatorPropelChoice(array('model' => 'Profile', 'column' => 'id')),
      'schema_id'                   => new sfValidatorPropelChoice(array('model' => 'Schema', 'column' => 'id', 'required' => false)),
      'schema_property_id'          => new sfValidatorPropelChoice(array('model' => 'SchemaProperty', 'column' => 'id', 'required' => false)),
      'name'                        => new sfValidatorString(array('max_length' => 255)),
      'label'                       => new sfValidatorString(array('max_length' => 255)),
      'definition'                  => new sfValidatorString(array('required' => false)),
      'comment'                     => new sfValidatorString(array('required' => false)),
      'type'                        => new sfValidatorString(),
      'uri'                         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status_id'                   => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id')),
      'language'                    => new sfValidatorString(array('max_length' => 6)),
      'note'                        => new sfValidatorString(array('required' => false)),
      'display_order'               => new sfValidatorInteger(array('required' => false)),
      'picklist_order'              => new sfValidatorInteger(array('required' => false)),
      'examples'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_required'                 => new sfValidatorBoolean(),
      'is_reciprocal'               => new sfValidatorBoolean(),
      'is_singleton'                => new sfValidatorBoolean(),
      'is_in_picklist'              => new sfValidatorBoolean(),
      'inverse_profile_property_id' => new sfValidatorPropelChoice(array('model' => 'ProfileProperty', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfileProperty';
  }


}
