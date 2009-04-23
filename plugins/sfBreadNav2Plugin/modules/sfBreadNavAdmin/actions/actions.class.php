<?php
class sfBreadNavAdminActions extends crudactions
{

  public function executeTest()
  {}

  public function executeDeletepage() {
    $this->setscope();
    
    $pageid = $this->getRequest()->getParameter('pageid');
    
    if ($this->pageowner($pageid)) {
      $page = sfBreadNavPeer::getNode($pageid);
      
      $page->delete();
      
      
      
      //sfBreadNavPeer::deleteDescendants($page);
      //sfBreadNavPeer::deleteNode($page);
            
      $this->redirect('sfBreadNavAdmin/index?scope='.$this->scope);
    }else{
      //display permission error
      $this->setTemplate('breadnav');
      $this->message = "You need to be logged in to delete menu pages.";
      return sfView::ERROR;
    }  
      
  }
  
  public function executeEdithome() {
    $this->setscope();
                
    $this->form = new sfBreadNavEditHomeForm();
    //if not post populate and show form.
    //if post validate and save.  redirect to admin.
        
    if ($this->getRequest()->isMethod('post') ) {
      $values = $this->getRequest()->getParameter('sfbreadnavedithomeform');
      $this->form->bind($values); 
      if ($this->form->isValid()) {
        if (sfBreadNavPeer::saveHome($values,$this->scope)) {        
          $this->redirect('sfBreadNavAdmin/index?scope='.$this->scope);
        }else {
          $this->setTemplate('breadnav');
          $this->message = "You need to be logged in to save a root page.";
          return sfView::ERROR;
        }
      }
    }else{
      
      $root = sfBreadNavPeer::getRoot($this->scope);
      if ($root) {
        //populate form 
        $this->form->bind($root->toForm());
      }else{
        //invalid scope id
        if ($this->scope = null ) {
          $this->setTemplate('breadnav');
          $this->message = "You need to be logged in to create a root page.";
          return sfView::ERROR;
        }  
      } 
    }
}

  public function executeIndex()
  {
    $this->setscope();  
    $this->checkfreshinstall();
    
    if ($this->getRequest()->hasParameter('pageid')){
      $this->checkfreshinstall();      
      //populate form with edit data
      $this->populateForm($this->getRequest()->getParameter('pageid'));
      $this->edit = true;

      return;
      }
      
    
    $this->generateAddPageForm();
    
      if ($this->getRequest()->isMethod('post') ) {
      //bind values 
      //validate
      //if valid then add page
      $values = $this->getRequest()->getParameter('sfbreadnavaddpageform');
      $this->form->bind($values); 
      if ($this->form->isValid()) {
        if ($this->form->getValue('id') == '') {
          
          if (!sfBreadNavPeer::addPage($values, $this->scope)) {
            $this->setTemplate('breadnav');
            $this->message = "You need to be logged in to add a page.";
            return sfView::ERROR;
          }
          
        }else{
          
          if (!sfBreadNavPeer::editPage($values)){
            $this->setTemplate('breadnav');
            $this->message = "You need to be logged in to edit a page.";
            return sfView::ERROR;
          }
          
        }
        $this->generateAddPageForm();
      } 
    }           
        
  }
  
  
  
  protected function savepage($values) {
    
    //save page
    $page = new sfBreadNav();
    $page->setPage($values['page']);
    $page->setModule($values['module']);
    $page->setAction($values['action']);
    $page->setCredential($values['module']);
    $page->save();
    
  }
  
  protected function checkfreshinstall() {
         
    $root = sfBreadNavPeer::getRoot($this->scope); 
    if (!$root){ 
      $this->freshinstall = true;
    }
    $c = new Criteria();
    //if config set to ownermenu only show users menus
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));  
    }
    $menu = sfBreadNavApplicationPeer::doCount($c);
    if ($menu == 0) {
      $this->nomenu = true;
    }    
  }
  
  protected function populateForm($pageid) {
    
    $page = sfBreadNavPeer::retrieveByPK($pageid);
    $formarray = $page->toForm();
    $formarray['id'] = $pageid; 
    $formarray['order_option'] = 'below';
    $this->generateAddPageForm();
    $this->form->setDefaults($formarray);  
  }
  
  protected function setscope() {
    
    
    //use passed scope
    //if no scope passed get first scope
    //initialize scope form
    if ( $this->getRequest()->hasParameter('scope') )  {
      if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
        $this->scope = null;
        $c = new Criteria();
        $c->add (sfBreadNavApplicationPeer::ID,$this->getRequest()->getParameter('scope'));
        $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
        $tree = sfBreadNavApplicationPeer::doSelectOne($c);
        if ($tree) {$this->scope = $this->getRequest()->getParameter('scope');}  
      }else{
        $this->scope = $this->getRequest()->getParameter('scope');
      }
    }else{ 
      $c = new Criteria();
      
      //if config set to ownermenu only show users menus
      if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
        $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));  
      }
      
      $c->addAscendingOrderByColumn(sfBreadNavApplicationPeer::ID); 
      $tree = sfBreadNavApplicationPeer::doSelectOne($c);
      if($tree) {
        $this->scope = $tree->getId();        
      }else{
        //scope = null
        $this->scope = null;
      }
    }  
    $this->scopeform = new sfBreadNavScopeForm();
    $this->scopeform->setDefault('scope',$this->scope); 
    
  }
  

  protected function generateAddPageForm() { 
  
    $this->form = new sfBreadNavAddPageForm();
    $this->form->setSelectBoxes($this->scope);
 
  }
  
  protected function pageowner($pageid) {
    
    //if config set to ownermenu only show users menus
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c = new Criteria();
      $c->add (sfBreadNavPeer::ID,$pageid);
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
      $result = sfBreadNavPeer::doCountJoinsfBreadNavApplication($c);
      if ($result > 0) {return true;}else {return false;}  
    }else{
      return true;
    }
          
  }
}
