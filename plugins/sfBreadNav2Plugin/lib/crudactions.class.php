<?php

/**
 * sfBreadNavAdmin actions.
 *
 * @package    breadnav
 * @subpackage sfBreadNavAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 8507 2008-04-17 17:32:20Z fabien $
 */
class crudactions extends sfActions
{
  public function executeList()
  {
    $c = new Criteria();
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));      
    }
    $this->sf_bread_nav_applicationList = sfBreadNavApplicationPeer::doSelect($c);
  }

  public function executeCreate()
  {
    $this->form = new sfBreadNavApplicationForm();

    $this->setTemplate('edit');
  }

  public function executeEdit($request)
  {
    // check ownership if owner carry on,  if not show error
    
    if (sfBreadNavPeer::scopeowner($request->getParameter('id'))) {     
      $this->form = new sfBreadNavApplicationForm(sfBreadNavApplicationPeer::retrieveByPk($request->getParameter('id')));
    }else{
      $this->setTemplate('breadnav');
      $this->message = "You need to be logged in to edit a menu.";
      return sfView::ERROR;
    }
  }

  public function executeUpdate($request)
  {
    
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
        if ($this->getUser()->isAuthenticated()) {
          $userid =  sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser');
        }else{
          $this->setTemplate('breadnav');
          $this->message = "You need to be logged in to edit a menu.";
          return sfView::ERROR;
        }        
    }else{
      $userid = null;
    }
    
   
         
    $this->forward404Unless($request->isMethod('post'));
    $this->form = new sfBreadNavApplicationForm(sfBreadNavApplicationPeer::retrieveByPk($request->getParameter('id')));
    $values = $request->getParameter('sf_bread_nav_application');
    $values['user_id'] = $userid;
    $this->form->bind($values);
    if ($this->form->isValid())
    {
      
      //echo $values['id'];
      //die();
      
      $this->form->updateObject();
      $sf_bread_nav_application = $this->form->save();
      
      $this->redirect('sfBreadNavAdmin/list');
             
    }

    $this->setTemplate('edit');
  }

  public function executeDelete($request)
  {

    if (sfBreadNavPeer::scopeowner($request->getParameter('id'))) {     
      $this->forward404Unless($sf_bread_nav_application = sfBreadNavApplicationPeer::retrieveByPk($request->getParameter('id')));
      $sf_bread_nav_application->delete();
      $this->redirect('sfBreadNavAdmin/list');
    }else{
      $this->setTemplate('breadnav');
      $this->message = "You need to be logged in to delete a menu.";
      return sfView::ERROR;
    }




  }
}
