<?php 
class sfBreadNavScopeForm extends sfForm
{
  public function configure()
  {
  }

  public function setup()
  {

    $scopes = sfBreadNavApplicationPeer::getScopeArray();        
    
        
    $this->setWidgetSchema(new sfWidgetFormSchema(array(
      
      'scope' => new sfWidgetFormSelect(array('choices' => $scopes), array('onchange' => 'scopeform.submit()')),
      
      )));

    $this->setValidatorSchema(new sfValidatorSchema(array(
      'scope' => new sfValidatorPass(),
                  
      )));

    $this->widgetSchema->setNameFormat('%s');
    $this->widgetSchema->setLabel('scope','Active Menu');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    

    parent::setup();
  }
  
}