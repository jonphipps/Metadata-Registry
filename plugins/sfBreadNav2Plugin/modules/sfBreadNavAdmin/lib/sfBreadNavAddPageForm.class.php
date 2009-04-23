<?php 
class sfBreadNavAddPageForm extends sfForm
{
  public function configure()
  {
  }

  public function setup()
  {
       

    $this->setValidatorSchema(new sfValidatorSchema(array(
      'id'   => new sfValidatorPass(),   
      'page' => new sfValidatorString(array('max_length' => 255)),
      'module' => new sfValidatorString(array('max_length' => 128)),
      'action' => new sfValidatorString(array('max_length' => 128, 'required'=>false)),
      'credential' => new sfValidatorString(array('max_length' => 128, 'required'=>false)),
      'catch_all' => new sfValidatorPass(),
      'parent' => new sfValidatorPass(),
      'order' => new sfValidatorPass(),
      'order_option' => new sfValidatorPass()            
      )));

    
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->setDefault('order_option','below');

    parent::setup();
  }
  
  public function setSelectBoxes($scope) {
    
    $parents = sfBreadNavPeer::getParentArray($scope);        
    $order = sfBreadNavPeer::getOrderArray($scope);
      
    $orderoption = array('above'=>'above','below'=>'below');
        
    $this->setWidgetSchema(new sfWidgetFormSchema(array(
      'id'           => new sfWidgetFormInputHidden(),  
      'page'         => new sfWidgetFormInput(),
      'module'       => new sfWidgetFormInput(),
      'action'       => new sfWidgetFormInput(),
      'credential'   => new sfWidgetFormInput(),
      'catch_all'    => new sfWidgetFormInputCheckbox(),
      'parent'       => new sfWidgetFormSelect(array('choices' => $parents)),
      'order'        => new sfWidgetFormSelect(array('choices' => $order)),
      'order_option' => new sfWidgetFormSelectRadio(array('choices' => $orderoption))      
      )));
    $this->widgetSchema->setNameFormat('sfbreadnavaddpageform[%s]'); 
  }
  
}